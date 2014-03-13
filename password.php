<?php 
	$page_title="Change Your Password";
	include('includes/header.html');
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		require(dirname(__FILE__).'../mysql_connect.php');

		$errors=array();

		if (empty($_POST['email'])) {
			$errors[]='You forgot to enter your email.';
		}
		else
		{
			$e=mysql_real_escape_string(trim($_POST['email']),$dbc);
		}
		if (empty($_POST['pass'])) {
			$errors[]='You forgot to enter your password.';
		}
		else
		{
			$p=mysql_real_escape_string(trim($_POST['pass']),$dbc);
		}
		if (empty($_POST['pass1'])) {
			$errors[]='You forgot to enter your pass1.';
		}
		else
		{
			$p1=mysql_real_escape_string(trim($_POST['pass1']),$dbc);
		}
		if ($_POST['pass1']!=$_POST['pass2']) {
			$errors[]='Your new password did not match the confirm password.';
		}

		if (empty($errors)) {
			$q="SELECT * FROM users where (email='$e' and pass=sha1($p))";
			// echo $q;
			$r=@mysql_query($q,$dbc);
			$num=mysql_num_rows($r);
			if ($num>0) {
				$row=mysql_fetch_array($r);
				$q="update users set pass=sha1('$p1') where id=$row[0]";
				$r=@mysql_query($q,$dbc);
				if (mysql_affected_rows($dbc)==1) {
					echo '<h1>Thank you.</h1>
					<p>Your password has been updated,</p>
					';
				}
				else
				{
					echo "<h1>system errors</h1>";
					echo '<p class="errors"> your password could not be changed.</p>';
				}
			}
			else
			{
			echo '<h1>errors</h1>
			<p class="errors">The email address and password do not match those on file.</p>';
			}
			mysql_free_result($r);

			include('includes/footer.html');
			exit();
		}
		else
		{
			echo '
				<h1>Error!</h1>
				<p class="error">
				The following error(s) occurred:
				<br/>';
				foreach ($errors as $msg) {
					echo "-$msg<br/>\n";
				}
		}
		mysql_close($dbc);

	}
?>
<h1>Change password</h1>
<form action="password.php" method="post">
<p>Email address:<input type="text" name="email" size="20" value="<?php if (isset($_POST['email'])) {
	echo $_POST['email'];
} ?>"/></p>
<p>Curren Password:<input type="text" name="pass" size="20" value="<?php if (isset($_POST['pass'])) {
	echo $_POST['pass'];
} ?>"/></p>
<p>new password:<input type="text" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) {
	echo $_POST['pass1'];
} ?>"/></p>
<p>confirm password:<input type="text" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) {
	echo $_POST['pass2'];
} ?>"/></p>
<p><input type="submit" value="submit"></p>
</form>
<?php include('includes/footer.html');?>