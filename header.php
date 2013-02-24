<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0
 *
 * This file is here for Backwards compatibility with old themes and will be removed in a future version
 *
 */
_deprecated_file( sprintf( __( 'Theme without %1$s' ), basename(__FILE__) ), '3.0', null, sprintf( __('Please include a %1$s template in your theme.'), basename(__FILE__) ) );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<?php 
	//META DESCRIPTIONS FOR GOOGLE
	if (is_single()) $meta = get_post_meta($post->ID,'meta-description',true);
	else if (is_tag()) $meta = "Play free online " . get_query_var('tag') . " games at " . get_bloginfo("name");
	else if (is_category()) $meta = "Play free online " . get_the_category_by_ID( get_query_var('cat') ) . " games at ". get_bloginfo("name")	;
	else $meta = get_bloginfo('description');
	echo "<meta name=\"description\" content=\"" .$meta. "\"/>";
?>



<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--
<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Short+Stack' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Cherry+Swash' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Kranky' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Margarine' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Flamenco' rel='stylesheet' type='text/css'>
-->
<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>




<link rel="shortcut icon" href="/wp-content/themes/girlwithgun/sohorses.ico?v=2">




<?php 



//add portal specific CSS overrides  
if ( strtolower(get_bloginfo('name')) == "sohorses" ) echo '<link rel="stylesheet" href="/wp-content/themes/girlwithgun/sohorses.css" type="text/css" media="screen" />';

?>


<?php wp_head(); ?>


<?php 
	//site specific google tracking id
	if (strtolower(get_bloginfo('name')) == "sohorses") $trackingid = "UA-1140834-4";
	else if (strtolower(get_bloginfo('name')) == "girlwithgun") $trackingid = "UA-1140834-1";
	else $trackingid = "UA-1140834-1";
?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $trackingid;?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>


<script type="text/javascript">

//used by renderthumbnail.php


function showthumbnailTitle(thumb) {
		
		var shadow = thumb.getElementsByClassName("overlayshadow")[0];

}

function hidethumbnailTitle(thumb) {

		var shadow = thumb.getElementsByClassName("overlayshadow")[0];

}



</script>

<!--FACEBOOK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=115396571974411";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--END FACEBOOK-->

</head>
<body <?php body_class(); ?>>


<div id="centerdiv" class="backgroundcolor">


<div id="header" role="banner">
	<a href="<?php echo home_url(); ?>/">
	<?php 
	if(!is_home()) {
		//echo '<div id="homebutton">Home</div>';
	}
	?>
	<h1 id="headerimg" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
			
	</h1>
	</a>
	<div id="searchformbox">
		<?php get_search_form(); ?>
	</div>



	<div id="facebook_like">

		<h2 class="description smalltext"><?php bloginfo('description'); ?></h2>
		<div class="fb-like" data-href="https://www.facebook.com/sohorses" data-layout="button_count" data-show-faces="true" data-font="tahoma" data-width="100"></div>
		<!--<div class="description smalltext">follow us on Facebook!</div>-->
	</div>

	<div id="category_mainmenu">
	<?php

		if(!is_home()) {
			echo "<div class =\"homeicon tagbutton \">";
				echo "<a href=\"/\">all games</a>";
			echo "</div>";	
		}

		$args = array( 'orderby' => 'count', 'order' => 'DESC', 'number' => '5');
		$cats = get_categories($args);
		//highlight the active cat on homepage and cat page
		if (is_single()) {
			$t = get_the_category();
			$active_cat = $t[0]->name; 
		
		}
		else if (is_category()) {
			$active_cat = get_the_category_by_ID( get_query_var('cat') );
			
		}
		foreach($cats as $cat) {
			if ($cat->name == $active_cat ) {
			echo "<div class =\"activecat tagbutton \">";
				echo "<a href=\"/category/$cat->slug\">$cat->name games</a>";
			echo "</div>";				
			}
			else {
			echo "<div class =\"tagbutton\">";
				echo "<a href=\"/games/category/$cat->slug\">$cat->name games</a>";
			echo "</div>";
			}
		}

	?>
		<!--open up the sliding list of all categories-->
		<div class ="tagbutton" ><a href="javascript:void(0)" onclick="$('#fullmenu').slideToggle();" >more games...</a></div>
	
	</div>
	

</div>
<style>
 #fullmenu {
 	display:none;
 }
</style>
<div id="fullmenu" class="themecolor1">
	<div class ="closebutton" ><a href="javascript:void(0)" onclick="$('#fullmenu').slideToggle();" >x</a></div>
	<?php
		$args = array();
		$cats = get_categories($args);
		foreach($cats as $cat) {
			echo "<li>";
				echo "<a href=\"/games/category/$cat->slug\">$cat->name games <span>$cat->description</span> </a> ";

				//echo "<span>$cat->description</span>";
			echo "</li>";
		}
	?>
</div>

