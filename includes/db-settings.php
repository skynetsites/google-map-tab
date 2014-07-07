<?php
add_action( 'wp_enqueue_scripts', 'script' );
function script(){
	wp_enqueue_script('jquery');	
}

global $db_table_version;
$db_table_version = "1.0";

function db_create () {
    create_table();
}

function create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix . "gmt_tab";
    global $db_table_version;
    $installed_ver = get_option( "db_table_version" );
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name
            ||  $installed_ver != $db_table_version ) {
        $sql = "CREATE TABLE " . $table_name . " (
              `id` INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `lat` TEXT NOT NULL,
              `lon` TEXT NOT NULL,
              `title` TEXT NOT NULL,
              `content` TEXT NOT NULL,
              `zoom` TEXT NOT NULL,
              UNIQUE KEY id (id)
            );";
			
		$sql.= "INSERT INTO `px_gmt_tab` (`id`, `lat`, `lon`, `title`, `content`, `zoom`) VALUES
(1, '52.1', '11.3', 'Title A', 'Lorem Ipsum..', '8'),
(2, '51.2', '22.2', 'Title B', 'Lorem Ipsum..', '8'),
(3, '49.4', '35.9', 'Title C', 'Lorem Ipsum..', '8'),
(4, '47.8', '15.6', 'Title D', 'Lorem Ipsum..', '8');";
			

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        update_option( "db_table_version", $db_table_version );
}
    
	add_option("db_table_version", $db_table_version);

}