<?php
$navigation_type = get_theme_mod( "navigation_type", "navbar" );
$navbar_type	 = get_theme_mod( "navbar_type", "basic" );
$sidenav_type	 = get_theme_mod( "sidenav_type", "fixed" );
$nav_transparent = get_theme_mod( "nav_transparent", "no" );
$search_form	 = get_theme_mod( "search_form", "navbar" );
$footer_type	 = get_theme_mod( "footer_type", "advanced" );

$nav_fb_icon	 = get_theme_mod( "nav_fb_icon", "" );
$nav_fb_link	 = get_theme_mod( "nav_fb_link", "" );
$nav_gp_icon	 = get_theme_mod( "nav_gp_icon", "" );
$nav_gp_link	 = get_theme_mod( "nav_gp_link", "" );
$nav_tw_icon	 = get_theme_mod( "nav_tw_icon", "" );
$nav_tw_link	 = get_theme_mod( "nav_tw_link", "" );
$nav_insta_icon	 = get_theme_mod( "nav_insta_icon", "" );
$nav_insta_link	 = get_theme_mod( "nav_insta_link", "" );
$custom_sidenav = get_theme_mod('custom_sidenav', 'no');
$logo_image				 = get_theme_mod( "logo_image", "" );
$favicon				 = get_theme_mod( "favicon", "" );
$sitetitle				 = get_option( "blogname", "" );
$tagline				 = get_theme_mod( "tagline", "" );
$navbar_logo			 = get_theme_mod( "navbar_logo", "" );
$copyright_text			 = get_theme_mod( "copyright_text", "" );
$display_copyright_text	 = get_theme_mod( 'display_copyright_text', 'yes' );
$sidenav_opacity = get_theme_mod( 'sidenav_opacity', 'strong');
$sidenav_image = get_theme_mod('sidenav_image', '');
$default_sidenav_image = get_theme_mod('default_sidenav_image', '1');

?>

<div class="container-fluid wraper" id="navigation_identity">
	
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Sidebar Menu logo", "mdw" ); ?></h4>
			<div id="logo_image_preview" class="preview_placeholder">
				<img src="<?php echo $logo_image; ?>" class="img-fluid"/>
			</div> 
			<div class="md-form input-group"> 
				<input class="logo_image"
					   id="logo_image"
					   name="logo_image"
					   value="<?php echo $logo_image; ?>"
					   type="text">                                          
				<span class="input-group-btn">                      
					<button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove background image" type="button"><i class="fa fa-remove"></i></button>
				</span>
			</div>
			<button id="logo_image_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
		</div>
        <div class="col-md-6">
                <h4><?php _e( "Horizontal Menu logo", "mdw" ); ?></h4>
                <div id="navbar_image_preview" class="preview_placeholder">
                    <img src="<?php echo $navbar_logo; ?>" class="img-fluid"/>
                </div>
                <div class="md-form input-group">
                    <input class="navbar_logo"
                           id="navbar_logo"
                           name="navbar_logo"
                           value="<?php echo $navbar_logo; ?>"
                           type="text">
                    <span class="input-group-btn">                      
                        <button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove background image" type="button"><i class="fa fa-remove"></i></button>
                    </span>
                </div>
                <button id="navbar_image_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
            </div>
			<div class="col-md-6" >
					<h4>Custom background image</h4>
					<input type="radio" name="custom_sidenav" id="custom_sidenav_yes" value="yes" <?php echo $custom_sidenav == "yes" ? "checked" : "" ?> >
					<label for="custom_sidenav_yes">Yes</label><br>
					<input type="radio" name="custom_sidenav" id="custom_sidenav_no" value="no" <?php echo $custom_sidenav == "no" ? "checked" : "" ?> >
					<label for="custom_sidenav_no">No</label><br>
			</div>
            <div class="col-md-6">
                <h4><?php _e( "Mask Opacity", "mdw" ); ?></h4>

                <form class="form-inline">
                    <fieldset class="form-group">
                        <input name="sidenav_opacity" type="radio" id="sidenav_opacity_strong" value="strong"  <?php echo $sidenav_opacity == "strong" ? "checked" : "" ?>>
                        <label for="sidenav_opacity_strong">Strong</label>
                    </fieldset>

                    <fieldset class="form-group">
                        <input name="sidenav_opacity" type="radio" id="sidenav_opacity_light" value="light"  <?php echo $sidenav_opacity == "light" ? "checked" : "" ?>>
                        <label for="sidenav_opacity_light">Light</label>
                    </fieldset>

                    <fieldset class="form-group">
                        <input name="sidenav_opacity" type="radio" id="sidenav_opacity_slight" value="slight"  <?php echo $sidenav_opacity == "slight" ? "checked" : "" ?>>
                        <label for="sidenav_opacity_slight">Slight</label>
                    </fieldset>
                </form>
            </div>
				<div class="col-md-6" id="default_sidenav_image_display" <?php if ($custom_sidenav == "yes"){ ?> style="display: none;" <?php } ?>>
					<p class="text-center customizer-heading"></p>

					<div class="bg-img-preview">
						<label for="radio12"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/img/sidenav_backgrounds/sidenav1.jpg'; ?>" alt="Option 1" style="height: 230px"></label>
						<label for="radio22"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/img/sidenav_backgrounds/sidenav2.jpg'; ?>" alt="Option 2" style="height: 230px"></label>
						<label for="radio32"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/img/sidenav_backgrounds/sidenav3.jpg'; ?>" alt="Option 3" style="height: 230px"></label>
						<label for="radio42"><img class="img-fluid" src="<?php echo get_template_directory_uri().'/img/sidenav_backgrounds/sidenav4.jpg'; ?>" alt="Option 4" style="height: 230px"></label>
					</div>

					<form class="form-inline bg-img-options">
						<fieldset class="form-group col-md-2">
							<input name="default_sidenav_image" type="radio" id="radio12" value="1" <?php echo $default_sidenav_image == "1" ? "checked" : "" ?> >
							<label for="radio12"></label>
						</fieldset>

						<fieldset class="form-group col-md-2">
							<input name="default_sidenav_image" type="radio" id="radio22" value="2" <?php echo $default_sidenav_image == "2" ? "checked" : "" ?>>
							<label for="radio22"></label>
						</fieldset>

						<fieldset class="form-group col-md-2">
							<input name="default_sidenav_image" type="radio" id="radio32" value="3" <?php echo $default_sidenav_image == "3" ? "checked" : "" ?>>
							<label for="radio32"></label>
						</fieldset>

						<fieldset class="form-group col-md-2">
							<input name="default_sidenav_image" type="radio" id="radio42" value="4" <?php echo $default_sidenav_image == "4" ? "checked" : "" ?>>
							<label for="radio42"></label>
						</fieldset>
					</form>
                </div>		
		<div class="col-md-6" id="sidenav_image_custom" <?php if ($custom_sidenav == "no"){ ?> style="display: none;" <?php } ?>>
			<div id="sidenav_image_preview" class="preview_placeholder">
				<img src="<?php echo $sidenav_image; ?>" class="img-fluid"/>
			</div>
			<div class="md-form input-group">
				<input class="background_image"
					   id="sidenav_image"
					   name="sidenav_image"
					   value="<?php echo $sidenav_image; ?>"
					   type="text">
				<span class="input-group-btn">                      
					<button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove background image" type="button"><i class="fa fa-remove"></i></button>
				</span>
			</div>
			<button id="sidenav_image_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
		</div>

	</div>
	<br>

	<div class="row">
		<div class="col-md-12 save-section">
			<button id="navigation-identity-save" class="btn btn-primary" type='submit'><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>
</div>


<script>

    jQuery( ".input-cleaner" ).on( "click", function ( e ) {
        jQuery( this ).parent().prev().val( "" );
        jQuery( this ).parent().parent().prev().find( "img" ).attr( "src", "" );
    } );
    var postPageInput = jQuery( "#inputsRadioSelect input" );
    postPageInput.on( "change", function ( e ) {
        var value = jQuery( this ).attr( "value" )
        if ( value == 'no' ) {
            jQuery( "#copyright_text" ).fadeIn( 100 );
        } else {
            jQuery( "#copyright_text" ).fadeOut( 100 );
        }
    } );
    function imgPicker( button_id, p_id, c_id ) {
        jQuery( button_id ).on( 'click', function ( e ) {
            var dialog_title = 'Choose author page image';
            var button_text = 'Select Image';
            var library_type = 'image';
            var preview_id = p_id;
            var control_id = c_id;
            e.preventDefault();
            var custom_uploader = wp.media.frames.file_frame = wp.media( {
                title: dialog_title,
                button: {
                    text: button_text
                },
                library: { type: library_type },
                multiple: false
            } );
            custom_uploader.on( 'select', function () {
                attachment = custom_uploader.state().get( 'selection' ).first().toJSON();
                jQuery( '[id=\'' + c_id + '\']' ).val( attachment.url );

                var html = '';

                if ( library_type == 'image' ) {
                    html = '<img src="' + attachment.url + '" style=\'width: 100%;\'>';
                }

                if ( library_type == 'video' ) {
                    html = '<video autoplay loop><source src="' + attachment.url + '" type="video/' + get_extension( attachment.url ) + '" /></video>';
                }

                jQuery( '#' + p_id ).empty();
                jQuery( '#' + p_id ).append( html );
            } );
            custom_uploader.open();
        } );
    }
    imgPicker( "#sidenav_image_button", "sidenav_image_preview", "sidenav_image" );
    imgPicker( "#logo_image_button", "logo_image_preview", "logo_image" );
    imgPicker( "#favicon_image_button", "favicon_image_preview", "favicon" );
    imgPicker( "#navbar_image_button", "navbar_image_preview", "navbar_logo" );

    var siteIdentitySave = jQuery( "#navigation-identity-save" );
    siteIdentitySave.on( "click", function ( e ) {

        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_nav_settings"
        };
        var siteIdentityInputs = jQuery( "#navigation_identity" ).find( "input[type='text'], select, input[type='radio']:checked" );
        siteIdentityInputs.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );
        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            siteIdentitySave.html( "<i class='fa fa-check'></i> " + r );
            siteIdentitySave.attr( "class", "btn btn-success" );
            resetButton( siteIdentitySave );
        } ).fail( function ( e ) {
            siteIdentitySave.html( "<i class='fa fa-times'></i> " + r );
            siteIdentitySave.attr( "class", "btn btn-error" );
            resetButton( siteIdentitySave );
        } );
    } );
    var postPageInput = jQuery( '[name="custom_sidenav"]' );
	postPageInput.on( "change", function ( e ) {
        var value = jQuery( this ).attr( "value" )
        if ( value == 'yes' ) {
            jQuery( "#sidenav_image_custom" ).show();
            jQuery( "#default_sidenav_image_display" ).hide();

        } else {
            jQuery( "#sidenav_image_custom" ).hide();
            jQuery( "#default_sidenav_image_display" ).show();
        }
    } );
	
	


</script>
