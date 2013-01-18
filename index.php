<?php

?>
 

 
 <?php get_header(); ?>

 
 <?php if ( is_home() ) {
 		//query for "games" cat? cat games is gone and this still works?	
		//query_posts($query_string . 'games');
		
	}
	if (is_category()) {
		echo "<h2 class=\"archiveheader\">";
		the_category(' ');
		echo "</h2>";
		echo  category_description();
	}

	if (is_tag()) {
		echo "<h2 class=\"archiveheader\">";
		echo get_query_var('tag');
		echo "</h2>";
	}


 ?>
 
 
 
  <!-- render a grid of thumbnails. -->
 

  		<?php
			//first get the newest games
			$curpost = 0;
  			//new games will be stored to prevent double rendering on homepage
  			$visibleposts = array();
  			//allow 10 new games to render
			$args = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => 10 );
			$postslist = get_posts( $args );
		
			foreach ($postslist as $post) :  
				//max 8 days old
				$post_age = round((date('U') -  get_the_date('U'))/86400);
				if ($post_age<8) {
					$visibleposts[$post->ID] = true;
					setup_postdata($post); 
					include 'renderthumbnail.php';
					$curpost++; 
				}
			endforeach;
			//reset counter for the next loop
			wp_reset_postdata(); 
		?>



		<?php
			//secondly get the most popular games (alltime)
			
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => 40 );
			$postslist = get_posts( $args );
			
			foreach ($postslist as $post) :  
				//don't display when already visible as a new game
				if ($visibleposts[$post->ID] == false) {
					setup_postdata($post); 
					include 'renderthumbnail.php';
					$curpost++; 
				}
			endforeach;
			wp_reset_postdata(); 
		

		?>



 <?php get_footer(); ?>
