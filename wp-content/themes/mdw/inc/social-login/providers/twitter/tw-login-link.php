<?php

/* Load required lib files. */
require_once 'oauth/twitteroauth.php';

if ( function_exists( 'session_status' ) ) {
	if ( session_status() == PHP_SESSION_NONE ) {
		session_start();
	}
} else {
	if ( session_id() == '' ) {
		session_start();
	}
}

class TwitterLoginAuthLink {

	/**
	 * @var string
	 */
	protected $consumer_key = '';

	/**
	 * @var string
	 */
	protected $consumer_secret = '';

	/**
	 * @var string
	 */
	protected $oauth_callback = '';

	public function __construct() {
		$this->consumer_key		 = esc_attr( get_option( 'tw-id' ) );
		$this->consumer_secret	 = esc_attr( get_option( 'tw-secret' ) );

		global $admin_login;

		if ( $admin_login ) {
			$redirect_to = admin_url();
		} else {
			$redirect_to = home_url( add_query_arg( null, null ) );
		}

		$this->oauth_callback = get_home_url() . '?mdw_login_tw&redirect_to=' . $redirect_to;
		$this->login_twitter();
	}

	public function login_twitter() {

		$connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret ); // Key and Sec

		$request_token = $connection->getRequestToken( $this->oauth_callback ); // Retrieve Temporary credentials.

		$_SESSION[ 'oauth_token' ]	 = $token						 = $request_token[ 'oauth_token' ];

		$_SESSION[ 'oauth_token_secret' ] = $request_token[ 'oauth_token_secret' ];

		$url = $connection->getAuthorizeURL( $token ); // Redirect to authorize page.

		echo $url;
	}

}

$twitter_obj = new TwitterLoginAuthLink();
