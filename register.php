<?php
	$page_title='Register';
	include('includes/header.html');

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		# code...
		$errors=array();
		// if (empty($_POST['first_name']) {
		// 	$errors[]='Your forgot to enter your first name.';
		// }
		// else{
		// 	$fn=trim($_POST['first_name']);
		// }
		// 
		// if (empty($_POST['last_name'])) {
		// 	$errors[]='You forgot to enter your last name.';
		// }
		// else
		// {
		// 	$ln=trim($_POST['last_name']);
		// }
		// 
		// echo "23";
		require(dirname(__FILE__).'../mysql_connect.php');

		if (empty($_POST['username'])) {
			$errors[]='You forgot to enter your username.';
		}
		else
		{
			// $un=trim($_POST['username']);
			// 
			//$un=mysql_real_escape_string(trim($_POST['username']),$dbc);
			$un=$dbc->real_escape_string(trim($_POST['username']));
		}
		
		if (empty($_POST['email'])) {
			$errors[]='You forgot to enter your email address.';
		}
		else
		{
			// $e=mysql_real_escape_string(trim($_POST['email']),$dbc);
			 $e=$dbc->real_escape_string(trim($_POST['email']));
		}

		if (!empty($_POST['pass1'])) {
			if ($_POST['pass1']!=$_POST['pass2']) {
				$errors[]='Your password did not match the confirmed password.';

			}
			else
			{
				$p=$dbc->real_escape_string(trim($_POST['pass2']));
			}
			# code...
		}
		else
		{
			$errors[]='You forgot to enter your password.';
		}
		// echo '56';

		if (empty($errors)) {
			// echo "59";
  
  			$q="select * from users where email='$e'";
  			$r=$dbc->query($q);
  			$num=$r->num_rows;
  			if ($num>0) {
  				echo "email：$e has exist。";
  			}
  			else
  			{
				$q="insert into users(username,email,pass) values('$un','$e',sha1('$p'))";
				//echo $q;

				$r=$dbc->query($q);
				if ($r) {
					echo '
	<h1>Thank you!</h1>
	<p>You are now registerd</p>
	';
				}
				else{
					echo $dbc->error;
					echo '
	<h1>System error</h1>
	<p class="error">
		You could not be registered due to a system error. We apologize for any 
					inconvenience.
	</p>
	';
				}
			}
			$dbc->close();

			include('includes/footer.html');
			exit();
		}
		else
		{
			echo '
<h1>Error!</h1>
<p class="error">
	The following error(s) occurred:
	<br/>
	';
				foreach ($errors as $msg) {
					echo "-$msg
	<br/>
	\n";
				}
			echo '
</p>
<p>Please try again.</p>
<p>
	<br/>
</p>
';
		}
	}
?>
<h1>Register</h1>
<form action="register.php" method="post">
	<p>
		username:
		<input type="text" name="username" size="15" maxlength="20" 
		value="<?php 
			if (isset($_POST['username'])) {
				echo $_POST['username'];
			}
		?>"></p>
	<p>
		email:
		<input type="text" name="email" size="20" maxlength="60" 
		value="<?php 
			if (isset($_POST['email'])) {
				echo $_POST['email'];
			}
		?>"></p>
	<p>
		Password::
		<input type="text" name="pass1" size="20" maxlength="60" 
	value="<?php 
		if (isset($_POST['pass1'])) {
			echo $_POST['pass1'];
		}
	?>"></p>
	<p>
		Confirm Password::
		<input type="text" name="pass2" size="20" maxlength="60" 
value="<?php 
	if (isset($_POST['pass2'])) {
		echo $_POST['pass2'];
	}
?>"></p>
	<p>
		<input type="submit" name="submit" value="Register"</p></form>
	<?php include('includes/footer.html');?>