<?php

?>
 

 
 <?php get_header(); ?>

 
 <?php 

 	//for CSS targetting


 	if ( is_home() ) {
 	
 	}	
	if ( is_search()) {
		echo "<h2 class=\"archiveheader\">";
		echo "Games matching: \"". get_query_var('s')."\"";
		echo "</h2>";	
	}
	if (is_category()) {
		echo "<h2 class=\"archiveheader\">";
		echo get_the_category_by_ID( get_query_var('cat') );
		echo "</h2>";
		echo '<div class="categorydescription">'.category_description()."</div>";
	}

	if (is_tag()) {
		echo "<h2 class=\"archiveheader\">";
		echo get_query_var('tag');
		echo "</h2>";
	}



	//render a grid of thumbnails.
		$paged = get_query_var('page');
 		$maxposts =8;
		$curpost = 0;
		$numnewposts = 8; //first row of games are the latest, the following row are sorted by popularity (views)
		//first get the newest games
		$pageoffset =  get_query_var('page');
		//new games will be stored to prevent double rendering on homepage
		$visibleposts = array();
		//on the homepage, render some new games before the popular games
		if (is_home() And !$paged) {
			$args = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => $numnewposts);
			$postslist = get_posts( $args );
		
			foreach ($postslist as $post) :  
				//max 8 days old
				$post_age = round((date('U') -  get_the_date('U'))/86400);
				if ($post_age<8) {
					$visibleposts[$post->ID] = true;
					setup_postdata($post); 
					include 'renderthumbnail.php';
					$curpost++; 
					$numnewposts++;
				}
			endforeach;
			//reset counter for the next loop
			wp_reset_postdata(); 
		}
	

		if (is_home()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => 80);	
		}
		else if (is_category()){
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => 80,'category' => get_query_var('cat') );
		}
		else if (is_tag()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => 80,'tag' => get_query_var('tag') );	
		}
		else if(is_search()){
			$args = array('s' => get_query_var('s'));
		}

		//paging
		
		if ($paged) $args['offset'] = ($maxposts*$paged) - $numnewposts;

		$postslist = get_posts( $args );
		
		foreach ($postslist as $post) :  
			//don't display when already visible as a new game
			if ($visibleposts[$post->ID] == false) {
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
				if ($curpost == $maxposts) break;
			}
		endforeach;
		wp_reset_postdata(); 
	
	

?>



 <?php get_footer(); ?>
