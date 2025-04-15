<?php

class Catalog_Model_Product extends Core_Model_Abstract{


    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];

    public function init()
    {

        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_collectionClass = "Catalog_Model_Resource_Product_Collection";
    }

    public function getStatusText(){
        
        $sta = $this->getStatus();

       if(isset($this->status[$this->getStatus()])){
        
          return $this->status[$this->getStatus()];
       } else {
        return "NA";
       }
    }

    protected function _afterLoad()
    {
        if ($this->getProductId()) {

            $collection = Mage::getModel("catalog/product_Attribute")
                ->getCollection()
                ->addFieldToFilter("product_id", $this->getProductId())
                ->joinLeft(["attr" => "catalog_attribute"], "attr.attribute_id = main_table.attribute_id", ["name" => "name"]);

            $imagescollection = Mage::getModel("catalog/media_gallery")
                                    ->getCollection()
                                    ->addFieldToFilter("product_id", $this->getProductId());

           
            foreach ($collection->getData() as $_data) {
                $this->{$_data->getName()} = $_data->getValue();
            }

            $filepaths = [];

            foreach ($imagescollection->getData() as $image) {
                $filepaths[] = $image->getFilePath();
            }

            $this->_data['filepath'] = $filepaths;

        }
        
        return $this;
    }

    protected function _afterSave(){

        
        $attributes = Mage::getModel('catalog/attribute')
                            ->getCollection()
                            ->getData();

        foreach($attributes as $_attribute){

            $product_attribute = Mage::getModel(('catalog/product_attribute'))
                                        ->getCollection()
                                        ->addFieldToFilter('product_id', $this->getProductId())
                                        ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                                        ->getData();
           
           $value = $this->{$_attribute->getName()};

           if(isset($product_attribute[0])){

                $product_attribute[0]->setValue($value)
                    ->save();               
           } else {

                Mage::getModel('catalog/product_attribute')
                ->setAttributeId($_attribute->getAttributeId())
                ->setProductId($this->getProductId())
                ->setValue($value)
                ->save();
           }

        }

        if (!empty($_FILES['catalog_product']['name'][0])) {
            $uploadDir = Mage::getBaseDir() . "/media/Product/";

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['catalog_product']['name'] as $key => $imgName) {

                if ($_FILES['catalog_product']['error'][$key] == 0) {
                    $tmpFilePath = $_FILES['catalog_product']['tmp_name'][$key];
                    $type = $_FILES['catalog_product']['type'][$key];
                    $fileName = time() . "_" . basename($imgName);
                    $uploadFilePath = $uploadDir . $fileName;

                    

                    // echo $uploadFilePath;
                    if (move_uploaded_file($tmpFilePath, $uploadFilePath)) {
                        $filePath = "media/Product/" . $fileName;
                            // echo $filePath;
                        $catalog_media_gallery = Mage::getModel('catalog/media_gallery')
                                                ->getCollection()
                                                ->addFieldToFilter('product_id', $this->getProductId())
                                                ->addFieldToFilter('file_path', $filePath)
                                                ->getData();

                        

                        

                        if(isset($catalog_media_gallery[0])){

                            $catalog_media_gallery[0]->setFilePath($filePath)
                                ->save();               
                        } else {

                                Mage::getModel('catalog/media_gallery')
                                    ->setProductId($this->getProductId())
                                    ->setFilePath($filePath)
                                    ->setType($type)
                                    ->save();
                        }
                        
                    }
                }
            }
        }
    }
    

    
}
?>