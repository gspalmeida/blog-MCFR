<?php
if ( function_exists( 'session_status' ) ) {
	if ( session_status() == PHP_SESSION_NONE ) {
		session_start();
	}
} else {
	if ( session_id() == '' ) {
		session_start();
	}
}

add_action( 'comment_form_top', 'display_avalible_providers', 10 );

function display_avalible_providers() {
	if ( !is_user_logged_in() ) {
		$admin_login = false;
		?>
		<?php if ( get_option( 'tw-id' ) != null && get_option( 'tw-secret' ) != null && get_option( 'tw-id' ) != false && get_option( 'tw-secret' ) != false && get_option( 'fb-id' ) != null && get_option( 'fb-secret' ) != null && get_option( 'fb-secret' ) != false && get_option( 'fb-id' ) != false ) { ?>
			<h3>
				<b>Login with:</b>
			</h3>
		<?php } ?>
		<p class="mb-3">
			<!-- Facebook -->
			<?php if ( get_option( 'fb-id' ) != null && get_option( 'fb-secret' ) != null && get_option( 'fb-secret' ) != false && get_option( 'fb-id' ) != false ) { ?>
				<a type="button" class="btn btn-fb" href="<?php et_template_part( 'fb-login', 'link' ); ?>"><i class="fa fa-facebook"></i></a>
			<?php } ?>
			<!-- Twitter -->
			<?php if ( get_option( 'tw-id' ) != null && get_option( 'tw-secret' ) && get_option( 'tw-id' ) != false && get_option( 'tw-secret' ) != false ) { ?>
				<a type="button" class="btn btn-tw" href="<?php get_template_part( 'tw-login', 'link' ); ?>"><i class="fa fa-twitter"></i></a>
			<?php } ?>
			<!-- Google + -->
			<!-- <a type="button" class="btn btn-gplus" href=""><i class="fa fa-google-plus"></i></a> -->
		</p>
		<?php
	}
}

function admin_login_enqueue_style() {
	wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'Font_Awesome' );
	wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
	wp_enqueue_style( 'compiled' );
	wp_register_style( 'Admin_Login', get_template_directory_uri() . '/css/admin-login.css' );
	wp_enqueue_style( 'Admin_Login' );
}

add_action( 'login_enqueue_scripts', 'admin_login_enqueue_style', 1 );

add_action( 'login_form_top', 'display_avalible_providers_admin', 10, 1 );

add_action( 'login_form', 'display_avalible_providers_admin' );

function display_avalible_providers_admin() {
	$admin_login = true;
	?>
	<h3 class="my-1">
		<?php if ( get_option( 'tw-id' ) != null && get_option( 'tw-secret' ) != null && get_option( 'tw-id' ) != false && get_option( 'tw-secret' ) != false && get_option( 'fb-id' ) != null && get_option( 'fb-secret' ) != null && get_option( 'fb-secret' ) != false && get_option( 'fb-id' ) != false ) { ?>
			<b>Or login with:</b>
		<?php } ?>
	</h3>
	<p class="mb-2">
		<?php if ( get_option( 'fb-id' ) != null && get_option( 'fb-secret' ) != null && get_option( 'fb-secret' ) != false && get_option( 'fb-id' ) != false ) { ?>
			<a type="button" class="btn btn-fb" href="<?php require_once 'social-login/providers/facebook/fb-login-link.php'; ?>"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if ( get_option( 'tw-id' ) != null && get_option( 'tw-secret' ) && get_option( 'tw-id' ) != false && get_option( 'tw-secret' ) != false ) { ?>
			<a type="button" class="btn btn-tw" href="<?php require 'social-login/providers/twitter/tw-login-link.php'; ?>"><i class="fa fa-twitter"></i></a>
			<?php } ?>
		<!--Google +-->
		<!-- <a type="button" class="btn btn-gplus" href=""><i class="fa fa-google-plus"></i></a> -->
	</p>
	<?php
}
?>