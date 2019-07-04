<?php

if ( !empty( get_option( 'fb-id' ) ) && !empty( get_option( 'fb-secret' ) ) && get_option( 'fb-id' ) != false && get_option( 'fb-secret' ) != false ) {

	$_SESSION[ 'mdw_redirect' ] = $_GET[ 'redirect_to' ];

	require_once __DIR__ . '/fb-sdk/src/Facebook/autoload.php';

	$fb = new Facebook\Facebook( array(
		'app_id'				 => esc_attr( get_option( 'fb-id' ) ),
		'app_secret'			 => esc_attr( get_option( 'fb-secret' ) ),
		'default_graph_version'	 => 'v2.5'
	) );

	$helper = $fb->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
		// When Graph returns an error
		$error = 'Graph returned an error: ' . $e->getMessage();

		$back_link = $_GET[ 'redirect_to' ];

		require_once __DIR__ . '/../../templates/template-error.php';

		exit;
	} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
		// When validation fails or other local issues
		$error = 'Facebook SDK returned an error: ' . $e->getMessage();

		$back_link = $_GET[ 'redirect_to' ];

		require_once __DIR__ . '/../../templates/template-error.php';
		exit;
	}

	if ( !isset( $accessToken ) ) {

		if ( $helper->getError() ) {
			header( 'HTTP/1.0 401 Unauthorized' );
			$error	 = 'Error: ' . $helper->getError() . "\n";
			$error	 .= 'Error Code: ' . $helper->getErrorCode() . "\n";
			$error	 .= 'Error Reason: ' . $helper->getErrorReason() . "\n";
			$error	 .= 'Error Description: ' . $helper->getErrorDescription() . "\n";

			$back_link = $_GET[ 'redirect_to' ];

			require_once __DIR__ . '/../../templates/template-error.php';
		} else {
			header( 'HTTP/1.0 400 Bad Request' );
			$error = 'Bad request';

			$back_link = $_GET[ 'redirect_to' ];

			require_once __DIR__ . '/../../templates/template-error.php';
		}

		exit;
	}

// Logged in

	$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
	$tokenMetadata = $oAuth2Client->debugToken( $accessToken );

	$tokenMetadata->validateAppId( '1174966582618972' );

	$tokenMetadata->validateExpiration();

	if ( !$accessToken->isLongLived() ) {
		// Exchanges a short-lived access token for a long-lived one
		try {
			$accessToken = $oAuth2Client->getLongLivedAccessToken( $accessToken );
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			$error = '<p>Error getting long-lived access token: ' . $helper->getMessage() . "</p>\n\n";

			$back_link = $_GET[ 'redirect_to' ];

			require_once __DIR__ . '/../../templates/template-error.php';
			exit;
		}
	}

	$fb->setDefaultAccessToken( $accessToken );

	$response	 = $fb->get( '/me?fields=email,name,picture' );
	$userNode	 = $response->getGraphUser();

	$id		 = $userNode->getProperty( 'id' );
	$name	 = $userNode->getProperty( 'name' );
	$email	 = $userNode->getProperty( 'email' );

	$_SESSION[ 'mdw_user_id' ]	 = $id;
	$_SESSION[ 'mdw_name' ]		 = $name;
	$_SESSION[ 'mdw_email' ]	 = $email;
	$_SESSION[ 'mdw_provider' ]	 = 'facebook';
}
