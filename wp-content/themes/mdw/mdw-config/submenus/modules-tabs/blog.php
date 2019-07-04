<?php
$load_more_posts = get_theme_mod( 'load_more_posts', 'no' );
?>

<div class="container-fluid wraper" id="blog_panel">
	<h1><?php _e( 'Blog settings', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Load more posts in single blog listing?", "mdw" ); ?></h4>
			<select name="load_more_posts">
				<option <?php echo $load_more_posts == 'no' ? 'selected' : ''; ?> value="no"><?php _e( "No", "mdw" ); ?></option>
				<option <?php echo $load_more_posts == 'onscroll' ? 'selected' : ''; ?> value="onscroll"><?php _e( "Infinite scroll", "mdw" ); ?></option>
				<option <?php echo $load_more_posts == 'onclick' ? 'selected' : ''; ?> value="onclick"><?php _e( "On button click", "mdw" ); ?></option>
				<option <?php echo $load_more_posts == 'pagination' ? 'selected' : ''; ?> value="pagination"><?php _e( "Pagination", "mdw" ); ?></option>
			</select>
		</div>
		<div class="col-md-6">

		</div>
	</div>
	<div class="row text-xs-center">
		<div class="col-md-12 save-section">
			<button id="blog_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>

</div>
<script>
    var blogSave = jQuery( "#blog_save" );
    blogSave.on( "click", function ( e ) {

        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_blog_settings"
        };
        var blogInputs = jQuery( "#blog_panel" ).find( "input[type='text'], select, input[type='radio']:checked" );
        blogInputs.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );
        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            blogSave.html( "<i class='fa fa-check'></i> " + r );
            blogSave.attr( "class", "btn btn-success" );
            resetButton( blogSave );
        } ).fail( function ( e ) {
            blogSave.html( "<i class='fa fa-times'></i> " + r );
            blogSave.attr( "class", "btn btn-error" );
            resetButton( blogSave );
        } );
    } );
</script>
