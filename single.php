<?php get_header();?>



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
		<?php wp_reset_postdata(); ?>
	</div>
</div>

<div id="midcol">
	<?php 
		
		the_title("<h2 class=\"singlepostheader\">","</h2>");
		//uncomment if you want to display text entered in the post editor
		//the_content();
		echo "<div id=\"categoryandtags\">";
			echo "<span class =\"categorybutton\">";
			the_category(' '); 
			echo "</span>";
			the_tags("<span class=\"tagbutton\"  onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\"   >","</span><span onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\" class=\"tagbutton\">","</span>");	
		echo "</div>";	

		wp_reset_postdata();
		//fetch the swf file that is attached (bound) to the post
	    //$args = array( 'post_type' => 'attachment', 'post_parent' => $post->ID,  'post_mime_type' => 'application/x-shockwave-flash', 'numberposts' => 1  ); 
    	//$attachment = get_posts($args)[0];
		
	?>
	
	<script type="text/javascript">	
    	<?php /*
			//get the width and height of the game from the editor custom fields
			$customfieldwidth = get_post_custom_values('swf-width', $post->ID);
			$gamewidth = $customfieldwidth[0];
		
			$customfieldheight = get_post_custom_values('swf-height', $post->ID);
			$gameheight = $customfieldheight[0];
       		*/
       	?>

    	var flashvars = {};
		//var params = { scale: "exactfit" };
		//var params = { scale: "noscale" };
		var params = { scale: "showAll" };

		var attributes = {};    	
    	//swfobject.embedSWF("<?php echo $attachment->guid; ?>", "flashgame", "<?php echo $gamewidth;?>", "<?php echo $gameheight;?>", "11.0.0","expressInstall.swf", flashvars, params, attributes);
    </script>

	
	<div id="centergame">
		<div id="flashgame">
      		Alternative content - swfobject flash container div
    	</div>
    </div>
	
	
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
	<!--
	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	-->
</div>



<?php get_footer(); ?>
