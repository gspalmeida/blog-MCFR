<?php

function add_navbar_menu() {
	// Navigation Menus
	register_nav_menus( array(
		'navbar' => __( 'Horizontal Menu', 'mdw' ),
	) );
	// Add featured image support
}

add_action( 'after_setup_theme', 'add_navbar_menu' );

function add_sidenav_menu() {
	// Navigation Menus
	register_nav_menus( array(
		'sidenav' => __( 'Sidebar Menu', 'mdw' ),
	) );
	// Add featured image support
}

add_action( 'after_setup_theme', 'add_sidenav_menu' );

function add_footer_menu() {
	// Navigation Menus
	register_nav_menus( array(
		'footer_menu_1'	 => __( 'MDW Footer Menu 1', 'mdw' ),
		'footer_menu_2'	 => __( 'MDW Footer Menu 2', 'mdw' ),
		'footer_menu_3'	 => __( 'MDW Footer Menu 3', 'mdw' )
	) );
	// Add featured image support
}

add_action( 'after_setup_theme', 'add_footer_menu' );

function mdb_footer_init() {
	register_sidebar( array(
		'name'			 => 'MDW Footer Area',
		'id'			 => 'footer_area',
		'before_widget'	 => '<div>',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h5 class="title">',
		'after_title'	 => '</h5>',
	) );
}

// template-column-listing.php
if ( 'post.php' == basename( $_SERVER[ 'REQUEST_URI' ], '?' . $_SERVER[ 'QUERY_STRING' ] ) && !isset( $_GET[ 'post_type' ] ) ) {

	if ( isset( $_GET[ 'post' ] ) ) {

		$postid = $_GET[ 'post' ];

		// check the template file name
		if ( 'page-templates/template-column-listing.php' == get_page_template_slug( $postid ) ) {

			function column_listing_meta_box_markup( $object ) {
				wp_nonce_field( basename( __FILE__ ), "column-meta-box-nonce" );
				?>
				<div>

					<label for="column-meta-box-text"><?php _e( "Page heading:", "mdw" ); ?></label><br>
					<input name="column-meta-box-text" type="text" value="<?php echo get_post_meta( $object->ID, "column-meta-box-text", true ); ?>">

					<br>

					<label for="column-meta-box-counter"><?php _e( "Posts per page:", "mdw" ); ?></label><br>
					<input name="column-meta-box-counter" type="text" value="<?php echo get_post_meta( $object->ID, "column-meta-box-counter", true ); ?>">

					<br>

					<label for="column-meta-box-dropdown"><?php _e( "Columns:", "mdw" ); ?></label><br>
					<select name="column-meta-box-dropdown">
						<?php
						$option_values = array( 1, 2, 3, 4 );

						foreach ( $option_values as $key => $value ) {
							if ( $value == get_post_meta( $object->ID, "column-meta-box-dropdown", true ) ) {
								?>
								<option selected><?php echo $value; ?></option>
								<?php
							} else {
								?>
								<option><?php echo $value; ?></option>
								<?php
							}
						}
						?>
					</select>

				</div>
				<?php
			}

			function add_custom_meta_box() {
				add_meta_box( "column-meta-box", "Column Listing Configuration", "column_listing_meta_box_markup", "page", "side", "high", null );
			}

			add_action( "add_meta_boxes", "add_custom_meta_box" );
		}

		if ( 'page-templates/template-under-construction.php' == get_page_template_slug( $postid ) ) {

			function under_construction_meta_box_markup( $object ) {
				wp_nonce_field( basename( __FILE__ ), "under-construction-meta-box-nonce" );
				?>
				<div>

					<label for="under-construction-meta-box-text"><?php _e( "Page text:", "mdw" ); ?></label><br>
					<input name="under-construction-meta-box-text" type="text" value="<?php echo get_post_meta( $object->ID, "under-construction-meta-box-text", true ); ?>">

				</div>
				<?php
			}

			function add_under_construction_box() {
				add_meta_box( "under-construction-meta-box", "Under construction text", "under_construction_meta_box_markup", "page", "side", "high", null );
			}

			add_action( "add_meta_boxes", "add_under_construction_box" );
		}
	}
}

function save_custom_meta_box( $post_id, $post, $update ) {

	if ( !isset( $_POST[ "column-meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "column-meta-box-nonce" ], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( !current_user_can( "edit_post", $post_id ) ) {
		return $post_id;
	}

	if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	$slug = "page";
	if ( $slug != $post->post_type ) {
		return $post_id;
	}

	$meta_box_dropdown_value = "";
	$meta_box_text_value	 = "";
	$meta_box_counter_value	 = "";

	if ( isset( $_POST[ "column-meta-box-text" ] ) ) {
		$meta_box_text_value = $_POST[ "column-meta-box-text" ];
	}
	update_post_meta( $post_id, "column-meta-box-text", $meta_box_text_value );

	if ( isset( $_POST[ "column-meta-box-counter" ] ) ) {
		$meta_box_counter_value = $_POST[ "column-meta-box-counter" ];
	}
	update_post_meta( $post_id, "column-meta-box-counter", $meta_box_counter_value );

	if ( isset( $_POST[ "column-meta-box-dropdown" ] ) ) {
		$meta_box_dropdown_value = $_POST[ "column-meta-box-dropdown" ];
	}
	update_post_meta( $post_id, "column-meta-box-dropdown", $meta_box_dropdown_value );
}

add_action( "save_post", "save_custom_meta_box", 10, 3 );

function save_under_construction_meta_box( $post_id, $post, $update ) {

	if ( !isset( $_POST[ "under-construction-meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "under-construction-meta-box-nonce" ], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( !current_user_can( "edit_post", $post_id ) ) {
		return $post_id;
	}

	if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	$slug = "page";
	if ( $slug != $post->post_type ) {
		return $post_id;
	}

	$meta_under_box_dropdown_value = "";

	if ( isset( $_POST[ "under-construction-meta-box-text" ] ) ) {
		$meta_under_box_dropdown_value = $_POST[ "under-construction-meta-box-text" ];
	}
	update_post_meta( $post_id, "under-construction-meta-box-text", $meta_under_box_dropdown_value );
}

add_action( "save_post", "save_under_construction_meta_box", 10, 3 );

//Add custom fields to user profile
add_action( 'show_user_profile', 'add_extra_social_links' );
add_action( 'edit_user_profile', 'add_extra_social_links' );

function add_extra_social_links( $user ) {
	?>
	<h3>Social Network Links</h3>
	<table class="form-table">
		<tr>
			<th><label for="facebook_profile">Facebook URL</label></th>
			<td><input type="text" name="facebook_profile" value="<?php echo esc_attr( get_the_author_meta( 'facebook_profile', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="twitter_profile">Twitter URL</label></th>
			<td><input type="text" name="twitter_profile" value="<?php echo esc_attr( get_the_author_meta( 'twitter_profile', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="google_profile">Google+ URL</label></th>
			<td><input type="text" name="google_profile" value="<?php echo esc_attr( get_the_author_meta( 'google_profile', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="linkedin_profile">LinkedIn URL</label></th>
			<td><input type="text" name="linkedin_profile" value="<?php echo esc_attr( get_the_author_meta( 'linkedin_profile', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php
}

add_action( 'personal_options_update', 'save_extra_social_links' );
add_action( 'edit_user_profile_update', 'save_extra_social_links' );

function save_extra_social_links( $user_id ) {
	update_user_meta( $user_id, 'facebook_profile', sanitize_text_field( $_POST[ 'facebook_profile' ] ) );
	update_user_meta( $user_id, 'twitter_profile', sanitize_text_field( $_POST[ 'twitter_profile' ] ) );
	update_user_meta( $user_id, 'google_profile', sanitize_text_field( $_POST[ 'google_profile' ] ) );
	update_user_meta( $user_id, 'linkedin_profile', sanitize_text_field( $_POST[ 'linkedin_profile' ] ) );
}

/**
 * ADDING CUSTOM JAVA SCRIPT PANEL TO POST/PAGE/PRODUCT
 * Adds a meta box to the post editing screen
 */
function javascript_code() {
	$screens = array( 'post', 'page', 'product' );

	foreach ( $screens as $screen ) {

		add_meta_box( 'javascript_code', __( 'Add custom java script code to footer', 'mdw' ), 'javascript_code_callback', $screen );
	}
}

add_action( 'add_meta_boxes', 'javascript_code' );

/**
 * Outputs the content of the meta box
 */
function javascript_code_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>

	<p>
		<textarea id="javascript_code" rows="10" cols="70" name="javascript_code" id="javascript_code">
			<?php
			if ( isset( $prfx_stored_meta[ 'javascript_code' ] ) ) {
				echo $prfx_stored_meta[ 'javascript_code' ][ 0 ];
			}
			?>
		</textarea>
	</p>

	<?php
}

/**
 * Saves the custom meta input
 */
function javascript_code_save( $post_id ) {

	// Checks save status
	$is_autosave	 = wp_is_post_autosave( $post_id );
	$is_revision	 = wp_is_post_revision( $post_id );
	$is_valid_nonce	 = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	if ( isset( $_POST[ 'javascript_code' ] ) ) {
		update_post_meta( $post_id, 'javascript_code', $_POST[ 'javascript_code' ] );
	}
}

add_action( 'save_post', 'javascript_code_save' );
?>
