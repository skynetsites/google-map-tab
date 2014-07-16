<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
<?php
extract($_POST);
global $wpdb;
	$table	=	$wpdb->prefix."gmt_tab";

if(isset($_GET['id'])){
	$id	=	$_GET['id'];
}

	$action	=	"add";
if(isset($_GET['action'])){
	$action	=	$_GET['action'];	
}

switch($action){
	
	case "add";
	if($_POST['submit']){
		
		$data =	array(
		'lat' 		=> $lat,
    	'lon'		=> $lon,
    	'title'		=> $title,
    	'content'	=> $content,
    	'zoom'		=> $zoom
		);

if(!empty($lat) and !empty($lon) and !empty($title) and !empty($content)){
	
	$insert		=	$wpdb->insert($table,$data) or die(mysql_error());
	$isuccess	=	__( 'Successfully Added.', 'googlemaptab');
		
}else{
	$ierror		=	__( 'Required Fields.', 'googlemaptab' );	
	$class_equired = 'class="class_equired"';
}

}

break;
	
	case "update";
	if($_POST['update']){
		
		$data =	array(
		'lat' 		=> $lat,
    	'lon'		=> $lon,
    	'title'		=> $title,
    	'content'	=> $content,
    	'zoom'		=> $zoom
		);
				
$ID		=	array(
			'id'	=>	$id
			
			);
if(!empty($lat) and !empty($lon) and !empty($title) and !empty($content)){
	
	$update		=	$wpdb->update($table,$data,$ID);
	$usuccess	=	__( 'Successfully Updated.', 'googlemaptab' );
		
}else{
	$uerror		=	__( 'Required Fields.', 'googlemaptab' );
	$class_equired = 'class="class_equired"';	
}

}
	
	break;

}

$usql		=	"SELECT * FROM $table WHERE id='$id'";
$uitens 	= 	$wpdb->get_row( $usql  );


?>
<?php if($action=='update'): ?>

      <h2>
        <?php _e( 'Edit', 'googlemaptab' ); ?> 
        <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=add" class="add-new-h2"><?php _e( 'Add New', 'googlemaptab' ); ?></a>
      </h2>
       <?php if(!empty($usuccess)): ?>
        <div class="updated">
		<p><?php echo $usuccess; ?></p>
		</div>
        <?php elseif(!empty($uerror)): ?>
        <div class="error">
		<p><?php echo $uerror; ?></p>
        </div>
        <?php endif ?>
        <table class="form-table">
        <form name="addplaycidade" action="" method="post">
        
        <tr valign="top">
          <th scope="row"><span data-title="<?php _e( 'With this tool you can easily find out the geographic coordinates of a point/area. Click to start.', 'googlemaptab' ); ?>" class="tooltip"><a href="http://www.mapcoordinates.net/pt" title="" target="_blank"><strong><?php _e( 'Geographic Coordinates', 'googlemaptab' ); ?></strong></a></span></th>
          <td><input type="text" size="10" name="lat" value="<?php echo $uitens->lat; ?>" <?php echo $class_equired;?> placeholder="<?php _e( 'Latitude', 'googlemaptab' ); ?>" /> <input type="text" size="10" name="lon" value="<?php echo $uitens->lon; ?>" <?php echo $class_equired;?> placeholder="<?php _e( 'Longitude', 'googlemaptab' ); ?>" />
          <td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Title', 'googlemaptab' ); ?>
            </strong></th>
          <td><input type="text" size="35" name="title" value="<?php echo $uitens->title; ?>" <?php echo $class_equired;?> />
          <td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Address', 'googlemaptab' ); ?>
            </strong></th>
          <td><input type="text" name="content" size="70" value="<?php echo $uitens->content; ?>" <?php echo $class_equired;?> />
          <br /><small><?php _e( 'Use the tag &lt;br /&gt; for line break.', 'googlemaptab' ); ?></small></td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Zoom', 'googlemaptab' ); ?>
            </strong></th>
          <td><select name="zoom">
              <?php for($i=1;$i<101;$i++):?>
              <option value="<?php echo $i;?>" <?php if ( $uitens->zoom == $i ) echo 'selected'; ?>><?php echo $i;?></option>
              <?php endfor;?>
            </select></td>
        </tr>
        <tr valign="top">
          <th scope="row"><input type="submit" class="button-primary" value="<?php _e( 'Update', 'googlemaptab' ); ?>" name="update" /></th>
          <td></td>
        </tr>
      </table>
      </form>
      <?php else:?>
      <h2>
        <?php _e( 'Add', 'googlemaptab' ); ?>
      </h2>
      <?php if(!empty($isuccess)): ?>
<div class="updated">
<p><?php echo $isuccess; ?> <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=list" title=""><?php _e( 'See List', 'googlemaptab' ); ?></a></p>
</div>
<?php elseif(!empty($ierror)): ?>
<div class="error">
<p><?php echo $ierror; ?></p>
</div>
<?php endif ?>
      <table class="form-table">
       
        <form name="addplaycidade" action="" method="post">
          <tr valign="top">
            <th scope="row"><span data-title="<?php _e( 'With this tool you can easily find out the geographic coordinates of a point/area. Click to start.', 'googlemaptab' ); ?>" class="tooltip"><a href="http://www.mapcoordinates.net/pt" title="" target="_blank"><strong><?php _e( 'Geographic Coordinates', 'googlemaptab' ); ?></strong></a></span></th>
            <td><input type="text" size="10" name="lat" <?php echo $class_equired;?> placeholder="<?php _e( 'Latitude', 'googlemaptab' ); ?>" /> <input type="text" size="10" name="lon" <?php echo $class_equired;?> placeholder="<?php _e( 'Longitude', 'googlemaptab' ); ?>" />
            <td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <td><input type="text" size="35" name="title" <?php echo $class_equired;?> />
            <td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Address', 'googlemaptab' ); ?>
              </strong></th>
            <td><input type="text" name="content" size="70" <?php echo $class_equired;?> />
            <br /><small><?php _e( 'Use the tag &lt;br /&gt; for line break.', 'googlemaptab' ); ?></small></td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Zoom', 'googlemaptab' ); ?>
              </strong></th>
            <td><select name="zoom">
                <?php for($i=1;$i<101;$i++):?>
                <option value="<?php echo $i;?>" <?php echo $i=='12'?'selected':'';?>><?php echo $i;?></option>
                <?php endfor;?>
              </select></td>
          </tr>
          <tr valign="top">
            <th scope="row"><input type="submit" class="button-primary" value="<?php _e( 'Insert', 'googlemaptab' ); ?>" name="submit" /></th>
            <td></td>
          </tr>
        </form>
      </table>
      <?php endif ?>
    </div>
  </div>
</div>
