<?php
/*
  Plugin Name: MDW CTA
  Plugin URI: http://mdwordpress.com
  Description: Custom heading, paragraph, background and action button
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_CTA' );
} );

/**
 * CTA widget.
 */
class MDW_CTA extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'mdw_cta', // Base ID
  __( 'MDW CTA', 'mdw' ), // Name
	  array( 'description'	 => __( 'Custom heading, paragraph, background and action button', 'mdw' ),
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
	public function widget( $args, $instance ) {

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
						$template = dirname( __DIR__ ) . '/cta/templates/template-' . $i . '.php';
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
        $ICG             = new WidgetInputsGenerator();
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$font_color		 = ( isset( $instance[ 'font_color' ] ) ) ? $instance[ 'font_color' ] : '#fff';


		$background_image	 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
		$optional_image		 = ( isset( $instance[ 'optional_image' ] ) ) ? $instance[ 'optional_image' ] : '';
		$image_position		 = ( isset( $instance[ 'image_position' ] ) ) ? $instance[ 'image_position' ] : 'right';
		$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
		$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;


		/* Custom feed variables */
		?>


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
				<!--Title -->
				<div class="widget_input col-md-12">
                <?php $ICG->textInput( 'title', $title, 'Title', $this); ?>
					<br/>
				</div>
				<!--/.Title -->

				<!--Content-->
				<div class="widget_input col-md-12">
                <?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this); ?>
					<br/>
				</div>
				<!--/.Content-->

				<!--Background image-->
				<div class='widget_input col-md-6'>
                    <?php $ICG->imageInput( 'background_image', $background_image, 'Choose Image', 'Select Background Image', "", $background_image, $this ); ?>
					<br>
				</div>
				<!--/.Background image-->

				<!--Optional image-->
				<div class='widget_input col-md-6'>
                    <?php $ICG->imageInput( 'optional_image', $optional_image, 'Choose Image', 'Select Optional Image', "", $optional_image, $this ); ?>
                    <br/>
				</div>
				<!--/.Optional image-->

				<!--Button text -->
                <div class="widget_input col-md-6">

                    <?php $ICG->textInput( 'button_text', $button_text, 'Button text ', $this ); ?>
                    <br/>
                </div>
                <div class="widget_input col-md-6">

                    <?php $ICG->textInput( 'button_url', $button_url, 'Button url ', $this ); ?>
                    <br/>
                </div>
				<!--/.Button url -->

				<!--Image position-->
				<div class='widget_input col-md-12'>
                    <?php $ICG->selectInput( 'image_position', $image_position, "Optional image position:", array(
                        array(
                            "value" => "left",
                            "text" => "Left",
                        ),
                        array(
                            "value" => "right",
                            "text" => "Right"
                        )
                    ), $this ); ?>
				</div>
				<!--/.Image position-->
			</div>
			<div class="row">
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
				<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
					Your widget ID is:
		<?php echo $widget_id; ?>
				</p>
			</div>
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
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]		 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'optional_image' ]	 = (!empty( $new_instance[ 'optional_image' ] ) ) ? strip_tags( $new_instance[ 'optional_image' ] ) : '';
		$instance[ 'background_image' ]	 = (!empty( $new_instance[ 'background_image' ] ) ) ? ( $new_instance[ 'background_image' ] ) : '';
		$instance[ 'image_position' ]	 = (!empty( $new_instance[ 'image_position' ] ) ) ? ( $new_instance[ 'image_position' ] ) : '';
		$instance[ 'button_text' ]		 = (!empty( $new_instance[ 'button_text' ] ) ) ? ( $new_instance[ 'button_text' ] ) : "";
		$instance[ 'button_url' ]		 = (!empty( $new_instance[ 'button_url' ] ) ) ? ( $new_instance[ 'button_url' ] ) : "";
		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		return $instance;
	}

}

// class My_Widget
