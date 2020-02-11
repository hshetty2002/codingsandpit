<?php session_start(); // place it on the top of the script ?>
<?php
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
<!--        <form action="https://www.codingkidsnow.com/thank-you" method="POST">
-->        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="rzp_test_0iFYQGkeOpElYh" // Enter the Key ID generated from the Dashboard
            data-amount="142100" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
            data-currency="INR"
            data-buttontext="Pay with Razorpay"
            data-prefill.name=<?php echo $fname; ?>
            data-prefill.email=<?php echo $email; ?>
            data-prefill.contact=<?php echo $phone; ?>
            data-notes.childsname="Child's name"
            data-notes.childsgrade="Child's grade"
        ></script>
<!--        <input type="hidden" custom="Hidden Element" name="hidden">
-->        </form>

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
