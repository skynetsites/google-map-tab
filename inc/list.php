<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
      <h2>
        <?php _e( 'List', 'googlemaptab' ); ?>
        <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=add" class="add-new-h2">
        <?php _e( 'Add New', 'googlemaptab' ); ?>
        </a> </h2>
      <?php
extract($_POST);
global $wpdb;
	$table	=	$wpdb->prefix."gmt_tab";

if(isset($_GET['id'])){
	$id	=	$_GET['id'];
}

	$action	=	"list";
if(isset($_GET['action'])){
	$action	=	$_GET['action'];	
}

switch($action){
	case "delete";
	
	$data =	array(
		'id' => $id
		);

if(!empty($id)){
	
	$delete	= $wpdb->delete( $table,$data);
	$del	=	__( 'Successfully Deleted.', 'googlemaptab');
		
}	
	
	break;	
}

?>
      <?php if(!empty($del)): ?>
      <div class="updated">
        <p><?php echo $del; ?></p>
      </div>
      <?php endif ?>
      <table id="list" class="wp-list-table widefat fixed posts">
        <thead>
          <tr>
            <th scope="col" width="50%"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <th scope="col" width="50%"><strong>
              <?php _e( 'Detailing', 'googlemaptab' ); ?>
              </strong></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <tr>
            <th scope="col" width="50%"><strong>
              <?php _e( 'Title', 'googlemaptab' ); ?>
              </strong></th>
            <th scope="col" width="50%"><strong>
              <?php _e( 'Detailing', 'googlemaptab' ); ?>
              </strong></th>
          </tr>
        </tfoot>
        <tbody id="the-cidade">
          <?php
		  global $wpdb;
		$table	=	$wpdb->prefix."gmt_tab";
		$sql	=	"SELECT * FROM $table";

		$itens 	= 	$wpdb->get_results( $sql );
		$total = mysql_affected_rows();
	?>
          <?php if( !empty( $itens ) ) : ?>
          <?php foreach( $itens as $iten ): $i++;
		  
		  $zebra=($i%2)?'alternate':'';
		  ?>
          <tr class="<?php echo $zebra; ?>">
            <td><strong><a class="row-title" href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=update&id=<?php echo $iten->id; ?>t" title="Editar <?php echo $iten->title;?>"><?php echo $iten->title;?></a></strong>
              <div class="row-actions"><span class="edit"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=add&action=update&id=<?php echo $iten->id; ?>" title="">
                <?php _e( 'Edit', 'googlemaptab' ); ?>
                </a> | </span> <span class="trash"><a class="submitdelete" title="" href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=list&action=delete&id=<?php echo $iten->id; ?>">
                <?php _e( 'Delete', 'googlemaptab' ); ?>
                </a></span></div></td>
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
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
        <td class="colspanchange" colspan="2"><?php _e( 'Please, you need to add the information in the fields below.', 'googlemaptab' ); ?></td>
          <?php endif; ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
