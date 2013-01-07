<?php

?>
 

 
 <?php get_header(); ?>

 
 <?php if ( is_home() ) {
 		//query for "games" cat? cat games is gone and this still works?	
		query_posts($query_string . 'games');
		
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
 $maxposts = 35;
 $curpost = 0;
 ?>
 
 
 <?php if ( have_posts() ) : while ( have_posts() and $curpost++ < $maxposts ) : the_post(); ?>
 
 
<?php include 'renderthumbnail.php'; ?>

 <!-- Stop The Loop (but note the "else:" - see next line). -->
 <?php endwhile; else: ?>

 <!-- The very first "if" tested to see if there were any Posts to -->
 <!-- display.  This "else" part tells what do if there weren't any. -->
 <p>Sorry, no posts matched your criteria.</p>

 <!-- REALLY stop The Loop. -->

 <?php endif; ?>
 <?php get_footer(); ?>
