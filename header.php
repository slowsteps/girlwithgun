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
	else $meta = get_bloginfo('description');
	echo "<meta name=\"description\" content=\"" .$meta. "\"/>";
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

	<?php if ( strtolower(get_bloginfo('name')) != "sohorses") echo "<!--";?>
	<div class="fb-follow" data-href="https://www.facebook.com/sohorses" data-layout="button_count" data-show-faces="true" data-font="tahoma" data-width="100"></div>
	<?php if (get_bloginfo('name') != "sohorses") echo "-->";?>

</div>

