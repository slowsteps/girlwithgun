<?php 
get_header();
the_post();
?>

<div id="relatedcol">
<div id="related">
<?php
$args = array( 'numberposts' => 4, 'order'=> 'DESC', 'orderby' => 'date' );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?>	
		
	<a href="<?php the_permalink();?>" onclick="_gaq.push(['_trackEvent', 'relatedthumb', 'clicked'])">
	<div class="post">
		<?php 
			the_title("<h2>","</h2>");   
			echo "<div class=\"thumbnail\">";
			the_post_thumbnail();
			echo "</div>";
		?>
	</div>
	</a>
<?php endforeach; ?>
<?php
//reset the current post counter for the main game post 
wp_reset_postdata(); 
?>
</div>
</div>

<div id="leftcol">
	<?php 
		echo "attachment template test";
		the_title("<h2 class=\"singlepostheader\">","</h2>");
		the_content();
		the_category(' '); 
		the_tags("<span class=\"tagbutton\"  onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\"   >","</span><span onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\" class=\"tagbutton\">","</span>");	



wp_reset_postdata();

    $args = array( 'post_type' => 'attachment', 'post_mime_type' => 'application/x-shockwave-flash', 'numberposts' => 10  ); 
    $attachments = get_posts($args);
    if ($attachments) {
            foreach ( $attachments as $attachment ) {
                echo "<br>";    
		echo $attachment->guid;
            }
    }
    else echo "no attachments";


	?>
</div>

<div id="rightcol">	
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-4715818108855319";
	/* girlwithgun skyscraper */
	google_ad_slot = "5069061423";
	google_ad_width = 160;
	google_ad_height = 600;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
</div>



<?php get_footer(); ?>
