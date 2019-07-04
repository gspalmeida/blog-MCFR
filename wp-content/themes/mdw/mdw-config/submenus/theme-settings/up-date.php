<?php
$license_key = get_theme_mod( 'license_key', '' );
$domain		 = $_SERVER[ 'HTTP_HOST' ];

$my_theme = wp_get_theme();
if ( is_child_theme() == true ) {
	$version = $my_theme->parent()->get( 'Version' );
} else {
	$version = $my_theme->get( 'Version' );
}
$horse_or_full_time	 = get_option( 'horse_or_full_time' );
// update_option("when_horse_dies", "asd");
$when_horse_dies	 = get_option( 'when_horse_dies' );
?>
<div class="row text-xs-center">
	<div class="<?php echo $horse_or_full_time == 'horse' ? 'col-md-6' : 'col-md-12'; ?>">
        <h3 class="card-header primary-color white-text "><?php _e( "Update", "mdw" ); ?></h3>
        <div class="card-block">
            <h4 id="message_version"></h4>
            <button class="btn btn-primary" id="updateBtn"><?php _e( "Download", "mdw" ); ?></button>
        </div>
	</div>
	<div style="display:<?php echo $horse_or_full_time == 'horse' ? 'block' : 'none'; ?>" class="col-md-6">
		<h3 class="card-header primary-color white-text "><?php _e( "Upgrade", "mdw" ); ?></h3>
		<div class="card-block">
			<h4 id="message_license_key" class="card-title"><?php _e( "Enter your license key", "mdw" ); ?></h4>
			<div class="md-form input-group">
				<input type="text" id="check_license_key" name="license_key" value="<?php echo $license_key; ?>">
				<span class="input-group-btn">
					<button id="send_license_key" class="btn btn-primary"><?php _e( "Send", "mdw" ); ?></button>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="display:<?php echo $horse_or_full_time == 'horse' ? 'block' : 'none'; ?>" class="row text-xs-center">
	<div class="col-md-12">
		<h3 class="card-header primary-color white-text ">Learn more</h3>
		<div class="card-block">
			<h4 class="card-title"><?php _e( "Your trial expires at ", "mdw" ); ?></h4>
			<h5><?php echo $when_horse_dies; ?></h5>
			<a class="btn btn-primary" href="https://mdwp.io/product/material-design-for-wordpress-pro/"><?php _e( 'Get full version', 'mdw' ); ?></a>
		</div>
	</div>
</div>
<script>
    var version = "<?php echo $version; ?>";
    var domain = "<?php echo $domain; ?>";
    var license_key = "<?php echo $license_key; ?>";
    var callback = ajaxurl;
    var horse_or_full_time = "<?php echo $horse_or_full_time; ?>";
    var when_horse_dies = "<?php echo $when_horse_dies; ?>";
// update
    var message_version = jQuery( "#message_version" );
    var updateBtn = jQuery( "#updateBtn" );
// license key check
    var license_key_input = jQuery( "#check_license_key" );
    var message_license_key = jQuery( "#message_license_key" );
    var send_license_key = jQuery( "#send_license_key" );
    updateBtn.hide();
    message_version.html( "Checking for available updates <i class='fa fa-spinner fa-pulse'></i>" );
// ACTION: version_check
    jQuery.ajax( {
        url: callback,
        type: 'post',
        data: {
            action: 'version_check'
        }
    } ).done( function ( newest_version ) {
        if ( newest_version != '"' + version + '"' ) {
            // let user update
            message_version.html( "<?php _e( 'New updates are available.', 'mdw' ); ?>" );
            updateBtn.show();
        } else {
            // You are up to date message
            message_version.html( "<?php _e( 'You have the latest version of MDW.' ); ?>" );
        }
    } ).fail( function ( jqXHR, textStatus, errorThrown ) {
        // connection failure

        message_version.html( "<?php _e( 'Oops. It looks like our server has some difficulties. We\'e working on it, but so far you can\'t download your actualisation.', 'mdw' ); ?>" );
    } );

// ACTION: update
    updateBtn.on( "click", function ( e ) {
        message_version.html( "<?php _e( 'Updating', 'mdw' ); ?>.. <i class='fa fa-spinner fa-pulse'></i>" )
        jQuery.ajax( {
            url: callback,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'update',
                domain: '<?php echo $domain; ?>',
                horse_or_full_time: '<?php echo $horse_or_full_time; ?>',
                when_horse_dies: '<?php echo $when_horse_dies; ?>'
            }
        } ).done( function ( response ) {

            var data = {
                action: "approved_download",
                status: JSON.parse( response ).status,
                when_horse_dies: JSON.parse( response ).when_horse_dies
            }
            jQuery.ajax( {
                url: ajaxurl,
                type: 'post',
                dataType: 'json',
                data: data
            } ).done( function ( response ) {
                if ( response.status )
                    updateBtn.hide();
                message_version.html( response.message );
            } ).fail( function ( jqXHR, textStatus, errorThrown ) {
                // connection failure
                message_version.html( "<?php _e( 'Oops. It looks like our server has some difficulties. We\'re working on it, but so far you can\'t download your actualisation.', 'mdw' ); ?>" );
            } );

        } ).fail( function ( jqXHR, textStatus, errorThrown ) {
            // connection failure
            message_version.html( "<?php _e( 'Oops. It looks like our server has some difficulties. We\'re working on it, but so far you can\'t download your actualisation.', 'mdw' ); ?>" );
        } );
    } )

// ACTION: check_license_key
    send_license_key.on( "click", function ( e ) {
        jQuery.ajax( {
            url: callback,
            type: 'post',
            data: {
                action: 'check_license_key',
                domain: '<?php echo $domain; ?>',
                license_key: license_key_input.val()
            }
        } ).done( function ( response ) {
            response = JSON.parse( response );
            jQuery.ajax( {
                url: ajaxurl,
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'set_license_key',
                    status: JSON.parse( response ).status,
                    option: JSON.parse( response ).option,
                    message: JSON.parse( response ).message
                }
            } ).done( function ( response ) {
                if ( +response.status )
                    jQuery( ".md-form.input-group" ).hide();
                message_license_key.html( response.message );
            } ).fail( function ( jqXHR, textStatus, errorThrown ) {
                // connection failure
                message_version.html( "<?php _e( 'Oops. It looks like our server has some difficulties. We\'re working on it, but so far you can\'t download your actualisation.', 'mdw' ); ?>" );
            } );

        } ).fail( function ( jqXHR, textStatus, errorThrown ) {
            // connection failure
            message_version.html( "<?php _e( 'Oops. It looks like our server has some difficulties. We\'re working on it, but so far you can\'t download your actualisation.', 'mdw' ); ?>" );
        } );
    } );


</script>
