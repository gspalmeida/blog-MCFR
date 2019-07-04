<?php
/*
  Plugin Name: Testimonials
  Plugin URI: http://mdowrdpress.com
  Description: Widget presenting certain features (V1)
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdowrdpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Testimonials' );
} );

/**
 * MDW_Testimonials widget.
 */
class MDW_Testimonials extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Testimonials', // Base ID
  __( 'MDW Testimonials', 'mdw' ), // Name
	  array( 'description'	 => __( 'Widget presenting certain features (V1)', 'mdw' ),
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

		wp_register_style( 'tooltip', get_template_directory_uri() . '/widgets/css/admin.css' );
		wp_enqueue_style( 'tooltip' );

		wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
		wp_enqueue_style( 'Font_Awesome' );
		wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
		wp_enqueue_style( 'compiled' );
		wp_register_style( 'Admin_Widget_MDW', get_template_directory_uri() . '/css/admin-widget-mdw.css' );
		wp_enqueue_style( 'Admin_Widget_MDW' );
		wp_register_style( 'v4', get_template_directory_uri() . '/widgets/css/admin.css' );
		wp_enqueue_style( 'v4' );
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

			// j == template count

			for ( $i = 1; $i <= 5; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/testimonials/templates/testimonials-template-' . $i . '.php';
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
		$ICG			 = new WidgetInputsGenerator();
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$fieldCount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : '1';
		$tempSettingsArray	 = array(
			"name_",
			"quote_",
			"image_",
			"bg_image_",
			"color_",
			"job_",
			"rate_",
			"slider_",
			"icon_",
			"icon_container_",
			"icon_color_"
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
		get_template_part( 'template-parts/icons' );
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
					<img src="">
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>

				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_1" class="nav-link <?php echo ($template_number == 1) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v1" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 1 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_2" class="nav-link <?php echo ($template_number == 2) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v2" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 2 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_3" class="nav-link <?php echo ($template_number == 3) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v3" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 3 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_4" class="nav-link <?php echo ($template_number == 4) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v4" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 4 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_5" class="nav-link <?php echo ($template_number == 5) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v5" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 5 <i class="fa fa-eye"></i></a>
				</li>
			</ul>

            <br/>
            <div class="widget_input">
                <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
            </div>


			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>
					<?php $ICG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
					<br/>

					<div class="widget_input col-md-6">
						<span id="add-testimonial <?php echo $this->get_field_id( 'result' ); ?>" data-version="1" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Add testimonial', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete testimonial', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel1">
						<br>

						<?php
						if ( $template_number == 1 ) {
							for ( $j = 1; $j <= $fieldCount; $j++ ) {
								?>
								<br>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Testimonial ', 'mdw' ); ?> <?php echo ($j) ?>
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> 
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $j ) ?>" class="col-md-12" style='display:none;'>

									<?php ?>
									<div class="col-md-4">



										<div class="widget_input">

											<?php $ICG->textareaInput( 'quote_' . $j, ${'quote_' . $j}, 'Quote ', $this ); ?>
											<br/>
										</div>

										<div class="widget_input col-md-12">
											<?php $ICG->insertColorPicker( $this, ${'color_' . $j}, 'color_' . $j ); ?>
										</div>

										<div class='widget_input col-md-12'>
											<?php $ICG->imageInput( "image_" . $j, ${"image_" . $j}, "", 'Select Image', "", ${"image_" . $j}, $this ); ?>
										</div>


									</div>
									<?php ?>
								</div>
							<?php } ?> 
						<?php } ?>
					</div>

				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>

					<?php $ICG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
					<br/>

					<div class="widget_input col-md-6">
						<span id="add-testimonial <?php echo $this->get_field_id( 'result' ); ?>" data-version="2" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Add testimonial', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Delete testimonial', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel2">
						<br>

						<?php
						if ( $template_number == 2 ) {
							for ( $j = 1; $j <= $fieldCount; $j++ ) {
								?>
								<br>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Testimonial ', 'mdw' ); ?> <?php echo ($j) ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $j ) ?>" class="col-md-12" style='display:none;'>


									<div class="col-md-4">
										<!-- Testimonial name -->

										<div class="widget_input">

											<?php $ICG->textInput( 'name_' . $j, ${'name_' . $j}, 'Name ', $this ); ?>
											<br/>
										</div>
										<!-- /.Testimonial name-->

										<!-- Testimonial quote -->

										<div class="widget_input">

											<?php $ICG->textareaInput( 'quote_' . $j, ${'quote_' . $j}, 'Quote ', $this ); ?>
											<br/>
										</div>

                                        <div class="widget_input">
                                            <?php $ICG->textInput( 'job_' . $j, ${'job_' . $j}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>

                                        <div class="widget_input col-md-12">
                                            <p>
                                                <?php _e( 'Star rating: ', 'mdw' ); ?>
                                            </p>
                                            <select style="display:block" id="<?php echo $this->get_field_id( 'rate_' . $j ); ?>" name="<?php echo $this->get_field_name( 'rate_' . $j ); ?>">

                                                <?php for ( $k = 0; $k <= 5; $k++ ) { ?>
                                                    <option <?php echo ( $k == ${'rate_' . $j} ? 'selected' : ''); ?> value="<?php echo $k; ?>"><?php echo ( $k ); ?></option>
                                                    <?php if ( $k != 5 ) { ?><option  <?php echo ( ($k + 0.5) == ${'rate_' . $j} ? 'selected' : ''); ?> value="<?php echo $k + 0.5; ?>"><?php echo $k + 0.5; ?></option><?php } ?>
                                                <?php } ?>

                                            </select>
                                            <br/>
                                        </div>
										<!-- /.Testimonial quote -->

										<!--Image -->
										<div class='widget_input col-md-12'>
											<?php $ICG->imageInput( "image_" . $j, ${"image_" . $j}, "", 'Select Image', "", ${"image_" . $j}, $this ); ?>
										</div>

										<!--/.Image -->
									</div>

								</div>
							<?php } ?>
						<?php } ?>
					</div>

				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<br/>
					<?php $ICG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
					<br/>

					<div class="widget_input col-md-6">
						<span id="add-testimonial <?php echo $this->get_field_id( 'result' ); ?>" data-version="3" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Add testimonial', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Delete testimonial', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel3">
						<br>

						<?php
						if ( $template_number == 3 ) {
							for ( $j = 1; $j <= $fieldCount; $j++ ) {
								?>
								<br>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Testimonial ', 'mdw' ); ?> <?php echo ($j) ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $j ) ?>" class="col-md-12" style='display:none;'>

									<div class="widget_input">

										<?php $ICG->textInput( 'name_' . $j, ${'name_' . $j}, 'Name ', $this ); ?>
										<br/>
									</div>
									<!-- /.Testimonial name-->

									<!-- Testimonial quote -->

									<div class="widget_input">

										<?php $ICG->textareaInput( 'quote_' . $j, ${'quote_' . $j}, 'Quote ', $this ); ?>
										<br/>
									</div>

									<div class="widget_input">
										<?php $ICG->textInput( 'job_' . $j, ${'job_' . $j}, 'Job title ', $this ); ?>
										<br/>
									</div>

                                    <div class="widget_input col-md-12">
                                        <p>
                                            <?php _e( 'Star rating: ', 'mdw' ); ?>
                                        </p>
                                        <select style="display:block" id="<?php echo $this->get_field_id( 'rate_' . $j ); ?>" name="<?php echo $this->get_field_name( 'rate_' . $j ); ?>">

                                            <?php for ( $k = 0; $k <= 5; $k++ ) { ?>
                                                <option <?php echo ( $k == ${'rate_' . $j} ? 'selected' : ''); ?> value="<?php echo $k; ?>"><?php echo ( $k ); ?></option>
                                                <?php if ( $k != 5 ) { ?><option  <?php echo ( ($k + 0.5) == ${'rate_' . $j} ? 'selected' : ''); ?> value="<?php echo $k + 0.5; ?>"><?php echo $k + 0.5; ?></option><?php } ?>
                                            <?php } ?>

                                        </select>
                                        <br/>
                                    </div>
									<!-- /.Testimonial quote -->

									<!--Image -->
									<div class='widget_input col-md-12'>
										<?php $ICG->imageInput( "image_" . $j, ${"image_" . $j}, "", 'Select Image', "", ${"image_" . $j}, $this ); ?>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>

				</div>
				<!--/.Panel 3-->

				<!--Panel 4-->
				<div class="tab-pane fade <?php echo ($template_number == 4) ? 'active in' : '' ?>" id="v4" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-testimonial <?php echo $this->get_field_id( 'result' ); ?>" data-version="4" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Add testimonial', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Delete testimonial', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel4">
						<br>

						<?php
						if ( $template_number == 4 ) {
							for ( $j = 0; $j <= $fieldCount - 1; $j++ ) {
								?>
								<br>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Testimonial ', 'mdw' ); ?> <?php echo ($j + 1) ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $j + 1 ) ?>" class="col-md-12" style='display:none;'>

									<?php for ( $i = $j * 3 + 1; $i <= $j * 3 + 3; $i++ ) { ?>
										<div class="col-md-4">
											<div class="widget_input">

												<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
												<br/>
											</div>
											<!-- /.Testimonial name-->

											<!-- Testimonial quote -->

											<div class="widget_input">

												<?php $ICG->textareaInput( 'quote_' . $i, ${'quote_' . $i}, 'Quote ', $this ); ?>
												<br/>
											</div>

											<div class="widget_input">
												<?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
												<br/>
											</div>

											<div class="widget_input col-md-12">
												<p>
													<?php _e( 'Star rating: ', 'mdw' ); ?>
												</p>
												<select style="display:block" id="<?php echo $this->get_field_id( 'rate_' . $i ); ?>" name="<?php echo $this->get_field_name( 'rate_' . $i ); ?>">

													<?php for ( $k = 0; $k <= 5; $k++ ) { ?>
														<option <?php echo ( $k == ${'rate_' . $i} ? 'selected' : ''); ?> value="<?php echo $k; ?>"><?php echo ( $k ); ?></option>
														<?php if ( $k != 5 ) { ?><option  <?php echo ( ($k + 0.5) == ${'rate_' . $i} ? 'selected' : ''); ?> value="<?php echo $k + 0.5; ?>"><?php echo $k + 0.5; ?></option><?php } ?>
													<?php } ?>

												</select>
												<br/>
											</div>
											<!-- /.Testimonial quote -->

											<!--Image -->
											<div class='widget_input col-md-12'>
												<?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
											</div>

										</div>
									<?php } ?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>

				</div>
				<!--/.Panel 4-->

				<!--Panel 5-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
					<br/>
					<?php $ICG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
					<br/>

					<div class="widget_input col-md-6">
						<span id="add-testimonial <?php echo $this->get_field_id( 'result' ); ?>" data-version="5" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Add testimonial', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Delete testimonial', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel5">
						<br>

						<?php
						if ( $template_number == 5 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Testimonial ', 'mdw' ); ?> <?php echo ($i) ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

									<div class="col-md-12">
										<!-- Testimonial name -->
                                            <div class="widget_input">

                                                <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                                <br/>
                                            </div>
                                            <!-- /.Testimonial name-->

                                            <!-- Testimonial quote -->

                                            <div class="widget_input">

                                                <?php $ICG->textareaInput( 'quote_' . $i, ${'quote_' . $i}, 'Content ', $this ); ?>
                                                <br/>
                                            </div>
										<!-- /.Testimonial quote -->

										<!--Image -->
                                            <div class='widget_input col-md-12'>
                                                <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                            </div>
										<!--/.Image -->

										<!--Background Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "bg_image_" . $i, ${"bg_image_" . $i}, "", 'Select Background Image', "", ${"bg_image_" . $i}, $this ); ?>
                                        </div>
										<!--/.Background Image -->

										<div class="col-md-12 row"> 
											<!--  Icon  -->
											<?php for ( $k = ($i - 1) * 3 + 1; $k <= ($i - 1) * 3 + 3; $k++ ) { ?>
											<div class="cold-md-4">
													
                                                <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $k}, ${'icon_color_' . $k}, "icon_".$k, "icon_color_".$k, "icon_container_".$k   ); ?>
											</div>
												<!--  /.Icon  -->
											<?php } ?>
										</div>     
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>

				</div>
				<!--/.Panel 5-->

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
            <?php $ICG->selectInput( 'box_layout', $box_layout, "", array(
                array(
                    "value" => "container",
                    "text"  => "Boxed",
                ), 
                array(
                  "value" => "container-fluid",
                  "text"  => "Full width",  
                ),
            ), $this ); ?>
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
		$instance[ 'widget_id' ]	 = $this->id;
		$instance[ 'title' ]		 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]	 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';

		$instance[ 'fieldCount' ]	 = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';
		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : 1;

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";

		$amount = $instance[ 'fieldCount' ] * 3 + 3;



		$tempSettingsArray = array(
			"name_",
			"quote_",
			"image_",
			"bg_image_",
			"color_",
			"job_",
			"rate_",
			"slider_",
			"icon_",
			"icon_container_",
			"icon_color_"
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
