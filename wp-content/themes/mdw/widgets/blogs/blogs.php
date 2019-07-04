<?php
/*
  Plugin Name: Blog
  Plugin URI: http://mdwordpress.com
  Description: Blog listing
  Author: MDWordpress.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_Blog' );
} );

/**
 * MDW_Blog widget.
 */
class MDW_Blog extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Blog', // Base ID
  __( 'MDW Blog', 'mdw' ), // Name
	  array( 'description'	 => __( 'Blog listing', 'mdw' ),
			'category'		 => __( 'blog', 'mdw' )
		) // Args
		);

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}

	function admin_setup() {

		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ) );
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

			for ( $i = 1; $i <= 13; $i++ ) {

				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' ) {
						$template = dirname( __DIR__ ) . '/blogs/templates/blogs-template-' . $i . '.php';
					}
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
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		$template_number		 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$instance[ 'animation' ] = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$box_layout = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

		/* Posts feed variables */
		$category			 = ( isset( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : 'No categories';
		$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 2; // default for that blog layout
		$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 30;

		$social_buttons = ( isset( $instance[ 'social_buttons' ] ) ) ? $instance[ 'social_buttons' ] : "yes";
		$share_animation = ( isset( $instance[ 'share_animation' ] ) ) ? $instance[ 'share_animation' ] : "rotating";

		$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

		$display_date	 = ( isset( $instance[ 'display_date' ] ) ? $instance[ 'display_date' ] : '' );
		$display_author	 = ( isset( $instance[ 'display_author' ] ) ? $instance[ 'display_author' ] : '' );
		$columns_amount	 = ( isset( $instance[ 'columns_amount' ] ) ) ? $instance[ 'columns_amount' ] : '1';
		$orderby		 = ( isset( $instance[ 'orderby' ] ) ) ? $instance[ 'orderby' ] : 'date';
		$order			 = ( isset( $instance[ 'order' ] ) ) ? $instance[ 'order' ] : 'DESC';
		
		?>

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
                <?php for($i=1; $i<=13; $i++){ ?>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
				</li>
                <?php } ?>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<?php
                $options = array(
                    array(
                        'value'  => '1',
                        'text'   => '1',
                    ),
                    array(
                        'value'  => '2',
                        'text'   => '2',
                    ),
                    array(
                        'value'  => '3',
                        'text'   => '3',
                    ),
                    array(
                        'value'  => '4',
                        'text'   => '4',
                    ),
                );
				$order_options	 = array(
					array(
						'value'	 => 'title',
						'text'	 => __( 'Title', 'mdw' ),
					),
					array(
						'value'	 => 'date',
						'text'	 => __( 'Date', 'mdw' )
					),
					array(
						'value'	 => 'modified',
						'text'	 => __( 'Last modified', 'mdw' )
					),
					array(
						'value'	 => 'author',
						'text'	 => __( 'Author', 'mdw' )
					),
					array(
						'value'	 => 'comment_count',
						'text'	 => __( 'Comments amount', 'mdw' )
					),
					array(
						'value'	 => 'rand',
						'text'	 => __( 'Random', 'mdw' )
					)
				);

				$ICG->selectInput( 'orderby', $orderby, 'Order By', $order_options, $this );
				$ICG->selectInput( 'order', $order, 'Order', array(
					array(
						'value'	 => 'DSC',
						'text'	 => 'Descending',
					),
					array(
						'value'	 => 'ASC',
						'text'	 => 'Ascending',
					),
				), $this );

				?>
                <div class="widget_input">
                    <label><?php _e( 'Categories:', 'mdw' ); ?></label>
                    <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">

                        <option <?php echo ( $category == 'No categories' ? 'selected' : ''); ?> value='No categories'>All categories</option>

                        <?php foreach ( get_terms( 'category', 'parent=0&hide_empty=0' ) as $term ) { ?>
                            <option <?php echo ($term->term_id == $category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                <?php
                                echo $term->name;
                                ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>
                <div class="widget_input">
                    <?php $ICG->numberInput( 'amount', $amount, 'Post Amount', $this ); ?>
                    <br/>
                </div>
                <div class="widget_input">
                    <?php $ICG->numberInput( 'words_per_excerpt', $words_per_excerpt, 'Word per excerpt', $this ); ?>
                    <br/>
                </div>
				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->
				</div>
				<!--/.Panel 1-->
				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options , $this );
						?>
					</div>
					<!--Title -->
					<div class="widget_input">
						<?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->

				</div>
				<!--/.Panel 2-->
				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
						<br/>
					</div>
					<!--/.Title -->
					<!--Main description -->
					<div class="widget_input">
						<?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->
				</div>
				<!--/.Panel 3-->
				<!--Panel 4-->
				<div class="tab-pane fade <?php echo ($template_number == 4) ? 'active in' : '' ?>" id="v4" role="tabpanel">
					<br>
				</div>
				<!--/.Panel 4-->
				<!--Panel 5-->
				<div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 5-->
				<!--Panel 6-->
				<div class="tab-pane fade <?php echo ($template_number == 6) ? 'active in' : '' ?>" id="v6" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 6-->
				<!--Panel 7-->
				<div class="tab-pane fade <?php echo ($template_number == 7) ? 'active in' : '' ?>" id="v7" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
					<!--Share select-->
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'social_buttons', $social_buttons, 'Share buttons', array(
							array(
								'value'	 => 'yes',
								'text'	 => 'Yes',
							),
							array(
								'value'	 => 'no',
								'text'	 => 'No',
							)
						), $this );
						?>
					</div>
					<!--/.Share select-->
					<!--Share animation select-->
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'share_animation', $share_animation, 'Share buttons animations', array(
							array(
								'value'	 => 'rotating',
								'text'	 => 'Rotating',
							),
							array(
								'value'	 => 'reveal',
								'text'	 => 'Reveal',
							)
						), $this );
						?>
					</div>
					<!--/.Share animation select-->
				</div>
				<!--/.Panel 7-->
				<!--Panel 8-->
				<div class="tab-pane fade <?php echo ($template_number == 8) ? 'active in' : '' ?>" id="v8" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 8-->
				<!--Panel 9-->
				<div class="tab-pane fade <?php echo ($template_number == 9) ? 'active in' : '' ?>" id="v9" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
					<!--Share select-->
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'social_buttons', $social_buttons, 'Share buttons', array(
							array(
								'value'	 => 'yes',
								'text'	 => 'Yes',
							),
							array(
								'value'	 => 'no',
								'text'	 => 'No',
							)
						), $this );
						?>
					</div>
					<!--/.Share select-->
				</div>
				<!--/.Panel 9-->
				<!--Panel 10-->
				<div class="tab-pane fade <?php echo ($template_number == 10) ? 'active in' : '' ?>" id="v10" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 10-->
				<!--Panel 11-->
				<div class="tab-pane fade <?php echo ($template_number == 11) ? 'active in' : '' ?>" id="v11" role="tabpanel">
					<br>
					<!--Title -->
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $ICG->textInput( 'title', $title, 'Title', $this ); ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $ICG->textareaInput( 'main_content', $main_content, 'Content', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->
				</div>
				<!--/.Panel 11-->
				<!--Panel 12-->
				<div class="tab-pane fade <?php echo ($template_number == 12) ? 'active in' : '' ?>" id="v12" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 12-->

				<!--Panel 13-->
				<div class="tab-pane fade <?php echo ($template_number == 13) ? 'active in' : '' ?>" id="v13" role="tabpanel">
					<br>
					<div class="widget_input">
						<?php
						$ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options, $this );
						?>
					</div>
				</div>
				<!--/.Panel 13-->
				<?php
				$pages	 = get_pages( array(
					'meta_key' => '_wp_page_template'
				) );

				$how_many_pages = count( $pages );

				if ( $how_many_pages > 1 ) {
					?>
					<!--Site dropdown select-->
					<div class="widget_input">
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


			</div>

		</div>
		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
		<div class="widget_input">
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
		<!-- Display post date  -->
		<div class="widget_input">
			<?php $ICG->insertCheckBox( $this, 'Display post date', 'display_date', $display_date ); ?>
			<br>
		</div>
		<!-- Display post date  -->
		<!-- Display post author  -->
		<div class="widget_input">
			<?php $ICG->insertCheckBox( $this, 'Display post author', 'display_author', $display_author ); ?>
			<br>
		</div>
		<!-- Display post author  -->
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

		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '1';
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		$instance[ 'box_layout' ] = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : '';

		/* conditional display for content */
		$instance[ 'display_date' ]		 = (!empty( $new_instance[ 'display_date' ] ) ? ( $new_instance[ 'display_date' ] ) : '' );
		$instance[ 'display_author' ]	 = (!empty( $new_instance[ 'display_author' ] ) ? ( $new_instance[ 'display_author' ] ) : '');

		/* Post feed variables */
		$instance[ 'amount' ]			 = (!empty( $new_instance[ 'amount' ] ) ) ? ( $new_instance[ 'amount' ] ) : 3;
		$instance[ 'category' ]			 = (!empty( $new_instance[ 'category' ] ) ) ? ( $new_instance[ 'category' ] ) : 'All categories';
		$instance[ 'words_per_excerpt' ] = (!empty( $new_instance[ 'words_per_excerpt' ] ) ) ? ( $new_instance[ 'words_per_excerpt' ] ) : 30;
		// v12

		$instance[ 'social_buttons' ]	 = (!empty( $new_instance[ 'social_buttons' ] ) ) ? ( $new_instance[ 'social_buttons' ] ) : "yes";
		$instance[ 'columns_amount' ]	 = (!empty( $new_instance[ 'columns_amount' ] ) ) ? ( $new_instance[ 'columns_amount' ] ) : "1";

		$instance[ 'share_animation' ]	 = (!empty( $new_instance[ 'share_animation' ] ) ) ? ( $new_instance[ 'share_animation' ] ) : "rotating";
		$instance[ 'orderby' ]			 = (!empty( $new_instance[ 'orderby' ] ) ) ? ( $new_instance[ 'orderby' ] ) : "date";
		$instance[ 'order' ]			 = (!empty( $new_instance[ 'order' ] ) ) ? ( $new_instance[ 'order' ] ) : "DESC";

		$instance[ 'page_id' ] = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
	
		return $instance;
	}

}

// class My_Widget
