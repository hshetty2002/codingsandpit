<?php session_start(); // place it on the top of the script ?>
<?php
    $statusMsg = !empty($_SESSION['msg'])?$_SESSION['msg']:'';
    $prevFName = !empty($_SESSION['fname'])?$_SESSION['fname']:'';
    $prevEmail = !empty($_SESSION['email'])?$_SESSION['email']:'';
    $prevPhone = !empty($_SESSION['phone'])?$_SESSION['phone']:'';
    $prevDate = !empty($_SESSION['duedate'])?$_SESSION['duedate']:'';
    
    unset($_SESSION['msg']);
    unset($_SESSION['fname']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['duedate']);

    echo $statusMsg;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};

</script>   

</head>

<body>

    <div class="container">

<!--
<form method="post" action="action.php">
<form method="post" action="action_free.php">
-->

<form method="post" action="action_free.php">
    <div class="form-group">
      <input type="text" class="form-control" name="fname" placeholder="Name of person receiving messages" value=<?php echo $prevFName; ?> >
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="email" placeholder="Email to send messages to" value=<?php echo $prevEmail; ?> >
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="phone" placeholder="Mobile number to send messages to" value=<?php echo $prevPhone; ?> >
    </div>
    <div class="form-group">
        Approximate Due Date: <input type="date" name="duedate" value=<?php echo $prevDate; ?>>    
    </div>
    <div class="form-group">
        (Due Date can be changed later)
    </div>
    <p><input type="checkbox" name="agree" value="YES"> I accept the Terms of Use, Privacy Policy and Refund Policy</input></p>
	<p><button type="submit" class="btn btn-default" name="submit" value="REGISTER">Register</button></p>



<!--
    <p><label>Name of person receiving messages: </label><input type="text" name="fname" value=<?php echo $prevFName; ?> ></p>
    <p><label>Email: </label><input type="text" name="email" value=<?php echo $prevEmail; ?> ></p>
    <p><label>Phone: </label><input type="text" name="phone" value=<?php echo $prevPhone; ?> ></p>
    <p><input type="submit" name="submit" value="REGISTER"/></p>
	
	<input size="16" type="text" value="2012-06-15 14:45" readonly class="form_datetime">
 

-->    
   
</form>

</body>