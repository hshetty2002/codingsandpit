<?php
session_start();
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
//    $phone = $_POST['phone'];
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    
    $agree = $_POST['agree'];
    
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){ $email_ok = 1;} else { $email_ok = 0;}
    if(!empty($phone) && strlen($phone) === 10){ $phone_ok = 1;} else { $phone_ok = 0;}

    if(!empty($agree) && ($agree === "YES")) { $agree_ok = 1;} else { $agree_ok = 0;}

    if($email_ok && $phone_ok && $agree_ok){

        ?>
        <button id="rzp-button1">Pay</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
        var options = {
            "key": "rzp_test_0iFYQGkeOpElYh", // Enter the Key ID generated from the Dashboard
            "amount": "142100", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
            "currency": "INR",
//            "name": "Acme Corp",
//            "description": "A Wild Sheep Chase is the third novel by Japanese author  Haruki Murakami",
//            "image": "https://example.com/your_logo",
//            "order_id": "order_9A33XWu170gUtm",//This is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order). Refer the Checkout form table given below
            "handler": function (response){
                alert(response.razorpay_payment_id);
            },
            "prefill": {
                "name": $fname,
                "email": $email,
                "contact": $phone
            },
            "notes": {
                "child's name": "child's name",
                "child's grade": "child's grade"
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
        </script>
<?php        

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address, valid phone number and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        header('location:index.php');
    }
}

?>
