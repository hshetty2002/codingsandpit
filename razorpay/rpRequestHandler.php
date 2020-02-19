<?php session_start(); // place it on the top of the script ?>

<html>
<head>
<title>Razorpay Payment</title>
    <style type="text/css">
    .razorpay-payment-button {
      background-color: #008CBA; 
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 12px;
    }
    </style>
</head>
<body>
<center>
 
<!--   If coming back from payment page, then go back to mailchimp index page (otherwise this will resubmit) -->
 
 <?php
 if(performance.navigation.type == 2){
   header('location:../index.php');
 }
 ?>
 
<?php 
 
// pull the variables out of the session
    $fname = $_SESSION['fname'];
    $standard = $_SESSION['standard'];
    $pfname = $_SESSION['pfname'];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];

?>
    <div class="container">
    <div class="text">
      <p>We have received your details, please Pay to complete the registration.</p>
      <p>We have pre-filled the credit card form with your details but you can change it if required.</p>
    </div>

<!--        data-key="rzp_test_0iFYQGkeOpElYh" //this key is for the Test mode
-->
    <form action="https://codingkidsnow.herokuapp.com/thankyou.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_live_6AuPzoSb8VdrBq" //this key is for the Live mode
        data-amount="142100" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        data-currency="INR"
        data-buttontext="Pay"
        data-prefill.name=<?php echo $pfname; ?>
        data-prefill.email=<?php echo $email; ?>
        data-prefill.contact=<?php echo $phone; ?>  
        data-notes.childname=<?php echo $fname; ?>
        data-notes.childstandard=<?php echo $standard; ?>
        data-notes.address="<?php echo $address; ?>"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
    </form>

</body>
</html>
