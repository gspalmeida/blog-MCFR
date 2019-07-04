<?php

function update_router() {
	$url = 'https://mdwp.io/remote/';
	if ( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ) {
		$ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
	} elseif ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
		$ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
	} else {
		$ip = $_SERVER[ 'REMOTE_ADDR' ];
	}
	$separator	 = '';
	$postvars	 = '';

	foreach ( $_POST as $key => $value ) {
		$postvars	 .= $separator . urlencode( $key ) . '=' . urlencode( $value );
		$separator	 = '&';
	}
	$postvars .= "&ip=" . $ip;

	$ch		 = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $postvars );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result	 = curl_exec( $ch );
	curl_close( $ch );
	if ( $result == 0 ) {
		update_new_version_http();
	} else {
		echo json_encode( $result );
	}
	die();
}

add_action( 'wp_ajax_update', 'update_router' );
add_action( 'wp_ajax_check_license_key', 'update_router' );
add_action( 'wp_ajax_version_check', 'update_router' );

function update_new_version_http() {
	$url = 'http://mdwp.io/remote/';
	if ( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ) {
		$ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
	} elseif ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
		$ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
	} else {
		$ip = $_SERVER[ 'REMOTE_ADDR' ];
	}
	$separator	 = '';
	$postvars	 = '';

	foreach ( $_POST as $key => $value ) {
		$postvars	 .= $separator . urlencode( $key ) . '=' . urlencode( $value );
		$separator	 = '&';
	}
	$postvars .= "&ip=" . $ip;

	$ch		 = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $postvars );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result	 = curl_exec( $ch );
	curl_close( $ch );
	echo json_encode( $result );
}

?>