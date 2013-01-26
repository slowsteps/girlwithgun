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
	//echo get_query_var('post');
	if (is_single()) echo get_post_custom_values('meta_description', $post->ID);
	else echo "<meta name=\"description\" content=\"" .get_bloginfo('description') . "\"/>";
?>



<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>

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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>



<script type="text/javascript">

//used by renderthumbnail.php


function showthumbnailTitle(thumb) {
		
		var shadow = thumb.getElementsByClassName("overlayshadow")[0];

}

function hidethumbnailTitle(thumb) {

		var shadow = thumb.getElementsByClassName("overlayshadow")[0];

}



</script>


</head>
<body <?php body_class(); ?>>


<div id="centerdiv">


<div id="header" role="banner">
	<a href="<?php echo home_url(); ?>/">
	<?php 
	if(!is_home()) {
		//echo '<div id="homebutton">Home</div>';
	}
	?>
	<div id="headerimg" onclick="_gaq.push(['_trackEvent', 'logo', 'clicked'])">
		<h1><?php bloginfo('name'); ?></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>
	</a>
	<div id="searchformbox">
		<?php get_search_form(); ?>
	</div>

</div>

