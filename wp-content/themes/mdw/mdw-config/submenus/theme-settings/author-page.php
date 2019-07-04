<?php
$author_version	 = get_theme_mod( 'author_version', '1' );
$author_img		 = get_theme_mod( 'author_img', '' );
$display_sidebar         = get_theme_mod( 'display_sidebar_author', 'yes' );
?>

<div id="author_page_panel" class="container-fluid wraper">
	<h1><?php _e( 'Author page settings', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Template version:", "mdw" ); ?></h4>
			<div class="form-group">
				<input <?php echo $author_version == '1' ? 'checked' : ''; ?> name="author_version" type="radio" id="author_version_1" value="1">
				<label for="author_version_1">Version 1</label>
			</div>

			<div class="form-group">
				<input <?php echo $author_version == '2' ? 'checked' : ''; ?> name="author_version" type="radio" id="author_version_2" value="2" >
				<label for="author_version_2">Version 2</label>
			</div>

			<div class="form-group">
				<input <?php echo $author_version == '3' ? 'checked' : ''; ?> name="author_version" type="radio" id="author_version_3" value="3" >
				<label for="author_version_3">Version 3</label>
			</div>

			<div class="form-group">
				<input <?php echo $author_version == '4' ? 'checked' : ''; ?> name="author_version" type="radio" id="author_version_4" value="4" >
				<label for="author_version_4">Version 4</label>
			</div>
			<h4><?php _e( "Image", "mdw" ); ?></h4>
			<div id="author_img_preview" class="preview_placeholder">
				<img src="<?php echo $author_img; ?>" class="img-fluid"/>
			</div>
			<input class="author_img"
				   id="author_img"
				   name="author_img"
				   value="<?php echo $author_img; ?>"
				   type="text">
			<button id="author_img_button" class="btn btn-primary"><?php _e( 'Select Image', 'mdw' ); ?></button>
		</div>
        <div class="col-md-6">
            <h4><?php _e( "Display sidebar", "mdw" ); ?></h4>
            <div class="form-group">
                <input <?php echo $display_sidebar == 'yes' ? 'checked' : ''; ?> name="display_sidebar_author" type="radio" id="display_sidebar_author_yes" value="yes">
                <label for="display_sidebar_author_yes"><?php _e( "Yes", "mdw" ); ?></label>
            </div>
            <div class="form-group">
                <input <?php echo $display_sidebar == 'no' ? 'checked' : ''; ?> name="display_sidebar_author" type="radio" id="display_sidebar_author_no" value="no">
                <label for="display_sidebar_author_no"><?php _e( "No", "mdw" ); ?></label>
            </div>
        </div>
		<div class="col-md-6">
			<h4><?php _e( "Preview", "mdw" ); ?></h4>
			<div>
				<img src="<?php echo get_template_directory_uri() . '/components/author/previews/v' . $author_version . '.jpg'; ?>" id="author_page_version_preview" class="img-fluid" />
			</div>
		</div>
	</div>


	<div class="row text-xs-center">
		<button id="author_page_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
	</div>

</div>

<script>
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
    imgPicker( "#author_img_button", "author_img_preview", "author_img" );
    var authorPageRadios = jQuery( "#author_page_panel" ).find( "input[type='radio']" );
    var authorPreviewSrc = "<?php echo get_template_directory_uri() . '/components/author/previews/v' ?>";
    authorPageRadios.on( "change", function ( e ) {
        jQuery( "#author_page_version_preview" ).attr( "src", authorPreviewSrc + jQuery( this ).val() + ".jpg" );
    } )

    var authorPageSave = jQuery( "#author_page_save" );
    authorPageSave.on( "click", function ( e ) {
        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );
        var data = {
            action: "save_author_page_settings"
        };
        var authorPageInputs = jQuery( "#author_page_panel" ).find( "input[type='text'], select, input[type='radio']:checked" );
        authorPageInputs.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );
        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            authorPageSave.html( "<i class='fa fa-check'></i> " + r );
            authorPageSave.attr( "class", "btn btn-success" );
            resetButton( authorPageSave );
        } ).fail( function ( e ) {
            authorPageSave.html( "<i class='fa fa-times'></i> " + r );
            authorPageSave.attr( "class", "btn btn-error" );
            resetButton( authorPageSave );
        } );
    } );
</script>
