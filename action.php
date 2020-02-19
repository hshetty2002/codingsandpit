<?php session_start(); // place it on the top of the script ?>
<?php
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $standard = $_POST['standard'];
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    $pfname = $_POST['pfname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
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
        $_SESSION['address'] = $address;

        // put it into MailChimp
        $apiKey = '5b261f7e714f9bc9d0d426dbb8919a67-us19';
        $listID = 'f90c6f4526';

        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname,
                'STANDARD'  => $standard,
                'PFNAME'    => $pfname,
                'PHONE'     => $phone,
                'ADDRESS'   => $address,
                'AGREE'     => $agree
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

        header('location:razorpay/rpRequestHandler.php');

    }else{
        $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid standard, email, phone and agree to Terms of Use. </p>';
        $_SESSION['fname'] = 'echo $fname';
        $_SESSION['standard'] = $standard;
        $_SESSION['pfname'] = 'echo $pfname';
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = 'echo $address';

        header('location:index.php');
    }
}

?>
