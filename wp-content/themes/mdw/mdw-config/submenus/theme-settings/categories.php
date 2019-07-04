<?php
global $wpdb;
$categories	 = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
$category	 = get_theme_mod( 'categories', array() );

get_template_part( 'template-parts/icons' );

$cat_version		 = get_theme_mod( 'cat_version', '1' );
$cat_listing_version = get_theme_mod( 'cat_listing_version', '1' );
?>
<div class="container-fluid " id="categories_page_panel">
	<h1><?php _e( "Categories", "mdw" ); ?></h1>

	<?php if ( !empty( $categories ) ) { ?>

		<form id="categorySettingsForm" class="row" method="post">
			<div class="col-md-6">
				<div id="catTemplatePage">
					<h4><?php _e( ' Page', 'mdw' ); ?></h4>
					<input
						type="radio"
						id="catVersion1"
						name="categoryVersion"
						value="1"
						<?php echo $cat_version == '1' ? 'checked' : '' ?>
						/>
					<label for="catVersion1">Version 1</label>
					<br/>
					<input
						type="radio"
						id="catVersion2"
						name="categoryVersion"
						value="2"
						<?php echo $cat_version == '2' ? 'checked' : '' ?>
						/>
					<label for="catVersion2">Version 2</label>
				</div>
				<div id="catListing">
					<h4><?php _e( "Post's category listing", "mdw" ); ?></h4>
					<input type="radio" id="catListingv1" name="categoryListing" value="1" <?php echo $cat_listing_version == '1' ? 'checked' : '' ?> >
					<label for="catListingv1"><?php _e( "Last category name", "mdw" ); ?></label><br>
					<input type="radio" id="catListingv2" name="categoryListing" value="2" <?php echo $cat_listing_version == '2' ? 'checked' : '' ?> >
					<label for="catListingv2"><?php _e( "Breadcrumbs", "mdw" ); ?></label>
				</div>
			</div>
			<div class="col-md-6">
				<h4><?php _e( "Preview", "mdw" ); ?></h4>
				<div>
					<img src="<?php echo get_template_directory_uri() . '/components/categories/previews/v' . $cat_listing_version . '.jpg'; ?>" id="categories_page_version_preview" class="img-fluid" />
				</div>
			</div>
			<div id="catIconColor" class="col-md-12 row">
				<h4><?php _e( 'Icon and color', 'mdw' ); ?></h4>
				<?php
				foreach ( $categories as $cat ) {

					$icons = get_mdw_category( $cat, $category );
					?>
					<div class='category-updater col-md-3'> 
						<span ><i id="icon_modal_toggle" class="fa fa-close red-text category-customization-add-remove-icon"></i></span>
						<span class="icon_container"
							  id="<?php echo 'icon_container_' . $icons[ "id" ]; ?>"
							  name="<?php echo 'icon_container_' . $icons[ "id" ]; ?>"
							  >
							<i class="<?php echo empty( $icons[ "icon" ] ) ? 'fa fa-font-awesome' : $icons[ "icon" ]; ?>  chosen fa-4x"
							   style="color:<?php echo empty( $icons[ "color" ] ) ? '#607d8b' : $icons[ "color" ]; ?>">
							</i>
						</span>
						<br/>
						<input hidden
							   type="text" value="<?php echo $icons[ "icon" ]; ?>"
							   name="<?php echo 'category_icon_' . $icons[ "id" ]; ?>" />

						<input id="color_<?php echo $icons[ "id" ]; ?>"
							   type="color"
							   value="<?php echo empty( $icons[ "color" ] ) ? '#607d8b' : $icons[ "color" ]; ?>"
							   />
						<input hidden
							   value="<?php echo $icons[ "color" ]; ?>"
							   name="<?php echo 'category_color_' . $icons[ "id" ]; ?>"
							   id="color-code"
							   />
						<input hidden value="<?php echo $icons[ "cat_id" ]; ?>" name="<?php echo "id_" . $icons["id"]; ?>" />
						<h4><?php echo $icons["name"]; ?></h4>
					</div>

				<?php } ?>
				<div style="clear:both;"></div>
			</div>


		</form>
	<?php } ?>
    <div class="save-section">
		<button  id="categoryCustomizationBtn" class="btn btn-primary" type="submit"><?php _e( "Save", "mdw" ); ?></button>
		<p class="text-fluid" id="printResponse"></p>

    </div>
</div>



<script>
    jQuery( document ).ready( function () {
        var form = jQuery( "#categorySettingsForm" );
        var printResponse = jQuery( "#printResponse" );
        var catIconColorInputs = jQuery( ".category-updater" ).find( 'input' );
        var catTemplatePageInputs = jQuery( "#catTemplatePage" ).find( "input[type='radio']" );
        var catListingInputs = jQuery( "#catListing" ).find( "input[type='radio']" );
        var submitSubtton = jQuery( "#categoryCustomizationBtn" );
        var categoriesPageRadios = jQuery( "#categorySettingsForm" ).find( "input[name='categoryVersion']" );
        var categoriesPreviewSrc = "<?php echo get_template_directory_uri() . '/components/categories/previews/v' ?>";
        categoriesPageRadios.on( "change", function ( e ) {
            jQuery( "#categories_page_version_preview" ).attr( "src", categoriesPreviewSrc + jQuery( this ).val() + ".jpg" );
        } )
        submitSubtton.on( "click", function ( e ) {

            jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

            // e.preventDefault();

            var data = {
                action: 'category_settings_save',
            };
            catIconColorInputs.each( function ( i, e ) {
                if ( jQuery( e ).attr( 'name' ) ) {
                    data[jQuery( e ).attr( 'name' )] = jQuery( e ).val();
                }
            } );
            data.cat_listing_version = jQuery( "#categorySettingsForm" ).find( "input[name='categoryListing']:checked" ).val();
            data.cat_version = jQuery( "#categorySettingsForm" ).find( "input[name='categoryVersion']:checked" ).val();

            jQuery.ajax( {
                url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
                type: 'post',
                data: data
            } ).done( function ( response ) {
                submitSubtton.html( "<i class='fa fa-check'></i> " + response );
                submitSubtton.attr( "class", "btn btn-success" );
                resetButton( submitSubtton );
            } ).fail( function ( jqXHR, textStatus, errorThrown ) {
                submitSubtton.html( "<i class='fa fa-times'></i> " + errorThrown );
                submitSubtton.attr( "class", "btn btn-error" );
                resetButton( submitSubtton );
            } );
        } );
    } );

</script>
