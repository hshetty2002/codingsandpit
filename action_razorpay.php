<?php session_start(); // place it on the top of the script ?>
<?php
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $standard = $_POST['standard'];

    $agree = $_POST['agree'];
    
    if(!empty($standard) && $standard != 0){ $standard_ok = 1;} else { $standard_ok = 0;}
    if(!empty($agree) && ($agree === "YES")) { $agree_ok = 1;} else { $agree_ok = 0;}

    if($standard_ok && $agree_ok){

?>
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

<?php

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid standard and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['standard'] = $standard;

        header('location:index.php');
    }
}

?>
