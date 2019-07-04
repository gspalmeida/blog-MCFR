<?php
/*
  Plugin Name: Team
  Plugin URI: http://mdwordpress.com
  Description: Display your best projects
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Project' );
} );

/**
 * MDW_Project widget.
 */
class MDW_Project extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Project', // Base ID
  __( 'MDW Project', 'mdw' ), // Name
	  array( 'description'	 => __( 'Display your best projects', 'mdw' ),
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
		wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
		wp_enqueue_style( 'Font_Awesome' );
		wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
		wp_enqueue_style( 'compiled' );
		wp_register_style( 'Admin_Widget_MDW', get_template_directory_uri() . '/css/admin-widget-mdw.css' );
		wp_enqueue_style( 'Admin_Widget_MDW' );
	}

	/**
	 * Front-end display of widget.

	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $w_args, $instance ) {

        wp_register_style( 'mdw-projectv5', get_template_directory_uri() . '/widgets/projects/css/style.css' );
        wp_enqueue_style( 'mdw-projectv5' );

		

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
						$template = dirname( __DIR__ ) . '/projects/templates/projects-template-' . $i . '.php';
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

		// for v1, v2, v3
		$what_to_feed	 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'custom';
		$category		 = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

		// for v4
		$left_or_right	 = ( isset( $instance[ 'left_or_right' ] ) ) ? $instance[ 'left_or_right' ] : 'left';
		$image			 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$no_image		 = get_template_directory_uri() . "/img/no_image.jpg";
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';

		$amount						 = 4; // highest
		//v5
		//v1
		for($i = 1; $i <= 3; $i++) {
			
			${'custom_button_icon_container_' . $i} = ( isset( $instance[ "custom_button_icon_container_" . $i ] ) ) ? $instance[ "custom_button_icon_container_" . $i ] : "";
			${'custom_button_icon_' . $i} = ( isset( $instance[ "custom_button_icon_" . $i ] ) ) ? $instance[ "custom_button_icon_" . $i ] : "";
			${'custom_button_collor_' . $i} = ( isset( $instance[ "custom_button_collor_" . $i ] ) ) ? $instance[ "custom_button_collor_" . $i ] : "";
		}

		for ( $i = 1; $i <= $amount; $i++ ) {

			${'category_' . $i}				 = ( isset( $instance[ 'category_' . $i ] ) ) ? $instance[ 'category_' . $i ] : 'No categories';
			${'url_' . $i}					 = ( isset( $instance[ 'url_' . $i ] ) ) ? $instance[ 'url_' . $i ] : '';
			${'image_description_' . $i}		 = ( isset( $instance[ 'image_description_' . $i ] ) ) ? $instance[ 'image_description_' . $i ] : '';
			${"title_" . $i}				 = ( isset( $instance[ "title_" . $i ] ) ) ? $instance[ "title_" . $i ] : "";
			${"content_" . $i}				 = ( isset( $instance[ "content_" . $i ] ) ) ? $instance[ "content_" . $i ] : "";
			${"icon_text_" . $i}			 = ( isset( $instance[ "icon_text_" . $i ] ) ) ? $instance[ "icon_text_" . $i ] : "";
			${"icon_" . $i}					 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
			${"icon_container_" . $i}		 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
			${"icon_color_" . $i}			 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '#607d8b';
			${"image_" . $i}				 = ( isset( $instance[ "image_" . $i ] ) ) ? $instance[ "image_" . $i ] : "";
			${"button_text_" . $i}			 = ( isset( $instance[ "button_text_" . $i ] ) ) ? $instance[ "button_text_" . $i ] : "";
			${"button_url_" . $i}			 = ( isset( $instance[ "button_url_" . $i ] ) ) ? $instance[ "button_url_" . $i ] : "";
			${"button_icon_" . $i}			 = ( isset( $instance[ "button_icon_" . $i ] ) ) ? $instance[ "button_icon_" . $i ] : "";
			${"icon_button_" . $i}			 = ( isset( $instance[ "icon_button_" . $i ] ) ) ? $instance[ "icon_button_" . $i ] : "";
			${"icon_container_button_" . $i} = ( isset( $instance[ "icon_container_button_" . $i ] ) ) ? $instance[ "icon_container_button_" . $i ] : "";
		}

		get_template_part( 'template-parts/icons' );
		?>
		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
		<div class="titlepage_widget">

			<!-- Remember version of widget -->
			<input hidden
				   id="<?php echo $this->get_field_id( 'template_number' ); ?>"
				   name="<?php echo $this->get_field_name( 'template_number' ); ?>"
				   value="<?php echo sanitize_text_field( $template_number ); ?>"
				   type="text">
			<!-- ./Remember version of widget -->


			<!-- Nav tabs -->
			<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
				<!-- Version preview -->
				<div id="<?php echo $this->get_field_id( 'tooltip' ); ?>">
					<img src="">
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>

                <?php for($i=1; $i<=5; $i++){ ?>
                <li class="nav-item">
                    <a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
                </li>
                <?php } ?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--MDW Project V1 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<!--Title -->
					<div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
                            <?php $ICG->textInput( 'main_content', $main_content, 'Content', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->


					<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
						<!-- Project icon -->
						<div class="widget_input col-md-4">
                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>


							<?php $ICG->textInput( "icon_text_".$i , ${'icon_text_' . $i}, 'Icon Text', $this ); ?>
							<br/>

						</div>
						<!-- Project icon -->
					<?php } ?>


					<!-- 2 Nav tabs -->
					<ul class="nav nav-tabs md-pills pills-ins" role="tablist" style="float: left;">
						<li class="nav-item" id="posts-btn">
							<a class="nav-link <?php echo ($what_to_feed == 'posts' ? "active" : ''); ?>" data-toggle="tab" href="#posts" role="tab"><?php _e( 'Feed posts', 'mdw' ); ?></a>
						</li>
						<li class="nav-item" id="custom-btn">
							<a class="nav-link <?php echo ($what_to_feed == 'custom' ? "active" : ''); ?>" data-toggle="tab" href="#custom" role="tab"><?php _e( 'Customize', 'mdw' ); ?></a>
						</li>
					</ul>
					<!-- /.2 Nav tabs -->

					<!-- Tab panels -->
					<div>
						<!--Custom panel -->
						<div id="custom-panel" <?php echo ($what_to_feed == 'posts' ? "style='display:none'" : ''); ?> >
							<br>
							<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
								<div class="<?php echo $i == 1 ? 'col-md-12' : 'col-md-6'; ?>" >
									<!-- Project title -->
									<div class="widget_input " >
										<?php $ICG->textInput( "title_".$i , ${'title_' . $i}, 'Title', $this ); ?>
										<br/>
									</div>
									<!-- Project title -->

									<!-- Project content -->
									<div class="widget_input">
										<?php $ICG->textareaInput( "content_".$i , ${'content_' . $i}, 'Content', $this ); ?>
										<br/>
									</div>
									<!-- Project content -->

									<!-- Project button text -->
									<div class="widget_input " >
										<?php $ICG->textInput( "button_text_".$i , ${'button_text_' . $i}, 'Button Text', $this ); ?>
										<br/>
									</div>
									<!-- Project button text -->

									<!-- Project button url -->
									<div class="widget_input " >
										<?php $ICG->textInput( "button_url_".$i , ${'button_url_' . $i}, 'Button url', $this  ); ?>
										<br/>
									</div>
									<!-- Project button url -->

									<!-- Project button icon -->
									<?php $ICG->insertIconContainers( $this, ${'custom_button_icon_container_' . $i}, ${'custom_button_collor_' . $i}, "custom_button_icon_".$i, "custom_button_collor_".$i, "custom_button_icon_container_".$i  ); ?>

									<!-- Project button icon -->

									<!--Image -->
									<div class="widget_input">
                                        <?php $ICG->imageInput( 'image_' . $i, ${'image_' . $i}, 'Choose Background Image', 'Select Image', "", ${'image_' . $i}, $this ); ?>
									</div>
									<!--/.Image -->



								</div>
							<?php } ?>

						</div>
						<!--/.Custom panel-->

						<!--Posts panel-->
						<div id="post-panel" <?php echo (esc_attr( $what_to_feed ) == 'custom' ? "style='display:none'" : ''); ?>>
							<br>

							<!--Post category dropdown select-->
							<div class="widget_input col-md-12">


								<label><?php _e( 'Categories:', 'mdw' ); ?></label>
								<select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">

									<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>

										<option <?php echo ($term->term_id == esc_attr( $category ) ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
											<?php
											echo $term->name;
											?>
										</option>
									<?php } ?>

								</select>
							</div>
							<!--/.Post category dropdown select-->
						</div>
						<!--/.Posts panel-->

					</div>



					<input style="visibility:hidden"
						   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
						   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
						   value="<?php echo esc_attr( $what_to_feed ); ?>"
						   type="text">
				</div>
				<!--/.MDW Project V1 Panel-->

				<!--MDW Project V2 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<!--Title -->
                    <div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Title -->

                    <!--Main description -->
                    <div class="widget_input">
                            <?php $ICG->textInput( 'main_content', $main_content, 'Content', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Main description -->
					<div class='row'>
						<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
							<!-- Project icon-->
							<div class="widget_input col-md-4">
						<?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>


                            <?php $ICG->textInput( "icon_text_".$i , ${'icon_text_' . $i}, 'Icon Text', $this ); ?>
                            <br/>

                        </div>
							<!-- ./Project icon-->
						<?php } ?>

					</div>
				
				<!-- 2 Nav tabs -->
                        <ul class="nav nav-tabs md-pills pills-ins" role="tablist" style="float: left;">
                            <li class="nav-item" id="posts-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'posts' ? "active" : ''); ?>" data-toggle="tab" href="#posts" role="tab"><?php _e( 'Feed posts', 'mdw' ); ?></a>
                            </li>
                            <li class="nav-item" id="custom-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'custom' ? "active" : ''); ?>" data-toggle="tab" href="#custom" role="tab"><?php _e( 'Customize', 'mdw' ); ?></a>
                            </li>
                        </ul>
                        <!-- /.2 Nav tabs -->

                        <!-- Tab panels -->
                        <div>
                            <!--Custom panel -->
                            <div id="custom-panel" <?php echo ($what_to_feed == 'posts' ? "style='display:none'" : ''); ?> >
						<br>
						<br>
						<br>
						<br>
						<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
							<div class="col-md-4" >
								<!-- Project title -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "title_".$i , ${'title_' . $i}, 'Title', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project title -->

                                    <!-- Project content -->
                                    <div class="widget_input">
                                        <?php $ICG->textareaInput( "content_".$i , ${'content_' . $i}, 'Content', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project content -->

                                    <!-- Project button text -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "button_text_".$i , ${'button_text_' . $i}, 'Button Text', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project button text -->

                                    <!-- Project button url -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "button_url_".$i , ${'button_url_' . $i}, 'Button url', $this  ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project button url -->

                                    <!-- Project button icon -->
									<?php $ICG->insertIconContainers( $this, ${'icon_container_button_' . $i}, '', 'icon_button_' . $i,'', 'icon_container_button_' . $i ); ?>

                                    <!-- Project button icon -->

                                    <!--Image -->
                                    <div class="widget_input">
                                        <?php $ICG->imageInput( 'image_' . $i, ${'image_' . $i}, 'Choose Background Image', 'Select Image', "", ${'image_' . $i}, $this ); ?>
                                    </div>
                                    <!--/.Image -->
							</div>
						<?php } ?>
                        </div>


						<!--/.Custom panel-->

						<div id="post-panel" <?php echo (esc_attr( $what_to_feed ) == 'custom' ? "style='display:none'" : ''); ?>>
                            <br>

                            <!--Post category dropdown select-->
                            <div class="widget_input col-md-12">


                                <label><?php _e( 'Categories:', 'mdw' ); ?></label>
                                <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">

                                    <?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>

                                        <option <?php echo ($term->term_id == esc_attr( $category ) ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                            <?php
                                            echo $term->name;
                                            ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                            <!--/.Post category dropdown select-->
						</div>
						<!--/.Posts panel-->

					

					<input style="visibility:hidden"
						   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
						   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
						   value="<?php echo esc_attr( $what_to_feed ); ?>"
						   type="text">
				</div>
                </div>
				<!--/.MDW Project V2 Panel-->

				<!--MDW Project V3 Panel -->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<!--Title -->
                    <div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Title -->

                    <!--Main description -->
                    <div class="widget_input">
                            <?php $ICG->textInput( 'main_content', $main_content, 'Content', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Main description -->

					<?php for ( $i = 1; $i <= 4; $i++ ) { ?>
						<?php if ( $i % 2 != 0 ) echo "<div class='row'>"; ?>
						<div class='col-md-6'>
							<!-- Project icon text -->
							<div class="widget_input col-md-4">
                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>


                            <?php $ICG->textInput( "icon_text_".$i , ${'icon_text_' . $i}, 'Icon Text', $this ); ?>
                            <br/>

                        </div>
							<!-- Project icon text -->
						</div>
						<?php if ( $i % 2 == 0 ) echo "</div>"; ?>
					<?php } ?>


					<!-- 2 Nav tabs -->
					<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
						<li class="nav-item" id="posts-btn">
							<a class="nav-link <?php echo (esc_attr( $what_to_feed ) == 'posts' ? "active" : ''); ?>" data-toggle="tab" href="#posts" role="tab"><?php _e( 'Feed posts', 'mdw' ); ?></a>
						</li>
						<li class="nav-item" id="custom-btn">
							<a class="nav-link <?php echo (esc_attr( $what_to_feed ) == 'custom' ? "active" : ''); ?>" data-toggle="tab" href="#custom" role="tab"><?php _e( 'Customize', 'mdw' ); ?></a>
						</li>
					</ul>
					<!-- /.2 Nav tabs -->

					<!-- Tab panels -->
					<div>
						<!--Custom panel -->
						<div id="custom-panel" <?php echo (esc_attr( $what_to_feed ) == 'posts' ? "style='display:none'" : ''); ?> >
							<br>
							<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
								<?php if ( $i % 2 != 0 ) echo "<div class='row'>"; ?>
								<div class='col-md-6'>
									<!-- Project title -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "title_".$i , ${'title_' . $i}, 'Title', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project title -->

                                    <!-- Project content -->
                                    <div class="widget_input">
                                        <?php $ICG->textareaInput( "content_".$i , ${'content_' . $i}, 'Content', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project content -->

                                    <!-- Project button text -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "button_text_".$i , ${'button_text_' . $i}, 'Button Text', $this ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project button text -->

                                    <!-- Project button url -->
                                    <div class="widget_input " >
                                        <?php $ICG->textInput( "button_url_".$i , ${'button_url_' . $i}, 'Button url', $this  ); ?>
                                        <br/>
                                    </div>
                                    <!-- Project button url -->

                                    <!-- Project button icon -->
									<?php $ICG->insertIconContainers( $this, ${'icon_container_button_' . $i}, '', 'icon_button_' . $i,'', 'icon_container_button_' . $i ); ?>

                                    <!-- Project button icon -->

                                    <!--Image -->
                                    <div class="widget_input">
                                        <?php $ICG->imageInput( 'image_' . $i, ${'image_' . $i}, 'Choose Background Image', 'Select Image', "", ${'image_' . $i}, $this ); ?>
                                    </div>
                                    <!--/.Image -->
								</div>
								<?php if ( $i % 2 == 0 ) echo "</div>"; ?>
							<?php } ?>

						</div>
						<!--/.Custom panel-->

						<!--Posts panel-->
						<div id="post-panel" <?php echo (esc_attr( $what_to_feed ) == 'custom' ? "style='display:none'" : ''); ?>>
							<br>

							<!--Excerpt or content-->
							<div class='widget_input'>

							</div>
							<!--/.Excerpt or content-->

							<!--Post category dropdown select-->
							<div class="widget_input">


								<label><?php _e( 'Categories:', 'mdw' ); ?></label>
								<select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">

									<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>

										<option <?php echo ($term->term_id == esc_attr( $category ) ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
											<?php
											echo $term->name;
											?>
										</option>
									<?php } ?>

								</select>
							</div>
							<!--/.Post category dropdown select-->
						</div>
						<!--/.Posts panel-->

					</div>

					<input style="visibility:hidden"
						   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
						   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
						   value="<?php esc_attr( $what_to_feed ); ?>"
						   type="text">
				</div>
				<!--/.MDW Project V3 Panel -->

				<!--MDW Project V4 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 4) ? 'active in' : '' ?>" id="v4" role="tabpanel">
					<!--Title -->
                    <div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Title -->

                    <!--Main description -->
                    <div class="widget_input">
                            <?php $ICG->textInput( 'main_content', $main_content, 'Content', $this ); ?>
                        <br/>
                    </div>
                    <!--/.Main description -->

					<!-- Left or right -->
					<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
						<li class="nav-item" id="image-to-the-left">
							<a class="nav-link <?php echo ($left_or_right == 'left') ? 'active' : '' ?>" data-toggle="tab"  role="tab">
								<?php _e( 'Image on the left', 'mdw' ); ?>
							</a>
						</li>
						<li class="nav-item" id="image-to-the-right">
							<a class="nav-link <?php echo ($left_or_right == 'right') ? 'active' : '' ?>" data-toggle="tab"  role="tab">
								<?php _e( 'Image on the right', 'mdw' ); ?>
							</a>
						</li>
					</ul>
					<!-- /.Left or right -->
					<br>

					<div class='row'>
						<!--Image -->
						<div class="widget_input col-md-6 " style="<?php echo ($left_or_right == 'left') ? 'float:left;' : 'float:right;'; ?>">
                             <?php $ICG->imageInput( 'image', $image, 'Choose Background Image', 'Select Image', "", $image, $this ); ?>
						</div>
						<!--/.Image -->

						<div class="widget_input col-md-6 " style="<?php echo ($left_or_right == 'right') ? 'float:left;' : 'float:right;'; ?>">
							<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
								<!-- Project icon-->
                            <div class="widget_input">
                                <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>


                            <?php $ICG->textInput( "icon_text_".$i , ${'icon_text_' . $i}, 'Icon Text', $this ); ?>
                            <br/>

                        </div>
                            <!-- ./Project icon-->

								<!-- Project content -->
								<div class="widget_input">
									<?php $ICG->textareaInput( "content_".$i , ${'content_' . $i}, 'Content', $this ); ?>
									<br/>
								</div>
								<!-- Project content -->

							<?php } ?>
						</div>
					</div>
					<input style="visibility:hidden"
						   id="<?php echo $this->get_field_id( 'left_or_right' ); ?>"
						   name="<?php echo $this->get_field_name( 'left_or_right' ); ?>"
						   value="<?php echo esc_attr( $left_or_right ); ?>"
						   type="text">
				</div>
				<!--/.MDW Project V4 Panel-->

				<!--MDW Project V5 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
					<br>
					<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>

					<ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
						<li class="nav-item" id="posts-btn">
							<a class="nav-link <?php echo ($what_to_feed == 'posts' ? "active" : ''); ?>" data-toggle="tab" href="#" data-href="#posts" role="tab"><?php _e( 'Feed posts', 'mdw' ); ?></a>
						</li>
						<li class="nav-item" id="custom-btn">
							<a class="nav-link <?php echo ($what_to_feed == 'custom' ? "active" : ''); ?>" data-toggle="tab" href="#" data-href="#custom" role="tab"><?php _e( 'Customize', 'mdw' ); ?></a>
						</li>
					</ul>

					<div class="tab-content col-md-12">
						<!--Custom panel -->
						<div id="custom-panel" <?php echo ($what_to_feed == 'posts' ? " style='display:none'" : ''); ?>>

							<div class='row'>
                                
								<!--Image 1-->
                                <?php for($i=1; $i<=4; $i++){ ?>
								<div class="widget_input col-md-3 " style="<?php echo ($left_or_right == 'left') ? 'float:left;' : 'float:right;'; ?>">

										<?php $ICG->imageInput( 'image_'.$i, ${'image_'.$i}, '', 'Select Image', "", ${'image_'.$i}, $this ); ?>

									<!-- Image 1 description-->
									<div class="widget_input">
                                        <?php $ICG->textInput( 'image_description_'.$i, ${'image_description_'.$i}, 'Image description', $this ); ?>
										<br/>
									</div>

									<!--/.Image 1 description-->
									<!-- Image 1 url-->
									<div class="widget_input">
                                        <?php $ICG->textInput( 'url_'.$i, ${'url_'.$i}, 'Image url', $this ); ?>
										<br/>
									</div>

									<!--/.Image 1 url-->
									<!-- Image 1 icon-->
									<div class="widget_input">
										<?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>

									</div>
									<!--/.Image 1 icon-->
								</div>
								<!--/.Image 1-->
                                <?php } ?>


							</div>
							<input style="visibility:hidden"
								   id="<?php echo $this->get_field_id( 'left_or_right' ); ?>"
								   name="<?php echo $this->get_field_name( 'left_or_right' ); ?>"
								   value="<?php echo esc_attr( $left_or_right ); ?>"
								   type="text">
						</div>
						<div id="post-panel" <?php echo ($what_to_feed == 'custom' ? " style='display:none'" : ''); ?>>
							<!--Post category dropdown select-->
							<div class="widget_input">

                                <?php for($i=1; $i<=4; $i++){ ?>
								<label><?php _e( 'Category:', 'mdw' ); ?></label>
								<select style="display:block" id="<?php echo $this->get_field_id( 'category_'.$i ); ?>" name="<?php echo $this->get_field_name( 'category_'.$i ); ?>">

									<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>

										<option <?php echo ($term->term_id == esc_attr( ${'category_'.$i} ) ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
											<?php
											echo $term->name;
											?>
										</option>
									<?php } ?>

								</select>
                                <?php } ?>
							</div>
						</div>

						<!--/.MDW Project V5 Panel-->
					</div>
				</div>
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
		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
			<div class="widget_input col-md-12">
				<label for="<?php echo $this->get_field_name( 'box_layout' ); ?>"><?php _e( 'Box layout', 'mdw' ); ?> </label>
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

		$instance[ 'site_title' ]		 = (!empty( $new_instance[ 'site_title' ] ) ) ? ( $new_instance[ 'site_title' ] ) : '';
		$instance[ 'widget_id' ]		 = $this->id;
		$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'main_content' ]		 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : 1;
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'box_layout' ]		 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		// v1, v2, v3
		$instance[ 'what_to_feed' ]	 = (!empty( $new_instance[ 'what_to_feed' ] ) ) ? ( $new_instance[ 'what_to_feed' ] ) : 'custom';
		$instance[ 'category' ]		 = (!empty( $new_instance[ 'category' ] ) ) ? ( $new_instance[ 'category' ] ) : 1;

		// v4
		$instance[ 'image' ]		 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : "";
		$instance[ 'left_or_right' ] = (!empty( $new_instance[ 'left_or_right' ] ) ) ? ( $new_instance[ 'left_or_right' ] ) : 'left';

		// v5

		// default for v3: 4, default for others: 3;
		$amount = ( $instance[ 'template_number' ] == 3 ? 4 : 3 );
		for ( $i = 1; $i <= 4; $i++ ) {

			$instance[ 'title_' . $i ]					 = (!empty( $new_instance[ 'title_' . $i ] ) ) ? ( $new_instance[ 'title_' . $i ] ) : '';
			$instance[ 'url_' . $i ]					 = (!empty( $new_instance[ 'url_' . $i ] ) ) ? ( $new_instance[ 'url_' . $i ] ) : '';
			$instance[ 'image_description_' . $i ]		 = (!empty( $new_instance[ 'image_description_' . $i ] ) ) ? ( $new_instance[ 'image_description_' . $i ] ) : '';
			$instance[ 'category_' . $i ]				 = (!empty( $new_instance[ 'category_' . $i ] ) ) ? ( $new_instance[ 'category_' . $i ] ) : '';
			$instance[ 'content_' . $i ]				 = (!empty( $new_instance[ 'content_' . $i ] ) ) ? ( $new_instance[ 'content_' . $i ] ) : '';
			$instance[ 'icon_text_' . $i ]				 = (!empty( $new_instance[ 'icon_text_' . $i ] ) ) ? ( $new_instance[ 'icon_text_' . $i ] ) : '';
			$instance[ 'icon_' . $i ]					 = (!empty( $new_instance[ 'icon_' . $i ] ) ) ? ( $new_instance[ 'icon_' . $i ] ) : '';
			$instance[ 'icon_container_' . $i ]			 = (!empty( $new_instance[ 'icon_container_' . $i ] ) ) ? ( $new_instance[ 'icon_container_' . $i ] ) : '';
			$instance[ 'icon_color_' . $i ]				 = (!empty( $new_instance[ 'icon_color_' . $i ] ) ) ? ( $new_instance[ 'icon_color_' . $i ] ) : '#607d8b';
			$instance[ 'image_' . $i ]					 = (!empty( $new_instance[ 'image_' . $i ] ) ) ? ( $new_instance[ 'image_' . $i ] ) : '';
			$instance[ 'button_text_' . $i ]			 = (!empty( $new_instance[ 'button_text_' . $i ] ) ) ? ( $new_instance[ 'button_text_' . $i ] ) : '';
			$instance[ 'button_url_' . $i ]				 = (!empty( $new_instance[ 'button_url_' . $i ] ) ) ? ( $new_instance[ 'button_url_' . $i ] ) : '';
			$instance[ 'icon_button_' . $i ]			 = (!empty( $new_instance[ 'icon_button_' . $i ] ) ) ? ( $new_instance[ 'icon_button_' . $i ] ) : '';
			$instance[ 'icon_container_button_' . $i ]	 = (!empty( $new_instance[ 'icon_container_button_' . $i ] ) ) ? ( $new_instance[ 'icon_container_button_' . $i ] ) : '';
			$instance[ 'custom_button_icon_container_' . $i ]	 = (!empty( $new_instance[ 'custom_button_icon_container_' . $i ] ) ) ? ( $new_instance[ 'custom_button_icon_container_' . $i ] ) : '';
			$instance[ 'custom_button_collor_' . $i ]	 = (!empty( $new_instance[ 'custom_button_collor_' . $i ] ) ) ? ( $new_instance[ 'custom_button_collor_' . $i ] ) : '';
			$instance[ 'custom_button_icon_' . $i ]	 = (!empty( $new_instance[ 'custom_button_icon_' . $i ] ) ) ? ( $new_instance[ 'custom_button_icon_' . $i ] ) : '';
			
		}


		return $instance;
	}

}

// class My_Widget
