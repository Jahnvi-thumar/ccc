<?php

class Admin_Controller_Product_Index extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['list' , 'new', 'save' , 'save3' , 'delete'];
    public function newAction(){
        
        $layout = Mage::getBlock('Core/Layout');
        $new = $layout->createBlock('Admin/Product_Index_new')
                      ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new' , $new);
        $layout->getChild('head')->addCss('main2.css');
        $layout->toHtml();

        
    }

    public function listAction(){
       
        $layout = Mage::getBlock('Core/Layout');
        
        $list = $layout->createBlock('Admin/Product_Index_list')
                ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list' , $list);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml(); 
    }

    public function saveAction(){

        
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $product->setData($request->getParam('catalog_product'));
        $product->save();

        die;
        header('Location: http://localhost/mvc_copy/admin/product_index/list');
        exit;
        
    }

    public function save2gftyhnAction()
    {
        $pro_attr = [];
        $request = Mage::getModel('Core/Request');

        $product = Mage::getModel('catalog/product');
        $product->setData($request->getParam('catalog_product'));
        $product->save();
        $product_id = $product->getProductId();

        $product_attributes = Mage::getModel('catalog/product_attribute');
        $product_attributes_data = $request->getParam('catalog_product_attribute');
        
        foreach ($product_attributes_data as $key => $value) {
        
           $pro_attr_data =  Mage::getModel('catalog/attribute')->load($key , 'name');
           $pro_attr['attribute_id'] = $pro_attr_data->getAttributeId();
           $pro_attr['product_id'] = $product_id;
           $pro_attr['value'] = $value;
           $product_attributes->setData($pro_attr)->save();
           
        }

        if (!empty($_FILES['catalog_media_gallery']['name'][0])) {
            $uploadDir = Mage::getBaseDir() . "/media/Product/";

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $mediaGallery = Mage::getModel('catalog/media_gallery');

            foreach ($_FILES['catalog_media_gallery']['name'] as $key => $imgName) {
                if ($_FILES['catalog_media_gallery']['error'][$key] == 0) {
                    $tmpFilePath = $_FILES['catalog_media_gallery']['tmp_name'][$key];
                    $type = $_FILES['catalog_media_gallery']['type'][$key];
                    $fileName = time() . "_" . basename($imgName);
                    $uploadFilePath = $uploadDir . $fileName;

                    echo $uploadFilePath;
                    if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
                        $filePath = "media/Product/" . $fileName;

                        $mediaGallery->setData([
                            'product_id' => $product_id,
                            'file_path' => $filePath,
                            'type' => $type,
                        ]);
                        // echo '<pre>';
                        // echo '</pre>';
                        $mediaGallery->save();
                    }
                }
            }
        }
        die();
        header('Location: http://localhost/mvc_copy/admin/product_index/list');
        exit;
    }

    public function deleteAction(){


        $request = Mage::getModel('Core/Request');
        $product = Mage::getModel('catalog/product');
        $id = $request->getQuery('id');
        $product->load($id);
        $img = $product->getImage();    
        
        if($img){
            unlink($img);
        }
       
        $product->delete();
        

        header('Location: http://localhost/mvc_copy/admin/product_index/list');
        exit;
  
    }
}

?>