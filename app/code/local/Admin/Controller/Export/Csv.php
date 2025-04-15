<?php

class Admin_Controller_Export_Csv extends Core_Controller_Admin_Action{

    public function getCsvAction(){
        echo 'csv';
        $products = Mage::getModel('catalog/product')->getCollection()->getData();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="products.csv"');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        fputcsv($output, ['product_id', 'name', 'description', 'sku' , 'price' , 'stock_quantity' , 'category_id' , 'created_at' , 'updated_at']);

        // Write product data to CSV
        foreach ($products as $product) {
            fputcsv($output, [$product->getProductId(), $product->getName(), $product->getDescription(), 
                $product->getSku() , $product->getPrice(), $product->getStockQuantity(), $product->getCategoryId(), $product->getCreatedAt(), 
                    $product->getUpdatedAt()]);
        }

        // Close the stream
        fclose($output);
        exit;
    }

}

?>