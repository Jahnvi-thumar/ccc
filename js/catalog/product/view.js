

//     class addToCart{

        
//         constructor(){
//             console.log('constructor called');
//             this.init();
//         }

//         init(){
//             console.log('init');
//             let ele = document.querySelector(".spd__add-to-bag .addtocart");
//             console.log(ele);
//             // $(document).on('click' , '.spd__add-to-bag' , () => this.goToCart());

//             $(document).on('click', '.spd__add-to-bag .addtocart', (event) => {
//                 event.preventDefault(); // Prevents default form submission if inside a form
//                 this.goToCart();
//             });
//         }

//         collectFormData(){

//             let form = $('form#cartform')[0];
//             console.log('form: ', form);
//             let formData = new FormData(form);
//             console.log('formData');
//             console.log(formData);

//             for(let pair of formData.entries()){
//                 console.log(pair[0], pair[1]);
//             }
//             return formData;
//         }

//         goToCart(){
//             console.log('goToCart called');

//             let formData = this.collectFormData();

//             if (typeof jQuery === "undefined" || typeof $.ajax === "undefined") {
//                 console.error("Error: jQuery is not loaded.");
//                 return;
//             }

//             $.ajax({
//                 url: 'http://localhost/mvc_copy/checkout/cart/add/',
//                 method: 'POST',
//                 data: formData,
//                 processData: false,  // ✅ Prevent jQuery from processing FormData
//                 contentType: false, 
//                 success: (response) => {
//                     console.log('Response received:', response);
//                 },
//                 error: (xhr, status, error) => {
//                     console.error('AJAX Error:', error);
//                 }
//             });
//         }
//     }

//     $(document).ready(() => {
//         new addToCart();
//     })
// // });








class AddToCart {
    constructor() {
        // Check if jQuery is available
        if (typeof jQuery === "undefined") {
            console.error("Error: jQuery is not loaded. AddToCart cannot initialize.");
            return;
        }
        
        console.log('constructor called');
        this.init();
    }
    
    init() {
        console.log('init');
        let ele = document.querySelector(".spd__add-to-bag .addtocart");
        console.log(ele);
        
        $(document).on('click', '.spd__add-to-bag .addtocart', (event) => {
            event.preventDefault(); // Prevents default form submission if inside a form
            this.goToCart();
        });
    }
    
    collectFormData() {
        let form = $('form#cartform')[0];
        console.log('form: ', form);
        let formData = new FormData(form);
        console.log('formData');
        console.log(formData);
        
        for(let pair of formData.entries()) {
            console.log(pair[0], pair[1]);
        }
        return formData;
    }
    
    goToCart() {
        console.log('goToCart called');
        
        let formData = this.collectFormData();
        
        if (typeof jQuery === "undefined" || typeof $.ajax === "undefined") {
            console.error("Error: jQuery is not loaded.");
            return;
        }
        
        $.ajax({
            url: 'http://localhost/mvc_copy/checkout/cart/add/',
            method: 'POST',
            data: formData,
            processData: false,  // ✅ Prevent jQuery from processing FormData
            contentType: false,
            success: (response) => {
                console.log('Response received:', response);
            },
            error: (xhr, status, error) => {
                console.error('AJAX Error:', error);
            }
        });
    }
}

// Initialization function with retry mechanism
function initAddToCart() {
    if (typeof jQuery !== 'undefined') {
        new AddToCart();
    } else {
        console.log("jQuery not found, retrying in 100ms...");
        setTimeout(initAddToCart, 100);
    }
}

// Start the initialization process
if (document.readyState === 'complete' || document.readyState === 'interactive') {
    initAddToCart();
} else {
    document.addEventListener('DOMContentLoaded', initAddToCart);
}