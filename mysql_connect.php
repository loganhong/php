<?php
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'hong880926');
	define('DB_HOST', 'localhost');
	define('DB_Name', 'logansite');
	// echo "6";
	$dbc=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_Name) OR die('Could not connect to mysql:'.mysql_error());
	echo mysql_error($dbc);
	mysql_select_db(DB_Name,$dbc);
	mysql_set_charset($dbc,'utf8');
	// echo "9";
?>