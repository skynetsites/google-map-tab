<?php
add_action( 'admin_head', 'gmt_add_tinymce' );
function gmt_add_tinymce() {
    global $typenow;

    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'gmt_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'gmt_add_tinymce_button' );
}

// inlcude the js for tinymce
function gmt_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['gmt_tab'] = plugins_url( '/javascripts/tinymce-button.js', __FILE__ );
    // Print all plugin js path
    //var_dump( $plugin_array );
    return $plugin_array;
}

// Add the button key for address via JS
function gmt_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'gmt_button_key' );
    // Print all buttons
    //var_dump( $buttons );
    return $buttons;
}