<?php
	$page_title='View current users';
	include('includes/header.html');
	echo "<h1>Registered Users</h1>";
	require(dirname(__FILE__).'../mysql_connect.php');

	$display=5;
	if (isset($_Get['p']) && is_numeric($_GET['p'])) {
		$pages=$_GET['p'];
	}
	else
	{
		$q="SELECT count(1) FROM users";
		$r=$dbc->query($q);
		$row= $r->fetch_array;
		$record=$row[0];

		if ($record>$display) {
			$pages=ceil($record/$display);
		}else
		{
			$pages=1;
		}
	}


	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start=$_GET['s'];
	}
	else{$start=0;}

	$q="SELECT * from users order by createdate asc limit $start,$display";

	$r=$dbc->query($q);
	$num=$r->num_rows;
	if ($num>0) {
		echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
			<tr>
			<td align="left">edit</td>
			<td align="left">delete</td>
			<td align="left">id</td>
			<td align="left">Name</td>
			<td align="left">Email</td>
			<td align="left">Registered Date</td>
			</tr>
		';
		$bg='#eeeeee';
		while ($row=$r->fetch_array(MYSQL_ASSOC)) {
			$bg=($bg=='#eeeeee'?'#fffff':'#eeeeee');
		echo '<tr bgcolor="'.$bg.'">
			<td align="left"><a href="edit_user.php?id='.$row['id'].'">edit</a></td>
			<td align="left"><a href="delete_user.php?id='.$row['id'].'">delete</a></td>
			<td align="left">'.$row['id'].'</td>
			<td align="left">'.$row['username'].'</td>
			<td align="left">'.$row['email'].'</td>
			<td align="left">'.$row['createdate'].'</td>
			</tr>';
		}
		echo "</table>";
		$r->free_result;
		
	}
	else
	{
		echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';		
		echo '<p>'.mysql_error($dbc).'<br /> <br /> Query：'.$q.'</p>';
	}
	$dbc->close();
	
	if ($pages>1) {
		echo '<br /><p>';
		$currentPage=($start/$display)+1;
		if ($currentPage!=1) {
			echo '<a href="view_users.php?s='.($start-$display).'&p='.$pages.'">Previous</a>';
		}
		 echo $currentPage;

		if ($currentPage!=$pages) {
			echo '<a href="view_users.php?s='.($start+$display).'&p='.$pages.'">Next</a>';
		}
	}

	include('includes/footer.html');
?>