
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"></label>
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Search" onclick="_gaq.push(['_trackEvent', 'searchsubmit', 'clicked'])"/>
    </div>
</form>

<!--AUTOCOMPLETE-->

<style>

.ui-autocomplete {
	font-size: 18px;
	padding:5px;
	padding-bottom:10px;
	border: 3px solid hotpink;
}

.ui-menu-item {
	
	background-repeat: no-repeat;
	height: 30px;
	
}

.ui-widget-content .ui-state-focus
{
     
	background-position: right;
	background-repeat: no-repeat;
	border: 0px solid black;
    background-color: hotpink;
    height: 30px;
   
}

</style>

<?php
	$args = array('orderby' => 'post_title', 'order' => 'desc','numberposts' => 200);	
	$gameslist = get_posts( $args );
	$gamenames = [];
	foreach ($gameslist as $post) {
	 	array_push($gamenames,$post->post_title);
	 	//echo get_the_post_thumbnail($post->ID,'thumbnail');
	 	//echo "hoi" . wp_get_attachment_thumb_file($post->ID);
	}
	//var_dump($gamenames);

?>

<script>

	var gamenames = <?php echo json_encode($gamenames ); ?>;
	var obj = {source: gamenames};	
	$( "#s" ).autocomplete(obj);

</script>
