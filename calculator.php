<?php
	function create_gallon_radio($value){
		echo '<input type="radio" name="gallon_price" value="'.$value.'"';
		if (isset($_POST['gallon_price']) && $_POST['gallon_price']==$value) {
			echo 'checked="checked"';
		}
		echo "/>$value";
	}
	function create_radio($value, $name = 'gallon_price') {
			echo '<input type="radio" name="'.$name.'" value="'.$value.'"';
			if (isset($_POST[$name]) && $_POST[$name]==$value) {
				echo 'checked="checked"';
				# code...
			}
			echo "/>$value";
	}

	function calculate_trip_cost ($miles, $mpg, $ppg) {
		$gallons=$miles/$mgp;
		$dollars=$gallons/$ppg;
		return number_format($dollars,2);
	}


	$page_title='Trip Cost Calculator';
	include('includes/header.html');

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		# code...
		if (isset($_POST['distance'],$_POST['gallon_price'],$_POST['efficiency']) 
			&& is_numeric($_POST['distance'])
			&& is_numeric($_POST['gallon_price'])
			&& is_numeric($_POST['efficiency']))
		 {
			# code...
			#$gallons=$_POST['distance'] /$_POST['efficiency'];
			#$dollars=$_POST['distance']/65;
		 	$cost=calculate_trip_cost($_POST['distance'],$_POST['efficiency'],$_POST['gallon_price']);
		 	$hours=$_POST['distance']/65;
			echo '<h1>Total Estimated Cost</h1>
<p>
The total cost of driving '.$_POST['distance'].' miles ,avaraging'.$_POST['efficiency'].
			' miles per gallon, and paying an average of $' . $_POST['gallon_price'] . 
			' per gallon, is $' .  $cost. 
			'. If you drive at an average of 65 miles per hour, the trip will take approximately ' . number_format($hours, 2) . 
			' hours.
</p>
'; 
		}
		else
		{
			echo "
<h1>Error!</h1>
<p class='error'>
Please enter a vaild distance, price per gallon , and fuel efficiency.
</p>
";
}
	}
?>
<h1>Trip Cost Calculator</h1>
<form action="calculator.php" method="POST">
<p>
	Distance(in miles):
	<input type="text" name="distance" value="<?php if (isset($_POST['distance'])) echo $_POST['distance']; ?>" />
</p>
<p>
	>Ave. Price Per Gallon:
	<span class="input">
		<?php 
		create_radio('3.00');
		create_radio('3.50');
		create_radio('4.00');
		?>
		<!--<input type="radio" name="gallon_price" value="3.00" <?php if (isset($_POST['gallon_price']) && $_POST['gallon_price']=='3.00') {echo 'checked="checked"';} ?> />
		3.00
		<input type="radio" name="gallon_price" value="3.50" <?php if (isset($_POST['gallon_price']) && $_POST['gallon_price']=='3.50') {echo 'checked="checked"';} ?>/>
		3.50
		<input type="radio" name="gallon_price" value="4.00" <?php if (isset($_POST['gallon_price']) && $_POST['gallon_price']=='4.00') {echo 'checked="checked"';} ?>/>
		4.00-->
	</span>33778961
</p>
<p>
	Fuel Efficiency:
	<select name="efficiency">
		<option value="10" <?php if (isset($_POST['efficiency']) && $_POST['efficiency']=="10") echo 'selected="selected"';?>>Terrible</option>
		<option value="20" <?php if (isset($_POST['efficiency']) && $_POST['efficiency']=="20") echo 'selected="selected"';?>>Decent</option>
		<option value="30" <?php if (isset($_POST['efficiency']) && $_POST['efficiency']=="30") echo 'selected="selected"';?>>Very Good</option>
		<option value="50" <?php if (isset($_POST['efficiency']) && $_POST['efficiency']=="50") echo 'selected="selected"';?>>Outstanding</option>
	</select>
</p>
<p>
	<input type="submit" name="submit" value="Calculate!" />
</p>
</form>

<?php
	include('includes/footer.html');
?>