<?php
	$page_title="edit a user.";
	include('includes/header.html');
	echo '<h1><delete a user/h1>
	';
	echo 'get'. $_GET['id'].'<br>';
	echo 'post'.$_POST['id'].'<br>';
	if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
		$id=$_GET['id'];
	}
	else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
		$id=$_POST['id'];
	}
	else
	{
		echo '<p class="error">this page has been accessed in error</p>';
		include("includes/footer.html");
		exit();
	}
	require_once(dirname(__FILE__).'/mysql_connect.php');

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (empty($_POST['username'])) {
			$errors[]='You forgot to enter your username.';
		}
		else
		{
			// $un=trim($_POST['username']);
			$un=mysql_real_escape_string(trim($_POST['username']),$dbc);
		}
		
		if (empty($_POST['email'])) {
			$errors[]='You forgot to enter your email address.';
		}
		else
		{
			$e=mysql_real_escape_string(trim($_POST['email']),$dbc);
		}
		if (empty($errors)) {
		 
			$q='update users set username="'.$un.'" , email="'.$e.'" where id='.$id;
			echo $q;
			$r=@mysql_query($q,$dbc);
			
			if (mysql_affected_rows($dbc)==1) {
				echo '<p>		The user has been update.';
			}
			else
			{
				echo '
		<p class="error">The user could not be update due to a system error.</p>
		';
				echo '
		<p>'.mysql_error($dbc).'</p>
		';
			}
		}
		else
		{
		echo "the user has not been deleted";

		}
	}
	else
	{
		$q="select * from users where id=$id";
		$r=@mysql_query($q,$dbc);
		if (mysql_num_rows($r)==1) {
			$row=mysql_fetch_array($r);
			echo '
		<h3>Username : '.$row['username'].'</h3>
		';
			echo '
		<form action="edit_user.php" method="post">
			<input type="text" name="username" value="'.$row['username'].'" />
			Yes
			<input type="text" name="email" value="'.$row['email'].'" />
			No
			<input type="hidden" name="id" value="'.$id.'" />
			<input type="submit" name="submit" vaule="submit" />
		</form>
		';
		}
		else
		{
			echo '
		<p class="error">This page has been accessed in error.</p>
		"';
		}
	}
	mysql_close($dbc);
	include('includes/footer.html');
?>
