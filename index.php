<?php
/*
Plugin Name: Google Map Tab
Plugin URI: https://github.com/isaiaswebnet/google-map-tab
Description: A plugin that allows you to tab with Google Maps to your posts or pages using a shortcode [google-map-tab]. To add a shortcode in posts or pages simply click the Insert Google Map Tab button in the editor..
Author: Isaías Oliveira
Version: 1.0
Author URI: https://www.facebook.com/isaiaswebnet
*/
include 'shortcode_tinymce.php';
register_activation_hook( __FILE__, 'db_create' );

require 'includes/db-settings.php';

add_action( 'admin_menu', 'plugin_menu' );
function plugin_menu() {
	add_menu_page( 'Google Map Tab', 'Google Map Tab', 'manage_options', 'options', 'wp_options',plugin_dir_url( __FILE__ )."/javascripts/images/gmt-icon.png" );
	add_submenu_page('options','','','manage_options','options','wp_options');
	add_submenu_page( 'options', 'Adicionar', 'Adicionar', 'manage_options', 'add', 'wp_add' );
	add_submenu_page('options','Configurações','Configurações','manage_options','settings','wp_options');
}

add_action( 'admin_init', 'register_settings' );
function register_settings() {
	register_setting( 'baw-settings-group', 'id_tabs' );
	register_setting( 'baw-settings-group', 'max_width' );
	register_setting( 'baw-settings-group', 'min_width' );
	register_setting( 'baw-settings-group', 'height' );
	register_setting( 'baw-settings-group', 'map_type' );
	register_setting( 'baw-settings-group', 'all' );
	register_setting( 'baw-settings-group', 'view_all' );
	register_setting( 'baw-settings-group', 'active' );
}

add_action( 'plugins_loaded', 'languages' );
function languages() {
load_plugin_textdomain( 'googlemaptab', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function wp_options() { ?>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ );?>javascripts/jscolor.js"></script>
<?php
include 'settings.php';
}

function wp_add(){ ?>
<style type="text/css">
#add tr.cor {
	background: #f9f9f9;
}
#add td {
	vertical-align: middle;
}
.class_equired {
	border: 1px #FF0000 solid !important
}
</style>
<?php
include('add.php');
}

add_shortcode('google-map-tab','google_map_tab');
function google_map_tab() { 
	
	$id_tabs	= get_option('id_tabs');
	if(!$id_tabs){ $id_tabs =	'tabs';}

?>
<section id="<?php echo $id_tabs; ?>" class="row">
  <div class="four columns gtabs mobile-two">
    <ul class="tabs-content">
      <li class="active" id="example4Tab">
        <div class="row">
          <div class="four columns">
            <div class="gmap_controls tabs" id="controls-tabs"></div>
          </div>
        </div>
	 <div class="row">
	  <div class="four columns">
	   <div id="info" class="tab-content"></div>
	  </div>
	 </div>
        <div class="gmap" id="gmap-tabs"></div>
      </li>
    </ul>
  </div>
</section>
<?php
}

add_action( 'wp_enqueue_scripts', 'enqueue_script' );
function enqueue_script() {
	wp_enqueue_style( 'libs.min', plugin_dir_url( __FILE__ ).'stylesheets/libs.min.css', false, 'screen' );
	wp_enqueue_style( 'app', plugin_dir_url( __FILE__ ).'stylesheets/app.css', false, 'screen' );
	wp_enqueue_script( 'jquery-1.9.0.min', 'http://code.jquery.com/jquery-1.9.0.min.js', false );
	wp_enqueue_script( 'maps', 'http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7', false );
	wp_enqueue_script( 'maplace', plugin_dir_url( __FILE__ ).'javascripts/maplace.js', false );
}

add_action( 'wp_footer', 'script_script' );
function script_script() {
	
	$id_tabs	= get_option('id_tabs');
	if(!$id_tabs){ $id_tabs =	'tabs';}
	
	$max_width	= get_option('max_width');
	if(!$max_width){ $max_width =	'800';}
	
	$min_width	= get_option('min_width');
	if(!$min_width){ $min_width =	'700';}
	
	$height	= get_option('height');
	if(!$height){ $height =	'300';}
	
	$view_all	= get_option('view_all');
	if(!$view_all){ $view_all =	'true';}
	
	$map_type	= get_option('map_type');
	if(!$map_type){ $map_type =	'ROADMAP';}
	
	$all	= get_option('all');
	if(!$all){ $all =	'View All';}
	
	$view_all	= get_option('view_all');
	if(!$view_all){ $view_all =	'true';}
	
	$active	= get_option('active');
	if(!$active){ $view_all =	'true';}
	
	$start = $view_all=='true'?'0':'1';
?>
<style>
#<?php echo $id_tabs;?> {width:<?php echo $max_width;?>px;max-width:100%;min-width:<?php echo $min_width;?>px;margin:0 auto}
#<?php echo $id_tabs;?> .gmap {height: <?php echo $height;?>px !important;}
#<?php echo $id_tabs;?> h3 {margin: 10px 0 5px 0 !important;line-height: 1 !important}
#<?php echo $id_tabs;?> p {margin: 0 0 5px 0 !important;}
#<?php echo $id_tabs;?> .tabs li.active {border-top: 3px solid #<?php echo $active;?>  !important;}
</style>
<script type="text/jscript">
var Tabs = [
<?php 
global $wpdb;
$table	=	$wpdb->prefix.'gmt_tab';	
$lsql	=	"SELECT * FROM $table";
$itens	=	$wpdb->get_results( $lsql );
foreach($itens as $iten): 
	$lat = $iten->lat;
	$lon = $iten->lon;
	$title = $iten->title;
	$content = strip_tags($iten->content);
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

$(function() {
 
 new Maplace({
	locations: Tabs,
	map_div: '#gmap-tabs',
	controls_div: '#controls-tabs',
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
		$('#info').html(location.html);
	}
 }).Load(); 

});
</script>
<?php
 }

