<?php
/*
  Plugin Name: MDW Ecommerce
  Plugin URI: http://MDWordPress.com
  Description: Widget listing products.
  Author: MDWordPress.com
  Version: 1.0
  Author URI: http://MDWordPress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );


add_action( 'widgets_init', function() {
	register_widget( 'MDW_Ecommerce' );
} );

/**
 * MDW_Ecommerce widget.
 */
class MDW_Ecommerce extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Ecommerce', // Base ID
  __( 'MDW Ecommerce', 'mdw' ), // Name
	  array( 'description'	 => __( 'Widget listing products.', 'mdw' ),
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

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			

			$page_id = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';

			if ( get_the_ID() == $page_id || $page_id == 'All pages' ) {
                echo $w_args[ 'before_widget' ];

				// use a template for the output so that it can easily be overridden by theme
				// read which template was chosen, if none, set first template

				$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

				// j == template count

				for ( $i = 1; $i <= 6; $i++ ) {


					// check if $i has value of chosen template in backend

					if ( $template_number == $i ) {

						// check for template in active theme

						$template = locate_template( 'template-' . $i . '.php' );

						// if none found use widget template
						if ( $template == '' )
							$template = dirname( __DIR__ ) . '/ecommerce/templates/ecommerce-template-' . $i . '.php';
					}
				}
				include ( $template );
                echo $w_args[ 'after_widget' ];
			}

			
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
        $ICG             = new WidgetInputsGenerator();
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		/* Posts feed variables */
		$prod_category		 = ( isset( $instance[ 'prod_category' ] ) ) ? $instance[ 'prod_category' ] : 'All categories';
		$amount				 = ( isset( $instance[ 'amount' ] ) ) ? $instance[ 'amount' ] : 3; // default for that blog layout
		$words_per_excerpt	 = ( isset( $instance[ 'words_per_excerpt' ] ) ) ? $instance[ 'words_per_excerpt' ] : 30;
		$template_number	 = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$columns_amount		 = ( isset( $instance[ 'columns_amount' ] ) ) ? $instance[ 'columns_amount' ] : '1';

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
		?>
		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>
		<!--Template dropdown select-->
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
				for ( $i = 1; $i <= 6; $i++ ) {
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
                <!--Title -->
                
                <div class="widget_input">
                    <?php $ICG->textInput( 'title', $title, 'Title', $this); ?>
                </div>
                <!--/.Title -->
                <div class="widget_input">
                    <?php $ICG->textInput( 'main_content', $main_content, 'Content', $this); ?>
                </div>
                <!--/.Words per excerpt-->
                <div class="widget_input">
                    <?php $ICG->numberInput( 'words_per_excerpt', $words_per_excerpt, 'Words per excerpt:', $this); ?>
                </div>
                <!--/.Words per excerpt-->

				<!--Panel 1-->
				<div class="tab-pane fade in <?php if ( $template_number == 1 ) echo "active" ?>" id="v1" role="tabpanel">
					<br>
					<div class="widget_input">
                        <?php
                        $ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options , $this );
                        ?>
					</div>

                    <div class="widget_input">
                        <?php $ICG->numberInput( 'amount', $amount, 'Posts amount', $this); ?>
                    </div>
                    <div class="widget_input">
                        <label><?php _e( 'Product categories:', "mdw" ); ?></label>
                        <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'prod_category' ); ?>">

                            <option <?php echo ( $prod_category == 'All categories' ? 'selected' : ''); ?> value='All categories'>All categories</option>

                            <?php foreach ( get_terms( 'product_cat', 'parent=0&hide_empty=0' ) as $term ) { ?>
                                <option <?php echo ($term->term_id == $prod_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                    <?php
                                    echo $term->name;
                                    ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade in <?php if ( $template_number == 2 ) echo "active" ?>" id="v2" role="tabpanel">
                   <br>
                    <div class="widget_input">
                        <?php
                        $ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options , $this );
                        ?>
                    </div>
                    
                    <div class="widget_input">
                        <?php $ICG->numberInput( 'amount', $amount, 'Posts amount', $this); ?>
                    </div>
                    <div class="widget_input">
                        <label><?php _e( 'Product categories:', "mdw" ); ?></label>
                        <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'prod_category' ); ?>">

                            <option <?php echo ( $prod_category == 'All categories' ? 'selected' : ''); ?> value='All categories'>All categories</option>

                            <?php foreach ( get_terms( 'product_cat', 'parent=0&hide_empty=0' ) as $term ) { ?>
                                <option <?php echo ($term->term_id == $prod_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                    <?php
                                    echo $term->name;
                                    ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
				</div>
				<!--/.Panel 2-->

				<!--Panel 3-->
				<div class="tab-pane fade in <?php if ( $template_number == 3 ) echo "active" ?>" id="v3" role="tabpanel">
					                   <br>
                    <div class="widget_input">
                        <?php
                        $ICG->selectInput( 'columns_amount', $columns_amount, 'Columns:', $options , $this );
                        ?>
                    </div>

                    <div class="widget_input">
                        <?php $ICG->numberInput( 'amount', $amount, 'Posts amount', $this); ?>
                    </div>
                    <div class="widget_input">
                        <label><?php _e( 'Product categories:', "mdw" ); ?></label>
                        <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'prod_category' ); ?>">

                            <option <?php echo ( $prod_category == 'All categories' ? 'selected' : ''); ?> value='All categories'>All categories</option>

                            <?php foreach ( get_terms( 'product_cat', 'parent=0&hide_empty=0' ) as $term ) { ?>
                                <option <?php echo ($term->term_id == $prod_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                    <?php
                                    echo $term->name;
                                    ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
				</div>
				<!--/.Panel 3-->

				<!--Panel 4-->
				<div class="tab-pane fade in <?php if ( $template_number == 4 ) echo "active" ?>" id="v4" role="tabpanel">
					<br>
                    <div class="widget_input">
                        <?php $ICG->numberInput( 'amount', $amount, 'Posts amount', $this); ?>
                    </div>
				</div>
				<!--/.Panel 4-->

				<!--Panel 5-->
				<div class="tab-pane fade in <?php if ( $template_number == 5 ) echo "active" ?>" id="v5" role="tabpanel">
					<br>
                    <div class="widget_input">
                        <label><?php _e( 'Product categories:', "mdw" ); ?></label>
                        <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'prod_category' ); ?>">

                            <option <?php echo ( $prod_category == 'All categories' ? 'selected' : ''); ?> value='All categories'>All categories</option>

                            <?php foreach ( get_terms( 'product_cat', 'parent=0&hide_empty=0' ) as $term ) { ?>
                                <option <?php echo ($term->term_id == $prod_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                    <?php
                                    echo $term->name;
                                    ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
				</div>
				<!--/.Panel 5-->




				<div class="tab-pane fade in <?php if ( $template_number == 6 ) echo "active" ?>" id="v6" role="tabpanel">
					<br>
                    <div class="widget_input">
                        <?php $ICG->numberInput( 'amount', $amount, 'Posts amount', $this); ?>
                    </div>
                    <div class="widget_input">
                        <label><?php _e( 'Product categories:', "mdw" ); ?></label>
                        <select style="display:block" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'prod_category' ); ?>">

                            <option <?php echo ( $prod_category == 'All categories' ? 'selected' : ''); ?> value='All categories'>All categories</option>

                            <?php foreach ( get_terms( 'product_cat', 'parent=0&hide_empty=0' ) as $term ) { ?>
                                <option <?php echo ($term->term_id == $prod_category ? 'selected' : ''); ?> value="<?php echo $term->term_id; ?>">
                                    <?php
                                    echo $term->name;
                                    ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
				</div>
				<!--/.Panel 1-->

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
			<div class="widget_input">
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
		$instance[ 'box_layout' ]	 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
		$instance[ 'animation' ]	 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

		/* Post feed variables */
		$instance[ 'amount' ]			 = (!empty( $new_instance[ 'amount' ] ) ) ? ( $new_instance[ 'amount' ] ) : 3;
		$instance[ 'prod_category' ]	 = (!empty( $new_instance[ 'prod_category' ] ) ) ? ( $new_instance[ 'prod_category' ] ) : 'All categories';
		$instance[ 'words_per_excerpt' ] = (!empty( $new_instance[ 'words_per_excerpt' ] ) ) ? ( $new_instance[ 'words_per_excerpt' ] ) : 30;
		$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : 1;
		$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'columns_amount' ]	 = (!empty( $new_instance[ 'columns_amount' ] ) ) ? ( $new_instance[ 'columns_amount' ] ) : "1";

		return $instance;
	}

}

// class My_Widget
