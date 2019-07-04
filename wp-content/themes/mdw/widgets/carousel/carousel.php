<?php
/*
  Plugin Name: Carousel
  Plugin URI: http://mdwordpress.com
  Description: Team members listing!
  Author: MDWootstrap.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Carousel' );
} );

/**
 * MDW_Carousel widget.
 */
class MDW_Carousel extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Carousel', // Base ID
  __( 'MDW Slider (former MDW Carousel)', 'mdw' ), // Name
	  array( 'description'	 => __( 'Beautiful slider', 'mdw' ),
			'category'		 => __( 'magazine', 'mdw' )
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
						$template = dirname( __DIR__ ) . '/carousel/templates/carousel-template-' . $i . '.php';
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
		$title		 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
        $page_id     = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$half_carousel	 = ( isset( $instance[ 'half_carousel' ] ) ) ? $instance[ 'half_carousel' ] : '';

		$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
		$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

		$what_to_feed	 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'custom';
		$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';

		$posts_amount = ( isset( $instance[ 'posts_amount' ] ) ) ? $instance[ 'posts_amount' ] : '';
		
		$WG = new WidgetInputsGenerator();

		$tempSettingsArray = array(
			"image_",
			"slider_",
			"caption_",
			"caption_heading_"
		);
		foreach ( $tempSettingsArray as $setting ) {
			$j = 0;
			for ( $k = 1; $k <= count( $instance ); $k++ ) {
				if ( !isset( $instance[ $setting . $k ] ) ) {
					continue;
				} else {
					$j++;
					${"" . $setting . $j} = $instance[ "" . $setting . $k ];
				}
			}
			$fieldcount = $j;
		}


		/* Custom feed variables */

		get_template_part( 'template-parts/icons' );
		;
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
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>

					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', $title, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->
					<fieldset class="widget_input form-group col-md-3">
						<?php $WG->insertCheckBox( $this, 'Mask ?', 'mask', ${'mask'}) ;?>
						<!-- <br/> -->
					</fieldset>
                    <fieldset class="widget_input form-group col-md-3">
                        <?php $WG->insertCheckBox( $this, 'Half carousel', 'half_carousel', $half_carousel ); ?>
                    </fieldset>

					<br>
					<br>
					<br>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
						<li class="nav-item">
							<a data-toggle="tooltip" id="custom-btn" class="nav-link <?php echo ($what_to_feed == 'custom' ? "active in" : ''); ?>" data-toggle="tab" href="#custom" role="tab" name="customize"><?php _e( 'Customize', 'mdw' ) ?></a>
						</li>
						<li class="nav-item">
							<a data-toggle="tooltip" id="posts-btn" class="nav-link <?php echo ($what_to_feed == 'posts' ? "active in" : ''); ?>" data-toggle="tab" href="#posts" role="tab" name="feed-posts"><?php _e( 'Feed posts', 'mdw' ) ?></a>
						</li>
					</ul>


					<div class="tab-content">
						<!--Custom Panel-->
						<div class="tab-pane fade <?php echo ($what_to_feed == 'custom' ? "active in" : ''); ?>" id="custom" role="tabpanel">
							<br>
                            

							<div class="widget_input col-md-6">
								<span id="add-image <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result', 'mdw' ); ?>-panel1" data-version="1"><?php _e( 'Add image ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
							</div>

							<div class="widget_input col-md-6">
								<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete image ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
										<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-4">
										
											<?php $WG->imageInput( 'image_'.$i, ${'image_'.$i}, '', 'Select Image', "", ${'image_'.$i}, $this ); ?>

											<!-- ./ Custom fields slider -->

											<!--Caption heading -->
											<div>
												<br>
												<?php $WG->textInput( 'caption_heading_' . $i, ${'caption_heading_' . $i},'Caption heading', $this ) ?>
												<!--/.Caption heading -->
												<!--Caption -->
												<div class="widget_input col-md-12">
												<?php $WG->textInput( 'caption_' . $i, ${'caption_' . $i},'Caption', $this ) ?>
												</div>
											</div>
											<!--/.Caption -->
										</div>
									<?php } ?>
								<?php } ?>

							</div>
						</div>
						<!--Post Panel-->
						<div class="tab-pane fade <?php echo ($what_to_feed == 'posts' ? "active in" : ''); ?>" id="posts" role="tabpanel">
							<!--Posts amount -->
							<div class="widget_input col-md-12">
								<label for="<?php echo $this->get_field_id( 'posts_amount' ); ?>"><?php _e( 'Posts amount:', 'mdw' ); ?></label>
								<input class="title_text" id="<?php echo $this->get_field_id( 'posts_amount' ); ?>"
									   name="<?php echo $this->get_field_name( 'posts_amount' ); ?>"
									   type="number"
									   value="<?php echo $posts_amount ?>"
									   min=1 >
							</div>
							<!--/.Posts amount -->
						</div>
						<!--What to feed-->
						<input hidden
							   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
							   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
							   value="<?php echo $what_to_feed; ?>"
							   type="text">
					</div>
				</div>
				<!--/.Panel 1-->
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

						<option <?php echo ( $page_id == 'All pages' ? 'selected' : ''); ?> value='All pages'><?php _e( 'All pages', 'mdw' ) ?></option>

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
				<label for="<?php echo $this->get_field_name( 'box_layout' ); ?>"><?php _e( 'Box layout', 'mdw' ); ?></label>
				<br>
				<select id="<?php echo $this->get_field_id( 'box_layout' ); ?>" name="<?php echo $this->get_field_name( 'box_layout' ); ?>" value="<?php echo sanitize_text_field( $box_layout ); ?>">
					<option <?php echo ($box_layout == 'container') ? 'selected' : '' ?> value="container"><?php _e( 'Boxed', 'mdw' ); ?></option>
					<option <?php echo ($box_layout == 'container-fluid') ? 'selected' : '' ?> value="container-fluid"><?php _e( 'Full width', 'mdw' ); ?></option>
				</select>
			</div>
			<div class="col-md-12">
				<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
					Your widget ID is:
		<?php echo $widget_id; ?>
			</div>
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

        $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'half_carousel' ] = (!empty( $new_instance[ 'half_carousel' ] ) ) ? ( $new_instance[ 'half_carousel' ] ) : '';

		$instance[ 'animation' ] = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'fieldCount' ] = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';

		$instance[ 'what_to_feed' ] = (!empty( $new_instance[ 'what_to_feed' ] ) ) ? ( $new_instance[ 'what_to_feed' ] ) : '';


		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";

		$amount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

		$instance[ 'mask' ]			 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'posts_amount' ]	 = (!empty( $new_instance[ 'posts_amount' ] ) ) ? ( $new_instance[ 'posts_amount' ] ) : "";

		$tempSettingsArray = array(
			"image_",
			"slider_",
			"caption_",
			"caption_heading_"
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
