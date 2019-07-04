<?php
/*
  Plugin Name: MDW Pricins
  Plugin URI: http://mdwordpress.com
  Description: Display pricing
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Pricings' );
} );

/**
 * MDW_Pricings widget.
 */
class MDW_Pricings extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Pricings', // Base ID
  __( 'MDW Pricings', 'mdw' ), // Name
	  array( 'description'	 => __( 'Display pricing', 'mdw' ),
			'category'		 => __( 'ecommerce', 'mdw' )
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

			// j == template count

			for ( $i = 1; $i <= 7; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template
					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/pricings/templates/pricings-template-' . $i . '.php';
				}
			}
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
		$ICG			 = new WidgetInputsGenerator();
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';

		/* Posts feed variables */
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
        $widget_id   = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";
        $background_image_2    = ( isset( $instance[ 'background_image_2' ] ) ) ? $instance[ 'background_image_2' ] : "";
		$background_color	 = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : "";
		$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

		// v5
		$gradient_2			 = ( isset( $instance[ 'gradient_2' ] ) ) ? $instance[ 'gradient_2' ] : '';
		$tempSettingsArray	 = array(
            "pricing_title_",
			"background_image_",
			"pricing_text_",
			"price_",
			"background_color_",
			"button_text_",
			"button_href_",
			"icon_",
			"icon_color_",
			"icon_container_",
			"feature_",
            "check_",
			"periodic_time_",
		);

		$value = $fieldCount * 6;
		foreach ( $tempSettingsArray as $setting ) {
			$j = 0;
			for ( $k = 1; $k <= $value; $k++ ) {
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
					<img src="">
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>

				<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					?>
					<li class="nav-item">
						<a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php if ( $template_number == $i ) echo "active" ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
					</li>
					<?php
				}
				?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">
                <br>
                <div class="widget_input">

                    <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
                    <br/>
                </div>

                <div class="widget_input">

                    <?php $ICG->textareaInput( "main_content", $main_content, 'Content ', $this ); ?>
                    <br/>
                </div>
				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'in active' : '' ?>" id="v1" role="tabpanel">
					<div class="widget_input col-md-6"> <span id="add-pricing <?php echo $this->get_field_id( 'result' ); ?>" data-version="1" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Add Card', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
					<div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete Card', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden="hidden" type="text" name="post">
					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel1">
						<?php
						if ( $template_number == 1 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Card', 'mdw' ); ?> <?php echo $i; ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
									<div class="widget_input">

										<?php $ICG->textInput( 'pricing_title_' . $i, ${'pricing_title_' . $i}, 'Pricing Title', $this ); ?>
										<br/>
									</div>

                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'price_' . $i, ${'price_' . $i}, 'Price ', $this ); ?>
                                        <br/>
                                    </div>
									<div class="widget_input">

										<?php $ICG->textInput( 'periodic_time_' . $i, ${'periodic_time_' . $i}, 'Peroid ', $this ); ?>
										<br/>
									</div>
									<!--/.Price -->
									<!--Background color-->
									<div class="widget_input col-md-12">
										<?php $ICG->insertColorPicker( $this, ${'background_color_' . $i}, 'background_color_' . $i ); ?>
									</div>
									<!--/.Background color-->

									<span class="col-md-12" style="height: 20px;"></span>

									<?php for ( $j = ($i - 1) * 6 + 1; $j <= ($i - 1) * 6 + 6; $j++ ) { ?>
										<!--Feature <?php echo $j; ?>-->
										<div class="widget_input col-md-12">
											<?php $ICG->insertCheckBox( $this, "feature available", 'check_' . $j, ${'check_' . $j} ); ?>
											<?php $ICG->textInput( 'feature_' . $j, ${'feature_' . $j}, 'Feature ' . $j, $this ); ?>
											<br/>
										</div>
										<!--/.Feature <?php echo $j; ?>-->
									<?php } ?>

									<span class="col-md-12" style="height: 30px;"></span>
									<div class="widget_input col-md-6">

										<?php $ICG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text ', $this ); ?>
										<br/>
									</div>
									<div class="widget_input col-md-6">

										<?php $ICG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ); ?>
										<br/>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'in active' : '' ?>" id="v2" role="tabpanel">
					<div class="widget_input col-md-6"> <span id="add-pricing <?php echo $this->get_field_id( 'result' ); ?>" data-version="2" data-version="2" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Add Card', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
					<div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Delete Card', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden="hidden" type="text" name="post">
					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel2">
						<?php
						if ( $template_number == 2 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Card', 'mdw' ); ?> <?php echo $i; ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
									<div class="widget_input">

										<?php $ICG->textInput( 'pricing_title_' . $i, ${'pricing_title_' . $i}, 'Pricing Title', $this ); ?>
										<br/>
									</div>

									<div class="widget_input">

										<?php $ICG->textInput( 'price_' . $i, ${'price_' . $i}, 'Price ', $this ); ?>
										<br/>
									</div>
									<!--/.Price -->
                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'periodic_time_' . $i, ${'periodic_time_' . $i}, 'Period ', $this ); ?>
                                        <br/>
                                    </div>

									<div class='widget_input col-md-12'>
										<?php $ICG->imageInput( 'background_image_' . $i, ${"background_image_" . $i}, "", 'Select Background Image', ${"background_image_" . $i}, ${"background_image_" . $i}, $this ); ?>
									</div>

									<span class="col-md-12" style="height: 20px;"></span>

									<?php for ( $j = ($i - 1) * 6 + 1; $j <= ($i - 1) * 6 + 6; $j++ ) { ?>
										<!--Feature <?php echo $j; ?>-->
										<div class="widget_input col-md-12">
											<?php $ICG->textInput( 'feature_' . $j, ${'feature_' . $j}, 'Feature ' . $j, $this ); ?>
											<br/>
										</div>
										<!--/.Feature <?php echo $j; ?>-->
									<?php } ?>

									<span class="col-md-12" style="height: 30px;"></span>
									<div class="widget_input col-md-6">

										<?php $ICG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text ', $this ); ?>
										<br/>
									</div>
									<div class="widget_input col-md-6">

										<?php $ICG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ); ?>
										<br/>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'in active' : '' ?>" id="v3" role="tabpanel">
					<div class="widget_input col-md-6"> <span id="add-pricing <?php echo $this->get_field_id( 'result' ); ?>" data-version="3" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Add Card', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
					<div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Delete Card', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden="hidden" type="text" name="post">
					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel3">
						<?php
						if ( $template_number == 3 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Card', 'mdw' ); ?> <?php echo $i; ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'pricing_title_' . $i, ${'pricing_title_' . $i}, 'Pricing Title', $this ); ?>
                                        <br/>
                                    </div>

                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'price_' . $i, ${'price_' . $i}, 'Price ', $this ); ?>
                                        <br/>
                                    </div>
                                    <!--/.Price -->
                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'periodic_time_' . $i, ${'periodic_time_' . $i}, 'Peroid ', $this ); ?>
                                        <br/>
                                    </div>
                                    <?php if($i == 2){ ?>
                                    <div class='widget_input col-md-12'>
                                        <?php $ICG->imageInput( 'background_image', $background_image_2, "", 'Select Background Image', $background_image_2, $background_image_2, $this ); ?>
                                    </div>
                                    <?php } ?>

                                    <span class="col-md-12" style="height: 20px;"></span>

                                    <?php for ( $j = ($i - 1) * 6 + 1; $j <= ($i - 1) * 6 + 6; $j++ ) { ?>
                                        <!--Feature <?php echo $j; ?>-->
                                        <div class="widget_input col-md-12">
                                            <?php $ICG->textInput( 'feature_' . $j, ${'feature_' . $j}, 'Feature ' . $j, $this ); ?>
                                            <br/>
                                        </div>
                                        <!--/.Feature <?php echo $j; ?>-->
                                    <?php } ?>

                                    <span class="col-md-12" style="height: 30px;"></span>
                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text ', $this ); ?>
                                        <br/>
                                    </div>
                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ); ?>
                                        <br/>
                                    </div>
								</div>
								<?php
							}
						}
						?>

					</div>
				</div>
				<!--/.Panel 3-->

				<!--Panel 4-->
				<div class="tab-pane fade <?php echo ($template_number == 4) ? 'in active' : '' ?>" id="v4" role="tabpanel">
					<div class="widget_input col-md-6"> <span id="add-pricing <?php echo $this->get_field_id( 'result' ); ?>" data-version="4" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Add Card', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
					<div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Delete Card', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden="hidden" type="text" name="post">
					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel4">
						<?php
						if ( $template_number == 4 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Card', 'mdw' ); ?> <?php echo $i; ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'pricing_title_' . $i, ${'pricing_title_' . $i}, 'Pricing Title', $this ); ?>
                                        <br/>
                                    </div>

                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'price_' . $i, ${'price_' . $i}, 'Price ', $this ); ?>
                                        <br/>
                                    </div>
									<!--/.Price -->

									<?php if ( $i == 2 ) { ?> <!-- Background color is only for second card -->
										<!--Background color-->
                                    <div class="widget_input col-md-12">
                                        <?php $ICG->insertColorPicker( $this, $background_color, 'background_color'); ?>
                                    </div>
										<!--/.Background color-->
									<?php } ?>

									<!-- Icon -->
                                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i  ); ?>

									<!-- /.Icon -->

                                    <div class="widget_input">

                                        <?php $ICG->textareaInput( 'pricing_text_' . $i, ${'pricing_text_' . $i}, 'Pricing Text', $this ); ?>
                                        <br/>
                                    </div>

									<div style="clear:both"></div>

                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text ', $this ); ?>
                                        <br/>
                                    </div>
                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ); ?>
                                        <br/>
                                    </div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<!--/.Panel 4-->


				<!--Panel 5-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'in active' : '' ?>" id="v5" role="tabpanel">

					<div class="widget_input col-md-6"> <span id="add-pricing <?php echo $this->get_field_id( 'result' ); ?>" data-version="5" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Add Card', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
					<div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Delete Card', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden="hidden" type="text" name="post">
					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel5">
						<?php
						if ( $template_number == 5 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Card', 'mdw' ); ?> <?php echo $i; ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>


									                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'pricing_title_' . $i, ${'pricing_title_' . $i}, 'Pricing Title', $this ); ?>
                                        <br/>
                                    </div>

                                    <div class="widget_input">

                                        <?php $ICG->textInput( 'price_' . $i, ${'price_' . $i}, 'Price ', $this ); ?>
                                        <br/>
                                    </div>
                                    <!--/.Price -->

                                    <!-- Icon -->
                                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i  ); ?>

                                    <!-- /.Icon -->

                                    <div class="widget_input">

                                        <?php $ICG->textareaInput( 'pricing_text_' . $i, ${'pricing_text_' . $i}, 'Pricing Text', $this ); ?>
                                        <br/>
                                    </div>

                                    <div style="clear:both"></div>

                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_text_' . $i, ${'button_text_' . $i}, 'Button text ', $this ); ?>
                                        <br/>
                                    </div>
                                    <div class="widget_input col-md-6">

                                        <?php $ICG->textInput( 'button_href_' . $i, ${'button_href_' . $i}, 'Button href ', $this ); ?>
                                        <br/>
                                    </div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<!--/.Panel 5-->

			</div>
		</div>

		<?php
		$pages = get_pages( array(
			'meta_key' => '_wp_page_template'
		) );

		$how_many_pages = count( $pages );

		if ( $how_many_pages > 1 ) {
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
			$ICG->selectInput( 'box_layout', $box_layout, "", array(
				array(
					"value"	 => "container",
					"text"	 => "Boxed",
				),
				array(
					"value"	 => "container-fluid",
					"text"	 => "Full width",
				),
			), $this );
			?>
		</div>

		<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
			Your widget ID is:
			<?php echo $widget_id; ?>
		</p>


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
		$options_amount				 = 6;

		/* Post feed variables */
		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : 1;
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

        $instance[ 'box_layout' ]    = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
        $instance[ 'background_image_2' ]  = (!empty( $new_instance[ 'background_image_2' ] ) ) ? ( $new_instance[ 'background_image_2' ] ) : "";
		$instance[ 'background_color' ]	 = (!empty( $new_instance[ 'background_color' ] ) ) ? ( $new_instance[ 'background_color' ] ) : "";
		$instance[ 'fieldCount' ]	 = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';

		$instance[ 'gradient_2' ]	 = (!empty( $new_instance[ 'gradient_2' ] ) ) ? ( $new_instance[ 'gradient_2' ] ) : "";
		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";


		$tempSettingsArray = array(
            "pricing_title_",
			"background_image_",
			"pricing_text_",
			"price_",
			"background_color_",
			"button_text_",
			"button_href_",
			"icon_",
			"icon_color_",
			"icon_container_",
			"feature_",
            "check_",
			"periodic_time_",
		);

		foreach ( $tempSettingsArray as $setting ) {
			$j = 1;

			for ( $i = 1; $i <= count( $new_instance ); $i++ ) {

				if ( !isset( $new_instance[ $setting . $i ] ) ) {
					continue;
				}

				$instance[ $setting . $j ] = $new_instance[ $setting . $i ];
				$j++;
			}
		}


		return $instance;
	}

}

// class My_Widget
