<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
      <h2>
        <?php _e( 'Settings', 'googlemaptab' ); ?>
      </h2>
      <?php if($_GET['settings-updated']=='true'): ?>
      <div class="updated">
        <p>
          <?php _e( 'Saved Settings.', 'googlemaptab' ); ?>
        </p>
      </div>
      <?php endif ?>
      <form method="post" action="options.php">
        <input type="hidden" value="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=settings&settings-updated=true">
        <?php 
		  settings_fields( 'options-group' );
		  $id_tabs	=	get_option('id_tabs');
		  $max_width = get_option('max_width');
		  $min_width = get_option('min_width'); 
		  $height = get_option('height');
		  $map_type	=	get_option('map_type');
		  $view_all	=	get_option('view_all');
		  $all	=	get_option('all');
		  $info	=	get_option('info');
		  $active	=	get_option('active');
		  $background_color	=	get_option('background_color');
		  $text_color	=	get_option('text_color');
		  ?>
        <ul class="wp-tab-bar">
          <li class="wp-tab-active"><a href="#tabs-1">
            <?php _e( 'General', 'googlemaptab' ); ?>
            </a></li>
          <li><a href="#tabs-2">
            <?php _e( 'Structure', 'googlemaptab' ); ?>
            </a></li>
          <li><a href="#tabs-3">
            <?php _e( 'Colors', 'googlemaptab' ); ?>
            </a></li>
        </ul>
        <div class="wp-tab-panel" id="tabs-1">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><?php _e( 'Tab ID', 'googlemaptab' ); ?></th>
                <td><input type="text" name="id_tabs" value="<?php echo $id_tabs; ?>" size="16" /></td>
              </tr>
              <tr>
                <th scope="row" ><?php _e( 'Width', 'googlemaptab' ); ?></th>
                <td><input type="text" name="max_width" value="<?php echo $max_width;?>" size="5" placeholder="<?php _e( 'Maximum', 'googlemaptab' ); ?>" />
                  <input type="text" name="min_width" value="<?php echo $min_width;?>" size="5" placeholder="<?php _e( 'Minimum', 'googlemaptab' ); ?>" /></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Height', 'googlemaptab' ); ?></th>
                <td><input type="text" name="height" value="<?php echo $height;?>" size="5" /></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="wp-tab-panel" id="tabs-2" style="display: none;">
          <table class="form-table">
            <tbody>
              <tr>
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
              <tr>
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
              <tr>
                <th scope="row"><?php _e( 'See All Title', 'googlemaptab' ); ?></th>
                <td><input type="text" name="all" value="<?php echo get_option('all');?>" size="30" /></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Info', 'googlemaptab' ); ?></th>
                <td><select name="info">
                    <option value="1" <?php if ( $info == '1' ) echo 'selected="selected"'; ?>>
                    <?php _e( 'True', 'googlemaptab' ); ?>
                    </option>
                    <option value="0" <?php if ( $info == '0' ) echo 'selected="selected"'; ?>>
                    <?php _e( 'False', 'googlemaptab' ); ?>
                    </option>
                  </select></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="wp-tab-panel" id="tabs-3" style="display: none;">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><?php _e( 'Background Color', 'googlemaptab' ); ?></th>
                <td><input type="text" name="background_color" value="<?php if ( $background_color == '' ) {echo '#F9F9F9';}else{ echo $background_color;}; ?>" size="10" class="color" /></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Text Color', 'googlemaptab' ); ?></th>
                <td><input type="text" name="text_color" value="<?php if ( $text_color == '' ) {echo '#333333';}else{ echo $text_color;}; ?>" size="10" class="color" /></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Active Tab Color', 'googlemaptab' ); ?></th>
                <td><input type="text" name="active" value="<?php if ( $active == '' ) {echo '#B82200';}else{ echo $active;}; ?>" size="10" class="color" /></td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'googlemaptab' ); ?>" />
        </p>
      </form>
    </div>
  </div>
</div>
