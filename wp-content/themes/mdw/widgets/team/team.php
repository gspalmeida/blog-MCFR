<?php
/*
  Plugin Name: Team
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
	register_widget( 'MDW_Team' );
} );

/**
 * MDW_Team widget.
 */
class MDW_Team extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Team', // Base ID
  __( 'MDW Team', 'mdw' ), // Name
	  array( 'description'	 => __( 'Team members listing!', 'mdw' ),
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

			for ( $i = 1; $i <= 9; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/team/templates/team-template-' . $i . '.php';
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

		//v3
		$members_per_row = ( isset( $instance[ 'members_per_row' ] ) ) ? $instance[ 'members_per_row' ] : '1';

		$fieldCount	 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
		$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';


		/* Custom feed variables */
		$amount				 = $fieldCount; // default for that project layout
        for ( $i = 1; $i <= $amount * 4; $i++  ) {

            ${"icon_" . $i}              = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
            ${"icon_container_" . $i}    = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
            ${"icon_color_" . $i}        = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '#607d8b';
        }
		// Controls amount of icons in widget version
		$loopMultiplier		 = ($template_number == '4') ? '4' : '3';
		$tempSettingsArray	 = array(
			"name_",
			"content_",
			"image_",
			"job_",
			"avatar_",
			"icon_url_"
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
                <?php for($i=1; $i<=9; $i++){ ?>
                <li class="nav-item">
                    <a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
                </li>
                <?php } ?>
			</ul>
            <div class="widget_input">
                <?php $ICG->textInput("title", $title, "Title ", $this); ?>
            </div>
            <!--/.Title -->
            <div class="widget_input">
                <?php $ICG->textareaInput("main_content", $main_content, "Content", $this); ?>
            </div>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result', 'mdw' ); ?>-panel1" data-version="1"><?php _e( 'Add member ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
										
											
										
										
                                            <!--  /.Icon  -->
                                        <?php } ?>
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

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2" data-version="2"><?php _e( 'Add member', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>    
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<br>
					<div class="widget_input">
                        <?php $ICG->numberInput( 'members_per_row', $members_per_row, 'Members per row', $this ); ?>
					</div>


					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3" data-version="3"><?php _e( 'Add member ', 'mdw' ); ?><i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Delete member ', 'mdw' ); ?><i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel3">
						<br>

						<?php
						if ( $template_number == 3 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>


                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
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
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4" data-version="4"><?php _e( 'Add member ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel4">
						<br>

						<?php
						if ( $template_number == 4 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i><i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

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

									    <div class="widget_input col-md-12">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input col-md-12">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input col-md-12">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-3">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 4-->

				<!--Panel 5-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result', 'mdw' ); ?>-panel5" data-version="5"><?php _e( 'Add member ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 5-->

				<!--Panel 6-->
				<div class="tab-pane fade <?php echo ($template_number == 6) ? 'active in' : '' ?>" id="v6" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result', 'mdw' ); ?>-panel6" data-version="6"><?php _e( 'Add member ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel6"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel6">
						<br>

						<?php
						if ( $template_number == 6 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 6-->

				<!--Panel 7-->
				<div class="tab-pane fade <?php echo ($template_number == 7) ? 'active in' : '' ?>" id="v7" role="tabpanel">
					<br>
					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel7" data-version="7"><?php _e( 'Add member', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel7"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel7">
						<br>

						<?php
						if ( $template_number == 7 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i><i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'content_' . $i, ${'content_' . $i}, 'Description ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 7-->

				<!--Panel 8-->
				<div class="tab-pane fade <?php echo ($template_number == 8) ? 'active in' : '' ?>" id="v8" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel8" data-version="8"><?php _e( 'Add member', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel8"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel8">
						<br>

						<?php
						if ( $template_number == 8 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
											<?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 8-->

				<!--Panel 9-->
				<div class="tab-pane fade <?php echo ($template_number == 9) ? 'active in' : '' ?>" id="v9" role="tabpanel">
					<br>

					<div class="widget_input col-md-6">
						<span id="add-member <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result', 'mdw' ); ?>-panel9" data-version="9"><?php _e( 'Add member ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel9"><?php _e( 'Delete member ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
					</div>

					<input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
					<input hidden type="text" name="post">

					<div id="<?php echo $this->get_field_name( 'result' ); ?>-panel9">
						<br>

						<?php
						if ( $template_number == 9 ) {
							for ( $i = 1; $i <= $fieldCount; $i++ ) {
								?>
								<br>
								<!-- Custom fields slider -->
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Member ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i><i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Name ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textInput( 'job_' . $i, ${'job_' . $i}, 'Job title ', $this ); ?>
                                            <br/>
                                        </div>
                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Content ', $this ); ?>
                                            <br/>
                                        </div>
                                    <!--Image -->
                                        <div class='widget_input col-md-12'>
                                            <?php $ICG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_" . $i}, $this ); ?>
                                        </div>
                                    <!--/.Image -->
                                    <div class="col-md-12"> 
                                        <!--  Icon  -->
                                        <?php for ( $j = ($i - 1) * $loopMultiplier + 1; $j <= ($i - 1) * $loopMultiplier + $loopMultiplier; $j++ ) { ?>
                                            <div class="col-md-4">
                                            <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $j}, ${'icon_color_' . $j}, "icon_".$j, "icon_color_".$j, "icon_container_".$j   ); ?>
                                            <?php $ICG->textInput( 'icon_url_' . $j, ${'icon_url_' . $j}, 'Icon url ', $this ); ?>
                                            <br/>
											</div>
                                            <!--  /.Icon  -->
                                        <?php } ?>
                                    </div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 9-->
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
		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'fieldCount' ] = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';

		$instance[ 'members_per_row' ] = (!empty( $new_instance[ 'members_per_row' ] ) ) ? ( $new_instance[ 'members_per_row' ] ) : '';

		$instance[ 'template_number' ] = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";

		$amount			 = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';
		$loopMultiplier	 = ($instance[ 'template_number' ] == '4') ? '4' : '3'; // Controls amount of icons in widget version

        for ( $i = 1; $i <= $amount * 4; $i++   ) {

            $instance[ 'icon_' . $i ]            = (!empty( $new_instance[ 'icon_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_' . $i ] ) : '';
            $instance[ 'icon_container_' . $i ]  = (!empty( $new_instance[ 'icon_container_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_container_' . $i ] ) : '';
            $instance[ 'icon_color_' . $i ]      = (!empty( $new_instance[ 'icon_color_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_color_' . $i ] ) : '#607d8b';
        }

		$tempSettingsArray = array(
			"name_",
			"content_",
			"image_",
			"job_",
			"avatar_",
			"icon_",
			"icon_url_",
			
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
