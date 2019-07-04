<?php
/*
  Plugin Name: MDW Intro: Video
  Plugin URI: http://mdwordpress.com
  Description: Widget presenting certain features
  Author: MDWootstrap.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Intro_Video' );
} );

/**
 * MDW_Intro_Video widget.
 */
class MDW_Intro_Video extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Intro_Video', // Base ID
  __( 'MDW Intro: Video', 'mdw' ), // Name
	  array( 'description'	 => __( 'Widget presenting certain features', 'mdw' ),
			'category'		 => __( 'intro', 'mdw' )
		) // Args
		);

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}

	function admin_setup() {

		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ), NULL, true );
		wp_enqueue_script( 'mdw-all-admin-scripts-js' );
		wp_register_script( 'mdw-tabs', get_template_directory_uri() . '/js/tabs.js', NULL, NULL, true );
		wp_enqueue_script( 'mdw-tabs' );
		wp_register_script( 'icon-picker', get_template_directory_uri() . '/js/icon-picker.js', NULL, NULL, true );
		wp_enqueue_script( 'icon-picker' );

		wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
		wp_enqueue_style( 'Font_Awesome' );
		wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
		wp_enqueue_style( 'compiled' );
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

		wp_register_style( 'intro', get_template_directory_uri() . '/widgets/css/intro.css' );
		wp_enqueue_style( 'intro' );

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];
			wp_register_style( 'MDW-intro-video-style-css', get_template_directory_uri() . '/widgets/intros/video/css/style.css' );
			wp_enqueue_style( 'MDW-intro-video-style-css' );

			// use a template for the output so that it can easily be overridden by theme
			// check for template in active theme
			$template = locate_template( array( 'video-template.php' ) );

			// if none found use the default template
			if ( $template == '' )
				$template = 'video-template.php';

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
		/* General variables */

		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$button_text	 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
		$button_href	 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';
		$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$no_image		 = get_template_directory_uri() . "/img/no_image.jpg";
		$video			 = ( isset( $instance[ 'video' ] ) ) ? $instance[ 'video' ] : '';
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
		$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
		$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		$WG = new WidgetInputsGenerator();
		?>


		<div class="titlepage_widget">
			<!--Title -->
			<div class="widget_input">
				<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
				<br/>
			</div>
			<!--/.Title -->

			<!--Main description -->
			<div class="widget_input">
				<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
				<br/>
			</div>
			<!--/.Main description -->
			<!--Big font -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font', ${'big_font'} ); ?>
			</fieldset>

			<!--/.Big font -->

			<!--Mask -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Mask', 'mask', ${'mask'} ); ?>
			</fieldset>
			<!--/.Mask -->
			<!--Filled buttons -->
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Filled buttons', 'filled_buttons', ${'filled_buttons'} ); ?>
			</fieldset>
			<!--/.Filled buttoms-->
			<div class='row'>
				<div class='col-md-6'>
					<!--Image -->
					<div class="widget_input">
						<?php $WG->imageInput( "image", $image, "", 'Select Image', ${'image' .'_url'}, $image, $this );?>		
					</div>
					<!--/.Image -->
				</div>

				<div class='col-md-6'>
					<!--Button text -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_text', ${'button_text'}, 'Button text :', $this ) ?>
						<br/>
					</div>
					<!--/.Button text -->

					<!--Button href -->
					<div class="widget_input">
						<?php $WG->textInput( 'button_href', ${'button_href'}, 'Button href :', $this ) ?>
						<br/>
					</div>
					<!--/.Button href -->

					<!-- Video header -->
					<div class="widget_input">
						<?php $WG->textInput( 'video', ${'video'}, 'Video link :', $this ) ?>
						<br/>
					</div>
					<!-- Video header-->
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
				<input hidden class="title_text" id="<?php echo $this->get_field_id( 'page_id' ); ?>"
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
		$instance = array();

		/* General variables */
		$instance[ 'widget_id' ]	 = $this->id;
		$instance[ 'title' ]		 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]	 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'video' ]		 = (!empty( $new_instance[ 'video' ] ) ) ? ( $new_instance[ 'video' ] ) : '';
		$instance[ 'button_text' ]	 = (!empty( $new_instance[ 'button_text' ] ) ) ? ( $new_instance[ 'button_text' ] ) : '';
		$instance[ 'button_href' ]	 = (!empty( $new_instance[ 'button_href' ] ) ) ? ( $new_instance[ 'button_href' ] ) : '';
		$instance[ 'image' ]		 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : '';
		$instance[ 'page_id' ]		 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'big_font' ]			 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";
		$instance[ 'mask' ]				 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'filled_buttons' ]	 = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";

		return $instance;
	}

}

// class My_Widget
