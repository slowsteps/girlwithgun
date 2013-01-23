
 

 
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
	//first row of games are the latest, the following row are sorted by popularity (views)

		$paged = get_query_var('page');
 		$maxposts =40;


		//MAX 200 games.
		$postcount = wp_count_posts('post')->publish;
		if ($postcount > 200) $totalposts = 200;
		else $totalposts = $postcount;
		
		$curpost = 0;
		
		//new games will be stored to prevent double rendering on homepage
		$visiblepostIDS = array();
		

		

		//ARGS FOR POPULAR
		if (is_home()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts);	
			$argsnew = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => '$totalposts');
		}
		else if (is_category()){
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts,'category' => get_query_var('cat') );
			$argsnew = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => '$totalposts','category' => get_query_var('cat'));
		}
		else if (is_tag()) {
			$args = array( 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'desc','numberposts' => $totalposts,'tag' => get_query_var('tag') );	
			$argsnew = array('orderby' => 'post_date', 'order' => 'DESC','numberposts' => '$totalposts','category' => get_query_var('tag'));
		}
		else if(is_search()){
			$args = array('s' => get_query_var('s'));
			$argsnew = array();
		}

	


		//GET POPULAR
		$postslistpopular = get_posts( $args );
			
	
		function IDinPopularList($instr) {
			global $postslistpopular;
			global $maxposts;
			trace("--------------");
			for ($i=0;$i<$maxposts;$i++) {
				$post = $postslistpopular[$i];

				trace($i ." - ".$post->post_name." - ".$instr);
				if ($post->post_name == $instr) {
					//trace($i ." - ".$post->post_name." - ".$instr);
					return true;
				}
			}
			return false;
		}



		//GET THE NEWEST
		if (!$paged) {
			$postslistnew = get_posts( $argsnew );		
				foreach ($postslistnew as $post) :  
						//max 8 days old
						$post_age = round((date('U') -  get_the_date('U'))/86400);
						if ($post_age<8) {

							if ( !IDinPopularList($post->post_name) ) {
								array_unshift($postslistpopular, $post);
								trace("not on the homepage, added to the front of the list:".$post->post_name);
							}
							else trace("already on homepage:".$post->post_name);
							
						}
			endforeach;
			//reset counter for the next loop
			wp_reset_postdata(); 
		}
		


		$start = 0 + $paged*$maxposts;
		//$start = (int)$start;
		$end = $start + $maxposts;

		

		for ($i=$start;$i<$end;$i++) {
						
			if ($i<$totalposts-1) {
				$post = $postslistpopular[$i];
				setup_postdata($post); 
				include 'renderthumbnail.php';
				$curpost++; 
			}
		}
		wp_reset_postdata();

		echo '<div id="pager">';

		
		$numpages = $totalposts / $maxposts;
		if ($numpages>1) {
			for ($i=0;$i<$numpages;$i++) {
				if ($i == $paged) echo  '<a href="/?page='.$i.'">' .'<span class="selected">Page '.$i. '</span></a>';
				else echo  '<a href="/?page='.$i.'">' .'<span>Page '.$i. '</span></a>';
			}
		}

		echo '</div>';

?>



 <?php get_footer(); ?>
