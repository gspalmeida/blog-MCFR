<?php

function set_license_key() {

	update_option( 'horse_or_full_time', $_POST[ 'option' ] );

	if ( $_POST[ 'status' ] ) {
		wp_clear_scheduled_hook( "daily_check" );
		set_theme_mod( "theme_status", "production" );
		update_option( 'when_horse_dies', '' );
	}
	$response = array(
		'status'	 => $_POST[ 'status' ],
		'message'	 => __( $_POST[ 'message' ], "mdw" )
	);

	echo json_encode( $response );

	die();
}

add_action( 'wp_ajax_set_license_key', 'set_license_key' );
?>
