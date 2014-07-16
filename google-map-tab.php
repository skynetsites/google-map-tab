<?php
/*
Plugin Name: Google Map Tab
Plugin URI: http://wordpress.org/support/plugin/google-map-tab
Description: A plugin that allows you to tab with Google Maps to your posts or pages using a shortcode [google-map-tab]. To add a shortcode in posts or pages simply click the Insert Google Map Tab button in the editor..
Author: Isaías Oliveira
Version: 1.0
Author URI: https://www.facebook.com/isaiaswebnet
License: GPLv2
*/


	// inc db-settings | create settings table db
	require_once( 'inc/db-settings.php' );

	// call the activation installer
	register_activation_hook( __FILE__, 'install' );
	register_activation_hook( __FILE__, 'install_data' );

// create plugin menu
add_action( 'admin_menu', 'plugin_menu' );
function plugin_menu() {
	// create menu in submenu page
	add_menu_page( 'Google Map Tab','Google Map Tab','manage_options','options','wp_options',plugin_dir_url( __FILE__ ).'/inc/js/images/gmt-icon.png' );
	add_submenu_page('options',__( 'List', 'googlemaptab' ),__( 'List', 'googlemaptab' ),'manage_options','list','wp_list');
	add_submenu_page( 'options',__( 'Add', 'googlemaptab' ),__( 'Add', 'googlemaptab' ), 'manage_options', 'add', 'wp_add' );
	add_submenu_page('options',__( 'Settings', 'googlemaptab' ),__( 'Settings', 'googlemaptab' ),'manage_options','settings','wp_options');

	// global variable remove duplicate menu 
	unset($GLOBALS['submenu']['options'][0]);

	// call register settings function
	add_action( 'admin_init', 'register_settings' );	
}
// call languages pt_BR
add_action( 'plugins_loaded', 'languages' );
function languages() {
load_plugin_textdomain( 'googlemaptab', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// register our settings
function register_settings() {
	register_setting( 'options-group', 'id_tabs' );
	register_setting( 'options-group', 'max_width' );
	register_setting( 'options-group', 'min_width' );
	register_setting( 'options-group', 'height' );
	register_setting( 'options-group', 'map_type' );
	register_setting( 'options-group', 'all' );
	register_setting( 'options-group', 'view_all' );
	register_setting( 'options-group', 'active' );
	register_setting( 'options-group', 'info' );
	register_setting( 'options-group', 'background_color' );
	register_setting( 'options-group', 'text_color' );
}

// back end
add_action('admin_enqueue_scripts',	'admin_scripts' );
function admin_scripts() {
	wp_enqueue_style( 'styles', plugins_url('/inc/css/styles.css', __FILE__), array(), null, 'all' );
	wp_enqueue_script( 'wp-tab-bar', plugins_url('/inc/js/wp-tab-bar.js', __FILE__) , array(), null, true );
	wp_enqueue_script( 'jscolor', plugins_url('/inc/js/jscolor.js', __FILE__) , array(), null, true );
}

// front end
add_action('wp_enqueue_scripts', 'front_scripts' );
function front_scripts() {
	wp_enqueue_script( 'maps-api', 'http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7', array(), '', true );
	wp_enqueue_script( 'maplace-0.1.3.min', plugins_url('/inc/js/maplace.min.js', __FILE__) , array(), '', true );
}

/*
* includes
*/

// inc page settings
function wp_options() { 
	require_once( 'inc/settings.php' );
}

// inc page list
function wp_list() { 
	require_once( 'inc/list.php' );
}

// inc page add
function wp_add(){ 
	require_once( 'inc/add.php' );
}

	// inc shortcode [google-map-tab]
	require_once( 'inc/shortcode.php' );

	// inc gmt-shortcode
	require_once( 'inc/gmt-shortcode.php' );
