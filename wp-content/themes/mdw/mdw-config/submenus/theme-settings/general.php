<?php
$font_style				 = get_theme_mod( "font_style", "300" );
$post_listing_version	 = get_theme_mod( "post_listing_version", "4" );
$back_to_the_top		 = get_theme_mod( "back_to_the_top", "no" );
$default_button			 = get_theme_mod( "default_button", "normal" );
$layout_type			 = get_theme_mod( "layout_type", "container_sidebar" );
$flex_cols				 = get_theme_mod( "flex_cols", "no" );
$sidenav_image			 = get_theme_mod( "sidenav_image", "" );
$color_scheme			 = get_theme_mod( "color_scheme", "navy-blue-skin" );
$background_image		 = get_theme_mod( "background_image", "" );
$background_repeat		 = get_theme_mod( "background_repeat", "no-repeat" );
$background_position_x	 = get_theme_mod( "background_position_x", "center" );
$background_attachment	 = get_theme_mod( "background_attachment", "scroll" );
$background_color		 = get_theme_mod( "background_color", "#FFFFFF" );

$theme_status	 = get_theme_mod( "theme_status", "production" );

?>

<div id="general_settings_panel" class="container-fluid wraper">
	<h1><?php _e( "General Settings", "mdw" ); ?></h1>
	<div class="switch col-md-12">
		<label>
			Test mode
			<input <?php echo $theme_status == "production" ? "checked value='production' " : "value='test'"; ?> name="theme_status" type="checkbox">
			<span class="lever"></span>
			Production mode
		</label>
	</div>
	<div class="col-md-12">
		<h4><?php _e( "Post listing blog version", "mdw" ); ?></h4>
		<select name="post_listing_version">
			<option <?php echo $post_listing_version == 1 ? 'selected' : ''; ?> value="1"><?php _e( "Version 1", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 2 ? 'selected' : ''; ?> value="2"><?php _e( "Version 2", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 3 ? 'selected' : ''; ?> value="3"><?php _e( "Version 3", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 4 ? 'selected' : ''; ?> value="4"><?php _e( "Version 4", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 5 ? 'selected' : ''; ?> value="5"><?php _e( "Version 5", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 6 ? 'selected' : ''; ?> value="6"><?php _e( "Version 6", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 7 ? 'selected' : ''; ?> value="7"><?php _e( "Version 7", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 8 ? 'selected' : ''; ?> value="8"><?php _e( "Version 8", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 9 ? 'selected' : ''; ?> value="9"><?php _e( "Version 9", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 10 ? 'selected' : ''; ?> value="10"><?php _e( "Version 10", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 11 ? 'selected' : ''; ?> value="11"><?php _e( "Version 11", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 12 ? 'selected' : ''; ?> value="12"><?php _e( "Version 12", "mdw" ); ?></option>
			<option <?php echo $post_listing_version == 13 ? 'selected' : ''; ?> value="13"><?php _e( "Version 13", "mdw" ); ?></option>
		</select>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Font style", "mdw" ); ?></h4>
			<select name="font_style">
				<option <?php echo $font_style == 100 ? 'selected' : ''; ?> value="100"><?php _e( "Thin", "mdw" ); ?></option>
				<option <?php echo $font_style == 300 ? 'selected' : ''; ?> value="300"><?php _e( "Light", "mdw" ); ?></option>
				<option <?php echo $font_style == 400 ? 'selected' : ''; ?> value="400"><?php _e( "Regular", "mdw" ); ?></option>
				<option <?php echo $font_style == 500 ? 'selected' : ''; ?> value="500"><?php _e( "Medium", "mdw" ); ?></option>
			</select>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Back to the top button", "mdw" ); ?></h4>
			<select name="back_to_the_top">
				<option <?php echo $back_to_the_top == 'yes' ? 'selected' : ''; ?> value="yes"><?php _e( "Yes", "mdw" ); ?></option>
				<option <?php echo $back_to_the_top == 'no' ? 'selected' : ''; ?> value="no"><?php _e( "No", "mdw" ); ?></option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Default button", "mdw" ); ?></h4>
			<select name="default_button">
				<option <?php echo $default_button == 'normal' ? 'selected' : ''; ?> value="normal"><?php _e( "Normal", "mdw" ); ?></option>
				<option <?php echo $default_button == 'outline' ? 'selected' : ''; ?> value="outline"><?php _e( "Outline", "mdw" ); ?></option>
				<option <?php echo $default_button == 'normal-rounded' ? 'selected' : ''; ?> value="normal-rounded"><?php _e( "Normal-Rounded", "mdw" ); ?></option>
				<option <?php echo $default_button == 'outline-rounded' ? 'selected' : ''; ?> value="outline-rounded"><?php _e( "Outline-Rounded", "mdw" ); ?></option>
			</select>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Layout type", "mdw" ); ?></h4>
			<select name="layout_type">
				<option <?php echo $layout_type == 'container_sidebar' ? 'selected' : ''; ?> value="container_sidebar"><?php _e( "Margins with sidebar", "mdw" ); ?></option>
				<option <?php echo $layout_type == 'full_sidebar' ? 'selected' : ''; ?> value="full_sidebar"><?php _e( "Full page with sidebar", "mdw" ); ?></option>
				<option <?php echo $layout_type == 'container' ? 'selected' : ''; ?> value="container"><?php _e( "Margins", "mdw" ); ?></option>
				<option <?php echo $layout_type == 'full' ? 'selected' : ''; ?> value="full"><?php _e( "Full page", "mdw" ); ?></option>
			</select>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12"  id="body-skin-section" class="" >
			<h4><?php _e( 'Color scheme', 'mdw' ); ?></h4>
			<?php
			$skins			 = array(
                array( 'name' => 'Navy Blue', 'class' => 'navy-blue-skin' ),
				array( 'name' => 'Light Blue', 'class' => 'light-blue-skin' ),
				array( 'name' => 'Grey', 'class' => 'grey-skin' ),
				array( 'name' => 'MDB', 'class' => 'mdb-skin' ),
				array( 'name' => 'Deep Purple', 'class' => 'deep-purple-skin' ),
				array( 'name' => 'Pink', 'class' => 'pink-skin' ),
                array( 'name' => 'White', 'class' => 'white-skin' ),
                array( 'name' => 'Black', 'class' => 'black-skin' ),
                array( 'name' => 'Cyan', 'class' => 'cyan-skin' ),
                array( 'name' => 'Indigo', 'class' => 'indigo-skin' ),
			);
			foreach ( $skins as $skin ) {
				?>
				<label class="scheme" data-color="<?php echo $skin[ "class" ] ?>">
					<input type="radio" value="<?php echo $skin[ "class" ] ?>" name="color_scheme"  <?php echo $color_scheme == $skin[ "class" ] ? 'checked' : ''; ?>>
					<?php echo $skin[ "name" ]; ?><br>
				</label>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4 class="my-2"><?php _e( "Fixed height columns", "mdw" ); ?></h4>
			<input <?php echo $flex_cols == 'no' ? 'checked' : ''; ?> name="flex_cols" type="radio" id="flex_cols_no" value="no">
			<label for="flex_cols_no">No</label>
			<input <?php echo $flex_cols == 'yes' ? 'checked' : ''; ?> name="flex_cols" type="radio" id="flex_cols_yes" value="yes">
			<label for="flex_cols_yes">Yes</label>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h3><strong><?php _e( "Background", "mdw" ); ?></strong></h3>
		</div>
		<div class="col-md-12">
			<h4><?php _e( "Color", "mdw" ); ?></h4>
			<input type="color"
				   value="<?php echo $background_color; ?>"
				   />
			<input hidden
				   type="text"
				   value="<?php echo $background_color; ?>"
				   name="background_color"
				   id="color-code"
				   />
		</div>
		<div class="col-md-3">
			<h4><?php _e( 'Image', 'mdw' ); ?></h4>
			<div id="background_image_preview" class="preview_placeholder">
				<img src="<?php echo $background_image; ?>" class="img-fluid"/>
			</div>
			<div class="md-form input-group">
				<input class="background_image"
					   id="background_image"
					   name="background_image"
					   value="<?php echo $background_image; ?>"
					   type="text">
				<span class="input-group-btn">                      
					<button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove background image" type="button"><i class="fa fa-remove"></i></button>
				</span>
			</div>
			<button id="background_image_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
		</div>
		<div class="col-md-3">
			<h4><?php _e( "Repeat", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $background_repeat == 'repeat' ? 'checked' : ''; ?> name="background_repeat" type="radio" id="background_repeat_1" value="repeat">
				<label for="background_repeat_1"><?php _e( "Tile", "mdw" ); ?></label>
			</div>

			<div class="form-group">
				<input <?php echo $background_repeat == 'no-repeat' ? 'checked' : ''; ?> name="background_repeat" type="radio" id="background_repeat_2" value="no-repeat">
				<label for="background_repeat_2"><?php _e( "No repeat", "mdw" ); ?></label>
			</div>

			<div class="form-group">
				<input <?php echo $background_repeat == 'repeat-x' ? 'checked' : ''; ?> name="background_repeat" type="radio" id="background_repeat_3" value="repeat-x">
				<label for="background_repeat_3"><?php _e( "Tile horizontally", "mdw" ); ?></label>
			</div>

			<div class="form-group">
				<input <?php echo $background_repeat == 'repeat-y' ? 'checked' : ''; ?> name="background_repeat" type="radio" id="background_repeat_4" value="repeat-y">
				<label for="background_repeat_4"><?php _e( "Tile vertically", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-3">
			<h4><?php _e( "Position", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $background_position_x == 'left' ? 'checked' : ''; ?> name="background_position_x" type="radio" id="background_position_x_1" value="left">
				<label for="background_position_x_1"><?php _e( "Left", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $background_position_x == 'center' ? 'checked' : ''; ?> name="background_position_x" type="radio" id="background_position_x_2" value="center">
				<label for="background_position_x_2"><?php _e( "Center", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $background_position_x == 'right' ? 'checked' : ''; ?> name="background_position_x" type="radio" id="background_position_x_3" value="right">
				<label for="background_position_x_3"><?php _e( "Right", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-3">
			<h4><?php _e( "Attachment", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $background_attachment == 'scroll' ? 'checked' : ''; ?> name="background_attachment" type="radio" id="background_attachment_1" value="scroll">
				<label for="background_attachment_1"><?php _e( "Scroll", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $background_attachment == 'fixed' ? 'checked' : ''; ?> name="background_attachment" type="radio" id="background_attachment_2" value="fixed">
				<label for="background_attachment_2"><?php _e( "Fixed", "mdw" ); ?></label>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12 save-section">
			<button id="general_settings_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>


</div>

<script>
    var generalSettingsSave = jQuery( "#general_settings_save" );
    jQuery( "[name=theme_status]" ).on( "change", function ( e ) {
        if ( jQuery( this ).is( ":checked" ) ) {
            jQuery( this ).val( "production" );
        } else {
            jQuery( this ).val( "test" );
        }
    } );

    generalSettingsSave.on( "click", function ( e ) {

        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var generalSettings = jQuery( "#general_settings_panel" ).find( "input[type='text'], select, input[type='radio']:checked, [name=theme_status]" );
        var data = {
            action: 'save_general_settings',
        };
        generalSettings.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );
        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            generalSettingsSave.html( "<i class='fa fa-check'></i> " + r );
            generalSettingsSave.attr( "class", "btn btn-success" );
            resetButton( generalSettingsSave );
        } ).fail( function ( e ) {
            generalSettingsSave.html( "<i class='fa fa-times'></i> " + r );
            generalSettingsSave.attr( "class", "btn btn-error" );
            resetButton( generalSettingsSave );
        } );
    } )
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
    imgPicker( "#background_image_button", "background_image_preview", "background_image" );
    imgPicker( "#button_image_button", "button_image_preview", "button_image" );
// skin color picker
    jQuery( "#body-skin-section label" ).on( "click", function () {
        jQuery( "#body-skin-section label" ).each( function () {
            jQuery( "i", this ).remove();
            jQuery( "input", this ).removeAttr( "checked" );
        } );
        jQuery( this ).find( "input" ).attr( "checked", "" );
        jQuery( this ).append( "<i class='fa fa-check' aria-hidden='true'></i>" );
    } );

    jQuery( "#body-skin-section label input" ).each( function () {
        if ( jQuery( this ).attr( "checked" ) == "checked" ) {
            jQuery( this ).parent().append( "<i class='fa fa-check' aria-hidden='true'></i>" );
        }
    } );
</script>
