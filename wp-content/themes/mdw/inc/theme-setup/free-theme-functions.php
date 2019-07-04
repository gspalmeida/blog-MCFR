<?php
// template-jumbotron.php
if ( 'post.php' == basename( $_SERVER[ 'REQUEST_URI' ], '?' . $_SERVER[ 'QUERY_STRING' ] ) && !isset( $_GET[ 'post_type' ] ) ) {



	if ( isset( $_GET[ 'post' ] ) ) {

		// get post ID
		$postid = $_GET[ 'post' ];

		function navigation_meta_box_markup( $object ) {
			wp_nonce_field( basename( __FILE__ ), "navigation-meta-box-nonce" );
			?>
			<div>
				<label for="meta-navigation-type"><?php _e( "Navigation:", "mdw" ); ?></label><br>
				<select name="meta-navigation-type">
					<?php
					$option_values = array( "inherit" => "Inherit", "none" => "None", "navbar" => "Horizontal Menu", "sidenav" => "Sidebar Menu", "both" => "Both" );

					foreach ( $option_values as $key => $value ) {
						if ( $key == get_post_meta( $object->ID, "meta-navigation-type", true ) ) {
							?>
							<option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						}
					}
					?>
				</select>
				<br>
				<label for="meta-navbar-type"><?php _e( "Horizontal Menu type:", "mdw" ); ?></label><br>

				<select name="meta-navbar-type">
					<?php
					$option_values = array( "inherit" => "Inherit", "basic" => "Basic", "top" => "Fixed top", "bottom" => "Fixed bottom", "scrolling" => "Scrolling" );


					foreach ( $option_values as $key => $value ) {
						if ( $key == get_post_meta( $object->ID, "meta-navbar-type", true ) ) {
							?>
							<option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						}
					}
					?>
				</select>
				<br>
				<label for="meta-sidenav-type"><?php _e( "Sidebar Menu type:", "mdw" ); ?></label><br>
				<select name="meta-sidenav-type">
					<?php
					$option_values = array( "inherit" => "Inherit", "fixed" => "Fixed", "hidden" => "Hidden", );

					foreach ( $option_values as $key => $value ) {
						if ( $key == get_post_meta( $object->ID, "meta-sidenav-type", true ) ) {
							?>
							<option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						}
					}
					?>
				</select>
				<br>

				<?php
				$transparent_navbar	 = get_post_meta( $object->ID, 'meta-transparent-type', true );
				?>

				<input name="meta-transparent-type" type="checkbox" value="yes" 
				<?php echo ( $transparent_navbar == "yes" ) ? 'checked' : ''; ?>
					   >
				<label for="meta-transparent-type"><?php _e( "Transparent Horizontal Menu", "mdw" ); ?></label><br>





				<label for="custom-layout-meta-box-dropdown"><?php _e( "Layout type", "mdw" ); ?></label><br>
				<select name="custom-layout-meta-box-dropdown">
					<?php
					$option_values		 = array( "inherit" => "Inherit", "container_sidebar" => "Margins with sidebar", "full_sidebar" => "Full page with sidebar", "container" => "Margins", "full" => "Full page" );

					foreach ( $option_values as $key => $value ) {
						if ( $key == get_post_meta( $object->ID, "custom-layout-meta-box-dropdown", true ) ) {
							?>
							<option selected value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						}
					}
					?>
				</select>
				<br>
				<label for="meta-footer-type"><?php _e( "Footer type:", "mdw" ); ?></label><br>
				<select name="meta-footer-type">
					<?php
					$option_values = array( "inherit" => "Inherit", "none" => "None", "advanced" => "Advanced" );
					foreach ( $option_values as $key => $value ) {
						if ( $key == get_post_meta( $object->ID, "meta-footer-type", true ) ) {
							?>
							<option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
							<?php
						} else {
							?>
							<option value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php
						}
					}
					?>
				</select>
				<br>
				<label><?php _e( "Choose sidebar: ", "mdw" ) ?></label><br />
				<label for="meta-sidebar-type"><?php _e( "Select from existing:", "mdw" ); ?>
					<select name="meta-sidebar-type">
						<option value="default">Default</option>
						<?php
						global $wp_registered_sidebars;
						foreach ( $wp_registered_sidebars as $key => $value ) {
							if ( $key == get_post_meta( $object->ID, "meta-sidebar-type", true ) ) {
								?>
								<option value="<?php echo $key ?>" selected><?php echo $key ?></option>
								<?php
							}
						}
						?>
					</select>
			</div>
			<label for="new-sidebar-type"><?php _e( "Define new: ", "mdw" ) ?></label>
			<input name="new-sidebar-type" type="text" value="">
			<?php
		}

		if ( !function_exists( "add_custom_meta_box" ) ) {

			function custom() {
				add_meta_box( "navigation-meta-box", "Navigation Configuration (optional)", "navigation_meta_box_markup", "page", "side", "high", null );
			}

			add_action( "add_meta_boxes", "custom" );
		}
		// check the template file name
		if ( 'template-jumbotron.php' == get_page_template_slug( $postid ) ) {


			function jumbotron_meta_box_markup( $object ) {
				wp_nonce_field( basename( __FILE__ ), "jumbotron-meta-box-nonce" );
				?>
				<div>

					<label for="jumbotron-meta-box-text"><?php _e( "Page heading:", "mdw" ); ?></label><br>
					<input name="jumbotron-meta-box-text" type="text" value="<?php echo get_post_meta( $object->ID, "jumbotron-meta-box-text", true ); ?>">

					<br>
					<label for="jumbotron-meta-box-textarea-top-content"><?php _e( "Top content:", "mdw" ); ?></label><br>
					<textarea name="jumbotron-meta-box-textarea-top-content" ><?php echo get_post_meta( $object->ID, "jumbotron-meta-box-textarea-top-content", true ); ?></textarea>

					<br>
					<label for="jumbotron-meta-box-textarea-bottom-content"><?php _e( "Bottom content:", "mdw" ); ?></label><br>
					<textarea name="jumbotron-meta-box-textarea-bottom-content" ><?php echo get_post_meta( $object->ID, "jumbotron-meta-box-textarea-bottom-content", true ); ?></textarea>

					<br>
					<label for="jumbotron-meta-box-button-name"><?php _e( "Button name:", "mdw" ); ?></label><br>
					<input name="jumbotron-meta-box-button-name" type="text" value="<?php echo get_post_meta( $object->ID, "jumbotron-meta-box-button-name", true ); ?>">

					<br>
					<label for="jumbotron-meta-box-button-link"><?php _e( "Button link:", "mdw" ); ?></label><br>
					<input name="jumbotron-meta-box-button-link" type="text" value="<?php echo get_post_meta( $object->ID, "jumbotron-meta-box-button-link", true ); ?>" placeholder="www.mdwp.io">
				</div>
				<?php
			}

			function add_custom_meta_box() {
				add_meta_box( "jumbotron-meta-box", "Jumbotron Configuration", "jumbotron_meta_box_markup", "page", "side", "high", null );
			}

			add_action( "add_meta_boxes", "add_custom_meta_box" );
		} elseif ( 'template-full-background-image.php' == get_page_template_slug( $postid ) ) {


			function background_meta_box_markup( $object ) {
				wp_nonce_field( basename( __FILE__ ), "background-meta-box-nonce" );
				?>
				<div>

					<label for="background-meta-box-text"><?php _e( "Page heading:", "mdw" ); ?></label><br>
					<input name="background-meta-box-text" type="text" value="<?php echo get_post_meta( $object->ID, "background-meta-box-text", true ); ?>">

					<br>
					<label for="background-meta-box-textarea-secondary"><?php _e( "Secondary:", "mdw" ); ?></label><br>
					<textarea name="background-meta-box-textarea-secondary" ><?php echo get_post_meta( $object->ID, "background-meta-box-textarea-secondary", true ); ?></textarea>

					<br>
					<label for="background-meta-box-button-name"><?php _e( "Button name:", "mdw" ); ?></label><br>
					<input name="background-meta-box-button-name" type="text" value="<?php echo get_post_meta( $object->ID, "background-meta-box-button-name", true ); ?>">

					<br>
					<label for="background-meta-box-button-link"><?php _e( "Button link:", "mdw" ); ?></label><br>
					<input name="background-meta-box-button-link" type="text" value="<?php echo get_post_meta( $object->ID, "background-meta-box-button-link", true ); ?>" placeholder="www.mdwp.io">

					<br>
					<label for="background-meta-box-button-name_1"><?php _e( "Second button name:", "mdw" ); ?></label><br>
					<input name="background-meta-box-button-name_1" type="text" value="<?php echo get_post_meta( $object->ID, "background-meta-box-button-name_1", true ); ?>">

					<br>
					<label for="background-meta-box-button-link_1"><?php _e( "Second button link:", "mdw" ); ?></label><br>
					<input name="background-meta-box-button-link_1" type="text" value="<?php echo get_post_meta( $object->ID, "background-meta-box-button-link_1", true ); ?>" placeholder="www.mdwp.io">
				</div>
				<?php
			}

			function add_custom_meta_box() {
				add_meta_box( "background-meta-box", "Background image Configuration", "background_meta_box_markup", "page", "side", "high", null );
			}

			add_action( "add_meta_boxes", "add_custom_meta_box" );
		}
	}
}

function save_jumbotron_meta_box( $post_id, $post, $update ) {


	if ( !isset( $_POST[ "jumbotron-meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "jumbotron-meta-box-nonce" ], basename( __FILE__ ) ) ) {
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

	// $meta_box_dropdown_value = "";
	$meta_box_text_value		 = "";
	$meta_box_textarea_value	 = "";
	$meta_box_button_name_value	 = "";
	$meta_box_button_link_value	 = "";
	//$meta_box_counter_value = "";

	if ( isset( $_POST[ "jumbotron-meta-box-text" ] ) ) {
		$meta_box_text_value = $_POST[ "jumbotron-meta-box-text" ];
	}
	update_post_meta( $post_id, "jumbotron-meta-box-text", $meta_box_text_value );

	if ( isset( $_POST[ "jumbotron-meta-box-textarea-top-content" ] ) ) {
		$meta_box_textarea_value = $_POST[ "jumbotron-meta-box-textarea-top-content" ];
	}
	update_post_meta( $post_id, "jumbotron-meta-box-textarea-top-content", $meta_box_textarea_value );

	if ( isset( $_POST[ "jumbotron-meta-box-textarea-bottom-content" ] ) ) {
		$meta_box_textarea_value = $_POST[ "jumbotron-meta-box-textarea-bottom-content" ];
	}
	update_post_meta( $post_id, "jumbotron-meta-box-textarea-bottom-content", $meta_box_textarea_value );

	if ( isset( $_POST[ "jumbotron-meta-box-button-name" ] ) ) {
		$meta_box_button_name_value = $_POST[ "jumbotron-meta-box-button-name" ];
	}
	update_post_meta( $post_id, "jumbotron-meta-box-button-name", $meta_box_button_name_value );

	if ( isset( $_POST[ "jumbotron-meta-box-button-link" ] ) ) {
		$meta_box_button_link_value = $_POST[ "jumbotron-meta-box-button-link" ];
	}
	update_post_meta( $post_id, "jumbotron-meta-box-button-link", $meta_box_button_link_value );
}

function save_background_meta_box( $post_id, $post, $update ) {


	if ( !isset( $_POST[ "background-meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "background-meta-box-nonce" ], basename( __FILE__ ) ) ) {
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

	// $meta_box_dropdown_value = "";
	$meta_box_text_value			 = "";
	$meta_box_textarea_value		 = "";
	$meta_box_button_name_value		 = "";
	$meta_box_button_name_value_1	 = "";
	$meta_box_button_link_value		 = "";
	$meta_box_button_link_value_1	 = "";
	//$meta_box_counter_value = "";

	if ( isset( $_POST[ "background-meta-box-text" ] ) ) {
		$meta_box_text_value = $_POST[ "background-meta-box-text" ];
	}
	update_post_meta( $post_id, "background-meta-box-text", $meta_box_text_value );

	if ( isset( $_POST[ "background-meta-box-textarea-secondary" ] ) ) {
		$meta_box_textarea_value = $_POST[ "background-meta-box-textarea-secondary" ];
	}
	update_post_meta( $post_id, "background-meta-box-textarea-secondary", $meta_box_textarea_value );

	if ( isset( $_POST[ "background-meta-box-button-name" ] ) ) {
		$meta_box_button_name_value = $_POST[ "background-meta-box-button-name" ];
	}
	update_post_meta( $post_id, "background-meta-box-button-name", $meta_box_button_name_value );

	if ( isset( $_POST[ "background-meta-box-button-link" ] ) ) {
		$meta_box_button_link_value = $_POST[ "background-meta-box-button-link" ];
	}
	update_post_meta( $post_id, "background-meta-box-button-link", $meta_box_button_link_value );

	if ( isset( $_POST[ "background-meta-box-button-name_1" ] ) ) {
		$meta_box_button_name_value_1 = $_POST[ "background-meta-box-button-name_1" ];
	}
	update_post_meta( $post_id, "background-meta-box-button-name_1", $meta_box_button_name_value_1 );

	if ( isset( $_POST[ "background-meta-box-button-link_1" ] ) ) {
		$meta_box_button_link_value_1 = $_POST[ "background-meta-box-button-link_1" ];
	}
	update_post_meta( $post_id, "background-meta-box-button-link_1", $meta_box_button_link_value_1 );
}

function save_navigation_meta_box( $post_id, $post, $update ) {


	if ( !isset( $_POST[ "navigation-meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "navigation-meta-box-nonce" ], basename( __FILE__ ) ) ) {
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

	// $meta_box_dropdown_value = "";
	$custom_navigation_meta_box_dropdown_value	 = "";
	$custom_navbar_meta_box_dropdown_value		 = "";
	$custom_transparent_meta_box_dropdown_value	 = "";
	$custom_siednav_meta_box_dropdown_value		 = "";
	$custom_layout_meta_box_dropdown_value		 = "";
	$custom_footer_meta_box_dropdown_value		 = "";
	//$meta_box_counter_value = "";


	if ( isset( $_POST[ "meta-navigation-type" ] ) ) {
		$custom_navigation_meta_box_dropdown_value = $_POST[ "meta-navigation-type" ];
	}
	update_post_meta( $post_id, "meta-navigation-type", $custom_navigation_meta_box_dropdown_value );

	if ( isset( $_POST[ "meta-navbar-type" ] ) ) {
		$custom_navbar_meta_box_dropdown_value = $_POST[ "meta-navbar-type" ];
	}
	update_post_meta( $post_id, "meta-navbar-type", $custom_navbar_meta_box_dropdown_value );

	if ( isset( $_POST[ "meta-transparent-type" ] ) ) {
		$custom_transparent_meta_box_dropdown_value = $_POST[ "meta-transparent-type" ];
	}
	update_post_meta( $post_id, "meta-transparent-type", $custom_transparent_meta_box_dropdown_value );

	if ( isset( $_POST[ "meta-sidenav-type" ] ) ) {
		$custom_siednav_meta_box_dropdown_value = $_POST[ "meta-sidenav-type" ];
	}
	update_post_meta( $post_id, "meta-sidenav-type", $custom_siednav_meta_box_dropdown_value );

	if ( isset( $_POST[ "custom-layout-meta-box-dropdown" ] ) ) {
		$custom_layout_meta_box_dropdown_value = $_POST[ "custom-layout-meta-box-dropdown" ];
	}
	update_post_meta( $post_id, "custom-layout-meta-box-dropdown", $custom_layout_meta_box_dropdown_value );

	if ( isset( $_POST[ "meta-footer-type" ] ) ) {
		$custom_footer_meta_box_dropdown_value = $_POST[ "meta-footer-type" ];
	}
	update_post_meta( $post_id, "meta-footer-type", $custom_footer_meta_box_dropdown_value );
}

/**
 * 
 * @param type $post_id
 */
function register_new_sidebar( $post_id ) {

	if ( isset( $_POST[ 'new-sidebar-type' ] ) && !empty( $_POST[ 'new-sidebar-type' ] ) ) {
		$new_siderbar_type	 = $_POST[ 'new-sidebar-type' ];
		$new_siderbar_type	 = filter_var( $new_siderbar_type, FILTER_SANITIZE_STRING );
		$custom_sidebars	 = get_theme_mod( 'custom_sidebars' );
		if ( count( $custom_sidebars ) == 0 ) {
			$new_settings = array( $new_siderbar_type );
			set_theme_mod( 'custom_sidebars', $new_settings );
		} else {
			$custom_sidebars[] = $new_siderbar_type;
			set_theme_mod( 'custom_sidebars', $custom_sidebars );
		}
		update_post_meta( $post_id, 'meta-sidebar-type', $new_siderbar_type );
	} else if ( !isset( $_POST[ 'meta-sidebar-type' ] ) ) {
		$_POST[ 'meta-sidebar-type' ] = "default";
	} else {
		$new_siderbar_type	 = $_POST[ 'meta-sidebar-type' ];
		$new_siderbar_type	 = filter_var( $new_siderbar_type, FILTER_SANITIZE_STRING );
		update_post_meta( $post_id, 'meta-sidebar-type', $new_siderbar_type );
	}
}

add_action( "save_post", "save_background_meta_box", 10, 3 );
add_action( "save_post", "save_jumbotron_meta_box", 10, 3 );
add_action( "save_post", "save_navigation_meta_box", 10, 3 );
add_action( "save_post", "register_new_sidebar", 10, 3 );
