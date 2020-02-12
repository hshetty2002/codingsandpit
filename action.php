<?php session_start(); // place it on the top of the script ?>
<?php
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $standard = $_POST['standard'];

    $agree = $_POST['agree'];
    
    if(!empty($standard) && $standard != 0){ $standard_ok = 1;} else { $standard_ok = 0;}
    if(!empty($agree) && ($agree === "YES")) { $agree_ok = 1;} else { $agree_ok = 0;}

    if($standard_ok && $agree_ok){

        $_SESSION['fname'] = $fname;
        $_SESSION['standard'] = $standard;
        header('location:razorpay/rpRequestHandler.php');

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid standard and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['standard'] = $standard;

        header('location:index.php');
    }
}

?>
