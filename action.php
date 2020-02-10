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
        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone("Asia/Calcutta"));
        $order = "CODINGKIDS" . $date->format('YmdHis');

		$keyvaluepairs['amount'] = "99";
//		$keyvaluepairs['amount'] = "1421";
		$keyvaluepairs['merchant_id'] = "190296";
		$keyvaluepairs['order_id'] = $order;
		$keyvaluepairs['currency'] = "INR";
		$keyvaluepairs['redirect_url'] = "https://codingkidsnow.herokuapp.com/ccavenue/ccavResponseHandler.php";
		$keyvaluepairs['cancel_url'] = "https://codingkidsnow.herokuapp.com/ccavenue/ccavResponseHandler.php";
		$keyvaluepairs['language'] = "EN";
		
        $_SESSION['keyvaluepairs'] = $keyvaluepairs;

        $_SESSION['fname'] = $fname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        header('location:../ccavenue/ccavRequestHandler.php');

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address, valid phone number and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        header('location:index.php');
    }
}

?>
