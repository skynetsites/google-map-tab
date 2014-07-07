<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
      <h2>
        <?php _e( 'Settings', 'googlemaptab' ); ?>
      </h2>
      <form method="post" action="options.php">
        <table class="form-table" cellpadding="0" cellspacing="0" border="0">
          <?php 
		  settings_fields( 'baw-settings-group' );
		  $id_tabs	=	get_option('id_tabs');
		  $max_width = get_option('max_width');
		  $min_width = get_option('min_width'); 
		  $height = get_option('height');
		  $map_type	=	get_option('map_type');
		  $view_all	=	get_option('view_all');
		  $all	=	get_option('all');
		  $active	=	get_option('active')
		  ?>
          <tr valign="top">
            <th scope="row"><?php _e( 'Tab ID', 'googlemaptab' ); ?></th>
            <td><input type="text" name="id_tabs" value="<?php echo $id_tabs; ?>" size="16" /></td>
          </tr>
          <tr valign="top">
            <th scope="row" ><?php _e( 'Width', 'googlemaptab' ); ?></th>
            <td><input type="text" name="max_width" value="<?php echo $max_width;?>" size="5" placeholder="<?php _e( 'Maximum', 'googlemaptab' ); ?>" />
              |
              <input type="text" name="min_width" value="<?php echo $min_width;?>" size="5" placeholder="<?php _e( 'Minimum', 'googlemaptab' ); ?>" /></td>
          <tr valign="top">
            <th scope="row"><?php _e( 'Height', 'googlemaptab' ); ?></th>
            <td><input type="text" name="height" value="<?php echo $height;?>" size="5" /></td>
          <tr valign="top">
            <th scope="row"><?php _e( 'Type of Map', 'googlemaptab' ); ?></th>
            <td><select name="map_type">
                <option value="ROADMAP" <?php if ( $map_type == 'ROADMAP' ) echo 'selected="selected"'; ?>>
                <?php _e( 'Rodmap', 'googlemaptab' ); ?>
                </option>
                <option value="SATELLITE" <?php if ( $map_type == 'SATELLITE' ) echo 'selected="selected"'; ?>>
                <?php _e( 'Satellite', 'googlemaptab' ); ?>
                </option>
                <option value="TERRAIN" <?php if ( $map_type == 'TERRAIN' ) echo 'selected="selected"'; ?>>
                <?php _e( 'Terrain', 'googlemaptab' ); ?>
                </option>
                <option value="HYBRID" <?php if ( $map_type == 'HYBRID' ) echo 'selected="selected"'; ?>>
                <?php _e( 'Hybrid', 'googlemaptab' ); ?>
                </option>
              </select></td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php _e( 'View All', 'googlemaptab' ); ?></th>
            <td><select name="view_all">
                <option value="true" <?php if ( $view_all == 'true' ) echo 'selected="selected"'; ?>>
                <?php _e( 'True', 'googlemaptab' ); ?>
                </option>
                <option value="false" <?php if ( $view_all == 'false' ) echo 'selected="selected"'; ?>>
                <?php _e( 'False', 'googlemaptab' ); ?>
                </option>
              </select></td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php _e( 'See All Title', 'googlemaptab' ); ?></th>
            <td><input type="text" name="all" value="<?php echo get_option('all');?>" size="30" /></td>
          </tr>
          <tr valign="top">
            <th scope="row"><?php _e( 'Active Tab', 'googlemaptab' ); ?></th>
            <td><input type="text" name="active" value="<?php if ( $active == '' ) {echo '#b82200';}else{ echo $active;}; ?>" size="10" class="color" /></td>
          </tr>
        </table>
        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'googlemaptab' ); ?>" />
        </p>
      </form>
    </div>
  </div>
</div>
