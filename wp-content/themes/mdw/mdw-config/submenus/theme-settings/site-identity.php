<?php
$favicon				 = get_theme_mod( "favicon", "" );
$sitetitle				 = get_option( "blogname", "" );
$tagline				 = get_theme_mod( "tagline", "" );
$copyright_text			 = get_theme_mod( "copyright_text", "" );
$display_copyright_text	 = get_theme_mod( 'display_copyright_text', 'yes' );


?>
<div class="container-fluid wraper" id="site_identity_panel">
	<h1><?php _e( 'Site identity', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-4">
			<h4><?php _e( "Favicon", "mdw" ); ?></h4>
			<div id="favicon_image_preview" class="preview_placeholder">
				<img src="<?php echo $favicon; ?>" class="img-fluid"/>
			</div>
			<div class="md-form input-group">
				<input class="favicon"
					   id="favicon"
					   name="favicon"
					   value="<?php echo $favicon ?>"
					   type="text">
				<span class="input-group-btn">                      
					<button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove background image" type="button"><i class="fa fa-remove"></i></button>
				</span>
			</div>
			<button id="favicon_image_button" class="btn btn-primary"><?php _e( 'Select Favicon', 'mdw' ); ?></button>
		</div>


		<div class="col-md-4">

			<h4><?php _e( "Site title & Tagline", "mdw" ); ?></h4>
			<br>
			<input class="title_text"
				   id="sitetitle"
				   name="sitetitle"
				   value="<?php echo $sitetitle ?>"
				   placeholder="<?php _e( 'Site title', 'mdw' ); ?>"
				   type="text">


			<br>


			<div class="">
				<input class="title_text"
					   id="tagline"
					   name="tagline"
					   value="<?php echo $tagline ?>"
					   placeholder="<?php _e( 'Tagline', 'mdw' ); ?>"
					   type="text">
			</div>
		</div>	
		<div class="col-md-4">
			<h4><?php _e( "Footer Copyright Text", "mdw" ); ?></h4>
			<div id="inputsRadioSelect">
				<div class="form-group">
					<input <?php echo $display_copyright_text == 'yes' ? 'checked' : ''; ?> name="display_copyright_text" type="radio" id="display_copyright_text_yes" value="yes">
					<label for="display_copyright_text_yes"><?php _e( "Blog name", "mdw" ); ?></label>
				</div>
				<div class="form-group">
					<input <?php echo $display_copyright_text == 'no' ? 'checked' : ''; ?> name="display_copyright_text" type="radio" id="display_copyright_text_no" value="no">
					<label for="display_copyright_text_no"><?php _e( "Custom", "mdw" ); ?></label>
				</div>
			</div>
			<input class="title_text"
				   style="<?php echo $display_copyright_text == 'yes' ? 'display: none;' : ''; ?>"
				   id="copyright_text"
				   name="copyright_text"
				   value="<?php echo $copyright_text ?>"
				   placeholder="<?php _e( 'Copyright text', 'mdw' ); ?>"
				   type="text">
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 save-section">
			<button id="site_identity_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
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

    var siteIdentitySave = jQuery( "#site_identity_save" );
    siteIdentitySave.on( "click", function ( e ) {

        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_site_identity_settings"
        };
        var siteIdentityInputs = jQuery( "#site_identity_panel" ).find( "input[type='text'], select, input[type='radio']:checked" );
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


</script>
