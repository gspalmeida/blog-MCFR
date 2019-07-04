<?php

if ( extension_loaded( 'curl' ) && !get_option( 'horse_or_full_time', false ) ) {
	add_action( 'after_switch_theme', 'register_theme' );
}

function register_theme() {
	$horse_of_full_time = get_option( 'horse_or_full_time' );
	if ( !get_option( 'horse_or_full_time' ) || empty( $horse_of_full_time ) ) {
		update_option( 'horse_or_full_time', 'horse' );
	}
	set_theme_mod( 'theme_status', 'production' );

	$url = 'https://mdwp.io/remote/';

	$ip = ip_check();

	$myvars = 'action=register' . '&domain=' . $_SERVER[ 'HTTP_HOST' ] . '&ip=' . $ip;

	$ch			 = curl_init( $url );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$response	 = curl_exec( $ch );
	curl_close( $ch );
	update_option( 'when_horse_dies', $response );

	horse_check();
}

if ( (!get_option( 'horse_or_full_time' ) || empty( $horse_of_full_time ) ) || strlen( get_option( 'when_horse_dies' ) ) ) {
	add_action( 'after_switch_theme', 'my_activation', 10, 1 );
}

function periodical_check() {

	$ip = ip_check();

	$myvars = 'action=periodical_check' . '&domain=' . $_SERVER[ 'HTTP_HOST' ] . '&ip=' . $ip . '&when_horse_dies=' . get_option( 'when_horse_dies' );

	$ch			 = curl_init( 'https://mdwp.io/remote/' );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$response	 = curl_exec( $ch );
    curl_close( $ch );
    
	$response = json_decode( $response );

	horse_check();

	if ( !$response->status ) {
		update_option( 'when_horse_dies', $response->date );
	}
}

function my_activation() {
	wp_schedule_event( time(), 'hourly', 'daily_check' );
}

function ip_check() {

	if ( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ) {
		$ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
	} elseif ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
		$ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
	} else {
		$ip = $_SERVER[ 'REMOTE_ADDR' ];
	}

	return $ip;
}

function horse_check() {

	$url = 'https://mdwp.io/remote/';

	$license_key = get_theme_mod( 'license_key', false );

	if ( $license_key ) {

		$myvars = 'action=check_license_key' . '&domain=' . $_SERVER[ 'HTTP_HOST' ] . '&license_key=' . $license_key;

		$ch			 = curl_init( $url );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$response	 = curl_exec( $ch );
		curl_close( $ch );

		$response = json_decode( $response );

		if ( $response->status ) {
			update_option( 'horse_or_full_time', $response->option );
			update_option( 'when_horse_dies', '' );
			wp_clear_scheduled_hook( 'daily_check' );
			set_theme_mod( 'theme_status', 'production' );
		}
	}
}

/**
 * Check trial version expiry date
 */
function run_periodical_check() {
	if ( get_theme_mod( "theme_status", "production" ) == "test" || ( strtotime( get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) - time() ) / 60 / 60 / 24 < 0 && get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) {
		$current_time	 = date( 'Y-m-d H:i:s' );
		$interval		 = 43200;  //equals 1 hour
		$periodical_time = intval( get_option( 'periodical-check-timestamp' ) );

		if ( get_option( 'periodical-check-timestamp' ) == false ) {
			periodical_check();
			update_option( 'periodical-check-timestamp', (strtotime( $current_time ) + $interval ) );
		}
		if ( strtotime( $current_time ) >= $periodical_time ) {
			periodical_check();
			update_option( 'periodical-check-timestamp', (strtotime( $current_time ) + $interval ) );
		}
	}
}

run_periodical_check();
