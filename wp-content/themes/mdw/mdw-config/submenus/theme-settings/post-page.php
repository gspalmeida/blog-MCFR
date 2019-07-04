<?php
$display_post_thumbnail	 = get_theme_mod( 'display_post_thumbnail', 'yes' );
$display_author_box		 = get_theme_mod( 'display_author_box', 'yes' );
$display_post_tags		 = get_theme_mod( 'display_post_tags', 'yes' );
$display_post_author	 = get_theme_mod( 'display_post_author', 'yes' );
$display_post_date		 = get_theme_mod( 'display_post_date', 'yes' );
$display_post_category	 = get_theme_mod( 'display_post_category', 'yes' );
$display_sidebar		 = get_theme_mod( 'display_sidebar', 'yes' );
$display_buttons		 = get_theme_mod( 'display_buttons', 'yes' );
$post_page				 = get_theme_mod( 'post_page', '' );
$button_image			 = get_theme_mod( "button_image", "" );

if ( $button_image == '' ) {
	$button_image = get_template_directory_uri() . '/img/prevnextbutton.jpg';
}
?>

<div class="container-fluid wraper" id="post_page_panel">
	<h1><?php _e( 'Post page', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Display Featured Image", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_post_thumbnail == 'yes' ? 'checked' : ''; ?> name="display_post_thumbnail" type="radio" id="display_post_thumbnail_yes" value="yes">
				<label for="display_post_thumbnail_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_post_thumbnail == 'no' ? 'checked' : ''; ?> name="display_post_thumbnail" type="radio" id="display_post_thumbnail_no" value="no">
				<label for="display_post_thumbnail_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Display Post Author", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_post_author == 'yes' ? 'checked' : ''; ?> name="display_post_author" type="radio" id="display_post_author_yes" value="yes">
				<label for="display_post_author_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_post_author == 'no' ? 'checked' : ''; ?> name="display_post_author" type="radio" id="display_post_author_no" value="no">
				<label for="display_post_author_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Display Post Date", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_post_date == 'yes' ? 'checked' : ''; ?> name="display_post_date" type="radio" id="display_post_date_yes" value="yes">
				<label for="display_post_date_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_post_date == 'no' ? 'checked' : ''; ?> name="display_post_date" type="radio" id="display_post_date_no" value="no">
				<label for="display_post_date_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Display Post Category", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_post_category == 'yes' ? 'checked' : ''; ?> name="display_post_category" type="radio" id="display_post_category_yes" value="yes">
				<label for="display_post_category_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_post_category == 'no' ? 'checked' : ''; ?> name="display_post_category" type="radio" id="display_post_category_no" value="no">
				<label for="display_post_category_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Display Author Box", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_author_box == 'yes' ? 'checked' : ''; ?> name="display_author_box" type="radio" id="display_author_box_yes" value="yes">
				<label for="display_author_box_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_author_box == 'no' ? 'checked' : ''; ?> name="display_author_box" type="radio" id="display_author_box_no" value="no">
				<label for="display_author_box_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Display Post Tags", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_post_tags == 'yes' ? 'checked' : ''; ?> name="display_post_tags" type="radio" id="display_post_tags_yes" value="yes">
				<label for="display_post_tags_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_post_tags == 'no' ? 'checked' : ''; ?> name="display_post_tags" type="radio" id="display_post_tags_no" value="no">
				<label for="display_post_tags_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Display Default Buttons", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_buttons == 'yes' ? 'checked' : ''; ?> name="display_buttons" type="radio" id="display_buttons_yes" value="yes">
				<label for="display_buttons_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_buttons == 'no' ? 'checked' : ''; ?> name="display_buttons" type="radio" id="display_buttons_no" value="no">
				<label for="display_buttons_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Display sidebar", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $display_sidebar == 'yes' ? 'checked' : ''; ?> name="display_sidebar" type="radio" id="display_sidebar_yes" value="yes">
				<label for="display_sidebar_yes"><?php _e( "Yes", "mdw" ); ?></label>
			</div>
			<div class="form-group">
				<input <?php echo $display_sidebar == 'no' ? 'checked' : ''; ?> name="display_sidebar" type="radio" id="display_sidebar_no" value="no">
				<label for="display_sidebar_no"><?php _e( "No", "mdw" ); ?></label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="col-md-6">
				<h4><?php _e( 'Default button image (pref. size 300 : 100)', 'mdw' ); ?></h4>
				<div id="button_image_preview" class="preview_placeholder">
					<img src="<?php echo $button_image; ?>" class="img-fluid"/>
				</div>
				<div class="md-form input-group">
					<input class="button_image"
						   id="button_image"
						   name="button_image"
						   value="<?php echo $button_image; ?>"
						   type="text">
					<span class="input-group-btn">                      
						<button class="btn btn-primary btn-sm input-cleaner" data-toggle="tooltip" data-placement="bottom" title="Remove button image" type="button"><i class="fa fa-remove"></i></button>
					</span>
				</div>
				<button id="button_image_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
			</div>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Post page", "mdw" ); ?></h4>
			<select name="post_page">
				<option value=""><?php _e( "Cascading", "mdw" ); ?></option>
				<option value="default"><?php _e( "Default", "mdw" ); ?></option>
				<option value="titleup"><?php _e( "Title up", "mdw" ); ?></option>
				<option value="coverphoto"><?php _e( "Cover photo", "mdw" ); ?></option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 save-section">
			<button id="post_page_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>
</div>
<script>
    jQuery( ".input-cleaner" ).on( "click", function ( e ) {
        jQuery( this ).parent().prev().val( "" );
        jQuery( this ).parent().parent().prev().find( "img" ).attr( "src", "" );
    } );


    var postPageSave = jQuery( "#post_page_save" );
    postPageSave.on( "click", function ( e ) {
        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_post_page_settings"
        };
        var postPageInputs = jQuery( "#post_page_panel" ).find( "input[type='text'], select, input[type='radio']:checked" );
        postPageInputs.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );


        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            postPageSave.html( "<i class='fa fa-check'></i> " + r );
            postPageSave.attr( "class", "btn btn-success" );
            resetButton( postPageSave );
        } ).fail( function ( e ) {
            postPageSave.html( "<i class='fa fa-times'></i> " + r );
            postPageSave.attr( "class", "btn btn-error" );
            resetButton( postPageSave );
        } );
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
    imgPicker( "#button_image_button", "button_image_preview", "button_image" );
</script>
