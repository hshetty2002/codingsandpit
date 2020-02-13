<?php session_start(); // place it on the top of the script ?>
<?php
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $standard = $_POST['standard'];
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    $pfname = $_POST['pfname'];
    $email = $_POST['email'];

    $agree = $_POST['agree'];
    
    if(!empty($standard) && $standard != 0){ $standard_ok = 1;} else { $standard_ok = 0;}
    if(!empty($agree) && ($agree === "YES")) { $agree_ok = 1;} else { $agree_ok = 0;}
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){ $email_ok = 1;} else { $email_ok = 0;}
    if(!empty($phone) && strlen($phone) === 10){ $phone_ok = 1;} else { $phone_ok = 0;}
    
    if($standard_ok && $agree_ok && $email_ok && $phone_ok){

        $_SESSION['fname'] = $fname;
        $_SESSION['standard'] = $standard;
        $_SESSION['pfname'] = $pfname;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        header('location:razorpay/rpRequestHandler.php');

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid standard, email, phone and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['standard'] = $standard;
        $_SESSION['pfname'] = $pfname;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;

        header('location:index.php');
    }
}

?>
