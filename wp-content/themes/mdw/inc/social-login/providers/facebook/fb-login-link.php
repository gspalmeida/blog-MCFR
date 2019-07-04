<?php

require_once __DIR__ . '/fb-sdk/src/Facebook/autoload.php';

$fb = new Facebook\Facebook( array(
	'app_id'				 => esc_attr( get_option( 'fb-id' ) ),
	'app_secret'			 => esc_attr( get_option( 'fb-secret' ) ),
	'default_graph_version'	 => 'v2.5'
) );

$helper = $fb->getRedirectLoginHelper();

$permissions = array( 'email' );

// Optional permissions

if ( $admin_login ) {
	$redirect_to = admin_url();
} else {
	$redirect_to = home_url( add_query_arg( null, null ) );
}

$loginUrl = $helper->getLoginUrl( get_home_url() . '?mdw_login_fb&redirect_to=' . $redirect_to, $permissions );

echo htmlspecialchars( $loginUrl );
