
        function selectPayment(paymentType) {
            document.getElementById("card-details").style.display = paymentType === "card" ? "block" : "none";
            document.getElementById("upi-details").style.display = paymentType === "upi" ? "block" : "none";
        }
 