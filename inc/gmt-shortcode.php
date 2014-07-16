<?php
// shortcode [google-map-tab]
add_shortcode('google-map-tab','google_map_tab');
function google_map_tab() { 
	
	// General
	$id_tabs	= get_option('id_tabs');
	if(!$id_tabs){ $id_tabs =	'tabs';}
	
	$max_width	= get_option('max_width');
	if(!$max_width){ $max_width =	'';}
	
	$min_width	= get_option('min_width');
	if(!$min_width){ $min_width =	'';}
	
	$height	= get_option('height');
	if(!$height){ $height =	'300';}
	
	// structure
	$map_type	= get_option('map_type');
	if(!$map_type){ $map_type =	'ROADMAP';}
	
	$all	= get_option('all');
	if(!$all){ $all =	'View All';}
	
	$view_all	= get_option('view_all');
	if(!$view_all){ $view_all =	'true';}
	
	$start = $view_all=='true'?'0':'1';
	
	$info	= get_option('info');
	if(!$info){ $info =	'0';}
	
	// color
	$background_color	= get_option('background_color');
	if(!$background_color){ $background_color =	'F9F9F9';}
	
	$active	= get_option('active');
	if(!$active){ $active =	'B82200';}
	
	$text_color	= get_option('text_color');
	if(!$text_color){ $text_color =	'333333';}

echo '<section id="'.$id_tabs.'" class="row">';
echo '<div id="controls-'.$id_tabs.'"></div>';
echo $info == '1'?'<div id="info-'.$id_tabs.'"></div>':'';
echo '<div id="gmap-'.$id_tabs.'"></div>';
echo '</section>';
?>
<script>
var <?php echo $id_tabs;?> = [
<?php 
global $wpdb;
$table	=	$wpdb->prefix.'gmt_tab';	
$lsql	=	"SELECT * FROM $table";
$itens	=	$wpdb->get_results( $lsql );
foreach($itens as $iten): 
	$lat = $iten->lat;
	$lon = $iten->lon;
	$title = $iten->title;
	$content = $iten->content;
	$zoom	= $iten->zoom;
	if(!$zoom){ $zoom =	'12';}
?>
    {
      lat: <?php echo $lat; ?>,
      lon: <?php echo $lon; ?>,
      title: '<?php echo $title; ?>',
      html: [
            '<h3><?php echo $title; ?></h3>',
            '<p><?php echo $content; ?></p>'
      ].join(''),
        zoom: <?php echo $zoom; ?>
    },
<?php endforeach; ?>
];
$jquery = jQuery.noConflict();
$jquery(function() {
new Maplace({
	locations: <?php echo $id_tabs;?>,
	map_div: '#gmap-<?php echo $id_tabs;?>',
	controls_div: '#controls-<?php echo $id_tabs;?>',
	controls_type: 'list',
	controls_on_map: false,
	show_infowindow: true,
	view_all: <?php echo $view_all; ?>,
	view_all_text: '<?php echo $all; ?>',
	start: <?php echo $start; ?>,
	map_options: {
		mapTypeId: google.maps.MapTypeId.<?php echo $map_type; ?>
	},
	afterShow: function(index, location, marker) {
		$jquery('#info-<?php echo $id_tabs;?>').html(location.html);
	}
}).Load();
}); 
</script>
<style>#<?php echo $id_tabs;?> {<?php echo 'max-width:'.$max_width.'px;';?>width:100%;<?php echo 'min-width:'.$min_width.'px;';?>min-height:1px;padding:0;margin:0;position:relative;float:left;}#<?php echo $id_tabs;?> h3 {margin:0 0 5px 0 !important;line-height: 1 !important}#<?php echo $id_tabs;?> p {margin:0 !important;}#<?php echo $id_tabs;?> .row {width:auto;max-width:none;min-width:0;}#controls-<?php echo $id_tabs;?> {list-style:none;display:block;min-height:1px;padding:0;margin:0;}#controls-<?php echo $id_tabs;?> .ullist {width:100%;}#controls-<?php echo $id_tabs;?> .ullist {margin-bottom:17px;line-height:1.6;list-style-position:outside;}#controls-<?php echo $id_tabs;?> .ullist li {display:block;padding:0;margin:0;list-style-type:none;font-size:14px;direction:ltr;float:left;}#controls-<?php echo $id_tabs;?> .ullist li:first-child {margin-left: 0;}#controls-<?php echo $id_tabs;?> .ullist li.active {border-top:3px solid #<?php echo $active;?> !important;font-weight:bold;background-color:#fff !important;}#controls-<?php echo $id_tabs;?> .ullist li a {min-height:1px;line-height:35px;padding:0px 20px !important;}#controls-<?php echo $id_tabs;?> .ullist li.active a {font-weight:bold;line-height: 32px;cursor:default;font-weight:bold;}#<?php echo $id_tabs;?> *, *:before, *:after {box-sizing:border-box;}#info-<?php echo $id_tabs;?> {width:100%;min-height:1px;padding:10px 10px 0 10px;margin:0;position:relative;float:left;}#gmap-<?php echo $id_tabs;?> {width:97.3% !important;height:<?php echo $height;?>px !important;padding:3px;border:5px solid #<?php echo $background_color;?>;box-sizing:content-box;}#<?php echo $id_tabs;?> img {max-width: none;}#info-<?php echo $id_tabs;?>, #controls-<?php echo $id_tabs;?> .ullist li.active a  {background-color:#<?php echo $background_color;?>;}#<?php echo $id_tabs;?> h3,#<?php echo $id_tabs;?> p,#controls-<?php echo $id_tabs;?> .ullist li a,#controls-<?php echo $id_tabs;?> .ullist li.active a {color:#<?php echo $text_color;?> !important;}</style>
<?php
}