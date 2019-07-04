<?php
/*
  Plugin Name: MDW Countdown
  Plugin URI: http://mdwordpress.com
  Description: Countdowns to selected date
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Countdown' );
} );

/**
 * Countdown widget.
 */
class MDW_Countdown extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'mdw_countdown', // Base ID
  __( 'MDW Countdown', 'mdw' ), // Name
	  array( 'description'	 => __( 'Countdowns to selected date', 'mdw' ),
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
		wp_register_script( 'countdown', get_template_directory_uri() . '/widgets/countdown/js/countdown.js' );
		wp_enqueue_script( 'countdown' );
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

        wp_register_script( 'countdown-js', get_template_directory_uri() . '/widgets/countdown/js/countdown.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'countdown-js' );

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
						$template = dirname( __DIR__ ) . '/countdown/templates/countdown-template-' . $i . '.php';
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
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$background_color	 = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '#ffffff';
		$font_color			 = ( isset( $instance[ 'font_color' ] ) ) ? $instance[ 'font_color' ] : '#000000';
		$day				 = ( isset( $instance[ 'day' ] ) ) ? $instance[ 'day' ] : '';
		$month				 = ( isset( $instance[ 'month' ] ) ) ? $instance[ 'month' ] : '';
		$year				 = ( isset( $instance[ 'year' ] ) ) ? $instance[ 'year' ] : '';
		$hour				 = ( isset( $instance[ 'hour' ] ) ) ? $instance[ 'hour' ] : '';
		$minute				 = ( isset( $instance[ 'minute' ] ) ) ? $instance[ 'minute' ] : '';
		$seconds			 = ( isset( $instance[ 'seconds' ] ) ) ? $instance[ 'seconds' ] : '';
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
				<!--Title -->
				<div class="widget_input col-md-12">
					<?php $ICG->textInput( 'title', $title, 'Title', $this); ?>
					<br/>
				</div>
				<!--/.Title -->
				<?php
				$today				 = getdate();
				?>
				<!--Date-->
				<div class="widget_input col-md-12">
					<div class="datePicker">
						<select class='daySelect' name="<?php echo $this->get_field_name( 'day' ); ?>">
							<?php for ( $i = 1; $i <= 31; $i++ ) { ?>
								<option <?php echo $i == $day ? 'selected' : ''; ?> value="<?php echo $i ?>" data-day="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
						<select class='monthSelect' name="<?php echo $this->get_field_name( 'month' ); ?>">
							<?php
							$months	 = array( __( 'January', 'mdw' ), __( 'February', 'mdw' ), __( 'March', 'mdw' ), __( 'April', 'mdw' ), __( 'May', 'mdw' ), __( 'June', 'mdw' ), __( 'July', 'mdw' ), __( 'August', 'mdw' ), __( 'September', 'mdw' ), __( 'October', 'mdw' ), __( 'November', 'mdw' ), __( 'December', 'mdw' ) );
							$counter = 1;
							foreach ( $months as $m ) {
								?>
								<option <?php echo $counter == $month ? 'selected' : ''; ?> value="<?php echo $counter ?>" data-month="<?php echo $counter ?>"><?php echo $m ?></option>
								<?php $counter++; ?>
							<?php } ?>
						</select>
						<select class='yearSelect' name="<?php echo $this->get_field_name( 'year' ); ?>">

							<option <?php echo $today[ 'year' ] == $year ? 'selected' : ''; ?> data-year="<?php print_r( $today[ 'year' ] ); ?>"><?php print_r( $today[ 'year' ] ); ?></option>
							<option <?php echo ( $today[ 'year' ] + 1 ) == $year ? 'selected' : ''; ?> data-year="<?php print_r( $today[ 'year' ] + 1 ); ?>"><?php print_r( $today[ 'year' ] + 1 ); ?></option>
						</select>
						<select class="hourSelect" name="<?php echo $this->get_field_name( 'hour' ); ?>">
							<?php
							for ( $i = 0; $i <= 23; $i++ ) {
								if ( $i < 10 ) {
									?>
									<option <?php echo $i == $hour ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo "0" . $i; ?></option>
								<?php } else { ?>
									<option <?php echo $i == $hour ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
								}
							}
							?>
						</select>
						<select class="minuteSelect" name="<?php echo $this->get_field_name( 'minute' ); ?>">
							<?php
							for ( $i = 0; $i <= 59; $i++ ) {
								if ( $i < 10 ) {
									?>
									<option <?php echo $i == $minute ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo "0" . $i; ?></option>
								<?php } else { ?>
									<option <?php echo $i == $minute ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
			}
		}
		?>
						</select>
					</div>


				</div>
				<!--/.Date-->

				<!--Background color-->
				<div class='widget_input col-md-12'>
                    <?php $ICG->insertColorPicker( $this, $background_color, 'background_color' ) ;?>
					<br/>
				</div>
				<!--/.Background color-->

				<!--Font color-->
				<div class='widget_input col-md-12'>
                    <?php $ICG->insertColorPicker( $this, $font_color, 'font_color' ) ;?>
					<br/>
				</div>
				<!--/.Font color-->
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
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'background_color' ]	 = (!empty( $new_instance[ 'background_color' ] ) ) ? ( $new_instance[ 'background_color' ] ) : '';
		$instance[ 'font_color' ]		 = (!empty( $new_instance[ 'font_color' ] ) ) ? ( $new_instance[ 'font_color' ] ) : '';
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'day' ]		 = (!empty( $new_instance[ 'day' ] ) ) ? ( $new_instance[ 'day' ] ) : '';
		$instance[ 'month' ]	 = (!empty( $new_instance[ 'month' ] ) ) ? ( $new_instance[ 'month' ] ) : '';
		$instance[ 'year' ]		 = (!empty( $new_instance[ 'year' ] ) ) ? ( $new_instance[ 'year' ] ) : '';
		$instance[ 'hour' ]		 = (!empty( $new_instance[ 'hour' ] ) ) ? ( $new_instance[ 'hour' ] ) : '';
		$instance[ 'minute' ]	 = (!empty( $new_instance[ 'minute' ] ) ) ? ( $new_instance[ 'minute' ] ) : '';
		$instance[ 'seconds' ]	 = (!empty( $new_instance[ 'seconds' ] ) ) ? ( $new_instance[ 'seconds' ] ) : '';


		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";


		return $instance;
	}

}

// class My_Widget
