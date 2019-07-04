<?php
/*
  Plugin Name: MDW Intro: Signup
  Plugin URI: http://mdwordpress.com
  Description: Intro widget containing signup form!
  Author: MDWootstrap.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );



add_action( 'widgets_init', function() {
	register_widget( 'MDW_Intro_Signup' );
} );

/**
 * Adds MDW_Intro_Signup widget.
 */
class MDW_Intro_Signup extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Intro_Signup', // Base ID
  __( 'MDW Intro: Signup', 'mdw' ), // Name
	  array( 'description'	 => __( 'Intro widget containing signup form!', 'mdw' ),
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

        wp_register_script( 'intro-signup-form-swap', get_template_directory_uri() . '/js/intro-signup-swap-form.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'intro-signup-form-swap' );

		wp_register_style( 'intro', get_template_directory_uri() . '/widgets/css/intro.css' );
		wp_enqueue_style( 'intro' );

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];
			wp_register_style( 'mdw-intro-signup-style-css', get_template_directory_uri() . '/widgets/intros/intro-signup/css/style.css' );
			wp_enqueue_style( 'mdw-intro-signup-style-css' );

			// use a template for the output so that it can easily be overridden by theme
			// check for template in active theme
			$template = locate_template( array( 'intro-signup-template.php' ) );

			// if none found use the default template
			if ( $template == '' )
				$template = 'intro-signup-template.php';

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
		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
		$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
		$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		
		$WG = new WidgetInputsGenerator();
		?>

		<div class="titlepage_widget">
			<!-- Main title  -->
			<div class="widget_input">
				<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
				<br/>
			</div>
			<!-- /.Main title  -->

			<!-- Main content  -->
			<div class="widget_input">
				<?php $WG->textareaInput( 'title_description', ${'title_description'} , ' Content ', $this ); ?>
				<br/>
			</div>
			<!-- /.Main content  -->

			<!--Big heading -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font', ${'big_font'} ); ?>
			</fieldset>

			<!--/.Big heading -->

			<!--Mask -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Mask', 'mask', ${'mask'} ); ?>
			</fieldset>
			<!--/.Mask -->
			<!--filled buttoms -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Filled buttons', 'filled_buttons', ${'filled_buttons'} ); ?>
			</fieldset>
			<!--/.filled buttoms-->

			<div class='row'>
				<div class='col-md-6'>
					<!-- Image  -->
					<?php $WG->imageInput( "background_image", $bg_image, "", 'Select Image', ${'background_image'.'_url'}, $bg_image, $this );?>
					<!-- /.Image  -->
				</div>

				<div class='col-md-6'>
					<!-- Button text  -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_text', ${'button_text'}, 'Button text :', $this ) ?>
						<br/>
					</div>
					<!-- /.Button text  -->

					<!-- Button URL  -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_url', ${'button_url'}, 'Button URL:', $this ) ?>
						<br/>
					</div>
					<!-- ./Button URL  -->
				</div>
			</div>
			<?php
			$pages			 = get_pages( array(
				'meta_key' => '_wp_page_template'
			) );

			$how_many_pages = count( $pages );

			if ( $how_many_pages >= 1 ) {
				?>
				<!--Site dropdown select-->
				<div class="widget_input col-md-12">
					<label><?php _e( 'Page to display widget:', 'mdw' ); ?></label>
					<select style="display:block" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>">

						<option <?php echo ( $page_id == 'All pages' ? 'selected' : ''); ?> value='All pages'><?php _e( 'All pages', 'mdw' ); ?></option>

						<?php foreach ( $pages as $page ) { ?>
							<option <?php echo ($page->ID == $page_id ? 'selected' : ''); ?> value="<?php echo $page->ID; ?>">
								<?php
								echo $page->post_title;
								if ( $page->post_title == "" ) {
									_e( 'Empty title', 'mdw' );
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

		</div>
		<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
			Your widget ID is:
		<?php echo $widget_id; ?>
		</p>
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
		$instance = array();

		$instance[ 'widget_id' ]		 = $this->id;
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? $new_instance[ 'title' ] : '';
		$instance[ 'title_description' ] = (!empty( $new_instance[ 'title_description' ] ) ) ? $new_instance[ 'title_description' ] : '';
		$instance[ 'button_url' ]		 = (!empty( $new_instance[ 'button_url' ] ) ) ? $new_instance[ 'button_url' ] : '';
		$instance[ 'button_text' ]		 = (!empty( $new_instance[ 'button_text' ] ) ) ? $new_instance[ 'button_text' ] : '';
		$instance[ 'background_image' ]	 = (!empty( $new_instance[ 'background_image' ] ) ) ? $new_instance[ 'background_image' ] : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'big_font' ]			 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";
		$instance[ 'mask' ]				 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'filled_buttons' ]	 = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";
		return $instance;
	}

}

// class My_Widget
