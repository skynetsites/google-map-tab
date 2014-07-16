<?php
// db table version
global $db_table_version;
$db_table_version = "1.0";

function install(){
	// makes the location table
	global $wpdb;
    global $db_table_version;
    
	$table_name = $wpdb->prefix . "gmt_tab";
    
	// provide an update
    $installed_ver = get_option( "db_table_version" );
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ||  $installed_ver != $db_table_version ) {
        $sql = "CREATE TABLE " . $table_name . " (
              `id` INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `lat` TEXT NOT NULL,
              `lon` TEXT NOT NULL,
              `title` TEXT NOT NULL,
              `content` TEXT NOT NULL,
              `zoom` TEXT NOT NULL,
              UNIQUE KEY id (id)
            )ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
			
		$sql.= "INSERT INTO `" . $table_name . "` (`id`, `lat`, `lon`, `title`, `content`, `zoom`) VALUES
			(1, '52.1', '11.3', 'Title A', 'Lorem Ipsum..', '12'),
			(2, '51.2', '22.2', 'Title B', 'Lorem Ipsum..', '12'),
			(3, '49.4', '35.9', 'Title C', 'Lorem Ipsum..', '12'),
			(4, '47.8', '15.6', 'Title D', 'Lorem Ipsum..', '12');";
			
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
	update_option( "db_table_version", $db_table_version );
}
	add_option("db_table_version", $db_table_version);
}

function install_data() {
	global $wpdb;
	$welcome_name = "Mr. WordPress";
	$welcome_text = "Congratulations, you just completed the installation!";
	$table_name = $wpdb->prefix . "gmt_tab";
	$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'name' => $welcome_name, 'text' => 			
	$welcome_text ) );
}

// check for update
add_action( 'plugins_loaded', 'update_db_check' );
function update_db_check() {
    global $db_table_version;
    if ( get_site_option( 'db_table_version' ) != $db_table_version ) {
        install();
    }
}
