<?php
/*
  Plugin Name: Magazine
  Plugin URI: http://mdwordpress.com
  Description: Magazine listing
  Author: MDWootstrap.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Magazine' );
} );

/**
 * MDW_Magazine widget.
 */
class MDW_Magazine extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Magazine', // Base ID
  __( 'MDW News (former MDW Magazine)', 'mdw' ), // Name
	  array( 'description'	 => __( 'Magazine listing', 'mdw' ),
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

        wp_register_style( 'magazine', get_template_directory_uri() . '/widgets/magazine/css/magazine.css' );
        wp_enqueue_style( 'magazine' );

		

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
						$template = dirname( __DIR__ ) . '/magazine/templates/magazine-template-' . $i . '.php';
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

//

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		/* General variables */
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

		/* Posts feed variables */
		$left_category			 = ( isset( $instance[ 'left_category' ] ) ) ? $instance[ 'left_category' ] : 'No categories';
		$left_amount			 = ( isset( $instance[ 'left_amount' ] ) ) ? $instance[ 'left_amount' ] : 3; // default for that blog layout
		$left_words_per_excerpt	 = ( isset( $instance[ 'left_words_per_excerpt' ] ) ) ? $instance[ 'left_words_per_excerpt' ] : 30;

		$middle_category			 = ( isset( $instance[ 'middle_category' ] ) ) ? $instance[ 'middle_category' ] : 'No categories';
		$middle_amount				 = ( isset( $instance[ 'middle_amount' ] ) ) ? $instance[ 'middle_amount' ] : 3; // default for that blog layout
		$middle_words_per_excerpt	 = ( isset( $instance[ 'middle_words_per_excerpt' ] ) ) ? $instance[ 'middle_words_per_excerpt' ] : 30;

		$right_category			 = ( isset( $instance[ 'right_category' ] ) ) ? $instance[ 'right_category' ] : 'No categories';
		$right_amount			 = ( isset( $instance[ 'right_amount' ] ) ) ? $instance[ 'right_amount' ] : 3; // default for that blog layout
		$right_words_per_excerpt = ( isset( $instance[ 'right_words_per_excerpt' ] ) ) ? $instance[ 'right_words_per_excerpt' ] : 30;

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$text			 = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : '';

		$image_url	 = ( isset( $instance[ 'image_url' ] ) ) ? $instance[ 'image_url' ] : '';
		$image_url_1 = ( isset( $instance[ 'image_url_1' ] ) ) ? $instance[ 'image_url_1' ] : '';
		$image_url_2 = ( isset( $instance[ 'image_url_2' ] ) ) ? $instance[ 'image_url_2' ] : '';

		$image	 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$image_1 = ( isset( $instance[ 'image_1' ] ) ) ? $instance[ 'image_1' ] : '';
		$image_2 = ( isset( $instance[ 'image_2' ] ) ) ? $instance[ 'image_2' ] : '';

		$title	 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$title_1 = ( isset( $instance[ 'title_1' ] ) ) ? $instance[ 'title_1' ] : '';
		$title_2 = ( isset( $instance[ 'title_2' ] ) ) ? $instance[ 'title_2' ] : '';

		$title_url	 = ( isset( $instance[ 'title_url' ] ) ) ? $instance[ 'title_url' ] : '';
		$title_url_1 = ( isset( $instance[ 'title_url_1' ] ) ) ? $instance[ 'title_url_1' ] : '';
		$title_url_2 = ( isset( $instance[ 'title_url_2' ] ) ) ? $instance[ 'title_url_2' ] : '';


		$b_color	 = ( isset( $instance[ 'b_color' ] ) ) ? $instance[ 'b_color' ] : '#4285F4';
		$b_color_1	 = ( isset( $instance[ 'b_color_1' ] ) ) ? $instance[ 'b_color_1' ] : '#4285F4';
		$b_color_2	 = ( isset( $instance[ 'b_color_2' ] ) ) ? $instance[ 'b_color_2' ] : '#4285F4';

		$what_to_feed = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts'; 
		$WG = new WidgetInputsGenerator();
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
					<img src="">
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>
				<?php
					for ( $i = 1; $i <= 7; $i++ ) {
							?>
							<li class="nav-item">
								<a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
							</li>	
						<?php }
				?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content col-md-12">

				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->

					<div class="col-md-6">
						<!--   LEFT SIDE   -->
						<h3><?php _e( 'Left side', 'mdw' ); ?></h3>
						<!--[left] Posts amount -->
						<div class="widget_input">
							<?php $WG->numberInput( 'left_amount', $left_amount, 'Posts amount', $this ) ?>
							<br/>
						</div>
						<!--/.[left] Posts amount -->

						<!--[left] Post category dropdown select-->
						<div class="widget_input">
							<label><?php _e( 'Categories:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'left_name' ); ?>" name="<?php echo $this->get_field_name( 'left_category' ); ?>">

								<option <?php echo ( $left_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == $left_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!--/.[left] Post category dropdown select-->


						<!--[left] Words per excerpt-->
						<div class="widget_input">
							<?php $WG->numberInput( 'left_words_per_excerpt', $left_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
						</div>
						<!--/.[left] Words per excerpt-->

					</div>

					<div class="col-md-6">
						<!--   RIGHT SIDE   -->
						<h3><?php _e( 'Right side', 'mdw' ); ?></h3>
						<!--[right] Posts amount -->
						<div class="widget_input">
							<?php $WG->numberInput( 'right_amount', $right_amount, 'Posts amount', $this ) ?>
							<br/>
						</div>
						<!--/.[right] Posts amount -->

						<!--[right] Post category dropdown select-->
						<div class="widget_input">
							<label><?php _e( 'Categories:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'right_name' ); ?>" name="<?php echo $this->get_field_name( 'right_category' ); ?>">

								<option <?php echo ( $right_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == $right_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!--/.[right] Post category dropdown select-->

						<!--[right] Words per excerpt-->
						<div class="widget_input">
							<?php $WG->numberInput( 'right_words_per_excerpt', $right_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
						</div>
						<!--/.[right] Words per excerpt-->

					</div>
				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->

					<!--Posts amount -->
					<div class="widget_input">
						<?php $WG->numberInput( 'middle_amount', $middle_amount, 'Posts amount:', $this ) ?>
						<br/>
					</div>
					<!--/.Posts amount -->
					<!--Post category dropdown select-->
					<div class="widget_input">
						<label><?php _e( 'Categories:', 'mdw' ); ?></label>
						<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

							<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

							<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
								<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
									<?php
									echo $term->name;
									?>
								</option>
							<?php } ?>

						</select>
					</div>
					<!--/.Post category dropdown select-->
					<!-- Words per excerpt-->
					<div class="widget_input">
							<?php $WG->numberInput( 'middle_words_per_excerpt', $middle_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
					</div>
					<!--/. Words per excerpt-->

				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->
					<div class="col-md-4">
						<!--   LEFT SIDE   -->
						<h3><?php _e( 'Left side', 'mdw' ); ?></h3>
						<!--[left] Posts amount -->
						<div class="widget_input">
							<?php $WG->numberInput( 'left_amount', $left_amount, 'Posts amount:', $this ) ?>
							<br/>
						</div>
						<!--/.[left] Posts amount -->

						<!--[left] Post category dropdown select-->
						<div class="widget_input">
							<label><?php _e( 'Categories:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'left_name' ); ?>" name="<?php echo $this->get_field_name( 'left_category' ); ?>">

								<option <?php echo ( $left_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == $left_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!--/.[left] Post category dropdown select-->


						<!--[left] Words per excerpt-->
						<div class="widget_input">
							<?php $WG->numberInput( 'left_words_per_excerpt', $left_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
						</div>
						<!--/.[left] Words per excerpt-->

					</div>

					<div class="col-md-4">
						<!--   MIDDLE   -->
						<h3>Middle</h3>
						<!--[middle] Posts amount -->
						<div class="widget_input">
							<?php $WG->numberInput( 'middle_amount', $middle_amount, 'Posts amount:', $this ) ?>
							<br/>
						</div>
						<!--/.[middle] Posts amount -->

						<!--[middle] Post category dropdown select-->
						<div class="widget_input">
							<label><?php _e( 'Categories:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

								<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!--/.[middle] Post category dropdown select-->


						<!--[middle] Words per excerpt-->
						<div class="widget_input">
							<?php $WG->numberInput( 'middle_words_per_excerpt', $middle_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
						</div>
						<!--/.[middle] Words per excerpt-->
					</div>

					<div class="col-md-4">
						<!--   RIGHT SIDE   -->
						<h3><?php _e( 'Right side', 'mdw' ); ?></h3>
						<!--[right] Posts amount -->
						<div class="widget_input">
							<?php $WG->numberInput( 'right_amount', $right_amount, 'Posts amount:', $this ) ?>
							<br/>
						</div>
						<!--/.[right] Posts amount -->

						<!--[right] Post category dropdown select-->
						<div class="widget_input">
							<label><?php _e( 'Categories:', 'mdw' ); ?></label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'right_name' ); ?>" name="<?php echo $this->get_field_name( 'right_category' ); ?>">

								<option <?php echo ( $right_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

								<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
									<option <?php echo ($term->term_id == $right_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
										<?php
										echo $term->name;
										?>
									</option>
								<?php } ?>

							</select>
						</div>
						<!--/.[right] Post category dropdown select-->


						<!--[right] Words per excerpt-->
						<div class="widget_input">
							<?php $WG->numberInput( 'right_words_per_excerpt', $right_words_per_excerpt, 'Words per excerpt:', $this ) ?>
							<br/>
						</div>
						<!--/.[right] Words per excerpt-->

					</div>
				</div>
				<!--/.Panel 3-->

				<!--Panel 4-->
				<div class="tab-pane fade <?php echo ($template_number == 4) ? 'active in' : '' ?>" id="v4" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Posts amount -->
					<div class="widget_input">
						<?php $WG->numberInput( 'middle_amount', $middle_amount, 'Posts amount:', $this ) ?>
						<br/>
					</div>
					<!--/.Posts amount -->

					<!--Post category dropdown select-->
					<div class="widget_input">
						<label><?php _e( 'Category:', 'mdw' ); ?></label>
						<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

							<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

							<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
								<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
									<?php
									echo $term->name;
									?>
								</option>
							<?php } ?>

						</select>
					</div>
					<!--/.Post category dropdown select-->

				</div>
				<!--/.Panel 4-->
				<!--Panel 5-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Posts amount -->
					<div class="widget_input">
						<?php $WG->numberInput( 'middle_amount', $middle_amount, 'Posts amount:', $this ) ?>
						<br/>
					</div>
					<!--/.Posts amount -->

					<!--Post category dropdown select-->
					<div class="widget_input">
						<label><?php _e( 'Category:', 'mdw' ); ?></label>
						<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

							<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

							<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
								<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
									<?php
									echo $term->name;
									?>
								</option>
							<?php } ?>

						</select>
					</div>
					<!--/.Post category dropdown select-->

				</div>
				<!--/.Panel 5-->
				<!--Panel 6-->
				<div class="tab-pane fade <?php echo ($template_number == 6) ? 'active in' : '' ?>" id="v6" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Posts amount -->
					<div class="widget_input">
						<?php $WG->numberInput( 'middle_amount', $middle_amount, 'Posts amount:', $this ) ?>
						<br/>
					</div>
					<!--/.Posts amount -->

					<!--Post category dropdown select-->
					<div class="widget_input">
						<label><?php _e( 'Category:', 'mdw' ); ?></label>
						<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

							<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

							<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
								<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
									<?php
									echo $term->name;
									?>
								</option>
							<?php } ?>

						</select>
					</div>
					<!--/.Post category dropdown select-->

				</div>
				<!--/.Panel 6-->
				<!--.Panel 7-->
				<div class="tab-pane fade <?php echo ($template_number == 7) ? 'active in' : '' ?>" id="v7" role="tabpanel">
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
							<br>

							<div class="col-md-12">
								<!--Image 1-->
								<?php for ( $i = 0; $i <= 2; $i++ ){
									if($i == 0 ){?>
										<div class="widget_input">
											<?php $WG->imageInput( "image", ${"image"}, "", 'Select Image', "", $image, $this );?>	
											<br/>
											<?php $WG->insertColorPicker( $this, $b_color, 'b_color' ) ;?>
											<br/>
											<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
											<br/>
											<?php $WG->textInput( 'title_url', ${'title_url'}, 'Title url', $this ) ?>
											<br/>
											<?php $WG->textInput( 'text', ${'text'}, 'Text', $this ) ?>
											<br/>	
										</div>
									<?php } else { ?>
										<div class="widget_input">
										<?php $WG->imageInput( "image_" . $i, ${"image_" . $i}, "", 'Select Image', "", ${"image_".$i}, $this );?>
										<br/>
										<?php $WG->insertColorPicker( $this, ${'b_color_'.$i}, 'b_color_'.$i ) ;?>
										<br>
										<?php $WG->textInput( 'title_'.$i, ${'title_'.$i}, 'Title', $this ) ?>
										<br/>
										<?php $WG->textInput( 'title_url_'.$i, ${'title_url_'.$i}, 'Title url', $this ) ?>
										<br/>
										</div>
									<?php  }	 
							} 
							
							?>
						</div>
						</div>
						<!--/.Custom panel-->

						<!--Posts panel-->
						<div id="post-panel" <?php echo ($what_to_feed == 'custom' ? ' style="display:none"' : ''); ?>><!-- style set for tabs to work, this one is hidden by default -->
							<br>

							<div class="col-md-4">
								<!--   LEFT SIDE   -->
								<h3><?php _e( 'Left side', 'mdw' ); ?></h3>
								<!--[left] Posts amount -->

								<!--/.[left] Posts amount -->

								<!--[left] Post category dropdown select-->
								<div class="widget_input">
									<label><?php _e( 'Categories:', 'mdw' ); ?></label>
									<select style="display:block" id="<?php echo $this->get_field_id( 'left_name' ); ?>" name="<?php echo $this->get_field_name( 'left_category' ); ?>">

										<option <?php echo ( $left_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

										<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
											<option <?php echo ($term->term_id == $left_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
												<?php
												echo $term->name;
												?>
											</option>
										<?php } ?>

									</select>
								</div>
								<!--/.[left] Post category dropdown select-->


								<!--[left] Words per excerpt-->
								<div class="widget_input">
									<?php $WG->numberInput( 'middle_words_per_excerpt', $left_words_per_excerpt, 'Words per excerpt:', $this ) ?>
									<br/>
								</div>
								<!--/.[left] Words per excerpt-->
							</div>
							<div class="col-md-4">
								<!--   MIDDLE   -->
								<h3><?php _e( 'Top right', 'mdw' ); ?></h3>
								<!--[middle] Posts amount -->

								<!--/.[middle] Posts amount -->

								<!--[middle] Post category dropdown select-->
								<div class="widget_input">
									<label><?php _e( 'Categories:', 'mdw' ); ?></label>
									<select style="display:block" id="<?php echo $this->get_field_id( 'middle_name' ); ?>" name="<?php echo $this->get_field_name( 'middle_category' ); ?>">

										<option <?php echo ( $middle_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

										<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
											<option <?php echo ($term->term_id == $middle_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
												<?php
												echo $term->name;
												?>
											</option>
										<?php } ?>

									</select>
								</div>
								<!--/.[middle] Post category dropdown select-->


								<!--[middle] Words per excerpt-->
								<div class="widget_input">
									<?php $WG->numberInput( 'middle_words_per_excerpt', $middle_words_per_excerpt, 'Words per excerpt:', $this ) ?>
									<br/>
								</div>
								<!--/.[middle] Words per excerpt-->

							</div>

							<div class="col-md-4">
								<!--   RIGHT SIDE   -->
								<h3><?php _e( 'Bottom right', 'mdw' ); ?></h3>
								<!--[right] Posts amount -->

								<!--/.[right] Posts amount -->

								<!--[right] Post category dropdown select-->
								<div class="widget_input">
									<label><?php _e( 'Categories:', 'mdw' ); ?></label>
									<select style="display:block" id="<?php echo $this->get_field_id( 'right_name' ); ?>" name="<?php echo $this->get_field_name( 'right_category' ); ?>">

										<option <?php echo ( $right_category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

										<?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
											<option <?php echo ($term->term_id == $right_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
												<?php
												echo $term->name;
												?>
											</option>
										<?php } ?>

									</select>
								</div>
								<!--/.[right] Post category dropdown select-->


								<!--[right] Words per excerpt-->
								<div class="widget_input">
										<?php $WG->numberInput( 'right_words_per_excerpt', $right_words_per_excerpt, 'Words per excerpt:', $this ) ?>
									<br/>
								</div>
								<!--/.[right] Words per excerpt-->

							</div>

							<input style="visibility:hidden"
								   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
								   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
								   value="<?php echo $what_to_feed; ?>"
								   type="text">

							<!--/.Posts amount -->

							<!--Post category dropdown select-->

							<!--/.Post category dropdown select-->
						</div>                  
					</div>
				</div>

				<!--/.Posts panel-->
				<input style="visibility:hidden"
					   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
					   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
					   value="<?php echo $what_to_feed; ?>"
					   type="text">
			</div>

			<br>
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
            <?php
            $WG->selectInput( 'box_layout', $box_layout, "Box Layout:", array(
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
		$instance[ 'widget_id' ]	 = $this->id;
		$instance[ 'main_content' ]	 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";

		/* Post feed variables */
		$instance[ 'left_amount' ]				 = (!empty( $new_instance[ 'left_amount' ] ) ) ? ( $new_instance[ 'left_amount' ] ) : 3;
		$instance[ 'left_category' ]			 = (!empty( $new_instance[ 'left_category' ] ) ) ? ( $new_instance[ 'left_category' ] ) : '3';
		$instance[ 'left_words_per_excerpt' ]	 = (!empty( $new_instance[ 'left_words_per_excerpt' ] ) ) ? ( $new_instance[ 'left_words_per_excerpt' ] ) : 30;

		$instance[ 'middle_amount' ]			 = (!empty( $new_instance[ 'middle_amount' ] ) ) ? ( $new_instance[ 'middle_amount' ] ) : 3;
		$instance[ 'middle_category' ]			 = (!empty( $new_instance[ 'middle_category' ] ) ) ? ( $new_instance[ 'middle_category' ] ) : '3';
		$instance[ 'middle_words_per_excerpt' ]	 = (!empty( $new_instance[ 'middle_words_per_excerpt' ] ) ) ? ( $new_instance[ 'middle_words_per_excerpt' ] ) : 30;

		$instance[ 'right_amount' ]				 = (!empty( $new_instance[ 'right_amount' ] ) ) ? ( $new_instance[ 'right_amount' ] ) : 3;
		$instance[ 'right_category' ]			 = (!empty( $new_instance[ 'right_category' ] ) ) ? ( $new_instance[ 'right_category' ] ) : '3';
		$instance[ 'right_words_per_excerpt' ]	 = (!empty( $new_instance[ 'right_words_per_excerpt' ] ) ) ? ( $new_instance[ 'right_words_per_excerpt' ] ) : 30;

		$instance[ 'text' ] = (!empty( $new_instance[ 'text' ] ) ) ? ( $new_instance[ 'text' ] ) : '';

		$instance[ 'image_url' ]	 = (!empty( $new_instance[ 'image_url' ] ) ) ? ( $new_instance[ 'image_url' ] ) : '';
		$instance[ 'image_url_1' ]	 = (!empty( $new_instance[ 'image_url_1' ] ) ) ? ( $new_instance[ 'image_url_1' ] ) : '';
		$instance[ 'image_url_2' ]	 = (!empty( $new_instance[ 'image_url_2' ] ) ) ? ( $new_instance[ 'image_url_2' ] ) : '';

		$instance[ 'image' ]	 = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : '';
		$instance[ 'image_1' ]	 = (!empty( $new_instance[ 'image_1' ] ) ) ? ( $new_instance[ 'image_1' ] ) : '';
		$instance[ 'image_2' ]	 = (!empty( $new_instance[ 'image_2' ] ) ) ? ( $new_instance[ 'image_2' ] ) : '';

		$instance[ 'title' ]	 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
		$instance[ 'title_1' ]	 = (!empty( $new_instance[ 'title_1' ] ) ) ? ( $new_instance[ 'title_1' ] ) : '';
		$instance[ 'title_2' ]	 = (!empty( $new_instance[ 'title_2' ] ) ) ? ( $new_instance[ 'title_2' ] ) : '';

		$instance[ 'title_url' ]	 = (!empty( $new_instance[ 'title_url' ] ) ) ? ( $new_instance[ 'title_url' ] ) : '';
		$instance[ 'title_url_1' ]	 = (!empty( $new_instance[ 'title_url_1' ] ) ) ? ( $new_instance[ 'title_url_1' ] ) : '';
		$instance[ 'title_url_2' ]	 = (!empty( $new_instance[ 'title_url_2' ] ) ) ? ( $new_instance[ 'title_url_2' ] ) : '';

		$instance[ 'b_color' ]	 = (!empty( $new_instance[ 'b_color' ] ) ) ? ( $new_instance[ 'b_color' ] ) : '#4285F4';
		$instance[ 'b_color_1' ] = (!empty( $new_instance[ 'b_color_1' ] ) ) ? ( $new_instance[ 'b_color_1' ] ) : '#4285F4';
		$instance[ 'b_color_2' ] = (!empty( $new_instance[ 'b_color_2' ] ) ) ? ( $new_instance[ 'b_color_2' ] ) : '#4285F4';

		$instance[ 'what_to_feed' ] = (!empty( $new_instance[ 'what_to_feed' ] ) ) ? ( $new_instance[ 'what_to_feed' ] ) : '';

		return $instance;
	}

}

// class My_Widget
