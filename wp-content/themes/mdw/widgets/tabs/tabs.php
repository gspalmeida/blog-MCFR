<?php
/*
  Plugin Name: MDW Tabs
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
	register_widget( 'MDW_Tabs' );
} );

/**
 * MDW Tabs widget.
 */
class MDW_Tabs extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'mdw_tabs', // Base ID
  __( 'MDW Tabs', 'mdw' ), // Name
	  array( 'description'	 => __( 'MDW Tabs allows you to toggle content on your pages', 'mdw' ),
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
	 * @param array $w_args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $w_args, $instance ) {

		

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
            echo $w_args[ 'before_widget' ];

			// use a template for the output so that it can easily be overridden by theme
			// read which template was chosen, if none, set first template

			$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

			for ( $i = 1; $i <= 7; $i++ ) {


				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/tabs/templates/tabs-template-' . $i . '.php';
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
        $widget_id   = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
        $text   = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : '';
		$title	 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$page_id	 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$fieldCount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$animation	 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id	 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$background_color = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '#4285F4';

		/* Custom feed variables */
		$amount = $fieldCount; // default for that project layout

		$tempSettingsArray = array(
			"name_",
			"content_",
			"icon_",
			"icon_container_",
			"icon_color_",
            "post_number_",
            "category_",
            "title_",
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
		<?php get_template_part( 'template-parts/icons' ); ?>
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

                <?php for($i=1; $i<=6; $i++){ ?>
                <li class="nav-item">
                    <a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
                </li>
                <?php } ?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">
                    

                    <div class="widget_input">
                        <?php $ICG->textInput( 'title', $title, 'Title ', $this ); ?>
                        <br/>
                    </div>
                    <div class="widget_input">
                        <?php $ICG->textareaInput( 'text', $text, 'Content ', $this ); ?>
                        <br/>
                    </div>
				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>

					<!--Background-->

					<div class="widget_input col-md-12">
                    <?php $ICG->insertColorPicker( $this, $background_color, 'background_color' ); ?>
					</div>
					<!--/.Background-->

					<div class="widget_input col-md-6">
						<span id="add-tab <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1" data-version="1"><?php _e( 'Add tab ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e( 'Delete group ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Tab ', 'mdw' ); ?> <?php echo $i ?> 
									<i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i>
									<i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

								<div class="widget_input">
									<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Group Name ', $this ); ?>
									<br/>
								</div>
                                <div class="widget_input">
                                    <?php $ICG->textInput( 'title_' . $i, ${'title_' . $i}, 'Group Title ', $this ); ?>
                                    <br/>
                                </div>
							

								<div class="widget_input">

									<?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Group Content ', $this ); ?>
									<br/>
								</div>

									<div class='widget_input col-md-12'>
                                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>
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
						<span id="add-tab <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2" data-version="2"><?php _e( 'Add tab ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e( 'Delete group ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Tab ', 'mdw' ); ?> <?php echo $i ?> <i class="pull-right fa fa-caret-down"></i><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

								<div class="widget_input">
									<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Group Name ', $this ); ?>
									<br/>
								</div>
                                <div class="widget_input">
                                    <?php $ICG->textInput( 'title_' . $i, ${'title_' . $i}, 'Group Title ', $this ); ?>
                                    <br/>
                                </div>

                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Group Content ', $this ); ?>
                                            <br/>
                                        </div>

                                    <div class='widget_input col-md-12'>
                                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>
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

					<div class="widget_input col-md-6">
						<span id="add-tab <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3" data-version="3"><?php _e( 'Add tab ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel3"><?php _e( 'Delete group ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Tab ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>

								<div class="widget_input">
									<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Group Name ', $this ); ?>
									<br/>
								</div>
                                <div class="widget_input">
                                    <?php $ICG->textInput( 'title_' . $i, ${'title_' . $i}, 'Group Title ', $this ); ?>
                                    <br/>
                                </div>

                                        <div class="widget_input">

                                            <?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Group Content ', $this ); ?>
                                            <br/>
                                        </div>

                                    <div class='widget_input col-md-12'>
                                    <?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>
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
						<span id="add-tab <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4" data-version="4"><?php _e( 'Add tab ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel4"><?php _e( 'Delete group ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Tab ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i><i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
								
								<div class="widget_input">
									<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Group Name ', $this ); ?>
									<br/>
								</div>
                                <div class="widget_input">
                                    <?php $ICG->textInput( 'title_' . $i, ${'title_' . $i}, 'Group Title ', $this ); ?>
                                    <br/>
                                </div>

								<div class="widget_input">

									<?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Group Content ', $this ); ?>
									<br/>
								</div>

								<div class='widget_input col-md-12'>
									<?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>
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
						<span id="add-tab <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5" data-version="5"><?php _e( 'Add tab ', 'mdw' ); ?> <i class="fa fa-plus-circle blue-text"></i></span>
					</div>

					<div class="widget_input col-md-6">
						<span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel5"><?php _e( 'Delete group ', 'mdw' ); ?> <i class="fa fa-minus-circle red-text"></i></span>
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
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Tab ', 'mdw' ); ?> <?php echo $i ?><i class="fa fa-trash pull-right red-text delete-the-feature" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
								<div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
                                        
                                <div class="widget_input">
									<?php $ICG->textInput( 'name_' . $i, ${'name_' . $i}, 'Group Name ', $this ); ?>
									<br/>
								</div>
                                <div class="widget_input">
                                    <?php $ICG->textInput( 'title_' . $i, ${'title_' . $i}, 'Group Title ', $this ); ?>
                                    <br/>
                                </div>

								<div class="widget_input">

									<?php $ICG->textareaInput( 'content_' . $i, ${'content_' . $i}, 'Group Content ', $this ); ?>
									<br/>
								</div>

								<div class='widget_input col-md-12'>
									<?php $ICG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i   ); ?>
								</div>
								</div>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!--/.Panel 5-->
				<!--Panel 6-->
				<div class="tab-pane fade <?php echo ($template_number == 6) ? 'active in' : '' ?>" id="v6" role="tabpanel">
					<!--Post category dropdown select-->
					<?php for ( $i = 1; $i <= 3; $i++ ) { ?>
						<div class="widget_input col-md-4">
							<label><?php _e( 'Category:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'category_' . $i ); ?>" name="<?php echo $this->get_field_name( 'category_' . $i ); ?>">

								<option <?php echo ( ${"category_" . $i} == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == ${"category_" . $i} ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
							<br><br>
                            <?php $ICG->numberInput( 'post_number_' . $i, empty( ${'post_number_' . $i} ) ? "1" : ${'post_number_' . $i}, "Post number:", $this ); ?>
						</div>
					<?php } ?>
					<!--/.Post category dropdown select-->
				</div>
				<!--/.Panel 6-->
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
		$instance[ 'widget_id' ] = $this->id;

		$instance[ 'fieldCount' ] = (!empty( $new_instance[ 'fieldCount' ] ) ) ? strip_tags( $new_instance[ 'fieldCount' ] ) : '0';

		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

        $instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
        $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : "";
		$instance[ 'text' ] = (!empty( $new_instance[ 'text' ] ) ) ? ( $new_instance[ 'text' ] ) : "";

        $instance[ 'background_color' ] = (!empty( $new_instance[ 'background_color' ] ) ) ? ( $new_instance[ 'background_color' ] ) : "";

		$amount = ( isset( $instance[ 'fieldCount' ] ) ) ? $instance[ 'fieldCount' ] : '0';


		$tempSettingsArray = array(
            "name_",
            "content_",
            "icon_",
            "icon_container_",
            "icon_color_",
            "post_number_",
            "category_",
            "title_",
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
