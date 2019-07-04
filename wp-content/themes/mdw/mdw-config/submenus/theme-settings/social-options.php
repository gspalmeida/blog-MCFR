<?php
$icons_style	 = get_theme_mod( "icons_style", "normal" );
$display_email	 = get_the_author_meta( 'display_email', get_current_user_id() );

$twitter_share		 = get_theme_mod( 'twitter_share', '0' );
$google_share		 = get_theme_mod( 'google_share', '0' );
$facebook_share		 = get_theme_mod( 'facebook_share', '0' );
$fb_comments		 = get_theme_mod( 'fb_comments', '0' );
$comments_button	 = get_theme_mod( 'comments_button', '' );
$minimal_share_count = get_theme_mod( 'minimal_share_count', '10' );
$social_icons_text = get_theme_mod('social_icons_text', 'Do you want to share?');
?>

<div id="social_options_panel" class="container-fluid wraper">
	<h1><?php _e( "Social options", "mdw" ); ?></h1>
	<div class="row">
		<?php
		$social_networks	 = array(
			'facebook'		 => 'facebook-official',
			'linkedin'		 => 'linkedin-square',
			'twitter'		 => 'twitter-square',
			'google'		 => 'google-plus-square',
			'instagram'		 => 'instagram',
			'pinterest'		 => 'pinterest-square',
			'youtube'		 => 'youtube-square',
			'dribbble'		 => 'dribbble',
			'vkontakte'		 => 'vk',
			'stackOverflow'	 => 'stack-overflow',
			'github'		 => 'github',
		);
		foreach ( $social_networks as $network => $icon ) {
			?>
			<div class="col-md-6">
				<div class="md-form">
					<i class="fa <?php echo "fa-" . $icon; ?> prefix"></i>
					<input
						class="form-control author-social-link"
						type="text"
						name="<?php echo ($network . '_profile'); ?>"
						value="<?php echo esc_attr( get_the_author_meta( ($network . '_profile' ), get_current_user_id() ) ); ?>"
						placeholder="<?php echo ucwords( $network ) . ' URL'; ?>"
						/>
					<label for="<?php //echo ($network . '_profile');    ?>"><?php //echo ucwords($network) . ' URL';    ?></label>
				</div>
			</div>
		<?php } ?>
		<div class="col-md-6">
			<div class="md-form">
				<i class="fa fa-share-square-o prefix"></i>
				<input type="number" id="minimal_share_count" name="minimal_share_count" class="form-control" placeholder="<?php _e( "Minimal share count", "mdw" ); ?>" value="<?php echo $minimal_share_count; ?>">
				<!-- <label for="minimal_share_count">Minimal share count</label> -->
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<fieldset class="form-group">
				<input <?php echo $facebook_share == '1' ? 'checked' : ''; ?> name="facebook_share" type="checkbox" id="facebook_share">
				<label for="facebook_share">Facebook share</label>
			</fieldset>
		</div>
		<div class="col-md-6">
			<fieldset class="form-group">
				<input <?php echo $twitter_share == '1' ? 'checked' : ''; ?> name="twitter_share" type="checkbox" id="twitter_share">
				<label for="twitter_share">Twitter share</label>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<fieldset class="form-group">
				<input <?php echo $google_share == '1' ? 'checked' : ''; ?> name="google_share" type="checkbox" id="google_share">
				<label for="google_share">Google+ share</label>
			</fieldset>
		</div>
		<div class="col-md-6">
			<fieldset class="form-group">
				<input <?php echo $comments_button == '1' ? 'checked' : ''; ?> name="comments_button" type="checkbox" id="comments_button">
				<label for="comments_button">Comments button</label>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<fieldset class="form-group">
				<input
					type="checkbox"
					id="display_email"
					name="display_email"
					value="<?php echo $display_email; ?>"
					<?php echo $display_email == '1' ? 'checked' : '' ?>
					/>
				<label for="display_email"><?php _e( "Email in an author box", "mdw" ) ?></label>
			</fieldset>

		</div>
		<div class="col-md-6">
			<fieldset class="form-group">
				<input <?php echo $fb_comments == '1' ? 'checked' : ''; ?> name="fb_comments" type="checkbox" id="fb_comments">
				<label for="fb_comments">Facebook comments</label>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Icons style", "mdw" ); ?></h4>
			<select name="icons_style">
				<option <?php echo $icons_style == 'normal' ? 'selected' : ''; ?> value="normal" name="option">Normal</option>
				<option <?php echo $icons_style == 'large' ? 'selected' : ''; ?> value="large">Large</option>
				<option <?php echo $icons_style == 'simple' ? 'selected' : ''; ?> value="simple">Simple</option>
				<option <?php echo $icons_style == 'simple_large' ? 'selected' : ''; ?> value="simple_large">Large Simple</option>
				<option <?php echo $icons_style == 'floating' ? 'selected' : ''; ?> value="floating">Floating</option>
				<option <?php echo $icons_style == 'floating_small' ? 'selected' : ''; ?> value="floating_small">Small Floating</option>
				<option <?php echo $icons_style == 'social_list' ? 'selected' : ''; ?> value="social_list">Social List</option>
			</select>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Preview", "mdw" ); ?></h4>
			<label for="social_icons_text"><?php echo _e('Set your social icons text: ', 'mdw') ?></label>
			<input				
				type="text"
				name="<?php echo ('social_icons_text'); ?>"
				value="<?php echo $social_icons_text ; ?>"
				placeholder="Custom social icons text"
				/>
			<div>
				<img src="<?php echo get_template_directory_uri() . '/components/icons-style/previews/' . $icons_style . '.jpg'; ?>" id="icons_style_preview" class="img-fluid" />
			</div>	
		</div>
	</div>
		

	<div class="row">
		<div class="col-md-12 save-section">
			<button id="social_options_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>
</div>



<script>
    var socialOptionsSettings = jQuery( "#social_options_panel" ).find( "input[type='text'], input[type='number'], select, input[type='radio']:checked, input[type='checkbox']" );
    var socialOptionsSave = jQuery( "#social_options_save" );
    var iconsPageRadios = jQuery( "#social_options_panel" ).find( "select[name='icons_style']" );
    var iconsPreviewSrc = "<?php echo get_template_directory_uri() . '/components/icons-style/previews/' ?>";
    iconsPageRadios.on( "change", function ( e ) {
        jQuery( "#icons_style_preview" ).attr( "src", iconsPreviewSrc + jQuery( this ).val() + ".jpg" );
    } )

    socialOptionsSave.on( "click", function ( e ) {

        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: 'save_social_settings',
        };

        socialOptionsSettings.each( function ( i, e ) {
            if ( jQuery( e ).val() == 'on' ) {
                jQuery( e ).val( '1' );
            }
            data[jQuery( e ).attr( 'name' )] = jQuery( e ).val();
        } );

        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            socialOptionsSave.html( "<i class='fa fa-check'></i> " + r );
            socialOptionsSave.attr( "class", "btn btn-success" );
            resetButton( socialOptionsSave );
        } ).fail( function ( e ) {
            socialOptionsSave.html( "<i class='fa fa-times'></i> " + r );
            socialOptionsSave.attr( "class", "btn btn-error" );
            resetButton( socialOptionsSave );
        } );
    } );

    jQuery( "#social_options_panel" ).find( "input[type='checkbox']" ).on( "change", function ( e ) {
        if ( jQuery( this ).is( ":checked" ) ) {
            jQuery( this ).val( "1" );
        } else {
            jQuery( this ).val( "0" );
        }
    } )
</script>
