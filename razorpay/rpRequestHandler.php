<?php session_start(); // place it on the top of the script ?>

<html>
<head>
<title>Razorpay Payment</title>
</head>
<body>
<center>
 
<!--   If coming back from ccavenue payment page, then go back to mailchimp index page (otherwise this will resubmit) -->
 
 <?php
 if(performance.navigation.type == 2){
//   	location.reload(true);
   header('location:../index.php');
 }
 ?>
 
<?php 
 
// pull the variables out of the session
    $fname = $_SESSION['fname'];
    $standard = $_SESSION['standard'];


    <script type="text/javascript" src="https://checkout.razorpay.com/v1/razorpay.js">
    var razorpay = new Razorpay({
      key: 'rzp_test_0iFYQGkeOpElYh',
    });

    var data = {
      amount: 1000, // in currency subunits. Here 1000 = 1000 paise, which equals to ₹10
      currency: "INR"// Default is INR. We support more than 90 currencies.
      email: 'gaurav.kumar@example.com',
      contact: '9123456780',
      notes: {
        address: 'Ground Floor, SJR Cyber, Laskar Hosur Road, Bengaluru',
      },
    };
    
    $btn.on('click', function(){
      // has to be placed within user initiated context, such as click, in order for popup to open.
      razorpay.createPayment(data);
    
      razorpay.on('payment.success', function(resp) {
        alert(resp.razorpay_payment_id),
        alert(resp.razorpay_order_id),
        alert(resp.razorpay_signature)}); // will pass payment ID, order ID, and Razorpay signature to success handler.
    
      razorpay.on('payment.error', function(resp){alert(resp.error.description)}); // will pass error object to error handler
    
    })
    </script>


</center>

</body>
</html>
