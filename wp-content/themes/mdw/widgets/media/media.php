<?php
/*
  Plugin Name: MDW Media
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
	register_widget( 'MDW_Image' );
} );

/**
 * MDW Accordion widget.
 */
class MDW_Image extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Media', // Base ID
  __( 'MDW Media', 'mdw' ), // Name
	  array( 'description'	 => __( 'MDW Accordion allows you to toggle content on your pages', 'mdw' ),
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
	public function widget( $w_args, $instance ) {

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];

			// use a template for the output so that it can easily be overridden by theme
			// read which template was chosen, if none, set first template

			$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

			for ( $i = 1; $i <= 2; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/media/templates/media-template-' . $i . '.php';
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
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$page_id	 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';


		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$image		 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';

		$icon_color		 = ( isset( $instance[ 'icon_color' ] ) ) ? $instance[ 'icon_color' ] : '#4285F4';
		$icon_container	 = ( isset( $instance[ 'icon_container' ] ) ) ? $instance[ 'icon_container' ] : '';

		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$text			 = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : '';

		$icon_url	 = ( isset( $instance[ 'icon_url' ] ) ) ? $instance[ 'icon_url' ] : '';
		$icon		 = ( isset( $instance[ 'icon' ] ) ) ? $instance[ 'icon' ] : '';
		$video		 = ( isset( $instance[ 'video' ] ) ) ? $instance[ 'video' ] : '';
		get_template_part( 'template-parts/icons' );
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
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_2" class="nav-link <?php echo ($template_number == 2) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v2" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 2 <i class="fa fa-eye"></i></a>
				</li>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>
					<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>

					<!--Image -->
					<div class="widget_input col-md-6">
                            <?php $ICG->imageInput( 'image', $image, 'Choose Background Image', 'Select Image', "", $image, $this ); ?>
					</div>
					<!--/.Image -->
                    <?php $ICG->textInput( 'text', $text, 'Content', $this ); ?>
				</div>
				<!--/.Panel 1-->
				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
                        <?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this ); ?>
					</div>
					<!--/.Main description -->


					<br>
					<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>

					<!--My inputs -->
					<?php $ICG->textInput( 'video', $video, 'Video url', $this ); ?>
					<!--/.My inputs -->

				</div>
			</div>
			<?php
			$pages		 = get_pages( array(
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
            <?php
            $ICG->selectInput( 'box_layout', $box_layout, "Box Layout:", array(
                array(
                    "value"  => "container",
                    "text"   => "Boxed",
                ),
                array(
                    "value"  => "container-fluid",
                    "text"   => "Full width",
                ),
            ), $this );
            ?>
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

		$instance[ 'widget_id' ]		 = $this->id;
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";
		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'box_layout' ]		 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
		$instance[ 'image' ]			 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : '';
		$instance[ 'icon_container' ]	 = (!empty( $new_instance[ 'icon_container' ] ) ) ? ( $new_instance[ 'icon_container' ] ) : '';
		$instance[ 'icon_color' ]		 = (!empty( $new_instance[ 'icon_color' ] ) ) ? ( $new_instance[ 'icon_color' ] ) : '';
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]		 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'text' ]				 = (!empty( $new_instance[ 'text' ] ) ) ? ( $new_instance[ 'text' ] ) : '';
		$instance[ 'icon_url' ]			 = (!empty( $new_instance[ 'icon_url' ] ) ) ? ( $new_instance[ 'icon_url' ] ) : '';
		$instance[ 'icon' ]				 = (!empty( $new_instance[ 'icon' ] ) ) ? ( $new_instance[ 'icon' ] ) : '';
		$instance[ 'video' ]			 = (!empty( $new_instance[ 'video' ] ) ) ? ( $new_instance[ 'video' ] ) : '';

		return $instance;
	}

}

// class My_Widget
