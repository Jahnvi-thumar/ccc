

// let validateInputs = new validate();
document.addEventListener('DOMContentLoaded', function() {
// Form elements
    const addressForm = document.getElementById('addressForm');
    const sameAddressCheckbox = document.getElementById('same_address');
    const shippingSection = document.getElementById('shipping_section');
    
    // Toggle shipping address section visibility
    if (sameAddressCheckbox && shippingSection) {
        // Initially hide shipping address section if checkbox is checked
        if (sameAddressCheckbox.checked) {
            shippingSection.classList.add('hidden');
        }
        
        sameAddressCheckbox.addEventListener('change', function() {
            if (this.checked) {
                shippingSection.classList.add('hidden');
            } else {
                shippingSection.classList.remove('hidden');
            }
        });
    }

    // let validateInputs = new validate();
});


