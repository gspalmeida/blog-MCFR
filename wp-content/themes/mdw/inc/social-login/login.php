<?php

/**
 * @param $provider       eg. 'facebook', 'twitter'
 * @param $user_email     eg. someemailadress@adress.com
 * @param $user_name      eg. User Name
 * @param $user_social_id eg. 12345678
 */
function mdw_login( $provider, $user_email, $user_name, $user_social_id ) {
	global $wpdb;

	if ( !isset( $_SESSION[ 'mdw_provider' ] ) || !isset( $_SESSION[ 'mdw_email' ] ) || !isset( $_SESSION[ 'mdw_name' ] ) || !isset( $_SESSION[ 'mdw_user_id' ] ) ) {
		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	$login = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value = %s", $provider, $user_social_id ) );

	if ( !empty( $login ) ) {

		// if user social account exist in database, log in

		wp_set_auth_cookie( $login->user_id, false );

		wp_redirect( $_SESSION[ 'mdw_redirect' ], 302 );

		unset( $_SESSION[ 'mdw_provider' ] );
		unset( $_SESSION[ 'mdw_email' ] );
		unset( $_SESSION[ 'mdw_name' ] );
		unset( $_SESSION[ 'mdw_user_id' ] );

		exit();
	} elseif ( email_exists( $user_email ) && get_option( 'linking-accounts' ) != 'yes' ) {

		// if site administrator disallowed linking accounts and someone is already register

		$error = 'You already have an account';

		$back_link = $_GET[ 'redirect_to' ];

		require_once 'templates/template-error.php';

		unset( $_SESSION[ 'mdw_provider' ] );
		unset( $_SESSION[ 'mdw_email' ] );
		unset( $_SESSION[ 'mdw_name' ] );
		unset( $_SESSION[ 'mdw_user_id' ] );
	} else {

// if administrator disallowed linking and user isn't in database it means that we have to register him and store social data in database

		if ( get_option( 'linking-accounts' ) != 'yes' ) {

			$user_pass = md5( substr( str_shuffle( '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 0, rand( 1, 10 ) ) );

			if ( email_exists( $user_email ) ) {
				$i = 0;

				while ( $i = 0 ) {
					$user_email = rand( 0, 9 ) . $user_email;

					if ( !email_exists( $user_email ) ) {
						$i++;
					}
				}
			}

			$user_id = wp_create_user( $user_name, $user_pass, $user_email );

			wp_set_auth_cookie( $user_id, false, '', '' );

			$redirect_url = $_SESSION[ 'mdw_redirect' ];

			unset( $_SESSION[ 'mdw_redirect' ] );

			global $wpdb;

			$prefix = $wpdb->prefix;

			$wpdb->insert(
			$prefix . 'usermeta', array(
				'user_id'	 => $user_id,
				'meta_key'	 => $_SESSION[ 'mdw_provider' ],
				'meta_value' => $_SESSION[ 'mdw_user_id' ]
			), array(
				'%d',
				'%s',
				'%s'
			)
			);

			unset( $_SESSION[ 'mdw_provider' ] );
			unset( $_SESSION[ 'mdw_email' ] );
			unset( $_SESSION[ 'mdw_name' ] );
			unset( $_SESSION[ 'mdw_user_id' ] );

			wp_redirect( $redirect_url, 302 );
		} else {

			// if user doesn't exist in database but succesfully loged in to social account, and linking is allowed

			header( 'Location: ' . get_home_url() . '?mdw_register_or_link' );

			exit();
		}
	}

	exit();
}

if ( function_exists( 'session_status' ) ) {
	if ( session_status() == PHP_SESSION_NONE ) {
		session_start();
	}
} else {
	if ( session_id() == '' ) {
		session_start();
	}
}

if ( isset( $_GET[ 'mdw_login_fb' ] ) ) {

	// someone wants to log in with facebook

	require 'providers/facebook/fb-callback.php';

	mdw_login( $_SESSION[ 'mdw_provider' ], $_SESSION[ 'mdw_email' ], $_SESSION[ 'mdw_name' ], $_SESSION[ 'mdw_user_id' ] );
} elseif ( isset( $_GET[ 'mdw_login_tw' ] ) ) {

	// someone wants to log in with twitter

	require 'providers/twitter/tw-callback.php';

	mdw_login( $_SESSION[ 'mdw_provider' ], $_SESSION[ 'mdw_email' ], $_SESSION[ 'mdw_name' ], $_SESSION[ 'mdw_user_id' ] );
} elseif ( isset( $_GET[ 'mdw_register_or_link' ] ) ) {

	if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	// linking accounts enabled, let user choose to link or register with social

	require 'templates/template-login.php';

	exit();
} elseif ( isset( $_GET[ 'mdw_link_account' ] ) ) {

	if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	// user wants to link

	require 'templates/template-link.php';

	exit();
} elseif ( isset( $_GET[ 'mdw_confirm_linking' ] ) ) {

	if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	// check linking if we have correct username and password

	$login = wp_authenticate( $_POST[ 'username' ], $_POST[ 'password' ] );

	if ( null == $login->errors ) {

		wp_set_auth_cookie( $login->ID, false, '', '' );

		$redirect_url = $_SESSION[ 'mdw_redirect' ];

		unset( $_SESSION[ 'mdw_redirect' ] );

		global $wpdb;

		$prefix = $wpdb->prefix;

		$wpdb->insert(
		$prefix . 'usermeta', array(
			'user_id'	 => $login->ID,
			'meta_key'	 => $_SESSION[ 'mdw_provider' ],
			'meta_value' => $_SESSION[ 'mdw_user_id' ]
		), array(
			'%d',
			'%s',
			'%s'
		)
		);

		unset( $_SESSION[ 'mdw_provider' ] );
		unset( $_SESSION[ 'mdw_email' ] );
		unset( $_SESSION[ 'mdw_name' ] );
		unset( $_SESSION[ 'mdw_user_id' ] );

		wp_redirect( $redirect_url, 302 );
	} else {

		if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

			// if one of required variables isn't set (or someone is trying to access directly files)

			exit();
		}

		//if we have invalid data

		$error = 'Invalid username or password';

		$back_link = home_url() . '?mdw_link_account';

		require_once 'templates/template-error.php';
	}

	exit();
} elseif ( isset( $_GET[ 'mdw_create_account' ] ) ) {

	if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	// user wants new account

	require 'templates/template-create-account.php';

	exit();
} elseif ( isset( $_GET[ 'mdw_create_account_confirm' ] ) ) {

	if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

		// if one of required variables isn't set (or someone is trying to access directly files)

		exit();
	}

	// check new account data

	$email		 = $_POST[ 'email' ];
	$username	 = $_POST[ 'username' ];
	$password	 = wp_hash_password( $_POST[ 'password' ] );

	global $wpdb;

	$login = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->users WHERE user_email = %s OR user_login = %s", $email, $username ) );

	if ( empty( $login ) && is_email( $email ) ) {

		$user_id = wp_create_user( $username, $password, $email );

		wp_set_auth_cookie( $user_id, false, '', '' );

		$redirect_url = $_SESSION[ 'mdw_redirect' ];

		unset( $_SESSION[ 'mdw_redirect' ] );

		global $wpdb;

		$prefix = $wpdb->prefix;

		$wpdb->insert(
		$prefix . 'usermeta', array(
			'user_id'	 => $user_id,
			'meta_key'	 => $_SESSION[ 'mdw_provider' ],
			'meta_value' => $_SESSION[ 'mdw_user_id' ]
		), array(
			'%d',
			'%s',
			'%s'
		)
		);

		unset( $_SESSION[ 'mdw_provider' ] );
		unset( $_SESSION[ 'mdw_email' ] );
		unset( $_SESSION[ 'mdw_name' ] );
		unset( $_SESSION[ 'mdw_user_id' ] );

		wp_redirect( $redirect_url, 302 );
	} else {

		if ( isset( $_SESSION[ 'mdw_provider' ] ) || isset( $_SESSION[ 'mdw_email' ] ) || isset( $_SESSION[ 'mdw_name' ] ) || isset( $_SESSION[ 'mdw_user_id' ] ) ) {

			// if one of required variables isn't set (or someone is trying to access directly files)

			exit();
		}

// display errors if create account fails

		if ( !is_email( $email ) ) {

			$error = 'This is not a valid email adress';
		} else {

			$error = 'This username or email is already registered';
		}

		$back_link = home_url() . '?mdw_create_account=true';

		require_once 'templates/template-error.php';
	}

	exit();
}