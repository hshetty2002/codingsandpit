<?php session_start(); // place it on the top of the script ?>
<?php 
     $fname = $_SESSION['fname'];
    $standard = $_SESSION['standard'];
?>


<script
    src="https://checkout.razorpay.com/v1/razorpay.js"
    data-key="rzp_test_0iFYQGkeOpElYh"
    data-amount="142100" 
    data-currency="INR"
    data-notes.childname=<?php echo $fname; ?>
    data-notes.childstandard=<?php echo $standard; ?>
></script>