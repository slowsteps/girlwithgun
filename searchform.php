
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"></label>
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Search" onclick="_gaq.push(['_trackEvent', 'searchsubmit', 'clicked'])"/>
    </div>
</form>

<!--AUTOCOMPLETE-->

<style>

.ui-autocomplete {
	font-size: 18px;
	padding:10px;
	
	border: 3px solid hotpink;
	box-shadow: 5px 5px 10px rgb(50,50,50);
}

.ui-menu-item {
	background-image: none;	
	height: 80px;
}

.ui-widget-content .ui-state-focus
{
    background-image: none; 
	border-radius: 0px;
	border: 1px solid transparent;
    color: hotpink;
    background-color: transparent;
    height: 75px;

   
}

.autocompletethumb {
	vertical-align: top;
	margin-right: 10px;
	border-radius: 4px;
}

</style>

<script>
var games = [];
//WATCHOUT, ALL ECHO ENDS UP AS JAVASCRIPT IN THE PAGE

<?php
	$args = array('orderby' => 'post_title', 'order' => 'desc','numberposts' => 200);	
	$gameslist = get_posts( $args );
	
	foreach ($gameslist as $post) {

		
		$thumburl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0];
		$attr = array('class' => 'autocompletethumb');
		$thumb = get_the_post_thumbnail($post->ID,array(80,60),$attr);
		//replace doublequotes, otherwise the object chokes
		$thumb = str_replace('"', "'", $thumb);
		$lowtitle = strtolower($post->post_title);
		//url to open
		$name = $post->post_name;
		echo "var gamedata = {label: \"$lowtitle\", value: \"$lowtitle\", thumb:\"$thumb\", thumburl:\"$thumburl\",name:\"$name\"};";
		echo "\ngames.push(gamedata);\n";
	}
	
?>

</script>

<script>

	

      $.ui.autocomplete.prototype._renderItem = function( ul, item) {
          var re = new RegExp("^" + this.term) ;
          var t = item.label.replace(re,"<span style='font-weight:bold;'>" + this.term +  "</span>");
          return $( "<li></li>" ).data( "item.autocomplete", item )
              .append( "<a>" + item.thumb + t + "</a>" )
              .appendTo( ul );
      };
  
	
	$( "#s" ).autocomplete({source: games,select: onSelect});


	function onSelect (event, ui) {
		 location.href = "/games/" + ui.item.name;
		 //ui.item.name;
    }


</script>



<script>

	//var gamenames = <?php echo json_encode($gamenames ); ?>;
	//var obj = {source: gamenames};	
	//$( "#s" ).autocomplete(obj);

</script>








