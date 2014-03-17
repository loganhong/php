<?php 
	include('includes/article_menu.php');
	include('includes/base.php');
	require(dirname(__FILE__).'../../mysql_connect.php');
	if (!empty($_GET["id"])) {
		$id=$_GET["id"];
	}
	$q="SELECT * FROM article where id=$id";

	$r=$dbc->query($q);

	if ($r->num_rows>0) {
		$row=$r->fetch_array();
 
		 echo '
		<div class="mainpage">
			<div class="content_title">
			<span>	'.$row["title"].'</span>
			</div>
			<div class="content">
			'.$row["content"].'
			</div>
		</div>
		';
	}
?>	