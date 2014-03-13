<?php 
	function create_ad()
	{
		echo '<p class="ad">
This is an annoying ad ! This is an annoying ad ! This is an  annoying ad!
</p>
';
	}

	$page_title='Welcome to this Stie!';
	include('includes/header.html');
	create_ad();
?>
<!-- Start of the page-specific content. -->
<h1>Content Header</h1>
<p>
This is where the page-specific content goes. This section, and the corresponding            header, will change from one page to the next.
</p>
<p>
Volutpat at varius sed sollicitudin et, arcu. Vivamus viverra. Nullam turpis. Vestibulum          sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor. Aenean felis. Quisque          eros. Cras lobortis commodo metus. Vestibulum vel purus. In eget odio in sapien adipiscing          blandit. Quisque augue tortor, facilisis sit amet, aliquam, suscipit vitae, cursus sed,          arcu lorem ipsum dolor sit amet.
</p>
<!-- End of the page-specific content. -->
<?php 
	create_ad();
echo phpinfo();
	include('includes/footer.html');
	
?>