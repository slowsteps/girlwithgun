 
 
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
		echo("<div class=\"thumbimg\">");
			the_post_thumbnail('thumbnail');
		echo("</div>");
		echo "<div id=\"overlay".$curpost."\" class=\"overlayshadow\">";
			the_title("<div class=\"overlaytext\">","</div>");
		echo "</div>";
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