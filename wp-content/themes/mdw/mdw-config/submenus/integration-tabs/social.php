<div class="row">
	<div class="col-md-12">
		<form id="social-settings" method="post" action="options.php" style="max-width: 600px;">
			<h1>Social configuration</h1>
			<div class="row">
				<div class="col-md-12">
					<?php
					settings_fields( 'mdw-config-social-optgroup' );
					do_settings_sections( 'mdw-config-social-optgroup' );
					?>
					<h4>Allow linking accounts: </h4>
					<input type="radio" name="linking-accounts" value="yes" id="linking-yes" <?php
					if ( get_option( 'linking-accounts' ) == 'yes' ) {
						echo "checked";
					}
					?>>
					<label for="linking-yes">Yes</label><br>					
					<input type="radio" name="linking-accounts" value="no" id="linking-no" <?php
					if ( get_option( 'linking-accounts' ) != 'yes' ) {
						echo "checked";
					}
					?>>
					<label for="linking-no">No</label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4><b>Facebook:</b></h4>
					<input type="text" name="fb-id" id="fb-id" placeholder="App ID" value="<?php echo esc_attr( get_option( 'fb-id' ) ); ?>">
					<label for="fb-id">Facebook App ID</label><br>
					<input type="text" name="fb-secret" id="fb-secret" placeholder="App Secret" value="<?php echo esc_attr( get_option( 'fb-secret' ) ); ?>">
					<label for="fb-secret">Facebook App Secret</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4><b>Twitter:</b></h4>
					<input type="text" name="tw-id" id="tw-id" placeholder="Consumer Key (API Key)" value="<?php echo esc_attr( get_option( 'tw-id' ) ); ?>">
					<label for="tw-id">Consumer Key (API Key)</label><br>
					<input type="text" name="tw-secret" id="tw-secret" placeholder="Consumer Secret (API Secret)" value="<?php echo esc_attr( get_option( 'tw-secret' ) ); ?>">
					<label for="tw-secret">Consumer Secret (API Secret)</label>
				</div>
			</div>
		

			<?php submit_button( 'Save' ); ?>
		</form>
	</div>	
</div>