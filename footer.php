

<div id="footer" role="contentinfo">


	<div id="tagcloud">
		<?php 
			$args = array('number' => 10);
			wp_tag_cloud($args); 

		?>
	</div>

	<div>
		<a href="/">Home</a> - 
		<a href="/about">About <?php echo get_bloginfo('name');?></a>
		- &copy 2013 Wungi
	</div>
</div>

		<?php wp_footer(); ?>
		<!--end #page div-->
</div>
</body>
</html>
