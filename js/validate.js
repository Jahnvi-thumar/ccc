class validate{

    
    constructor(formData){

        console.log('validate class is loaded');
        this.form = formData;
        // console.log('Form:', this.form);
        if (!this.form) {
            console.error('Form is undefined. Make sure you pass a valid form element.');
            return;
        }
        this.validationRules = {
            "validate-email": this.validateEmail.bind(this),
            "validate-number": this.validateNumber.bind(this),
            "validate-name": this.validateName.bind(this),
            "validate-address": this.validateAddress.bind(this),
            "validate-zipcode": this.validateZipcode.bind(this),
            "validate-required": this.validateRequired.bind(this)
        };
        this.observeInputs();
        this.setupFormSubmission();

    }
   
    validateEmail(input) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(input.value) ? "" : 'Please enter a valid email address';
    }

    validateName(input){
        const namePattern = /^[a-zA-Z\s]+$/;
        return namePattern.test(input.value) ? "" : 'Please enter only letters';
    }

    
    validateNumber(input) {
        return /^\d+$/.test(input.value) ? "" : "Only numbers allowed";
    }

    
    validateRequired(input) {
        return input.value.trim() ? "" : "This field is required";
    }

    validateAddress(input){
        const addressPattern = /[^\w\s-]/;
        return addressPattern.test(input.value) ? "" : 'Please enter a valid address';
    }

    validateZipcode(input){

        if (!/^\d{6}$/.test(input.value)) return 'Pincode must be exactly 6 digits';
        if (value[0] === '0') return 'First digit cannot be 0';
                        
    }

    observeInputs() {
        this.form.addEventListener('input' , (event) => {
            if(event.target.tagName === 'INPUT' || event.target.tagName === 'SELECT'){
                // console.log('input event called : ' , event.target);
                this.validateInput(event.target);
            }
        })

        let observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    // console.log('observer called');
                    if(node.tagName === 'INPUT' || node.tagName === 'SELECT') {
                        // console.log('observer is noticed');
                        // console.log('Node:', node);
                        this.validateInput(node)};
                });
            });
        });

        observer.observe(this.form, { childList: true, subtree: true });
    }

    validateInput(input){

        let errorMessage = "";
        Object.keys(this.validationRules).forEach((rule) => {
            if (input.classList.contains(rule)) {
                let error = this.validationRules[rule](input);
                if (error) errorMessage = error;
            }
        });

        this.showError(input, errorMessage);
        this.toggleSubmitButton();

    }

    showError(input, message) {
        // console.log('show error');
        
        let errorDiv = input.parentNode.querySelector(".error-message");
        
        if (!errorDiv) {
            errorDiv = document.createElement("div");
            errorDiv.classList.add("error-message", "text-danger", "mt-1");
            input.parentNode.appendChild(errorDiv);
        }
        
        // console.log('Setting error message:', message);
        errorDiv.textContent = message;
        
    }

    toggleSubmitButton() {
        const errorMessages = this.form.querySelectorAll(".error-message");
        // console.log('Error messages found:', errorMessages.length);
        
        let isValid = true;
        
        errorMessages.forEach(errorDiv => {
            // console.log('Error message content:', errorDiv.textContent);
            if (errorDiv.textContent.trim() !== "") {
                isValid = false;
                // console.log('Found invalid input with message:', errorDiv.textContent);
            }
        });
    
        const submitButton = this.form.querySelector("button[type='submit']");
        // console.log('Submit button found:', submitButton);
        
        if (submitButton) {
            // console.log('Setting button disabled state to:', !isValid);
            submitButton.disabled = !isValid;
            submitButton.style.opacity = !isValid ? "0.5" : "1";
        }
    }

    setupFormSubmission() {
        this.form.addEventListener("submit", (event) => {
            let isValid = true;
            const allInputs = this.form.querySelectorAll("input");

            allInputs.forEach((input) => {
                this.validateInput(input);
                if (input.nextElementSibling && input.nextElementSibling.textContent !== "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault(); 
                alert("Please fix validation errors before submitting.");
            }
        });
    }
    
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form.triggeronsubmit").forEach((form) => {
        // console.log('-----Form:', form);
        new validate(form);
    });
});
