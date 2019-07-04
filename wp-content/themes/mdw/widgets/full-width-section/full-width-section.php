<?php
/*
  Plugin Name: MDW Full Width Section
  Plugin URI: http://mdwordpress.com
  Description: Widget that displays itself on full width width
  Author: MDWordpress.com
  Version: 1.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_full_width_section' );
} );

/**
 * Adds MDW_Intro_Signup widget.
 */
class MDW_Full_Width_Section extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_full_width_section', // Base ID
  __( 'MDW Full Width Section', 'mdw' ), // Name
	  array( 'description'	 => __( 'Widget that displays itself on full page width', 'mdw' ),
			'category'		 => __( 'landing', 'mdw' )
		) // Args
		);

		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}

	function admin_setup() {

		wp_enqueue_media();
		wp_register_script( 'mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ), NULL, true );
		wp_enqueue_script( 'mdw-all-admin-scripts-js' );
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

			wp_register_style( 'Full-width-section', get_template_directory_uri() . '/widgets/css/admin.css' );
			wp_enqueue_style( 'Full-width-section' );


			// use a template for the output so that it can easily be overridden by theme
			// read which template was chosen, if none, set first template

			$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;

			// j == template count

			for ( $i = 1; $i <= 3; $i++ ) {

				// check if $i has value of chosen template in backend

				if ( $template_number == $i ) {

					// check for template in active theme

					$template = locate_template( 'template-' . $i . '.php' );

					// if none found use widget template

					if ( $template == '' )
						$template = dirname( __DIR__ ) . '/full-width-section/templates/full-width-section-template-' . $i . '.php';
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
		$widget_id			 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
		$bg_image_1			 = ( isset( $instance[ 'background_image_1' ] ) ) ? $instance[ 'background_image_1' ] : '';
		$bg_image_2			 = ( isset( $instance[ 'background_image_2' ] ) ) ? $instance[ 'background_image_2' ] : '';
		$no_image			 = get_template_directory_uri() . "/img/no_image.jpg";
		$no_image_1			 = get_template_directory_uri() . "/img/no_image.jpg";
		$no_image_2			 = get_template_directory_uri() . "/img/no_image.jpg";
		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$title_1			 = ( isset( $instance[ 'title_1' ] ) ) ? $instance[ 'title_1' ] : '';
		$title_2			 = ( isset( $instance[ 'title_2' ] ) ) ? $instance[ 'title_2' ] : '';
		$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
		$title_description_1 = ( isset( $instance[ 'title_description_1' ] ) ) ? $instance[ 'title_description_1' ] : '';
		$title_description_2 = ( isset( $instance[ 'title_description_2' ] ) ) ? $instance[ 'title_description_2' ] : '';
		$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
		$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
		$button_text_1		 = ( isset( $instance[ 'button_text_1' ] ) ) ? $instance[ 'button_text_1' ] : '';
		$button_url_1		 = ( isset( $instance[ 'button_url_1' ] ) ) ? $instance[ 'button_url_1' ] : '';
		$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
		$form_header		 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';

		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$page_id		 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$bg_color		 = ( isset( $instance[ "bg_color" ] ) ) ? $instance[ "bg_color" ] : "#4285F4";
		$bg_color_1		 = ( isset( $instance[ "bg_color_1" ] ) ) ? $instance[ "bg_color_1" ] : "#4285F4";
		$bg_color_2		 = ( isset( $instance[ "bg_color_2" ] ) ) ? $instance[ "bg_color_2" ] : "#4285F4";

		$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
		$big_font_1		 = ( isset( $instance[ 'big_font_1' ] ) ) ? $instance[ 'big_font_1' ] : '';
		$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';

		$button_text_2	 = ( isset( $instance[ 'button_text_2' ] ) ) ? $instance[ 'button_text_2' ] : '';
		$button_href	 = ( isset( $instance[ 'button_href' ] ) ) ? $instance[ 'button_href' ] : '';

		$icon_container_1	 = ( isset( $instance[ 'icon_container_1' ] ) ) ? $instance[ 'icon_container_1' ] : '';
		$icon_color_1		 = ( isset( $instance[ 'icon_color_1' ] ) ) ? $instance[ 'icon_color_1' ] : '';

		$filled_buttons = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
		$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
		$mask_1			 = ( isset( $instance[ 'mask_1' ] ) ) ? $instance[ 'mask_1' ] : '';
		$animation			 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		
		for ( $i = 1; $i <= 3; $i++ ) {
			${'text_color_' . $i} = ( isset( $instance[ 'text_color_'.$i ] ) ) ? $instance[ 'text_color_'.$i ] : '';
		}
		
		$WG = new WidgetInputsGenerator();
        $forms   = class_exists( 'WPCF7_Mail' );
        if ( class_exists( 'GFCommon' ) ) {
          $GFforms = GFAPI::get_forms();  
        } else {
          $GFforms = "";
        }
		get_template_part( 'template-parts/icons' );
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
					<!-- Preview container -->
					<img src="">
					<!-- Stores prewiews directory path -->
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>
				

				<?php
					for($i=1; $i<=3; $i++){
						?>
							<li class="nav-item">
								<a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a>
							</li>
					<?php }
				?>
			</ul>
			<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>

			<!-- Tab panels -->
			<div class="tab-content">
				<!--Panel 1-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<!-- Main title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
						<br/>
					</div>
					<div class="widget_input">
						<?php $WG->textareaInput( 'title_description', ${'title_description'} , ' Content ', $this ); ?>
						<br/>
					</div>
					<div class="widget_input">
						<h4><?php _e('Text color: ','mdw'); ?></h4>
						<?php $WG->insertColorPicker( $this, ${'text_color_1'}, 'text_color_1' ) ;?>
						<br>
					</div>					
					<!-- /.Main title -->
					<!-- Main content -->
					
					<!-- /.Main content -->

					<div class="row">
						<div class="col-md-6">
							<!-- Image -->
							<?php $WG->imageInput( "background_image", $bg_image, "", 'Select Image', "", $bg_image, $this );?>
							<br>
							<div class='widget_input col-md-12'>
								<h4><?php _e('Default background color: ','mdw'); ?></h4>
								<br>
								<?php $WG->insertColorPicker( $this, ${'bg_color'}, 'bg_color' ) ;?>
								<br>
								<br>
							</div>

							<!-- Image -->
						</div>

						<div class="col-md-6">
							<!-- Button text -->
							<div class="widget_input">
								<?php $WG->textInput( 'button_text', ${'button_text'}, 'Button text', $this ) ?>
								<br/>
							<!-- /.Button text -->

							<!-- Button URL -->
							<div class="widget_input">
								<?php $WG->textInput( 'button_url', ${'button_url'}, 'Button URL', $this ) ?>
								<br/>
							</div>
							<!-- /.Button URL -->
							<fieldset class="widget_input form-group col-md-6">
								<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font', ${'big_font'} ); ?>
							</fieldset>
							<fieldset class="widget_input form-group col-md-6">
								<?php $WG->insertCheckBox( $this, 'Mask', 'mask', ${'mask'} ); ?>
							</fieldset>
								

							</div>
						</div>
					</div>
				</div>
				<!--/.Panel 1-->

				<!--Panel 2-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<!-- Main title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title_1', ${'title_1'}, 'Title', $this ) ?>
						<br/>
					</div>
					<div class="widget_input">
						<h4><?php _e('Text color: ','mdw'); ?></h4>
						<?php $WG->insertColorPicker( $this, ${'text_color_2'}, 'text_color_2' ) ;?>
						<br>
					</div>
					<!-- /.Main title -->

					<div class="row">
						<div class="col-md-6">
							<!-- Image -->
							
							<?php $WG->imageInput( "background_image_1", $bg_image_1, "", 'Select Image', "", $bg_image_1, $this );?>
							<br>
							<div class='widget_input col-md-12'>
								<h4><?php _e('Default background color: ','mdw'); ?></h4>
								<br>
								<?php $WG->insertColorPicker( $this, ${'bg_color_1'}, 'bg_color_1' ) ;?>
								<br>
							</div>
							<!-- Image -->

						</div>
						<div class="col-md-6">
							<!-- Button text -->
							<div class="widget_input">
								<?php $WG->textInput( 'button_text_1', ${'button_text_1'}, 'Button text', $this ) ?>
							<br/>
							</div>
							<!-- /.Button text -->

							<!-- Button URL -->
							<div class="widget_input">
								<?php $WG->textInput( 'button_url_1', ${'button_url_1'}, 'Button URL', $this ) ?>
								<br/>
							</div>
							<!-- /.Button URL -->
							<fieldset class="widget_input form-group col-md-6">
								<?php $WG->insertCheckBox( $this, 'Big Font', 'big_font_1', ${'big_font_1'} ); ?>
							</fieldset>
							<fieldset class="widget_input form-group col-md-6">
								<?php $WG->insertCheckBox( $this, 'Mask', 'mask_1', ${'mask_1'} ); ?>
							</fieldset>
						</div>
					</div>
				</div>
				<!--/.Panel 2-->
				<!--Panel 3-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
					<!-- Main title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title_2', ${'title_2'}, 'Title', $this ) ?>
						<br/>
					</div>
					<div class="widget_input">
						<h4><?php _e('Title color: ','mdw'); ?></h4>
						<?php $WG->insertColorPicker( $this, ${'text_color_3'}, 'text_color_3' ) ;?>
						<br>
					</div>
					<!-- Main content -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'title_description_2', ${'title_description_2'} , ' Content ', $this ); ?>
						<br/>
					</div>
					<!-- /.Main content -->
					
					<!-- /.Main title -->



					<div class="row">
						<div class="col-md-6" style="position:relative;">

						</div>

						<div class="col-md-6 offset-md-3">
							<!-- Button text -->
							<div class="widget_input">
								<?php $WG->textInput( 'button_text_2', ${'button_text_2'}, 'Button text', $this ) ?>
								<br/>
							</div>
							<!-- /.Button text -->

							<!-- Button href-->
							<div class="widget_input col-md-12">
								<?php $WG->textInput( 'button_href', ${'button_href'}, 'Button href ', $this ) ?>
								<br/>
							</div>
							<!-- /.Button href-->
							<fieldset class="widget_input form-group col-md-6">
								<?php $WG->insertCheckBox( $this, 'Filled', 'filled_buttons', ${'filled_buttons'} ); ?>
							</fieldset>
						</div>
						<div class="widget_input col-md-6" style="position:relative;">
							<?php $WG->insertIconContainers(  $this, ${'icon_container_1'} , ${'icon_color_1'}, 'icon_1', 'icon_color_1', 'icon_container_1' ) ?>
							<br/>
						</div>
					</div>

					<div class="widget_input">	
						<?php $WG->textInput( 'form_header', ${'form_header'}, 'Form header', $this ) ?>
						<br/>
					</div>
					<div class='widget_input'>
                        <label><?php _e( 'Choose contact form', 'mdw' ); ?></label>
                        <?php
                        $args        = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
                        $cf7Forms    = get_posts( $args );
                        ?>
                                <?php if ( !empty( $forms ) || !empty( $GFforms ) ) { ?>


                                    <select style="display:block" id="<?php echo $this->get_field_id( 'form' ); ?>" name="<?php echo $this->get_field_name( 'form' ); ?>">

                                        <?php
                                        foreach ( $cf7Forms as $cf7Form ) {

                                            $form_title  = $cf7Form->post_title;
                                            $form_id     = "" . $cf7Form->ID;
                                            $form_code   = '[contact-form-7 id="' . $form_id . '" title="' . $form_title . '"]';
                                            ?>
                                            <option <?php echo ( $form_code == $form ? 'selected' : '' ) ?>
                                                value='<?php echo ( $form_code ); ?>' >
                                                    <?php echo ( $form_title ); ?>
                                            </option>

                                        <?php }
                                         foreach ( $GFforms as $GFform ) {

                                            $form_title  = $GFform["title"];
                                            $form_id     = "" . $GFform['id'];
                                            $form_code   = '[gravityform id="' . $form_id . '" title="' . $form_title . '"]';
                                            ?>
                                            <option <?php echo ( $form_code == $form ? 'selected' : '' ) ?>
                                                value='<?php echo ( $form_code ); ?>' >
                                                    <?php echo ( $form_title ); ?>
                                            </option>

                                        <?php } ?>

                                            <option <?php echo ( "empty" == $form ? 'selected' : '' ) ?>
                                                value='<?php echo "empty" ?>' >
                                                    <?php echo ( "None" ); ?>
                                            </option>
                                    </select>
                                <?php } else { ?>
                            <p><?php echo __( 'In order to use this feature, you have to install, activate and configure ', 'mdw' ) . 'ContactForm7' . __( ' in plugin menu first.', 'mdw' ); ?></p>
                        <?php } ?>
					</div>


				</div>
				<!--/.Panel 3-->
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
				<input hidden class="title" id="<?php echo $this->get_field_id( 'page_id' ); ?>"
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
		$instance							 = array();
		$instance[ 'widget_id' ]			 = $this->id;
		$instance[ 'title' ]				 = (!empty( $new_instance[ 'title' ] ) ) ? $new_instance[ 'title' ] : '';
		$instance[ 'title_1' ]				 = (!empty( $new_instance[ 'title_1' ] ) ) ? $new_instance[ 'title_1' ] : '';
		$instance[ 'title_2' ]				 = (!empty( $new_instance[ 'title_2' ] ) ) ? $new_instance[ 'title_2' ] : '';
		$instance[ 'title_description' ]	 = (!empty( $new_instance[ 'title_description' ] ) ) ? $new_instance[ 'title_description' ] : '';
		$instance[ 'title_description_1' ]	 = (!empty( $new_instance[ 'title_description_1' ] ) ) ? $new_instance[ 'title_description_1' ] : '';
		$instance[ 'title_description_2' ]	 = (!empty( $new_instance[ 'title_description_2' ] ) ) ? $new_instance[ 'title_description_2' ] : '';
		$instance[ 'button_url' ]			 = (!empty( $new_instance[ 'button_url' ] ) ) ? $new_instance[ 'button_url' ] : '';
		$instance[ 'button_text' ]			 = (!empty( $new_instance[ 'button_text' ] ) ) ? $new_instance[ 'button_text' ] : '';
		$instance[ 'button_url_1' ]			 = (!empty( $new_instance[ 'button_url_1' ] ) ) ? $new_instance[ 'button_url_1' ] : '';
		$instance[ 'button_text_1' ]		 = (!empty( $new_instance[ 'button_text_1' ] ) ) ? $new_instance[ 'button_text_1' ] : '';
		$instance[ 'form' ]					 = (!empty( $new_instance[ 'form' ] ) ) ? ( $new_instance[ 'form' ] ) : '';
		$instance[ 'form_header' ]			 = (!empty( $new_instance[ 'form_header' ] ) ) ? ( $new_instance[ 'form_header' ] ) : '';

		$instance[ 'page_id' ]				 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
		$instance[ 'template_number' ]		 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '1';
		$instance[ 'big_font' ]				 = (!empty( $new_instance[ 'big_font' ] ) ) ? ( $new_instance[ 'big_font' ] ) : "";
		$instance[ 'big_font_1' ]			 = (!empty( $new_instance[ 'big_font_1' ] ) ) ? ( $new_instance[ 'big_font_1' ] ) : "";
		$instance[ 'filled_buttons' ]		 = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";
		$instance[ 'background_image' ]		 = (!empty( $new_instance[ 'background_image' ] ) ) ? strip_tags( $new_instance[ 'background_image' ] ) : '';
		$instance[ 'background_image_1' ]	 = (!empty( $new_instance[ 'background_image_1' ] ) ) ? strip_tags( $new_instance[ 'background_image_1' ] ) : '';
		$instance[ 'background_image_2' ]	 = (!empty( $new_instance[ 'background_image_2' ] ) ) ? strip_tags( $new_instance[ 'background_image_2' ] ) : '';
		$instance[ 'bg_color' ]				 = (!empty( $new_instance[ 'bg_color' ] ) ) ? strip_tags( $new_instance[ 'bg_color' ] ) : '';
		$instance[ 'bg_color_1' ]			 = (!empty( $new_instance[ 'bg_color_1' ] ) ) ? strip_tags( $new_instance[ 'bg_color_1' ] ) : '';
		$instance[ 'bg_color_2' ]			 = (!empty( $new_instance[ 'bg_color_2' ] ) ) ? strip_tags( $new_instance[ 'bg_color_2' ] ) : '';

		$instance[ 'button_text_2' ] = (!empty( $new_instance[ 'button_text_2' ] ) ) ? $new_instance[ 'button_text_2' ] : '';
		$instance[ 'button_href' ]	 = (!empty( $new_instance[ 'button_href' ] ) ) ? ( $new_instance[ 'button_href' ] ) : '';

		$instance[ 'icon_color_1' ]		 = (!empty( $new_instance[ 'icon_color_1' ] ) ) ? ( $new_instance[ 'icon_color_1' ] ) : '';
		$instance[ 'icon_container_1' ]	 = (!empty( $new_instance[ 'icon_container_1' ] ) ) ? ( $new_instance[ 'icon_container_1' ] ) : '';

		$instance[ 'filled_buttons' ] = (!empty( $new_instance[ 'filled_buttons' ] ) ) ? ( $new_instance[ 'filled_buttons' ] ) : "";
		$instance[ 'mask' ]			 = (!empty( $new_instance[ 'mask' ] ) ) ? ( $new_instance[ 'mask' ] ) : "";
		$instance[ 'mask_1' ]			 = (!empty( $new_instance[ 'mask_1' ] ) ) ? ( $new_instance[ 'mask_1' ] ) : "";
		$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";
		
		for ( $i = 1; $i <= 3; $i++ ) {
			$instance[ 'text_color_'.$i ]		 = (!empty( $new_instance[ 'text_color_'.$i ] ) ) ? ( $new_instance[ 'text_color_'.$i ] ) : "";

		}


		return $instance;
	}

}
// class My_Widget
