<?php

class Page_Block_Header extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('page/header.phtml');
    }

    public function getCategory(){

        $category = Mage::getModel('catalog/category')->getCollection()->getData();
        return $category;
    }

    public function getNavLinks(){

        $admin_id = Mage::getSingleton('core/session')->get('login');
        $user = Mage::getSingleton('admin/user')->load($admin_id);
        $role = Mage::getSingleton('admin/role')->load($user->getRoleId());
        $permissions = json_decode($role->getPermissions());
        return $permissions;
        
    }

    function generateCategoryDropdowns($categories) {
        // Organize categories into a hierarchical structure
        $mainCategories = [];
        $subCategories = [];

        
        // First pass: separate main and sub categories
        foreach ($categories as $category) {
          
            $categoryData = $category->getData();
            $categoryId = $categoryData['category_id'];
            $parentId = $categoryData['parent_id'];
            
            if (empty($parentId)) {
                // This is a main category
                $mainCategories[$categoryId] = $categoryData;
                // Initialize children array
                $mainCategories[$categoryId]['children'] = [];
            } else {
                // This is a sub-category
                $subCategories[$categoryId] = $categoryData;
            }
        }
        
        // Second pass: organize sub-categories under their parents
        foreach ($subCategories as $categoryId => $categoryData) {
            $parentId = $categoryData['parent_id'];
            if (isset($mainCategories[$parentId])) {
                // This is a direct child of a main category
                $mainCategories[$parentId]['children'][$categoryId] = $categoryData;
                // Initialize children array for the sub-category
                $mainCategories[$parentId]['children'][$categoryId]['children'] = [];
            } else {
                // This is a child of a sub-category
                foreach ($mainCategories as &$mainCategory) {
                    foreach ($mainCategory['children'] as $subCategoryId => &$subCategory) {
                        if ($subCategoryId == $parentId) {
                            $subCategory['children'][$categoryId] = $categoryData;
                        }
                    }
                }
            }
        }
        
        // Generate the HTML for all dropdown menus
        $html = '';
        
        // Array of main categories we want to create dropdowns for
        $targetCategories = ['Men', 'Women', 'Kids', 'Home & Living', 'Beauty'];
        
        foreach ($targetCategories as $targetCategory) {
            // Find the category ID for this main category
            $categoryId = null;
            foreach ($mainCategories as $id => $category) {
                if ($category['name'] == $targetCategory) {
                    $categoryId = $id;
                    break;
                }
            }
            
            if ($categoryId && isset($mainCategories[$categoryId])) {
                // Determine CSS class based on category name
                $cssClass = strtolower(str_replace(' & ', '', str_replace(' ', '', $targetCategory)));
                
                // Set color based on category
                $colorCode = '#fb56c1'; // Default pink
                if ($targetCategory == 'Men') {
                    $colorCode = '#ee5f73'; // Red for Men
                } elseif ($targetCategory == 'Kids') {
                    $colorCode = '#f26a10'; // Orange for Kids
                } elseif ($targetCategory == 'Home & Living') {
                    $colorCode = '#0db7af'; // Teal for Home & Living
                } elseif ($targetCategory == 'Beauty') {
                    $colorCode = '#ff3e3e'; // Bright red for Beauty
                }
                
                $html .= '<div class="myntra-dropdown ' . $cssClass . '-dropdown">';
                
                // Get all subcategories of this category
                $subcategories = $mainCategories[$categoryId]['children'];
                
                // Group subcategories into columns (maximum 5 columns)
                $columnsCount = min(5, ceil(count($subcategories) / 4)); 
                
                // Check if there are any subcategories first
                if (empty($subcategories)) {
                  // No subcategories to display, skip this category or display a message
                  $html .= '<div class="myntra-dropdown-column">';
                  $html .= '<div class="myntra-category-section">';
                  $html .= '<p>No subcategories available for ' . htmlspecialchars($targetCategory) . '</p>';
                  $html .= '</div>';
                  $html .= '</div>';
                } else {
                  // Original code for when subcategories exist
                  $columnsCount = min(5, ceil(count($subcategories) / 4));
                  $subcategoriesPerColumn = ceil(count($subcategories) / $columnsCount);
                  
                  // Rest of your columns and category rendering logic...
                }
                
                
                // Aim for ~4 categories per column
                // $subcategoriesPerColumn = ceil(count($subcategories) / $columnsCount);
                
                $columnCounter = 0;
                $categoryCounter = 0;
                
                foreach ($subcategories as $subcategoryId => $subcategory) {
                    if ($categoryCounter % $subcategoriesPerColumn == 0) {
                        // Start a new column
                        if ($categoryCounter > 0) {
                            $html .= '</div>'; // Close previous column
                        }
                        $html .= '<div class="myntra-dropdown-column">';
                        $columnCounter++;
                    }
                    
                    $html .= '<div class="myntra-category-section">';
                    $html .= '<h3 class="myntra-category-title" style="color: ' . $colorCode . ';">' . 
                        htmlspecialchars($subcategory['name']) . '</h3>';
                    $html .= '<ul class="myntra-category-list">';
                    
                    // Add child categories if they exist
                    if (isset($subcategory['children']) && !empty($subcategory['children'])) {
                        foreach ($subcategory['children'] as $childId => $child) {
                            // $url = strtolower(str_replace(' ', '-', $cssClass . '/' . 
                            //     preg_replace('/[^a-zA-Z0-9\s]/', '', $child['name'])) . '.php');
                                
                                $url3 = $this->getUrl('catalog/product/list').'/?categoryid=' . $child['category_id'];
                                
                           
                            $html .= '<li class="myntra-category-item">';
                            $html .= '<a href="' . $url3 . '" class="myntra-category-link">' . 
                                htmlspecialchars($child['name']) . '</a>';
                            $html .= '</li>';
                        }
                    } else {
                        // If no children, create a single item for the subcategory itself
                        // $url = strtolower(str_replace(' ', '-', $cssClass . '/' . 
                        //     preg_replace('/[^a-zA-Z0-9\s]/', '', $subcategory['name'])) . '.php');
                        
                        $url3 = $this->getUrl('catalog/product/list').'/?categoryid=' . $subcategory['category_id'];

                        $html .= '<li class="myntra-category-item">';
                        $html .= '<a href="' . $url3 . '" class="myntra-category-link">' . 
                            htmlspecialchars($subcategory['name']) . '</a>';
                        $html .= '</li>';
                    }
                    
                    $html .= '</ul>';
                    $html .= '</div>'; // Close myntra-category-section
                    
                    $categoryCounter++;
                }
                
                $html .= '</div>'; // Close last column
                $html .= '</div>'; // Close myntra-dropdown
            }
        }
        
        return $html;
    }
}

?>