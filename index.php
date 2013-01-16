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
 
 
 
  <!-- Start the Loop. -->
 
		<?php
			//sort by newest in case no view data is available (zero clicks) 
			
			//$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value', 'order' => 'DESC','numberposts' => 35 );
			$args = array( 'orderby' => 'post_views_count', 'order' => 'ASC','numberposts' => 35 );

			$postslist = get_posts( $args );
			
			$curpost = 0;
			foreach ($postslist as $post) :  
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
			endforeach;
			wp_reset_postdata(); 
		?>



 <?php get_footer(); ?>
