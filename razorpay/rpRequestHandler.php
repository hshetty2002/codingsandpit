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

?>

    <form action="https://codingkidsnow.herokuapp.com/thankyou.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_0iFYQGkeOpElYh" //this key is for the Test mode
        data-amount="142100" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        data-currency="INR"
        data-buttontext="Pay"
        data-notes.childname=<?php echo $fname; ?>
        data-notes.childstandard=<?php echo $standard; ?>
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
    </form>

</body>
</html>
