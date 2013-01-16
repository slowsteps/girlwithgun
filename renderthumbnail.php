 
 
 <style>
 
 .overlayshadow {
  display:none;
 }
 
 </style>

 
 <div id="post<?php echo $curpost; ?>" class="post" onmouseover="showthumbnailTitle(this)" onmouseout="hidethumbnailTitle(this)">	
	
<?php
	echo "<a href=\"";
	the_permalink();
	echo "\">";
	
	echo "<div class=\"thumbnail\">";
		//the thumbnail image
		echo("<div class=\"thumbimg\">");
			the_post_thumbnail('thumbnail');
			echo "<br/>count: " . $post->post_views_count;
		echo("</div>");
		//rollover game title
		echo "<div id=\"overlay".$curpost."\" class=\"overlayshadow\">";
			the_title("<div class=\"overlaytext\">","</div>");
			
		echo "</div>";
		//post that are younger than a week get a new label
		$post_age = round((date('U') -  get_the_date('U'))/86400);
		if ($post_age<8) {
			echo("<div class=\"newgamelabel\">");
				echo "new " . $post_age;
			echo("</div>");
		}
	echo "</div>";
	echo "</a>";
?>
	
</div>	

<script type="text/javascript">

$("#post<?php echo $curpost; ?>").mouseenter(function() {
  $("#overlay<?php echo $curpost; ?>").slideToggle("fast");
});

$("#post<?php echo $curpost; ?>").mouseleave(function() {
  $("#overlay<?php echo $curpost; ?>").slideToggle();
});

</script>