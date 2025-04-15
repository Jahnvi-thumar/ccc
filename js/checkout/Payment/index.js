// Create a namespace for payment functions
var MyntraPayment = {
    init: function() {
        // Set up initial state based on pre-selected radio
        var selectedRadio = document.querySelector('.myntra-payment-radio:checked');
        if (selectedRadio) {
            this.selectPayment(selectedRadio.value);
        } else {
            this.selectPayment('cod'); // Default to COD
        }
        
        // Add event listeners to all payment options
        var paymentRadios = document.querySelectorAll('.myntra-payment-radio');
        paymentRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                MyntraPayment.selectPayment(this.value);
            });
        });
    },
    
    selectPayment: function(paymentType) {
        console.log("Selecting payment type:", paymentType);
        
        // Hide all payment details
        document.getElementById("card-details").style.display = "none";
        document.getElementById("upi-details").style.display = "none";
        
        // Remove active class from all options
        document.getElementById("card-option").classList.remove("myntra-payment-option-active");
        document.getElementById("upi-option").classList.remove("myntra-payment-option-active");
        document.getElementById("cod-option").classList.remove("myntra-payment-option-active");
        
        // Show selected payment details and add active class to selected option
        if (paymentType === "card") {
            document.getElementById("card-details").style.display = "block";
            document.getElementById("card-option").classList.add("myntra-payment-option-active");
        } else if (paymentType === "upi") {
            document.getElementById("upi-details").style.display = "block";
            document.getElementById("upi-option").classList.add("myntra-payment-option-active");
        } else if (paymentType === "cod") {
            document.getElementById("cod-option").classList.add("myntra-payment-option-active");
        }
    }
};

// Initialize the payment module when the DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    MyntraPayment.init();
    console.log("Payment module initialized");
});