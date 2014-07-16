<?php
add_action( 'admin_head', 'gmt_add_tinymce' );
function gmt_add_tinymce() {
    global $typenow;

    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'gmt_add_tinymce_plugin' );
     add_filter( 'mce_buttons', 'gmt_add_tinymce_button' );
}

function gmt_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['gmt_tab'] = plugin_dir_url( __FILE__ ) . 'js/tinymce-button.js';
    //var_dump( $plugin_array );
    return $plugin_array;
}

function gmt_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'gmt_button_key' );
    //var_dump( $buttons );
    return $buttons;
}
