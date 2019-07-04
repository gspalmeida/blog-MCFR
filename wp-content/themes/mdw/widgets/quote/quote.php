<?php
/*
  Plugin Name: MDW Quote
  Plugin URI: http://mdwordpress.com
  Description: Displays text in quotes
  Author: MDWP.io
  Version: 1.0
  Author URI: http://mdwp.io
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_Quote' );
} );

/**
 * Adds MDW_Intro_Signup widget.
 */
class MDW_Quote extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Quote', // Base ID
  __( 'MDW Quote', 'mdw' ), // Name
	  array( 'description'	 => __( 'Displays text in quotes', 'mdw' ),
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
				$template = dirname( __DIR__ ) . '/quote/templates/quote-template-1.php';

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
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$author		 = ( isset( $instance[ 'author' ] ) ) ? $instance[ 'author' ] : '';
		$quote		 = ( isset( $instance[ 'quote' ] ) ) ? $instance[ 'quote' ] : '';
		$big_font	 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';

		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$background_image	 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
		$mask	 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
		$background_color = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '';
		$text_color = ( isset( $instance[ 'text_color' ] ) ) ? $instance[ 'text_color' ] : '';
		$WG					 = new WidgetInputsGenerator();
		?>

		<div class="titlepage_widget">
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
				<!-- Main title -->
				<div class="widget_input">
					<?php $WG->textInput( 'author', ${'author'}, 'Author', $this ) ?>
					<br/>
				</div>
				<!-- /.Main title -->

				<!-- Main content -->
				<div class="widget_input">	
					<?php $WG->textareaInput( 'quote', ${'quote'}, ' Quote ', $this ); ?>
					<br/>
				</div>
				<!-- /.Main content -->
			</div>
			<div class="row">
			<fieldset class="widget_input form-group col-md-4">
				<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font', ${'big_font'} ); ?>
			</fieldset>
			<fieldset class="widget_input form-group col-md-6">
				<?php $WG->insertCheckBox( $this, 'Mask', 'mask', ${'mask'} ); ?>
			</fieldset>
			</div>
			<div class="row col-md-4">
				<h4><?php echo _e('Background color', 'mdw');?></h4>
				<?php $WG->insertColorPicker( $this, ${'background_color'}, 'background_color' ) ;?>
				<br>
				<h4><?php echo _e('Text color', 'mdw');?></h4>
				<?php $WG->insertColorPicker( $this, ${'text_color'}, 'text_color' ) ;?>
				<br>
			</div>
			
			<div class="widget_input">
				
					<?php $WG->imageInput( "background_image", $background_image, $placeholder, 'Select Image', ${'background_image'.'_url'}, $background_image, $this );?>
					<br/>
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
		$instance[ 'author' ]			 = (!empty( $new_instance[ 'author' ] ) ) ? $new_instance[ 'author' ] : '';
		$instance[ 'quote' ]			 = (!empty( $new_instance[ 'quote' ] ) ) ? $new_instance[ 'quote' ] : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'big_font' ]			 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";
		$instance[ 'background_image' ]	 = (!empty( $new_instance[ 'background_image' ] ) ) ? ( $new_instance[ 'background_image' ] ) : "";
		$instance[ 'mask' ]	 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'background_color' ]	 = (!empty( $new_instance[ 'background_color' ] ) ) ? ( $new_instance[ 'background_color' ] ) : "";
		$instance[ 'text_color' ]	 = (!empty( $new_instance[ 'text_color' ] ) ) ? ( $new_instance[ 'text_color' ] ) : "";


		return $instance;
	}

}

// class My_Widget
