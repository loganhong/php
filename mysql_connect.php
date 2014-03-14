<?php
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'hong880926');
	define('DB_HOST', 'localhost');
	define('DB_Name', 'logansite');
	// echo "6";
	$dbc=mysqli_init();
	$dbc->real_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_Name);
	//$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_Name) OR die('Could not connect to mysql:'.mysqli_error());
	echo mysqli_error($dbc);
	$dbc->set_charset('utf-8');
	//mysqli_set_charset ($dbc,'utf-8');
	// echo "9";
?>