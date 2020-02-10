<?php
session_start();
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
//    $phone = $_POST['phone'];
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    
    $duedate = $_POST['duedate'];
    $agree = $_POST['agree'];
    
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){ $email_ok = 1;} else { $email_ok = 0;}
    if(!empty($phone) && strlen($phone) === 10){ $phone_ok = 1;} else { $phone_ok = 0;}

    if(!empty($duedate)) {
        $today = date('d-m-Y',time()); 
        $todayDate = date_create($today);
        $due = date('d-m-Y', strtotime($duedate));
        $duedateDate = date_create($due);
        $diff =  date_diff($todayDate, $duedateDate);

        // No messages the first 3 weeks and last message is numbered 280
        if(($diff->days > 10) && ($diff->days < 260)){
             $duedate_ok = 1;
        } else $duedate_ok = 0;
    } else $duedate_ok = 0;

    if(!empty($agree) && ($agree === "YES")) { $agree_ok = 1;} else { $agree_ok = 0;}

    if($email_ok && $phone_ok && $duedate_ok && $agree_ok){
        // MailChimp API credentials
        $apiKey = '5b261f7e714f9bc9d0d426dbb8919a67-us19';
        $listID = '5300a9cbde';
        
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone("Asia/Calcutta"));
        $order = "MYBABY" . $date->format('YmdHis');
        
        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname,
                'PHONE'     => $phone,
                'AGREE'     => $agree,
                'DUEDATE'   => $duedate,
                'ORDER'     => $order
            ]
        ]);
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // store the status message based on response code
        if ($httpCode == 200) {
            $_SESSION['msg'] = '<p style="color: #34A853">Please complete the payment to subscribe to MyBaby.</p>';
        } else {
            switch ($httpCode) {
                case 214:
                    $msg = 'You are already subscribed.';
                    break;
                default:
                    $msg = 'Some problem occurred, please try again.';
                    break;
            }
            $_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
        }
        
        //send SMS
        $message = "welcome to MyBaby! A daily message to you to ensure a healthy pregnancy.";

        $username = "sumedh.bansode@mlakshmi.com";
        $hash_code = "b45875484ae2074744afa1ddf589d6fec023eb031d17a44d5dd3d892b9828c71";
        $sender_id="MYBABY";
//        $pre_message = "Dear Customer, ";
//        $post_message = "\nRegards,\nmLaxmi.com";
//        $full_message = $pre_message . $message . $post_message;        
        $full_message = "Welcome to MyBaby! A daily message to you to ensure a healthy pregnancy. Once payment is confirmed, your messages will start. babymynow.com";
        $url = 'https://api.textlocal.in/send?username=' . $username . '&hash=' . $hash_code . '&sender=' . $sender_id . '&numbers=' . $phone . '&message=' . rawurlencode($full_message);
        $ch = curl_init($url);
        $result = curl_exec($ch);
        curl_close($ch);

// START -trying this new thing below
        
//		$keyvaluepairs['amount'] = "99";
		$keyvaluepairs['amount'] = "649";
		$keyvaluepairs['merchant_id'] = "190296";
		$keyvaluepairs['order_id'] = $order;
		$keyvaluepairs['currency'] = "INR";
		$keyvaluepairs['redirect_url'] = "https://inc-babymynow.herokuapp.com/inc/mybaby/ccavenue/ccavResponseHandler.php";
		$keyvaluepairs['cancel_url'] = "https://inc-babymynow.herokuapp.com/inc/mybaby/ccavenue/ccavResponseHandler.php";
		$keyvaluepairs['language'] = "EN";
		
        $_SESSION['keyvaluepairs'] = $keyvaluepairs;

        $_SESSION['fname'] = $fname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['duedate'] = $duedate;


        header('location:../ccavenue/ccavRequestHandler.php');
// END - trying this new thing
//        header('location:../ccavenue/index.php');

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address, valid phone number, valid due date and agree to Terms of Use. </p>';
        $_SESSION['fname'] = $fname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['duedate'] = $duedate;
        
        header('location:index.php');
    }
}
//header('location:index.php');

?>
