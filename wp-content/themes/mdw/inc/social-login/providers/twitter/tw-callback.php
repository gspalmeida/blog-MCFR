<?php

if ( !empty( get_option( 'tw-id' ) ) && !empty( get_option( 'tw-secret' ) ) && get_option( 'tw-id' ) != false && get_option( 'tw-secret' ) != false ) {

	if ( function_exists( 'session_status' ) ) {
		if ( session_status() == PHP_SESSION_NONE ) {
			session_start();
		}
	} else {
		if ( session_id() == '' ) {
			session_start();
		}
	}

	/* Load required lib files. */
	require_once __DIR__ . '/oauth/twitteroauth.php';

	class TwitterAuth {

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
			$this->oauth_callback	 = get_home_url() . '?mdw_login_tw';
			$this->tw_callback();
		}

		public function tw_callback() {
			$connection					 = new TwitterOAuth( $this->consumer_key, $this->consumer_secret, $_SESSION[ 'oauth_token' ], $_SESSION[ 'oauth_token_secret' ] );
			$access_token				 = $connection->getAccessToken( $_REQUEST[ 'oauth_verifier' ] );
			$_SESSION[ 'access_token' ]	 = $access_token;

			if ( count( $access_token ) == 1 ) {

				// we got an error (probably invalid twitter key due to new one in session) to fix later

				$back_link = $_GET[ 'redirect_to' ];

				$error = 'Yor twitter key is invalid, go back, refresh page and try again.';

				require_once __DIR__ . '/../../templates/template-error.php';

				exit();
			}

			$access_token = $_SESSION[ 'access_token' ];

			$connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret, $access_token[ 'oauth_token' ], $access_token[ 'oauth_token_secret' ] );

			/* If method is set change API call made. Test is called by default. */
			$content = $connection->get( 'account/verify_credentials' );

			$_SESSION[ 'mdw_provider' ]	 = 'twitter';
			$_SESSION[ 'mdw_email' ]	 = md5( substr( str_shuffle( '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 0, rand( 1, 10 ) ) ) . '-twitter@fake-email.com';
			$_SESSION[ 'mdw_name' ]		 = $content->name;
			$_SESSION[ 'mdw_user_id' ]	 = $content->id_str;
			$_SESSION[ 'mdw_redirect' ]	 = $_GET[ 'redirect_to' ];
		}

	}

	$twitter_obj = new TwitterAuth();
}
