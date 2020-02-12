<?php session_start(); // place it on the top of the script ?>
<?php
    $statusMsg = !empty($_SESSION['msg'])?$_SESSION['msg']:'';
    $prevFName = !empty($_SESSION['fname'])?$_SESSION['fname']:'';
    $prevStandard = !empty($_SESSION['standard'])?$_SESSION['standard']:'';

    unset($_SESSION['msg']);
    unset($_SESSION['fname']);
    unset($_SESSION['standard']);
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

<form method="post" action="action.php">
    <div class="form-group">
      <input type="text" class="form-control" name="fname" placeholder="Child's name" value=<?php echo $prevFName; ?> >
    </div>
    <div class="form-group">
        <select name="standard" size="1" class="form-control">
            <option value="0">Child's standard</option>
            <option value="1">Standard 1</option>
            <option value="2">Standard 2</option>
            <option value="2">Standard 3</option>
            <option value="2">Standard 4</option>
            <option value="2">Standard 5</option>
            <option value="2">Standard 6</option>
            <option value="2">Standard 7</option>
            <option value="2">Standard 8</option>
        </select>
    </div>
    <p><input type="checkbox" name="agree" value="YES"> I, the parent of the child listed above, accept the Terms of Use, Privacy Policy and Refund Policy.</input></p>
	<p><button type="submit" class="btn btn-default" name="submit" value="REGISTER">Register</button></p>


</form>

</body>