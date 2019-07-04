<?php
/*
  Plugin Name: MDW Intro: Minimalist Form
  Plugin URI: http://mdwordpress.com
  Description: Intro widget containing signup form
  Author: MDWootstrap.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_Intro_Minimalist_Form' );
} );

/**
 * Adds MDW_Intro_Minimalist_Form widget.
 */
class MDW_Intro_Minimalist_Form extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Intro_Minimalist_Form', // Base ID
  __( 'MDW Intro: Minimalist', 'mdw' ), // Name
	  array( 'description'	 => __( 'Intro widget containing minimalist form!', 'mdw' ),
			'category'		 => __( 'intro', 'mdw' )
		) // Args
		);

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}

	function admin_setup() {

		wp_enqueue_media();
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ), NULL, true );
		wp_enqueue_script( 'mdw-all-admin-scripts-js' );
		wp_register_script( 'mdw-tabs', get_template_directory_uri() . '/js/tabs.js', NULL, NULL, true );
		wp_enqueue_script( 'mdw-tabs' );
		wp_register_script( 'icon-picker', get_template_directory_uri() . '/js/icon-picker.js', NULL, NULL, true );
		wp_enqueue_script( 'icon-picker' );
		wp_register_style( 'Admin_Widget_MDW', get_template_directory_uri() . '/css/admin-widget-mdw.css' );
		wp_enqueue_style( 'Admin_Widget_MDW' );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $w_args, $instance ) {

        wp_register_script( 'mdb-minimalist-form-minimalist-js', get_template_directory_uri() . '/widgets/intros/minimalist-form/js/minimalist.js' );
        wp_enqueue_script( 'mdb-minimalist-form-minimalist-js' );

		wp_register_style( 'intro', get_template_directory_uri() . '/widgets/css/intro.css' );
		wp_enqueue_style( 'intro' );

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];
			wp_register_style( 'mdw-minimalist-form-style-css', get_template_directory_uri() . '/widgets/intros/minimalist-form/css/style.css' );
			wp_enqueue_style( 'mdw-minimalist-form-style-css' );

			// use a template for the output so that it can easily be overridden by theme
			// check for template in active theme
			$template = locate_template( array( 'minimalist-form-template.php' ) );

			// if none found use the default template
			if ( $template == '' )
				$template = 'minimalist-form-template.php';

			include ( $template );
            echo $w_args[ 'after_widget' ];
		}

		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
		$no_image			 = get_template_directory_uri() . "/img/no_image.jpg";
		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
		$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
		$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
		$filled_buttons		 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		$big_font			 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';

		$select_form	 = ( isset( $instance[ 'select_form' ] ) ) ? $instance[ 'select_form' ] : '';
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$form = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
		$WG = new WidgetInputsGenerator();
        $forms   = class_exists( 'WPCF7_Mail' );
        if ( class_exists( 'GFCommon' ) ) {
          $GFforms = GFAPI::get_forms();  
        } else {
          $GFforms = "";
        }

		?>

		<div class="titlepage_widget">
			<!-- Main title -->
			<div class="widget_input">
				<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
				<br/>
			</div>
			<!-- /.Main title -->

			<!-- Main content -->
			<div class="widget_input">
				<?php $WG->textareaInput( 'title_description', ${'title_description'} , ' Content ', $this ); ?>
				<br/>
			</div>
			<!-- /.Main content -->


			<div class="row">
				<div class="col-md-6">
					<?php $WG->imageInput( "background_image", $bg_image, "", 'Select Image', "", $bg_image, $this );?>
					<!-- Image -->
	
				</div>
				<div class="col-md-6">
					<!-- Button text -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_text', ${'button_text'}, 'Button text', $this ) ?>
						<br/>
					</div>
					<!-- /.Button text -->

					<!-- Button URL -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_url', ${'button_url'}, 'Button URL', $this ) ?>
						<br/>
					</div>
					<!-- /.Button URL -->

					<?php if ( is_plugin_active( 'mdw-contact-form/mdw-contact-form.php' ) ) { ?> <!-- Check if there is MDW Contact Form plugin installed -->

						<!-- Form type -->
						<div class='widget_input'>
							<select style="display:block" id="<?php echo $this->get_field_id( 'form' ); ?>" name="<?php echo $this->get_field_name( 'form' ); ?>">

								<?php
								global $wpdb;
								$mdw_contact_forms_table = $wpdb->prefix . 'mdw_contact_forms';

								try {
									$forms = $wpdb->get_results( "SELECT * FROM $mdw_contact_forms_table" );
								} catch ( Exception $error ) {
									echo $error;
								}



								foreach ( $forms as $form ) {

									$form_name	 = $form->form_name;
									$form_id	 = $form->form_id;
									$mailto		 = $form->mailto;
									$form_code	 = '[mdw-form form_id=' . $form_id . ' mailto=' . $mailto . ']';
									?>
									<option <?php echo ( $form_code == $instance[ 'form' ]) ? 'selected' : '' ?>
										value='<?php echo ( $form_code ); ?>' >
											<?php echo esc_html( $form_name ); ?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!-- Form type -->

					<?php } else if ( class_exists( 'WPCF7' ) ) { ?> <!-- Check if there is Contact Form 7 plugin installed -->
						<!-- Form type -->
						<div class='widget_input'>
							<label><?php _e( 'Choose contact form', 'mdw' ); ?></label>
                              <?php
                              $args        = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
                              $cf7Forms    = get_posts( $args );
                              ?>
                              <?php if ( !empty( $forms ) || !empty( $GFforms ) ) { ?>


                                  <select style="display:block" id="<?php echo $this->get_field_id( 'form' ); ?>" name="<?php echo $this->get_field_name( 'form' ); ?>">

                                      <?php
                                      foreach ( $cf7Forms as $cf7Form ) {

                                          $form_title  = $cf7Form->post_title;
                                          $form_id     = "" . $cf7Form->ID;
                                          $form_code   = '[contact-form-7 id="' . $form_id . '" title="' . $form_title . '"]';
                                          ?>
                                          <option <?php echo ( $form_code == $form ? 'selected' : '' ) ?>
                                              value='<?php echo ( $form_code ); ?>' >
                                                  <?php echo ( $form_title ); ?>
                                          </option>

                                      <?php }
                                       foreach ( $GFforms as $GFform ) {

                                          $form_title  = $GFform["title"];
                                          $form_id     = "" . $GFform['id'];
                                          $form_code   = '[gravityform id="' . $form_id . '" title="' . $form_title . '"]';
                                          ?>
                                          <option <?php echo ( $form_code == $form ? 'selected' : '' ) ?>
                                              value='<?php echo ( $form_code ); ?>' >
                                                  <?php echo ( $form_title ); ?>
                                          </option>

                                      <?php } ?>

                                          <option <?php echo ( "empty" == $form ? 'selected' : '' ) ?>
                                              value='<?php echo "empty" ?>' >
                                                  <?php echo ( "None" ); ?>
                                          </option>
                                  </select>
                              <?php } else { ?>
                                  <p><?php echo __( 'In order to use this feature, you have to install, activate and configure contact form plugin', 'mdw' ); ?></p>
                              <?php } ?>
						</div>
						<!--Big heading -->
						<fieldset class="widget_input form-group">
							<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font', ${'big_font'} ); ?>
						</fieldset>

						<!--/.Big heading -->

						<!--filled buttoms -->
						<fieldset class="widget_input form-group">
							<?php $WG->insertCheckBox( $this, 'Filled buttons', 'filled_buttons', ${'filled_buttons'} ); ?>
						</fieldset>
						<!--/.filled buttoms-->
						<!-- Form type -->
					<?php } else { ?>
						<p><?php _e( 'You have no any contact form plugin. Install or activate required plugins!', 'mdw' ); ?></p>
					<?php } ?>

				</div>
			</div>
			<?php
			$pages = get_pages( array(
				'meta_key' => '_wp_page_template'
			) );

			$how_many_pages = count( $pages );

			if ( $how_many_pages >= 1 ) {
				?>
				<!--Site dropdown select-->
				<div class="widget_input col-md-12">
					<label><?php _e( 'Page to display widget: ', 'mdw' ); ?></label>
					<select style="display:block" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>">

						<option <?php echo ( $page_id == 'All pages' ? 'selected' : ''); ?> value='All pages'><?php _e( 'All pages', 'mdw' ); ?></option>

						<?php foreach ( $pages as $page ) { ?>
							<option <?php echo ($page->ID == $page_id ? 'selected' : ''); ?> value="<?php echo $page->ID; ?>">
								<?php
								echo $page->post_title;
								if ( $page->post_title == "" ) {
									echo "(empty title)";
								}
								?>
							</option>
						<?php } ?>

					</select>
				</div>
				<!--/.Site dropdown select-->
				<?php
			}
			if ( $how_many_pages == 1 ) {
				?>
				<input hidden class="title" id="<?php echo $this->get_field_id( 'page_id' ); ?>"
					   name="<?php echo $this->get_field_name( 'page_id' ); ?>"
					   type="number"
					   value="<?php
					   foreach ( $pages as $page ) {
						   echo $page->ID;
					   }
					   ?>">
				<br/>
				<?php
			}
			?>
			<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
				Your widget ID is:
		<?php echo $widget_id; ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance						 = array();
		$instance[ 'widget_id' ]		 = $this->id;
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? $new_instance[ 'title' ] : '';
		$instance[ 'title_description' ] = (!empty( $new_instance[ 'title_description' ] ) ) ? $new_instance[ 'title_description' ] : '';
		$instance[ 'button_url' ]		 = (!empty( $new_instance[ 'button_url' ] ) ) ? $new_instance[ 'button_url' ] : '';
		$instance[ 'button_text' ]		 = (!empty( $new_instance[ 'button_text' ] ) ) ? $new_instance[ 'button_text' ] : '';
		$instance[ 'background_image' ]	 = (!empty( $new_instance[ 'background_image' ] ) ) ? $new_instance[ 'background_image' ] : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'filled_buttons' ]	 = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";
		$instance[ 'big_font' ]			 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";

		$instance[ 'select_form' ]	 = (!empty( $new_instance[ 'select_form' ] ) ) ? $new_instance[ 'select_form' ] : '';
		$instance[ 'form' ]			 = (!empty( $new_instance[ 'form' ] ) ) ? ( $new_instance[ 'form' ] ) : '';
		return $instance;
	}

}

// class My_Widget
