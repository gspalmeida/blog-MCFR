<?php
/*
  Plugin Name: MDW Portfolio
  Plugin URI: http://mdwp.io
  Description: Lightbox in portfolio
  Author: MDWP.io
  Version: 1.0
  Author URI: http://mdwp.io
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_Portfolio' );
} );

/**
 * Adds MDW_Portfolio widget
 */
class MDW_Portfolio extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Portfolio', // Base ID
  __( 'MDW Portfolio', 'mdw' ), // Name
	  array( 'description'	 => __( 'Lightbox in portfolio', 'mdw' ),
			'category'		 => __( 'portfolio', 'mdw' )
		) // Args
		);

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}

	function admin_setup() {

		wp_enqueue_media();
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ), NULL, true );
		wp_enqueue_script( 'mdw-all-admin-scripts-js' );
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
			// check for template in active theme
			$template = locate_template( array( 'template-1.php' ) );

			// if none found use the default template
			if ( $template == '' )
				$template = dirname( __DIR__ ) . '/portfolio/templates/portfolio-template-1.php';

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
        $ICG             = new WidgetInputsGenerator();
		$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
		$image1				 = ( isset( $instance[ 'image1' ] ) ) ? $instance[ 'image1' ] : '';
		$image2				 = ( isset( $instance[ 'image2' ] ) ) ? $instance[ 'image2' ] : '';
		$image3				 = ( isset( $instance[ 'image3' ] ) ) ? $instance[ 'image3' ] : '';
		$image4				 = ( isset( $instance[ 'image4' ] ) ) ? $instance[ 'image4' ] : '';
		$image5				 = ( isset( $instance[ 'image5' ] ) ) ? $instance[ 'image5' ] : '';
		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$box_layout			 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
        $animation       = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
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

                <div class="widget_input">

                    <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
                    <br/>
                </div>

                <div class="widget_input">

                    <?php $ICG->textareaInput( 'title_description', $title_description, 'Content ', $this ); ?>
                    <br/>
                </div>
				<!-- /.Main content -->
                <h4>First bigger image: </h4>
				<!--Image -->
                <?php for ( $i = 1; $i<=5; $i++){ ?>
				<div class="widget_input col-md-12">
                    <?php $ICG->imageInput( 'image'.$i, ${'image'.$i}, 'Choose Background Image', 'Select Image', "", ${'image'.$i}, $this ); ?>
					
				</div>
                <?php } ?>
				<!--/.Image -->

				<!--/.Image -->
			</div>
        <div class="widget_input col-md-12">
            <?php
            $ICG->selectInput( 'box_layout', $box_layout, "", array(
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
			<?php
			$pages				 = get_pages( array(
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
									_e( '(empty title)', 'mdw' );
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
		$instance[ 'image1' ]			 = (!empty( $new_instance[ 'image1' ] ) ) ? ( $new_instance[ 'image1' ] ) : '';
		$instance[ 'image2' ]			 = (!empty( $new_instance[ 'image2' ] ) ) ? ( $new_instance[ 'image2' ] ) : '';
		$instance[ 'image3' ]			 = (!empty( $new_instance[ 'image3' ] ) ) ? ( $new_instance[ 'image3' ] ) : '';
		$instance[ 'image4' ]			 = (!empty( $new_instance[ 'image4' ] ) ) ? ( $new_instance[ 'image4' ] ) : '';
		$instance[ 'image5' ]			 = (!empty( $new_instance[ 'image5' ] ) ) ? ( $new_instance[ 'image5' ] ) : '';
		$instance[ 'box_layout' ]		 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : '';
		$instance[ 'title_description' ] = (!empty( $new_instance[ 'title_description' ] ) ) ? $new_instance[ 'title_description' ] : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
        $instance[ 'animation' ]     = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		return $instance;
	}

}

// class My_Widget
