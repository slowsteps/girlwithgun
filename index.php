
 

 
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
		echo '<div class="category_or_tag_description">'.category_description()."</div>";
	}

	if (is_tag()) {
		echo "<h2 class=\"archiveheader\">";
		echo get_query_var('tag');
		echo "</h2>";
		echo '<div class="category_or_tag_description">'.tag_description()."</div>";
	}



	//render a grid of thumbnails.
	//first row of games are the latest, the following row are sorted by popularity (views)

		$paged = get_query_var('page');
 		$maxposts =40;


		//MAX 200 games.
		$postcount = wp_count_posts('post')->publish;
		if ($postcount > 200) $totalposts = 200;
		else $totalposts = $postcount;
		
		$curpost = 0;
		
		//new games will be stored to prevent double rendering on homepage
		//$visiblepostIDS = array();
		

		

		//ARGS FOR POPULAR
		if (is_home()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts);	
			$argsnew = array('orderby' => 'post_date', 'order' => 'ASC','numberposts' => '$totalposts');
		}
		else if (is_category()){
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts,'category' => get_query_var('cat') );
			$argsnew = array('orderby' => 'post_date', 'order' => 'ASC','numberposts' => '$totalposts','category' => get_query_var('cat'));
		}
		else if (is_tag()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts,'tag' => get_query_var('tag') );	
			$argsnew = array('orderby' => 'post_date', 'order' => 'ASC','numberposts' => '$totalposts','tag' => get_query_var('tag'));
		}
		else if(is_search()){
			$args = array('s' => get_query_var('s'));
			$argsnew = array(); 
		}

	
		//COMBINED LIST
		$combinedgames = array();

		//GET POPULAR
		$postslistpopular = get_posts( $args );
			
	
		function gameInNewList($inpost) {
			global $combinedgames;
			
			foreach ($combinedgames as $post) {
				if ($post->ID == $inpost->ID) {
					//echo "match".$post->post_name;
					return true;
				}
			}

			return false;
		}



		//TODO MAKE G SYSTEM. Make a combined list. Push all young games to the front. Push populars one by one, if not duplicating a new one.. 

		//GET THE NEWEST
		
		$postslistnew = get_posts( $argsnew );		
			foreach ($postslistnew as $post) :  
					//max 8 days old
					$post_age = round((date('U') -  get_the_date('U'))/86400);
					if ($post_age<8 And !is_search()) {
							array_unshift($combinedgames, $post);
							
					}
			endforeach;
		//reset counter for the next loop
		wp_reset_postdata(); 
		
		
		//ADD POPULAR
		foreach ($postslistpopular as $post) {
			if (!gameInNewList($post)) {
				array_push($combinedgames, $post);
			
			}
			
		}


		//RENDERING HOME AND PAGING

		$start = 0 + $paged*$maxposts;
		$end = $start + $maxposts;

		

		for ($i=$start;$i<$end;$i++) {
						
			if ($i<count($combinedgames)) {
				$post = $combinedgames[$i];
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
			}
		}
		wp_reset_postdata();

		echo '<div id="pager">';

		
		
		$cur_url = $_SERVER['REQUEST_QUERY'];

		

		$numpages = count($combinedgames) / $maxposts;
		if ($numpages>1) {
			for ($i=0;$i<$numpages;$i++) {
				if ($i == $paged) echo  "<a href=\"$cur_url?page=$i\">" ."<span class=\"selected\">-</span></a>";
				else echo  "<a href=\"$cur_url?page=$i\">" . "<span>-</span></a>";
			}
		}

		echo '</div>';

?>



 <?php get_footer(); ?>
