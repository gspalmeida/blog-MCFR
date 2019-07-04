<?php
/*
  Plugin Name: MDW Intro: APP
  Plugin URI: http://mdwordpress.com
  Description: Application intro
  Author: MDWordpress.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Intro_App' );
} );

/**
 * MDW_Intro_App widget.
 */
class MDW_Intro_App extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Intro_App', // Base ID
  __( 'MDW Intro: APP', 'mdw' ), // Name
	  array( 'description'	 => __( 'Application Intro', 'mdw' ),
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

		wp_register_style( 'MDW-app-intro-custom-styles', get_template_directory_uri() . '/widgets/css/intro.css' );
		wp_enqueue_style( 'MDW-app-intro-custom-styles' );

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];
			// use a template for the output so that it can easily be overridden by theme
			// check for template in active theme
			$template = locate_template( array( 'app-template.php' ) );

			// if none found use the default template
			if ( $template == '' )
				$template = 'app-template.php';

			include ( $template );
            echo $w_args[ 'after_widget' ];
		}

		
	}

	public function form( $instance ) {
		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		/* General variables */
		$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$image				 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$transparent_image	 = ( isset( $instance[ 'transparent_image' ] ) ) ? $instance[ 'transparent_image' ] : '';
		$icon_1				 = ( isset( $instance[ 'icon_1' ] ) ) ? $instance[ 'icon_1' ] : '';
		$icon_color_1		 = ( isset( $instance[ 'icon_color_1' ] ) ) ? $instance[ 'icon_color_1' ] : '';
		$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
		$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
		$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		$WG = new WidgetInputsGenerator();

		$amount = 2;
		for ( $i = 1; $i <= $amount; $i++ ) {

			${"button_text_" . $i}	 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
			${"button_href_" . $i}	 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';
		}
		?>

		<div class="titlepage_widget">
			<?php get_template_part( 'template-parts/icons' ); ?>
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

			<div class="row">
				<!--Image -->
				<div class="widget_input col-md-6">
					<h3><?php _e( 'Select background image', 'mdw' ); ?></h3>
					<?php $WG->imageInput( "image", ${"image"}, "", 'Select Image', ${'image'.'_url'}, ${"image"}, $this );?>
				</div>
				<!--/.Image -->

				<!--Transparent Image -->
				<div class="widget_input col-md-6">
					<h3><?php _e( 'Select image on top', 'mdw' ); ?></h3>
					<?php $WG->imageInput( "transparent_image", ${"transparent_image"}, "", 'Select Image', ${'transparent_image'.'_url'}, ${"transparent_image"}, $this );?>
				</div>
				<!--/.Transparent Image -->
			</div>


			<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
				<div class="col-md-6">
					<!-- Button text-->
					<div class="widget_input">
						<?php $WG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text', $this ) ?>
						<br/>
					</div>
					<!-- /.Button text-->

					<!-- Button href-->
					<div class="widget_input">
						<?php $WG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ) ?>
						<br/>

					</div>
					<!-- /.Button href-->
					<?php if ( $i == 2 ) { ?>
						<!-- Icon  -->
						<div class="widget_input col-md-3">
							<?php $WG->insertIconContainers(  $this, ${'icon_container_1'} , ${'icon_color_1'}, 'icon_1', 'icon_color_1', 'icon_container_1' ) ?>
							<br/>
						</div>
						<!--  Icon  -->
					<?php } ?>
				</div>
			<?php } ?>
			<?php
			$pages = get_pages( array(
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
									_e( "Empty title", "mdw" );
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
		$instance[ 'widget_id' ]		 = $this->id;
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( ( $new_instance[ 'title' ] ) ) : '';
		$instance[ 'main_content' ]		 = (!empty( $new_instance[ 'main_content' ] ) ) ? strip_tags( ( $new_instance[ 'main_content' ] ) ) : '';
		$instance[ 'image' ]			 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : '';
		$instance[ 'transparent_image' ] = (!empty( $new_instance[ 'transparent_image' ] ) ) ? strip_tags( ( $new_instance[ 'transparent_image' ] ) ) : '';
		$instance[ 'icon_1' ]			 = (!empty( $new_instance[ 'icon_1' ] ) ) ? ( $new_instance[ 'icon_1' ] ) : '';
		$instance[ 'icon_container_1' ]	 = (!empty( $new_instance[ 'icon_container_1' ] ) ) ? strip_tags( ( $new_instance[ 'icon_container_1' ] ) ) : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'big_font' ]			 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";
		$instance[ 'mask' ]				 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'filled_buttons' ]	 = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";
		$instance[ 'icon_color_1' ]		 = (!empty( $new_instance[ 'icon_color_1' ] ) ) ? ( $new_instance[ 'icon_color_1' ] ) : "";


		$amount = 2;
		for ( $i = 1; $i <= $amount; $i++ ) {

			$instance[ 'button_text_' . $i ] = (!empty( $new_instance[ 'button_text_' . $i ] ) ) ? strip_tags( ( $new_instance[ 'button_text_' . $i ] ) ) : '';
			$instance[ 'button_href_' . $i ] = (!empty( $new_instance[ 'button_href_' . $i ] ) ) ? strip_tags( ( $new_instance[ 'button_href_' . $i ] ) ) : '';
		}

		return $instance;
	}

}

// class My_Widget
