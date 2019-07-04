<?php
$ecommerce_layout = get_theme_mod( 'ecommerce_layout', 'cards' );
?>

<div class="container-fluid wraper" id="ecommerce_panel">
	<h1><?php _e( 'Ecommerce settings', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Choose layout type", "mdw" ); ?></h4>
			<select name="ecommerce_layout">
				<option <?php echo $ecommerce_layout == 'cards' ? 'selected' : ''; ?> value="cards"><?php _e( "Product cards", "mdw" ); ?></option>
				<option <?php echo $ecommerce_layout == 'cards-narrower' ? 'selected' : ''; ?> value="cards-narrower"><?php _e( "Narrower product cards", "mdw" ); ?></option>
				<option <?php echo $ecommerce_layout == 'cards-wider' ? 'selected' : ''; ?> value="cards-wider"><?php _e( "Wider product cards", "mdw" ); ?></option>
				<option <?php echo $ecommerce_layout == 'list' ? 'selected' : ''; ?> value="list"><?php _e( "List of products", "mdw" ); ?></option>
			</select>
		</div>
		<div class="col-md-6">

		</div>
	</div>
	<div class="row text-xs-center">
		<div class="col-md-12 save-section">
			<button id="ecommerce_save" class="btn btn-primary"><?php _e( "Save", "mdw" ); ?></button>
		</div>
	</div>
</div>
<script>
    var ecommerce_save = jQuery( "#ecommerce_save" );
    ecommerce_save.on( "click", function ( e ) {
        jQuery( this ).html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_ecommerce_settings"
        };
        var ecommerce_inputs = jQuery( "#ecommerce_panel" ).find( "select" );
        ecommerce_inputs.each( function ( index, elem ) {
            data[jQuery( elem ).attr( "name" )] = jQuery( elem ).val();
        } );
        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            ecommerce_save.html( "<i class='fa fa-check'></i> " + r );
            ecommerce_save.attr( "class", "btn btn-success" );
            resetButton( ecommerce_save );
        } ).fail( function ( e ) {
            ecommerce_save.html( "<i class='fa fa-times'></i> " + r );
            ecommerce_save.attr( "class", "btn btn-error" );
            resetButton( ecommerce_save );
        } );
    } );
</script>
