<?php
/*
  Plugin Name: MDW Counter
  Plugin URI: http://mdwordpress.com
  Description: MDW Counter kicks off on scrolling to section
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Counter' );
} );

/**
 * Counter widget.
 */
class MDW_Counter extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'mdw_counter', // Base ID
  __( 'MDW Counter', 'mdw' ), // Name
	  array( 'description'	 => __( 'MDW Counter kicks off on scrolling to section', 'mdw' ),
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
        wp_register_script( 'counter', get_template_directory_uri() . '/widgets/counter/js/counter.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'counter' );

		

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
						$template = dirname( __DIR__ ) . '/counter/templates/counter-template-' . $i . '.php';
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
		$widget_id					 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title						 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content				 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$page_id					 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$counter_background_image	 = ( isset( $instance[ 'counter_background_image' ] ) ) ? $instance[ 'counter_background_image' ] : '';
		$animation					 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$title_color				 = ( isset( $instance[ 'title_color' ] ) ) ? $instance[ 'title_color' ] : "#ffffff";
		$content_color				 = ( isset( $instance[ 'content_color' ] ) ) ? $instance[ 'content_color' ] : "";

		$fieldCount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$WG = new WidgetInputsGenerator();


		$tempSettingsArray = array(
			"name_",
			"slider_",
			"number_",
			"size_",
			"color_"
		);
		foreach ( $tempSettingsArray as $setting ) {
			$j = 0;
			for ( $k = 1; $k < count( $instance ); $k++ ) {
				if ( !isset( $instance[ $setting . $k ] ) ) {
					continue;
				} else {
					$j++;
					${"" . $setting . $j} = $instance[ "" . $setting . $k ];
				}
			}
			$fieldcount = $j;
		}
		?>

		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
		<div class="titlepage_widget">
            <div class="inf-alert-to-click-save" style="display: none;">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
              To move your items into this version click save.
            </div>
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
					<!--Title -->
					<div class="widget_input col-md-12">
					<?php $WG->textInput( 'title', ${'title'}, 'title', $this ) ?>
					<br/>
					<?php $WG->insertColorPicker( $this, ${'content_color'}, 'content_color' ) ;?>
						
					</div>
					<!--/.Title -->
					<!--Content-->
					<div class="widget_input col-md-12">
							<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
								<br/>
								<br/>
						<?php $WG->insertColorPicker( $this, ${'title_color'}, 'title_color' ) ;?>
						<br>
					</div>
					<!--/.Content-->
					<!--Background image-->
					<div class='widget_input col-md-12'>
						<?php $WG->imageInput( "counter_background_image", ${"counter_background_image"}, "", 'Select Image', "", $counter_background_image, $this );?>
						<br>
					</div>
					<!--/.Background image-->

					<div class="widget_input col-md-6">
						<span id="add-counter <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1" data-version="1"><?php _e( 'Add counter ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete counter ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel1">
						<br>

						<?php
						if ( $template_number == 1 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Counter ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash red-text delete-the-feature pull-right" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
									<div class='widget_input col-md-12'>
											<?php $WG->insertColorPicker( $this, ${'color_'.$i}, 'color_'.$i ) ;?>
											<br>
										<br>
									</div>
									<div class='widget_input col-md-12'>
										<?php $WG->textInput( 'number_' . $i, ${'number_' . $i}, 'Number '.$i, $this ) ?>
										<br/>
									</div>
									<div class='widget_input col-md-12'>
										<?php $WG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name '.$i, $this ) ?>
										<br/>
									</div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 1-->
				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input col-md-12">
						<?php $WG->textInput( 'title', ${'title'}, 'title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->
					<!--Content-->
					<div class="widget_input col-md-12">
						<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
								<br/>
					</div>
					<!--/.Content-->
					<!--Background image-->
					<div class='widget_input col-md-12'>
						<?php $WG->imageInput( "counter_background_image", ${"counter_background_image"}, "", 'Select Image', ${"counter_background_image"}, ${"counter_background_image"}, $this );?>
						<br>
					</div>
					<!--/.Background image-->

					<div class="widget_input col-md-6">
						<span id="add-counter <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2" data-version="2"><?php _e( 'Add counter ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Delete counter ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel2">
						<br>

						<?php
						if ( $template_number == 2 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Counter ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash red-text delete-the-feature pull-right" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

									<div class='widget_input col-md-12'>
										<?php $WG->numberInput( 'size_' . $i, ${'size_' . $i}, 'Size', $this ) ?>
										<br/>
									</div>
									<div class='widget_input col-md-12'>
										<?php $WG->insertColorPicker( $this, ${'color_' . $i }, 'color_' . $i  ) ;?>
										<br>
									</div>
									<div class='widget_input col-md-12'>
										<?php $WG->numberInput( 'number_' . $i, ${'number_' . $i}, 'Number '. $i, $this ) ?>
										<br/>
									</div>
									<div class='widget_input col-md-12'>
										<?php $WG->textInput( 'name_' . $i . $i, ${'name_' . $i}, 'Name '.$i, $this ) ?>
										<br/>
									</div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 2-->
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
		$instance[ 'widget_id' ]				 = $this->id;
		$instance[ 'title' ]					 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]				 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'counter_background_image' ]	 = (!empty( $new_instance[ 'counter_background_image' ] ) ) ? ( $new_instance[ 'counter_background_image' ] ) : '';

		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";
		$instance[ 'fieldCount' ]	 = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';

		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ]	 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
		$instance[ 'content_color' ] = (!empty( $new_instance[ 'content_color' ] ) ) ? ( $new_instance[ 'content_color' ] ) : "";
		$instance[ 'title_color' ]	 = (!empty( $new_instance[ 'title_color' ] ) ) ? ( $new_instance[ 'title_color' ] ) : "";

		$amount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';


		$tempSettingsArray = array(
			"name_",
			"slider_",
			"number_",
			"size_",
			"color_"
		);

		foreach ( $tempSettingsArray as $setting ) {
			$j = 0;
			for ( $k = 1; $k <= count( $new_instance ); $k++ ) {
				if ( !isset( $new_instance[ $setting . $k ] ) ) {
					continue;
				} else {
					$j++;
					$instance[ "" . $setting . $j ] = (!empty( $new_instance[ "" . $setting . $k ] ) ) ? ( $new_instance[ "" . $setting . $k ] ) : "";
				}
			}
		}
		return $instance;
	}

}

// class My_Widget
