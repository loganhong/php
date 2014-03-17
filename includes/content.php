<?php 
	include('includes/base.php');
	require(dirname(__FILE__).'../../mysql_connect.php');
	$q="SELECT * FROM article";
	$r=$dbc->query($q);
	$util=new base_util();
	while ($row=$r->fetch_array(MYSQL_ASSOC)) {
		echo '
	<div class="mainpage">
		<div class="content_title">
			<a href="article.php?id='.$row["id"].'" title="'.$row["title"].'">'.$util->subString($row["title"], 0,30).'</a>
		</div>
		<div class="content">
		'.$util->subString($row["content"],0,300).'
		<a class="bigg-read-more" href="#"></a>
		</div>
	</div>
	';
	}
	include('includes/article_menu.php');
	
?>	
<script type="text/javascript">
(function(){
	$(".mainpage").mouseenter(function () {
            $(this).addClass('mainpagehover');
        });

    $(".mainpage").mouseleave(function () {
        $(this).removeClass('mainpagehover');
    });
})();	 
</script>