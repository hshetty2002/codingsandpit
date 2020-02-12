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

?>

<!--
	<form method="post" name="redirect" target='_parent' action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
	<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
	?>
	</form>
	<script language='javascript'>document.redirect.submit();</script>

-->

    <form action="https://codingkidsnow.herokuapp.com/thankyou.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_0iFYQGkeOpElYh" //this key is for the Test mode
        data-amount="142100" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        data-currency="INR"
        data-notes.childname=<?php echo $fname; ?>
        data-notes.childstandard=<?php echo $standard; ?>
    ></script>
    </form>
	<script language='javascript'>document.redirect.submit();</script>

<!-- Old

    <form action="https://codingkidsnow.herokuapp.com/thankyou.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_0iFYQGkeOpElYh" //this key is for the Test mode
        data-amount="142100" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
        data-currency="INR"
        data-buttontext="Pay with Razorpay"
        data-notes.childname=<?php echo $fname; ?>
        data-notes.childstandard=<?php echo $standard; ?>
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
    </form>


-->




</center>

</body>
</html>
