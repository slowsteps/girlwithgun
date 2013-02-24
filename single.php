<?php get_header();?>



<div id="relatedcol">
	<div id="related">
		
		<a href="\">
			<?php 
			//if(!is_home()) echo '<div id="homebutton">Home</div>';
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

		//only display a tag if there are two or more games with that tag
		echo "<div id=\"categoryandtags\">";

		echo "<div id=\"tag_intro\">More games with: </div>";
		//display category above game if not highlighted in mainmenu
		$post_cat = get_the_category();
		$inmainmenu = 0;
		$args = array( 'orderby' => 'count', 'order' => 'DESC', 'number' => '5');
		$cats = get_categories($args);
		
		foreach ($cats as $cat) {
			//echo $cat->name . " - " .  $post_cat[0]->name . "<br/>";
			if ($cat->name == $post_cat[0]->name) {
				$inmainmenu = 1;
				break;

			}
			else $inmainmenu = 0;
		}
		//echo "----" . $inmainmenu . "_______";

		if ($inmainmenu == 0) {
			echo "<div class =\"tagbutton\">";
				the_category('</div><div class ="tagbutton">'); 
			echo "</div>";
		}
		//end display categoty

		//display the tags
		$posttags = get_the_tags();
			if ($posttags) {
	 			 foreach($posttags as $tag) {
	    			
	  				if ( $tag->count > 1 ) {
		  				echo "<div class =\"tagbutton\">";
		  					$url = get_tag_link($tag->term_id);
		  					echo "<a href=\"$url\">$tag->name</a>";
		  				echo "</div>";
	  				}
	  		}
		}
		echo "</div>";
		//end display tags


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

  
			
			if (get_bloginfo('name') == 'sohorses') $bgcolor = "#FFFAF0";
			else $bgcolor = "#d2d2e6";
			

	


       	?>

    	var flashvars = {};
		//var params = { scale: "exactfit" };
		//var params = { scale: "noscale" };
		//var params = { scale: "showAll", bgcolor: "#FFFAF0"};
		//var params = { scale: "showAll", wmode: "opaque", bgcolor: "<?php echo $bgcolor;?>"};
		var params = { scale: "showAll", wmode: "window"};
		
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
			


			
			<div id="skiplink"><a href="javascript:void(0)" onclick="hidePreroll();" >play game</a></div>
			
		
			<style>
				#loadingbar {
					color:floralwhite;
					margin:auto;
					width:200px;
					background-color: deeppink;
				}
			</style>

			
		</div>
			
			<div id="posttext">
				<?php the_content(); ?>
			</div>

		<script>

			$('#skiplink').hide();
			$('#skiplink').delay(1000).fadeIn(3000);

			function hidePreroll() {
				$('#preroll').hide();
			}
		</script>

		<?php echo "<div id=\"gamesummary\">" . get_post_meta($post->ID,'meta-description',true) . "</div>"; ?>


    </div>
	
	
</div>



<?php get_footer(); ?>
