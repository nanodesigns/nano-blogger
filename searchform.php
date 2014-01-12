<?php
/**
 * nano blogger search form
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<label for="s" class="assistive-text"><?php _e( 'Search', 'nano-blogger' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'nano-blogger' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'nano-blogger' ); ?>"/>
	</form>
