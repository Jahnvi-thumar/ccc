<?php

class Admin_Controller_Category_Index {

    public function newAction(){

        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $new = $layout->createBlock('Admin/Category_Index_new')
                      ->setTemplate('admin/category/index/new.phtml');
        $layout->getChild('content')->addChild('new' , $new);
        $layout->getChild('head')->addCss('main2.css');
        $layout->toHtml();
    }

    public function listAction(){
        
    }

    public function deleteAction(){
        
    }

    public function saveAction(){
        $request = Mage::getModel('Core/Request');
        $category = Mage::getModel('catalog/category');
   
    $request->getParam('catalog_category');

        $category->setData($request->getParam('catalog_category'));
        // $oldimg = $category->getImage();
       
        
        // if (isset($_FILES['catlog_product']['name']['image']) && $_FILES['catlog_product']['error']['image'] == 0) {
        //     $uploadDir = Mage::getBaseDir() . "/media/Product/";

        //     if (!file_exists($uploadDir)) {
        //         mkdir($uploadDir, 0777, true);
        //     }

        //     $fileName = time() . "_" . basename($_FILES['catlog_product']['name']['image']);
        //     $uploadFilePath = $uploadDir . $fileName;
        //     $tmpFilePath = $_FILES['catlog_product']['tmp_name']['image'];

        //     if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
        //         // $data['image'] = "media/Product/" . $fileName;
        //         $filePath = "media/Product/" . $fileName;
        //         $product->setImage($filePath);
        //     }
        // }

        // $newimg = $product->getImage();

        // if($oldimg && $oldimg != $newimg){
        //     unlink($oldimg);
        // }

        $category->save();

        header('Location: http://localhost/mvc_copy/admin/category_index/list');
        exit;
    }
}
?>