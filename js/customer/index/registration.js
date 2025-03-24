

    class register{

        constructor(){
            console.log('constructor called');
            this.init();
        }

        init(){

            console.log('init called');
            let element = document.getElementById('email');
           
            element.addEventListener('blur' , (event) => {
                event.preventDefault();
                this.checkEmailExist();
            })
        }

        collectFormData(){
            let email = $('#email');
            let value = email.val();
            return value;
            // console.log(email);
            // console.log('value : ', email.val());
        }

        checkEmailExist(){
            console.log('checkEmailExist called');
            let emailval = this.collectFormData();

            if (typeof jQuery === "undefined" || typeof $.ajax === "undefined") {
                console.error("Error: jQuery is not loaded.");
                return;
            }

            $.ajax({
                url: 'http://localhost/mvc_copy/customer/index/registrationPost',
                type: 'POST',
                data: {email: emailval},
                success: (response) => {
                    console.log('Response received:', response);
                    if(response == '1'){
                        //allow for registration
                    } else {
                        let div = $('#email');
                        console.log('div' , div);

                        $('.error-email-msg').remove();
                        let errorDiv = $('<div class="error-email-msg" style="color: red; font-size: 14px;">User is already registered.</div>');
                        console.log('errordiv' , errorDiv);
                        div.after(errorDiv);

                        $(".submit-btn").prop("disabled", true).css({
                            "opacity": "0.5",
                            "cursor": "not-allowed"
                        });
                    }
                },
                error: (xhr, status, error) => {
                    console.error('AJAX Error:', error);
                }
            });
        }
    }

    $(document).ready(() => {
        new register();
    })
