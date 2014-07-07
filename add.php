<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
      <h2>
        <?php _e( 'Add', 'googlemaptab' ); ?>
      </h2>
      <?php

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
		$lat		=	$_POST['lat'];
    	$lon		=	$_POST['lon'];
    	$title		=	$_POST['title'];
    	$content	=	$_POST['content'];
    	$zoom		=	$_POST['zoom'];
	
$data =	array(
		'lat' 		=> $lat,
    	'lon'		=> $lon,
    	'title'		=> $title,
    	'content'	=> $content,
    	'zoom'		=> $zoom
		);

if(!empty($_POST['lat']) and !empty($_POST['lon']) and !empty($_POST['title']) and !empty($_POST['content'])){
	
	$insert		=	$wpdb->insert($table,$data) or die(mysql_error());
	$isuccess	=	__( 'Successfully Added', 'googlemaptab ');
		
}else{
	$ierror		=	__( 'Required Fields', 'googlemaptab' );	
	$class_equired = 'class="class_equired"';
}

}

break;
	
	case "update";
	if($_POST['update']){
		$lat		=	$_POST['lat'];
    	$lon		=	$_POST['lon'];
    	$title		=	$_POST['title'];
    	$content	=	$_POST['content'];
    	$zoom		=	$_POST['zoom'];
	
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
if(!empty($_POST['lat']) and !empty($_POST['lon']) and !empty($_POST['title']) and !empty($_POST['content'])){
	
	$update		=	$wpdb->update($table,$data,$ID);
	$usuccess	=	__( 'Successfully Added', 'googlemaptab' );
		
}else{
	$uerror		=	__( 'Required Fields', 'googlemaptab' );
	$class_equired = 'class="class_equired"';	
}

}
	
	break;
	
	
	
	case "delete";
		
		$delete		=	$wpdb->query(
							"DELETE FROM $table WHERE id='$id'"
						);
	break;	
}




$usql		=	"SELECT * FROM $table WHERE id='$id'";
$uitens 	= 	$wpdb->get_row( $usql  );


?>
      <table id="add" class="wp-cidade-table widefat fixed" cellspacing="0" style=" margin-top:20px;">
        <thead>
          <tr>
            <th scope="col" width="40%"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <th scope="col" width="40%"><strong>
              <?php _e( 'Detailing', 'googlemaptab' ); ?>
              </strong></th>
            <th colspan="2" scope="col" width="20%" style="text-align:center"><strong>
              <?php _e( 'Actions', 'googlemaptab' ); ?>
              </strong></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <tr>
            <th scope="col" width="40%"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <th scope="col" width="40%"><strong>
              <?php _e( 'Detailing', 'googlemaptab' ); ?>
              </strong></th>
            <th colspan="2" scope="col" width="20%" style="text-align:center"><strong>
              <?php _e( 'Actions', 'googlemaptab' ); ?>
              </strong></th>
          </tr>
        </tfoot>
        <tbody id="the-cidade">
          <?php
		$sql	=	"SELECT * FROM $table";

		$itens 	= 	$wpdb->get_results( $sql );
		$total = mysql_affected_rows();
	?>
          <?php if( !empty( $itens ) ) : ?>
          <?php foreach( $itens as $iten ): $i++;
		  
		  $zebra=($i%2)?'cor':'';
		  ?>
          <tr class="<?php echo $zebra; ?>">
            <td><?php echo $iten->title;?></td>
            <td><strong>
              <?php _e( 'Address', 'googlemaptab' ); ?>
              : </strong> <?php echo $iten->content; ?><br />
              <strong>
              <?php _e( 'Latitude', 'googlemaptab' ); ?>
              : </strong><?php echo $iten->lat; ?> | <strong>
              <?php _e( 'Longitude', 'googlemaptab' ); ?>
              : </strong><?php echo $iten->lon; ?><br/>
              <strong>
              <?php _e( 'Zoom', 'googlemaptab' ); ?>
              : </strong><?php echo $iten->zoom;?></td>
            <td><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=update&id=<?php echo $iten->id; ?>">
              <?php _e( 'Edit', 'googlemaptab' ); ?>
              </a></td>
            <td width="10%"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=delete&id=<?php echo $iten->id; ?>">
              <?php _e( 'Delete', 'googlemaptab' ); ?>
              </a></td>
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
        <td class="posts column-posts num" colspan="4"><?php _e( 'Please, you need to add the information in the fields below', 'googlemaptab' ); ?></td>
          <?php endif; ?>
          </tbody>
      </table>
      <?php if($action=='update'): ?>
      <table class="form-table">
        <form name="addplaycidade" action="" method="post">
        
        <tr valign="top">
          <th scope="row"><a href="http://www.mapcoordinates.net/pt" title="Map Coordinates - Google Maps encontrar coordenadas facilmente" target="_blank"><strong>
            <?php _e( 'Geographic Coordinates', 'googlemaptab' ); ?>
            </strong></a></th>
          <td><input type="text" size="10" name="lat" value="<?php echo $uitens->lat; ?>" <?php echo $class_equired;?> placeholder="<?php _e( 'Latitude', 'googlemaptab' ); ?>" />
            |
            <input type="text" size="10" name="lon" value="<?php echo $uitens->lon; ?>" <?php echo $class_equired;?> placeholder="<?php _e( 'Longitude', 'googlemaptab' ); ?>" />
          <td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Title', 'googlemaptab' ); ?>
            </strong></th>
          <td><input type="text" size="50" name="title" value="<?php echo $uitens->title; ?>" <?php echo $class_equired;?> />
          <td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Address', 'googlemaptab' ); ?>
            </strong></th>
          <td><input type="text" name="content" size="80" value="<?php echo $uitens->content; ?>" <?php echo $class_equired;?> /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><strong>
            <?php _e( 'Zoom', 'googlemaptab' ); ?>
            </strong></th>
          <td><select name="zoom">
              <?php for($i=1;$i<101;$i++):?>
              <option value="<?php echo $i;?>" <?php if ( $uitens->zoom == $i ) echo 'selected="selected"'; ?>><?php echo $i;?></option>
              <?php endfor;?>
            </select></td>
        </tr>
        <tr valign="top">
          <th scope="row"><input type="submit" class="button-primary" value="<?php _e( 'Update', 'googlemaptab' ); ?>" name="update" /></th>
          <td><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=add">
            <input type="button" class="button-primary" value="<?php _e( 'Add New', 'googlemaptab' ); ?>" name="add_new" style=" font-weight:bold" />
            </a></td>
        </tr>
      </table>
      </form>
      <?php else:?>
      <table class="form-table">
        <?php if(!empty($isuccess)): ?>
        <tr valign="top">
          <td width="21%"><span style="color:green;"><?php echo $isuccess; ?></span></td>
        </tr>
        <?php elseif(!empty($ierror)): ?>
        <tr valign="top">
          <td width="21%"><span style="color:red;"><?php echo $ierror; ?></span></td>
        </tr>
        <?php endif ?>
        <form name="addplaycidade" action="" method="post">
          <tr valign="top">
            <th scope="row"><a href="http://www.mapcoordinates.net/pt" title="Map Coordinates - Google Maps encontrar coordenadas facilmente" target="_blank"><strong>
              <?php _e( 'Geographic Coordinates', 'googlemaptab' ); ?>
              </strong></a></th>
            <td><input type="text" size="10" name="lat" <?php echo $class_equired;?> placeholder="<?php _e( 'Latitude', 'googlemaptab' ); ?>" />
              |
              <input type="text" size="10" name="lon" <?php echo $class_equired;?> placeholder="<?php _e( 'Longitude', 'googlemaptab' ); ?>" />
            <td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <td><input type="text" size="50" name="title" <?php echo $class_equired;?> />
            <td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Address', 'googlemaptab' ); ?>
              </strong></th>
            <td><input type="text" name="content" size="80" <?php echo $class_equired;?> /></td>
          </tr>
          <tr valign="top">
            <th scope="row"><strong>
              <?php _e( 'Zoom', 'googlemaptab' ); ?>
              </strong></th>
            <td><select name="zoom">
                <?php for($i=1;$i<101;$i++):?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
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
