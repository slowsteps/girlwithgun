

<style>
.stretch {
	clear:both;
}
</style>


<div class="stretch"></div>

		<?php wp_footer(); ?>

		<!--end #page div-->




</div>


<div id="footer" class="backgroundcolor">

	<div id="tagcloud">

		<?php 
			$args = array('number' => 8);
			wp_tag_cloud($args); 

		?>
	</div>

	<div>
		<div id="siteinfo">
			<?php echo get_site_option('siteinfo'); ?>
		</div>
		
		<a href="/">Home</a> |  
		<a href="/games/about">about <?php echo get_bloginfo('name');?></a>
		 

		<?php 
			if ( strtolower(get_bloginfo('name')) != "sohorses") {
				echo " | <a href=\"http://www.sohorses.com\">Play cool horse games for girls on soHorses.com</a>";
				echo " | <a href=\"http://www.girlwithgun.com/quadgamesvault\">quadgames vault</a>";
			}
		?>

	<?php if ( strtolower(get_bloginfo('name')) != "sohorses") echo "<!--";?>
	 <!--<a href="http://www.facebook.com/sohorses">Like us on Facebook!</a> <div class="fb-like" data-href="https://www.facebook.com/sohorses" data-layout="button_count" data-show-faces="true" data-font="tahoma" data-width="100"></div>-->
	<?php if ( strtolower(get_bloginfo('name')) != "sohorses") echo "-->";?>

	| &copy 2013 wungi 

	</div>


</div>

</body>
</html>
