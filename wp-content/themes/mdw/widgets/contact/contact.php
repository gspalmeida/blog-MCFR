<?php
/*
  Plugin Name: Contact
  Plugin URI: http://mdwordpress.com
  Description: Widget displaying contact section.
  Author: MDWordPress.com
  Version: 4.0.0
  Author URI: http://mdwordpress.com
 */
// Block direct requests
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

add_action( 'widgets_init', function() {
	register_widget( 'MDW_Contact' );
} );

/**
 * MDW_Contact widget.
 */
class MDW_Contact extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
		'MDW_Contact', // Base ID
  __( 'MDW Contact', 'mdw' ), // Name
	  array( 'description'	 => __( 'Widget displaying contact section.', 'mdw' ),
			'category'		 => __( 'landing', 'mdw' )
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
			wp_register_style( 'contact-form-widget-mdw', get_template_directory_uri() . '/widgets/css/admin.css' );
			wp_enqueue_style( 'contact-form-widget-mdw' );

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
						$template = dirname( __DIR__ ) . '/contact/templates/contact-template-' . $i . '.php';
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
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
		$template_number = ( isset( $instance[ 'template_number' ] ) ) ? $instance[ 'template_number' ] : 1;
		$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
		$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
		$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

		/* General variables */
		$page_id			 = ( isset( $instance[ 'page_id' ] ) ) ? $instance[ 'page_id' ] : 'All pages';
		$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$main_content		 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
		$address			 = ( isset( $instance[ 'address' ] ) ) ? $instance[ 'address' ] : '';
		$country			 = ( isset( $instance[ 'country' ] ) ) ? $instance[ 'country' ] : '';
		$phone				 = ( isset( $instance[ 'phone' ] ) ) ? $instance[ 'phone' ] : '';
		$opening_hours		 = ( isset( $instance[ 'opening_hours' ] ) ) ? $instance[ 'opening_hours' ] : '';
		$email_1			 = ( isset( $instance[ 'email_1' ] ) ) ? $instance[ 'email_1' ] : '';
		$email_2			 = ( isset( $instance[ 'email_2' ] ) ) ? $instance[ 'email_2' ] : '';
		$lat				 = ( isset( $instance[ 'lat' ] ) ) ? $instance[ 'lat' ] : '';
		$lng				 = ( isset( $instance[ 'lng' ] ) ) ? $instance[ 'lng' ] : '';
		$zoom				 = ( isset( $instance[ 'zoom' ] ) ) ? $instance[ 'zoom' ] : '';
		$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
		$form_header		 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';
		$form_description	 = ( isset( $instance[ 'form_description' ] ) ) ? $instance[ 'form_description' ] : '';
		$map_api_key		 = ( isset( $instance[ 'map_api_key' ] ) ) ? $instance[ 'map_api_key' ] : '';
		$first_title		 = ( isset( $instance[ 'first_title' ] ) ) ? $instance[ 'first_title' ] : '';
		$second_title		 = ( isset( $instance[ 'second_title' ] ) ) ? $instance[ 'second_title' ] : '';
		$third_title		 = ( isset( $instance[ 'third_title' ] ) ) ? $instance[ 'third_title' ] : '';
        $what_to_feed = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts'; 
		$WG					 = new WidgetInputsGenerator();

//v3
        $name = ( isset( $instance[ 'name' ] ) ) ? $instance[ 'name' ] : '';
        $image = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
		$image_url = ( isset( $instance[ 'image_url' ] ) ) ? $instance[ 'image_url' ] : '';


		$amount = 3;

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"day_" . $i}		 = ( isset( $instance[ 'day_' . $i ] ) ) ? $instance[ 'day_' . $i ] : '';
			${"hour_" . $i}		 = ( isset( $instance[ 'hour_' . $i ] ) ) ? $instance[ 'hour_' . $i ] : '';
			${"icon_url_" . $i}	 = ( isset( $instance[ 'icon_url_' . $i ] ) ) ? $instance[ 'icon_url_' . $i ] : '';
		}

		$forms	 = class_exists( 'WPCF7_Mail' );
        if ( class_exists( 'GFCommon' ) ) {
          $GFforms = GFAPI::get_forms();  
        } else {
          $GFforms = "";
        }

        

		$amount	 = 3;

		for ( $i = 1; $i <= $amount; $i++ ) {

			${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
			${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
			${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '#607d8b';
			${"icon_text_" . $i}		 = ( isset( $instance[ 'icon_text_' . $i ] ) ) ? $instance[ 'icon_text_' . $i ] : '';
		}
		?>


		<?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation ); ?>

		<?php get_template_part( 'template-parts/icons' ); ?>
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

				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_1" class="nav-link <?php echo ($template_number == 1) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v1" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 1 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_2" class="nav-link <?php echo ($template_number == 2) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v2" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 2 <i class="fa fa-eye"></i></a>
				</li>
				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_3" class="nav-link <?php echo ($template_number == 3) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v3" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 3 <i class="fa fa-eye"></i></a>
				</li>
			</ul>

			<!-- Tab panels -->
			<div class="tab-content">

				<!--Contact V1 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
					<br>
					<!--Title -->


					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->

					<!--Main description -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'main_content', ${'main_content'}, ' Content ', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->

					<div>
						<div>
							<br>
							<!-- Addres -->
							<div class="widget_input col-md-6">
								<?php $WG->textInput( 'address', ${'address'}, 'address', $this ) ?>
								<br/>
							</div>
							<!-- Addres-->

							<!-- Country -->
							<div class="widget_input col-md-6">
								<?php $WG->textInput( 'country', ${'country'}, 'country', $this ) ?>
								<br/>
							</div>
							<!-- Country-->

							<!-- Phone -->
							<div class="widget_input col-md-6">
								<?php $WG->numberInput( 'phone', ${'phone'}, 'Phone', $this ) ?>
								<br/>
							</div>
							<!-- Phone -->

							<!-- Opening hours -->
							<div class="widget_input col-md-6">			
								<?php $WG->textareaInput( 'opening_hours', ${'opening_hours'}, ' Opening hours ', $this ); ?>
								<br/>
							</div>
							<!-- Opening hours-->

							<!-- Email 1 (top) -->
							<div class="widget_input col-md-6">
								<?php $WG->insertEmailInput( 'email_1', ${'email_1'}, 'Email 1', $this ) ?>
								<br/>
							</div>
							<!-- Email 1(top)-->

							<!-- Email 2 (top) -->
							<div class="widget_input col-md-6">
								<?php $WG->insertEmailInput( 'email_2', ${'email_2'}, 'Email 2', $this ) ?>
								<br/>
							</div>
							<!-- Email 2(top)-->

							<!-- ICONS -->

						
							<!-- /ICONS -->

							<!-- Form header -->
							<div class="widget_input col-md-6">
								<?php $WG->textInput( 'form_header', ${'form_header'}, 'Form header', $this ) ?>
								<br/>
							</div>
							<!-- Form header-->

							<!-- Form description -->
							<div class="widget_input col-md-6">
								<?php $WG->textInput( 'form_description', ${'form_description'}, 'Form description', $this ) ?>
								<br/>
							</div>
							<!-- Form description-->
							<!-- Form type -->
							<div class='widget_input col-md-6'>
								<label><?php _e( 'Choose contact form', 'mdw' ); ?></label>
								<?php
								$args		 = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
								$cf7Forms	 = get_posts( $args );
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

											$form_title	 = $GFform["title"];
											$form_id	 = "" . $GFform['id'];
											$form_code	 = '[gravityform id="' . $form_id . '" title="' . $form_title . '"]';
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
									<p><?php echo __( 'In order to use this feature, you have to install, activate and configure contact form plugin', 'mdw' ); ?></p>
								<?php } ?>
							</div>
							<!-- Form type -->

                            <ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
                                <li class="nav-item" id="posts-btn">
                                    <a class="nav-link <?php echo ($what_to_feed == 'posts' ? "active" : ''); ?>" data-toggle="tab" href="#" data-href="#posts" role="tab"><?php _e( 'Map', 'mdw' ); ?></a>
                                </li>
                                <li class="nav-item" id="custom-btn">
                                    <a class="nav-link <?php echo ($what_to_feed == 'custom' ? "active" : ''); ?>" data-toggle="tab" href="#" data-href="#custom" role="tab"><?php _e( 'Custom Image', 'mdw' ); ?></a>
                                </li>
                            </ul>

							<!-- Map key -->
                        <div class="tab-content col-md-12">
                            <div id="post-panel" <?php echo ($what_to_feed == 'custom' ? ' style="display:none"' : ''); ?>>
    							<div class="widget_input col-md-6">
    								<?php $WG->textInput( 'map_api_key', ${'map_api_key'}, 'Map API Key', $this ) ?>
    								<br/>
    								<a href='https://developers.google.com/maps/documentation/javascript/get-api-key'><?php _e( 'How to get an Api Key for my app?', 'mdw' ); ?></a>
    								<br/>
    							</div>
    							<!-- Map key -->

    							<!-- Latitude -->
    							<div class="widget_input col-md-6">
    								<?php $WG->textInput( 'lat', ${'lat'}, 'Latitude', $this ) ?>
    								<br/>
    							</div>
    							<!-- Latitude-->

    							<!-- Longtitude -->
    							<div class="widget_input col-md-6">
    								<?php $WG->textInput( 'lng', ${'lng'}, 'Longtitude', $this ) ?>
    								<br/>
    							</div>
    							<!-- Longtitude-->
                                <div class="widget_input col-md-6">
                                    <?php
                                    $options = array();
                                    for ( $i = 0; $i < 18; $i++ ) {
                                        $options[] = (
                                        array(
                                            'value'  => $i,
                                            'text'   => $i,
                                        )
                                        );
                                    }
                                    ?>
                                    <?php $WG->selectInput( 'zoom', $zoom, 'Zoom: ', $options, $this ) ?>
                                    <br/>
                                </div>
                                <!-- Zoom -->
								
                            </div>
									
						
							
								
			


                            <div id="custom-panel" <?php echo ($what_to_feed == 'posts' ? " style='display:none'" : ''); ?>>
                                <div class="widget_input">
                                <?php $WG->imageInput( "image", $image, "", 'Select Image', "", $image, $this );?>
                                <br/>
                                </div>
                            </div>
                            <!-- Zoom -->
							
							
                            <input style="visibility:hidden"
                                   id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>"
                                   name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>"
                                   value="<?php echo $what_to_feed; ?>"
                                   type="text">

						</div>
								<?php
							for ( $i = 1; $i <= 3; $i++ ) { ?>
								<div class ="col-md-4 widget_input">
										<?php $WG->insertIconContainers(  $this, ${'icon_container_'.$i} , ${'icon_color_'.$i}, 'icon_'.$i, 'icon_color_'.$i, 'icon_container_'.$i ); ?>
										</div>
										<?php $WG->textInput( 'icon_text_'.$i, ${'icon_text_'.$i}, 'Icon text ', $this ) ?>
										<?php $WG->textInput( 'icon_url_'.$i, ${'icon_url_'.$i}, 'Icon url ', $this ) ?>
										<br/>
							<?php } ?>
                        </div>

					</div>
				</div>
				<!--/.Contact V1 Panel-->

				<!--Contact V2 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
					<br>
					<!--Title -->
					<div class="widget_input">
						<?php $WG->textInput( 'title', ${'title'}, 'title', $this ) ?>
						<br/>
					</div>
					<!--/.Title -->
					
					<!--Main description -->
					<div class="widget_input">
						<?php $WG->textareaInput( 'main_content', ${'main_content'}, ' Content ', $this ); ?>
						<br/>
					</div>
					<!--/.Main description -->
						<div class="row">				
					<?php
					for ( $i = 1; $i <= 3; $i++ ) { ?>
						<div class ="col-md-4 widget_input">
								<?php $WG->insertIconContainers(  $this, ${'icon_container_'.$i} , ${'icon_color_'.$i}, 'icon_'.$i, 'icon_color_'.$i, 'icon_container_'.$i ); ?>
								</div>
								<?php $WG->textInput( 'icon_text_'.$i, ${'icon_text_'.$i}, 'Icon text ', $this ) ?>
								<br/>
					<?php } ?>
								
				</div>

					<!-- Form type -->
                    <div class='widget_input col-md-12'>
                        
                        <?php if ( !empty( $forms ) || !empty( $GFforms ) ) { 
							$args        = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
							$cf7Forms    = get_posts( $args );
							?>

							<label><?php _e( 'Choose contact form', 'mdw' ); ?></label>
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
                    <!-- Form type -->
				</div>
				<!--/.Contact V2 Panel-->
				<div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">

					<!--.Contact V3 Panel-->
					<div class="col-md-6">

						<?php $WG->textInput( 'first_title', ${'first_title'}, 'First Title', $this ) ?>
						<br/>
						<div class="col-md-6">
								<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
								<div>									
								<?php $WG->textInput( 'day_' . $i, ${'day_' . $i}, 'Days', $this ) ?>								
								</div>
								<br>
								<?php } ?>
						</div>
						<div class="col-md-6">
							<?php for ( $i = 1; $i <= $amount; $i++ ) { ?>
								<div>
									<?php $WG->textInput( 'hour_' . $i, ${'hour_' . $i}, 'Hours', $this ) ?>
								</div>
								<br>
							<?php } ?>
						</div>
					</div>
					

					<div class="col-md-3">
						<?php $WG->textInput( 'second_title', ${'second_title'}, 'Second Title', $this ); ?>
						<br>
							<?php $WG->textInput( 'address', ${'address'}, 'Address', $this ); ?>
						<br>
						<div class="">
						<?php $WG->textInput( 'country', ${'country'}, 'City', $this ); ?>
						</div>
						<br>
						<?php $WG->textInput( 'third_title', ${'third_title'}, 'Third Title', $this ); ?>
						<br>
							<?php $WG->textInput( 'name', ${'name'}, 'Name', $this ); ?>
						<br>
						<div class="">
							<?php $WG->textInput( 'phone', ${'phone'}, 'Phone', $this ); ?>
						</div>
						<div class="">
							<?php $WG->textInput( 'email_1', ${'email_1'}, 'Email', $this ); ?>
						</div>
						
						
					</div>
									
					<?php
					for ( $i = 1; $i <= 3; $i++ ) { ?>
						<div class ="col-md-4 widget_input">
								<?php $WG->insertIconContainers(  $this, ${'icon_container_'.$i} , ${'icon_color_'.$i}, 'icon_'.$i, 'icon_color_'.$i, 'icon_container_'.$i ); ?>
								</div>
								<?php $WG->textInput( 'icon_url_'.$i, ${'icon_url_'.$i}, 'Icon url ', $this ) ?>
					<?php } ?>
								
				
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

							<option <?php echo ( $page_id == 'All pages' ? 'selected' : ''); ?> value='All pages'><?php _e( "All pages", "mdw" ); ?></option>

								<?php foreach ( $pages as $page ) { ?>
								<option <?php echo ($page->ID == $page_id ? 'selected' : ''); ?> value="<?php echo $page->ID; ?>">
									<?php
									echo $page->post_title;
									if ( $page->post_title == "" ) {
										_e( "Empty title", 'mdw' );
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
					<label for="<?php echo $this->get_field_name( 'box_layout' ); ?>"><?php _e( "Box layout", 'mdw' ); ?></label>
					<br>
					<select id="<?php echo $this->get_field_id( 'box_layout' ); ?>" name="<?php echo $this->get_field_name( 'box_layout' ); ?>" value="<?php echo sanitize_text_field( $box_layout ); ?>">
						<option <?php echo ($box_layout == 'container') ? 'selected' : '' ?> value="container"><?php _e( "Boxed", 'mdw' ); ?></option>
						<option <?php echo ($box_layout == 'container-fluid') ? 'selected' : '' ?> value="container-fluid"><?php _e( "Full width", 'mdw' ); ?></option>
					</select>
				</div>
				<div class="col-md-12">
					<p <?php echo ( $widget_id != '' ? '' : 'style="display:none;"' ); ?>>
						Your widget ID is:
					<?php echo $widget_id; ?>
					</p>
				</div>
					
			</div>
		</div>
			<!--/.Contact V3 Panel-->
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

			$instance[ 'widget_id' ]		 = $this->id;
			$instance[ 'template_number' ]	 = (!empty( $new_instance[ 'template_number' ] ) ) ? ( $new_instance[ 'template_number' ] ) : '';
			$instance[ 'box_layout' ]		 = (!empty( $new_instance[ 'box_layout' ] ) ) ? ( $new_instance[ 'box_layout' ] ) : "";
			$instance[ 'animation' ]		 = (!empty( $new_instance[ 'animation' ] ) ) ? ( $new_instance[ 'animation' ] ) : "None";

			/* General variables */
			$instance[ 'title' ]			 = (!empty( $new_instance[ 'title' ] ) ) ? ( $new_instance[ 'title' ] ) : '';
			$instance[ 'main_content' ]		 = (!empty( $new_instance[ 'main_content' ] ) ) ? ( $new_instance[ 'main_content' ] ) : '';
			$instance[ 'address' ]			 = (!empty( $new_instance[ 'address' ] ) ) ? ( $new_instance[ 'address' ] ) : '';
			$instance[ 'phone' ]			 = (!empty( $new_instance[ 'phone' ] ) ) ? ( $new_instance[ 'phone' ] ) : '';
			$instance[ 'country' ]			 = (!empty( $new_instance[ 'country' ] ) ) ? ( $new_instance[ 'country' ] ) : '';
			$instance[ 'opening_hours' ]	 = (!empty( $new_instance[ 'opening_hours' ] ) ) ? ( $new_instance[ 'opening_hours' ] ) : '';
			$instance[ 'email_1' ]			 = (!empty( $new_instance[ 'email_1' ] ) ) ? ( $new_instance[ 'email_1' ] ) : '';
			$instance[ 'email_2' ]			 = (!empty( $new_instance[ 'email_2' ] ) ) ? ( $new_instance[ 'email_2' ] ) : '';
			$instance[ 'lat' ]				 = (!empty( $new_instance[ 'lat' ] ) ) ? ( $new_instance[ 'lat' ] ) : '';
			$instance[ 'lng' ]				 = (!empty( $new_instance[ 'lng' ] ) ) ? ( $new_instance[ 'lng' ] ) : '';
			$instance[ 'zoom' ]				 = (!empty( $new_instance[ 'zoom' ] ) ) ? ( $new_instance[ 'zoom' ] ) : '14';
			$instance[ 'form' ]				 = (!empty( $new_instance[ 'form' ] ) ) ? ( $new_instance[ 'form' ] ) : '';
			$instance[ 'form_header' ]		 = (!empty( $new_instance[ 'form_header' ] ) ) ? ( $new_instance[ 'form_header' ] ) : '';
			$instance[ 'form_description' ]	 = (!empty( $new_instance[ 'form_description' ] ) ) ? ( $new_instance[ 'form_description' ] ) : '';
			$instance[ 'map_api_key' ]		 = (!empty( $new_instance[ 'map_api_key' ] ) ) ? ( $new_instance[ 'map_api_key' ] ) : '';
			$instance[ 'page_id' ]			 = (!empty( $new_instance[ 'page_id' ] ) ) ? ( $new_instance[ 'page_id' ] ) : "All pages";
			$instance[ 'first_title' ]		 = (!empty( $new_instance[ 'first_title' ] ) ) ? ( $new_instance[ 'first_title' ] ) : "";
			$instance[ 'second_title' ]		 = (!empty( $new_instance[ 'second_title' ] ) ) ? ( $new_instance[ 'second_title' ] ) : "";
			$instance[ 'third_title' ]		 = (!empty( $new_instance[ 'third_title' ] ) ) ? ( $new_instance[ 'third_title' ] ) : "";
            $instance[ 'what_to_feed' ] = (!empty( $new_instance[ 'what_to_feed' ] ) ) ? ( $new_instance[ 'what_to_feed' ] ) : '';

			//v3
            $instance[ 'name' ] = (!empty( $new_instance[ 'name' ] ) ) ? ( $new_instance[ 'name' ] ) : "";
            $instance[ 'image' ] = (!empty( $new_instance[ 'image' ] ) ) ? ( $new_instance[ 'image' ] ) : "";
			$instance[ 'image_url' ] = (!empty( $new_instance[ 'image_url' ] ) ) ? ( $new_instance[ 'image_url' ] ) : "";

			$amount = 3;
			for ( $i = 1; $i <= $amount; $i++ ) {

				$instance[ 'day_' . $i ]		 = (!empty( $new_instance[ 'day_' . $i ] ) ) ? strip_tags( $new_instance[ 'day_' . $i ] ) : '';
				$instance[ 'hour_' . $i ]		 = (!empty( $new_instance[ 'hour_' . $i ] ) ) ? strip_tags( $new_instance[ 'hour_' . $i ] ) : '';
				$instance[ 'icon_url_' . $i ]	 = (!empty( $new_instance[ 'icon_url_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_url_' . $i ] ) : '';
			}

			$amount = 3;
			for ( $i = 1; $i <= $amount; $i++ ) {

				$instance[ 'icon_' . $i ]			 = (!empty( $new_instance[ 'icon_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_' . $i ] ) : '';
				$instance[ 'icon_container_' . $i ]	 = (!empty( $new_instance[ 'icon_container_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_container_' . $i ] ) : '';
				$instance[ 'icon_color_' . $i ]		 = (!empty( $new_instance[ 'icon_color_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_color_' . $i ] ) : '';

				$instance[ 'icon_text_' . $i ] = (!empty( $new_instance[ 'icon_text_' . $i ] ) ) ? strip_tags( $new_instance[ 'icon_text_' . $i ] ) : '';
			}

			return $instance;
		}

	}

// class My_Widget
