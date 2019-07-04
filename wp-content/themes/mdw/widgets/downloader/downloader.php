<?php
/*
  Plugin Name: MDW Downloader
  Plugin URI: http://mdwordpress.com
  Description: Counter kicks off on scrolling to section
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_downloader' );
} );

/**
 * MDW Accordion widget.
 */
class MDW_downloader extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_downloader', // Base ID
  __( 'MDW Downloader', 'mdw' ), // Name
	  array( 'description'	 => __( 'MDW Downloader allows you to ', 'mdw' ),
			'category'		 => __( 'landing', 'mdw' )
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
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js' );
		wp_enqueue_script( 'mdw-all-admin-scripts-js' );
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

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];

			// use a template for the output so that it can easily be overridden by theme
			// read which template was chosen, if none, set first template

			$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

			for ( $i = 1; $i <= 1; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/downloader/templates/downloader-template-' . $i . '.php';
				}
			}

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
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$page_id	 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';


		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$title		 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$text_align	 = ( isset( $instance[ 'text_align' ] ) ) ? $instance[ 'text_align' ] : 'center';
		$img_align	 = ( isset( $instance[ 'img_align' ] ) ) ? $instance[ 'img_align' ] : 'left';
		$image		 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$content	 = ( isset( $instance[ 'content' ] ) ) ? $instance[ 'content' ] : '';

		$button_text = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
		$button_href = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';

		$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$main_title	 = ( isset( $instance[ 'main_title' ] ) ) ? $instance[ 'main_title' ] : '';

		$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
		$icon_color_1		 = ( isset( $instance[ 'icon_color_1' ] ) ) ? $instance[ 'icon_color_1' ] : '#4285F4';

		$filled_buttons = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		
		$WG = new WidgetInputsGenerator();

		get_template_part( 'template-parts/icons' );
		?>
    <?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
		<div class="titlepage_widget">

			<!-- Remember version of widget -->
			<input hidden
				   id="<?php echo $this->get_field_id( 'template_number' ); ?>"
				   name="<?php echo $this->get_field_name( 'template_number' ); ?>"
				   value="<?php echo sanitize_text_field( $template_number ); ?>"
				   type="text">

			<!-- Nav tabs -->
			<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
				<!-- Version preview -->
				<div id="<?php echo $this->get_field_id( 'tooltip' ); ?>">
					<!-- Preview container -->
					<img src="">
					<!-- Stores prewiews directory path -->
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>

				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_1" class="nav-link <?php echo ($template_number == 1) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v1" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 1 <i class="fa fa-eye"></i></a>
				</li>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="row">
					<!--Image -->
					<div class="widget_input col-md-6">
						<?php $WG->imageInput( "image", ${"image"}, "", 'Select Image', "", ${"image"}, $this );?>
					</div>
					<!--/.Image -->
					<div class="col-md-6">
						<div class="widget_input col-md-12">
							<?php $WG->textInput( 'main_title', ${'main_title'}, 'Main title', $this ) ?>
							<br/>
						</div>
						<!--Image title -->
						<div class="widget_input col-md-12">
							<?php $WG->textInput( 'title', ${'title'}, 'Heading ', $this ) ?>
							<br/>
						</div>
						<!--/.Image title -->
						<!--Main description -->
						<div class="widget_input col-md-12">
							<?php $WG->textInput( 'content', ${'content'}, 'Content ', $this ) ?>
							<br/>
						</div>
						<!--/.Main description -->
						<!-- Button text-->
						<div class="widget_input col-md-12">
							<?php $WG->textInput( 'button_text', ${'button_text'}, 'Button text ', $this ) ?>
							<br/>
						</div>
						<!-- /.Button text-->

						<!-- Button href-->
						<div class="widget_input col-md-12">
							<?php $WG->textInput( 'button_href', ${'button_href'}, 'Button href ', $this ) ?>
							<br/>
						</div>
						<!-- /.Button href-->
						<fieldset class="widget_input form-group col-md-6">
							<?php $WG->insertCheckBox( $this, 'Filled', 'filled_buttons', ${'filled_buttons'} ); ?>
						</fieldset>

						<div class="widget_input col-md-6" style="position:relative;">
							<?php $WG->insertIconContainers(  $this, ${'icon_container_1'} , ${'icon_color_1'}, 'icon_1', 'icon_color_1', 'icon_container_1' ) ?>
							<br/>
						</div>

					</div>
				</div>
				<br>
				<!--Image side select-->
				<div class="widget_input col-md-6">
					<label>
						<?php _e( 'Align image', 'mdw' ); ?>
					</label>
					<select style="display:block" id="<?php echo $this->get_field_id( 'img_align' ); ?>" name="<?php echo $this->get_field_name( 'img_align' ); ?>">
						<option <?php echo ( $img_align == 'left' ? 'selected' : ''); ?> value='left'>
							<?php _e( 'Left', 'mdw' ); ?>
						</option>
						<option <?php echo ( $img_align == 'right' ? 'selected' : ''); ?> value='right'>
							<?php _e( 'Right', 'mdw' ); ?>
						</option>
					</select>
				</div>
				<!--/.Image side select-->
				<!--Align dropdown select-->
				<div class="widget_input col-md-6">
					<label>
						<?php _e( 'Align text', 'mdw' ); ?>
					</label>
					<select style="display:block" id="<?php echo $this->get_field_id( 'text_align' ); ?>" name="<?php echo $this->get_field_name( 'text_align' ); ?>">
						<option <?php echo ( $text_align == 'left' ? 'selected' : ''); ?> value='left'>
							<?php _e( 'Left', 'mdw' ); ?>
						</option>
						<option <?php echo ( $text_align == 'right' ? 'selected' : ''); ?> value='right'>
							<?php _e( 'Right', 'mdw' ); ?>
						</option>
						<option <?php echo ( $text_align == 'center' ? 'selected' : ''); ?> value='center'>
							<?php _e( 'Center', 'mdw' ); ?>
						</option>
					</select>
				</div>
				<!--/.Align dropdown select--><span class="col-md-12" style="height: 2rem;"></span> </div>
			<!--/.Panel 1-->

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

						<option <?php echo ( $page_id == 'All pages' ? 'selected' : ''); ?> value='All pages'>All pages</option>

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
			<div class="widget_input col-md-12">
				<label for="<?php echo $this->get_field_name( 'box_layout' ); ?>">Box layout</label>
				<br>
				<select id="<?php echo $this->get_field_id( 'box_layout' ); ?>" name="<?php echo $this->get_field_name( 'box_layout' ); ?>" value="<?php echo sanitize_text_field( $box_layout ); ?>">
					<option <?php echo ($box_layout == 'container') ? 'selected' : '' ?> value="container">Boxed</option>
					<option <?php echo ($box_layout == 'container-fluid') ? 'selected' : '' ?> value="container-fluid">Full width</option>
				</select>
			</div>
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
		$instance[ 'widget_id' ] = $this->id;

		$instance[ 'animation' ] = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ]	 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
		$instance[ 'text_align' ]	 = (!empty( $new_instance[ 'text_align' ] ) ) ? strip_tags( $new_instance[ 'text_align' ] ) : 'center';
		$instance[ 'img_align' ]	 = (!empty( $new_instance[ 'img_align' ] ) ) ? strip_tags( $new_instance[ 'img_align' ] ) : 'center';

		$instance[ 'title' ]	 = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'content' ]	 = (!empty( $new_instance[ 'content' ] ) ) ? $new_instance[ 'content' ] : '';
		$instance[ 'image' ]	 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : '';

		$instance[ 'filled_buttons' ] = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";

		$instance[ 'main_title' ] = (!empty( $new_instance[ 'main_title' ] ) ) ? strip_tags( $new_instance[ 'main_title' ] ) : '';

		$instance[ 'button_text' ]	 = (!empty( $new_instance[ 'button_text' ] ) ) ? ( $new_instance[ 'button_text' ] ) : '';
		$instance[ 'button_href' ]	 = (!empty( $new_instance[ 'button_href' ] ) ) ? ( $new_instance[ 'button_href' ] ) : '';

		$instance[ 'icon_color_1' ]		 = (!empty( $new_instance[ 'icon_color_1' ] ) ) ? ( $new_instance[ 'icon_color_1' ] ) : '';
		$instance[ 'icon_container_1' ]	 = (!empty( $new_instance[ 'icon_container_1' ] ) ) ? ( $new_instance[ 'icon_container_1' ] ) : '';


		return $instance;
	}

}

// class My_Widget
