<div class="row">
	<div class="col-md-12">
		<form id="ga_update" method="post" action="options.php">
			<h1>Google Analytics Integration</h1>
			<?php
			settings_fields( 'mdw-config-ga-optgroup' );
			do_settings_sections( 'mdw-config-ga-optgroup' );
			?>
			<div class="form_input">
				<h4><label for="<?php echo get_tool_name( 'ga' ) ?>[id]">ID:</label></h4>
				<input type="text" id="<?php echo get_tool_name( 'ga' ) ?>-ga_id" name="google_analytics_id" value="<?php echo esc_attr( get_option( 'google_analytics_id' ) ); ?>">
			</div>

			<?php submit_button( 'Save' ); ?>
		</form>
	</div>
</div>
