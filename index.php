<?php
    // ini_set( 'sendmail_from', "myself@my.com" ); 
    // ini_set( 'SMTP', "mail.bigpond.com" );  
    // ini_set( 'smtp_port', 25 );
//Message Vars
$msg = '';
$msgClass = '';

//Check For Submit

	if(filter_has_var(INPUT_POST, 'submit')){
		//Get From Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		//Check Required Fields
		if(!empty($email) && !empty($email) && !empty($message)){
			//Passed
			//Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				//Failed
				$msg = 'Please use a valid email';
				$msgClass = 'alert-danger';
			} else {
				//Passed
				//Recipient Email
				$toEmail = 'feelsensa@gmail.com';
				$subject = "Contact Request From: $name";
				$body = '<h2>Contact Request</h2>
				<h4>Name</h4><p>'.$name.'</p>
				<h4>Email</h4><p>'.$email.'</p>
				<h4>Message</h4><p>'.$message.'</p>'
				;
				//Email headers
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .="Content-Type: text/html; charset=UTF-8" . "\r\n";
				$headers .= "From: " .$name. "<".$email. ">"."\r\n";
				if(mail($toEmail, $subject, $body, $headers)){
					$msg = 'Your email has been sent';
			$msgClass = 'alert-success';
				} else {
					$msg = 'Your email has not been sent';
			$msgClass = 'alert-danger';
				}
			}
		} else {
			//Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Contact Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
</head>
<body>
	<nav class="navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">My Website</a>
			</div>
		</div>
	</nav>

	<div class="container">
		<?php if($msg != '') : ?>
			<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
			</div>
			<div class="form-group">
				<label>Message</label>
				<textarea type="text" name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
			</div>
			<br>
			<button name="submit" type="submit" class="btn btn-secondary">Submit</button>
		</form>
	</div>
</body>
</html>