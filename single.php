<?php get_header();?>



<div id="relatedcol">
	<div id="related">
		
		<a href="\">
			<?php 
			if(!is_home()) echo '<div id="homebutton">Home</div>';
			?>
		</a>

		<?php
			
			$curpost = 0;

			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC','numberposts' => 3 );
			$postslist = get_posts( $args );
			
			foreach ($postslist as $post) :  
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
			endforeach;
			wp_reset_postdata(); 
		?>

		
		<?php
			$args = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => 2 );
			$postslist = get_posts( $args );
			
			foreach ($postslist as $post) :  
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
			endforeach;
			wp_reset_postdata(); 
		?>
	
	</div>
	
</div>

<div id="midcol">
	
	<!--
	<a href="/"><div id="backbutton">home</div></a>
	-->

	<?php 
		//track this gameplay in a meta filed posts_views_count
		setPostViews($post->ID);



		the_title("<h2 class=\"singlepostheader\">","</h2>");

		//uncomment if you want to display text entered in the post editor
		//the_content();
		echo "<div id=\"categoryandtags\">";
			echo "<div id=\"tag_intro\">More games with: </div>";
			echo "<div class =\"tagbutton\">";
				the_category('</div><div class ="tagbutton">'); 
			echo "</div>";
			the_tags("<div class=\"tagbutton\"  onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\"   >","</div><div onclick=\"_gaq.push(['_trackEvent', 'tag', 'clicked'])\" class=\"tagbutton\">","</div>");	
		echo "</div>";	

		

		wp_reset_postdata();
		//fetch the swf file that is attached (bound) to the post
	    $args = array( 'post_type' => 'attachment', 'post_parent' => $post->ID,  'post_mime_type' => 'application/x-shockwave-flash', 'numberposts' => 1  ); 
    	$attachments = get_posts($args);
		if ( count($attachments) > 0 ) $attachment = $attachments[0];
		else echo "no attachments found";
	?>
	
	<script type="text/javascript">	
    	<?php 
			//get the width and height of the game from the editor custom fields
			$customfieldwidth = get_post_custom_values('swf-width', $post->ID);
			$gamewidth = $customfieldwidth[0];
			if ($gamewidth==0) $gamewidth=800;	

			$customfieldheight = get_post_custom_values('swf-height', $post->ID);
			$gameheight = $customfieldheight[0];
       		if ($gameheight==0) $gameheight=600;

  
       	?>

    	var flashvars = {};
		//var params = { scale: "exactfit" };
		//var params = { scale: "noscale" };
		var params = { scale: "showAll", bgcolor: "#FFFAF0"};

		var attributes = {};    	
    	swfobject.embedSWF("<?php echo $attachment->guid; ?>", "flashgame", "<?php echo $gamewidth;?>", "<?php echo $gameheight;?>", "11.0.0","expressInstall.swf", flashvars, params, attributes);
    </script>

	
	<div id="centergame">
		<div id="flashgame">
      		Flash game not loaded - you are offline, or the media attachement could not be found.
    	</div>
    	
    	<div id="preroll">
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-4715818108855319";
			/* preroll-ad */
			google_ad_slot = "2373889076";
			google_ad_width = 336;
			google_ad_height = 280;
			//-->
			</script>
			<script type="text/javascript"src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			


			<a href="#" onclick="hidePreroll();" >
				<div id="skiplink">play game</div>
			</a>
		
			<style>
				#loadingbar {
					color:floralwhite;
					margin:auto;
					width:200px;
					background-color: deeppink;
				}
			</style>


		</div>
	

		<script>

			$('#skiplink').hide();
			$('#skiplink').delay(1000).fadeIn(3000);

			function hidePreroll() {
				$('#preroll').hide();
			}
		</script>

		<?php echo "<p id=\"gamesummary\">" . get_post_meta($post->ID,'meta-description',true) . "</p>"; ?>


    </div>
	
	
</div>



<?php get_footer(); ?>
