
// // At the top of filter.js
// console.log('filter.js');
// import $ from 'jquery';
//     class CategoryFilter {
//         constructor() {
//             console.log('Constructor called');
//             this.init();
//         }

//         init() {
//             // Use event delegation to handle dynamically added elements
//             $(document).on('change', '.filter-checkbox', () => this.applyFilter());
//             // $('.filter-checkbox, .filter-price').on('input', this.fetchFilteredProducts);

//         }

//         getSelectedCategories() {
//             let selectedCategories = [];
//             $('.filter-checkbox:checked').each(function () {
//                 selectedCategories.push($(this).val());
//             });
//             return selectedCategories;
//         }

//         collectFilterData() {
//             let filters = {};
//             $('.filter-checkbox:checked').each(function() {
//                 let name = $(this).attr('name');
//                 // console.log('name : ');
//                 // console.log(name);
//                 if (!filters[name]) {
//                     filters[name] = [];
//                 }
//                 filters[name].push($(this).val());
//             });
//             console.log('filters : ');
//             console.log(filters);
//             return filters;
//         }

//         applyFilter() {
//             let formData = this.collectFilterData();
//             let selectedCategories = this.getSelectedCategories().join(",");
            
//             console.log('Applying filter...');
//             console.log('Selected input fields:', formData);

//             // Ensure jQuery is available before making the request
//             if (typeof jQuery === "undefined" || typeof $.ajax === "undefined") {
//                 console.error("Error: jQuery is not loaded.");
//                 return;
//             }

//             $.ajax({
//                 url: 'http://localhost/mvc_copy/catalog/product/list/',
//                 type: 'GET',
//                 data: formData,
//                 success: (response) => {
//                     console.log('Response received:', response);
//                     $('.product-grid').html(response);
//                 },
//                 error: (xhr, status, error) => {
//                     console.error('AJAX Error:', error);
//                 }
//             });
//         }
//     }

//     // Initialize the class when the document is ready
//     // $(document).ready(() => {
//     //     new CategoryFilter();
//     // });

//     // Wrap your initialization in a function that checks for jQuery
// function initCategoryFilter() {
//     if (typeof jQuery !== 'undefined') {
//         new CategoryFilter();
//     } else {
//         // If jQuery isn't loaded yet, wait a bit and try again
//         setTimeout(initCategoryFilter, 100);
//     }
// }

// // Start the initialization process when the page is ready
// if (document.readyState === 'complete' || document.readyState === 'interactive') {
//     initCategoryFilter();
// } else {
//     document.addEventListener('DOMContentLoaded', initCategoryFilter);
// }








class CategoryFilter {
    constructor() {
        // Check if jQuery is available before proceeding
        if (typeof jQuery === "undefined") {
            console.error("Error: jQuery is not loaded. CategoryFilter cannot initialize.");
            return;
        }
        
        console.log('Constructor called');
        this.init();
    }
    
    init() {
        // Use event delegation to handle dynamically added elements
        $(document).on('change', '.filter-checkbox', () => this.applyFilter());
        // $('.filter-checkbox, .filter-price').on('input', this.fetchFilteredProducts);
    }
    
    getSelectedCategories() {
        let selectedCategories = [];
        $('.filter-checkbox:checked').each(function () {
            selectedCategories.push($(this).val());
        });
        return selectedCategories;
    }
    
    collectFilterData() {
        let filters = {};
        $('.filter-checkbox:checked').each(function() {
            let name = $(this).attr('name');
            // console.log('name : ');
            // console.log(name);
            if (!filters[name]) {
                filters[name] = [];
            }
            filters[name].push($(this).val());
        });
        console.log('filters : ');
        console.log(filters);
        return filters;
    }
    
    applyFilter() {
        let formData = this.collectFilterData();
        let selectedCategories = this.getSelectedCategories().join(",");
        
        console.log('Applying filter...');
        console.log('Selected input fields:', formData);
        
        // Ensure jQuery is available before making the request
        if (typeof jQuery === "undefined" || typeof $.ajax === "undefined") {
            console.error("Error: jQuery is not loaded.");
            return;
        }
        
        $.ajax({
            url: 'http://localhost/mvc_copy/catalog/product/list/',
            type: 'GET',
            data: formData,
            success: (response) => {
                console.log('Response received:', response);
                $('.product-grid').html(response);
            },
            error: (xhr, status, error) => {
                console.error('AJAX Error:', error);
            }
        });
    }
}

// Initialization function
function initCategoryFilter() {
    if (typeof jQuery !== 'undefined') {
        new CategoryFilter();
    } else {
        console.log("jQuery not found, retrying in 100ms...");
        setTimeout(initCategoryFilter, 100);
    }
}

// Start the initialization process
if (document.readyState === 'complete' || document.readyState === 'interactive') {
    initCategoryFilter();
} else {
    document.addEventListener('DOMContentLoaded', initCategoryFilter);
}