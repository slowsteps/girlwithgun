

<style>
.stretch {
	clear:both;
}
</style>


<div class="stretch"></div>

		<?php wp_footer(); ?>

		<!--end #page div-->




</div>


<div id="footer">

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
		
		<a href="/">home</a> |  
		<a href="/about">about <?php echo get_bloginfo('name');?></a>
		| &copy 2013 wungi | <a href="http://www.sohorses.com">Play cool horse games for girls on soHorses.com</a>
	</div>


</div>

</body>
</html>
