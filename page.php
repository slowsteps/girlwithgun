<?php 
get_header();
the_post();
?>

<style>
#centerdiv {
	width: 910px;
	padding-right:10px;
}
</style>

<div id="relatedcol">
<div id="related">
<?php
$args = array( 'numberposts' => 4, 'order'=> 'DESC', 'orderby' => 'date' );
$postslist = get_posts( $args );
$curpost = 0;
foreach ($postslist as $post) :  setup_postdata($post); ?>	
		
	<?php include 'renderthumbnail.php'; ?>
	<?php $curpost++; ?>
	
<?php endforeach; ?>
<?php
//reset the current post counter for the main game post 
wp_reset_postdata(); 
?>
</div>
</div>

<div id="midcol">
	<?php 
		the_title("<h2 class=\"pageheader\">","</h2>");
		the_content();
		the_tags("<span class=\"tagbutton\"  onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\"   >","</span><span onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\" class=\"tagbutton\">","</span>");	
		wp_reset_postdata();
	?>
	
	
	
</div>

<div id="rightcol">	

</div>



<?php get_footer(); ?>
