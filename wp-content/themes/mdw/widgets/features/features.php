<?php
/*
Plugin Name: Features
Plugin URI: http://mdwordpress.com
Description: Features
Author: MDWordpress.com
Version: 4.0.0
Author URI: http://mdwordpress.com
*/
// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');


add_action( 'widgets_init', function(){
    register_widget( 'MDW_Features' );
});
/**
 * Adds MDW_Version_1 widget.
 */
class MDW_Features extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'MDW_Features', // Base ID
            __('MDW Features', 'mdw'), // Name
            array( 'description' => __( 'Features', 'mdw' ),
                   'category' => __( 'landing', 'mdw' )
            ) // Args
        );

        add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );

    }

    function admin_setup(){

        wp_enqueue_media();
        wp_register_script('mdw-all-admin-scripts-js', get_template_directory_uri() . '/widgets/js/admin.js', array( 'jquery', 'media-upload', 'media-views' ), NULL, true );
        wp_enqueue_script('mdw-all-admin-scripts-js');
        wp_register_script( 'mdw-tabs', get_template_directory_uri() . '/js/tabs.js', NULL, NULL, true );
        wp_enqueue_script('mdw-tabs');
        wp_register_script( 'icon-picker', get_template_directory_uri() . '/js/icon-picker.js', NULL, NULL, true );
        wp_enqueue_script('icon-picker');
        wp_enqueue_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
        wp_enqueue_style('mdw-feature-v1-admin-css', get_template_directory_uri() . '/widgets/css/admin.css');
        wp_enqueue_style('mdw-feature-v1-icon_picker-css', get_template_directory_uri() . '/widgets/css/admin.css');
        wp_register_style( 'Admin_Widget_MDW', get_template_directory_uri() . '/css/admin-widget-mdw.css' );
        wp_enqueue_style('Admin_Widget_MDW');
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

      

        wp_register_style( 'Features_widget', get_template_directory_uri() . '/widgets/features/css/style.css' );
        wp_enqueue_style('Features_widget');

        $page_id = ( isset( $instance['page_id'] ) ) ? $instance['page_id'] : 'All pages';

        if (get_the_ID() == $page_id || $page_id == 'All pages') {
            echo $w_args['before_widget'];

          // use a template for the output so that it can easily be overridden by theme

          // read which template was chosen, if none, set first template

          $template_number = ( isset( $instance['template_number'] ) ) ? $instance['template_number'] : 1;

          // j == template count

          for ( $i = 1; $i <= 7; $i++ ) {

            // check if $i has value of chosen template in backend

            if ( $template_number == $i ) {

              // check for template in active theme

              $template = locate_template('template-'.$i.'.php');

              // if none found use widget template

              if ( $template == '' ) $template = dirname(__DIR__) . '/features/templates/features-template-'.$i.'.php';
            }
          }

          include ( $template );
          echo $w_args['after_widget'];
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
		$WG = new WidgetInputsGenerator();
        $animation = ( isset( $instance['animation'] ) ) ? $instance['animation'] : 'None';
        $widget_id = ( isset( $instance['widget_id'] ) ) ? $instance['widget_id'] : "";

        //v3 -------
        $widget_id = ( isset( $instance['widget_id'] ) ) ? $instance['widget_id'] :  '';
        $image = ( isset( $instance['image'] ) ) ? $instance['image'] : '';
        $image1 = ( isset( $instance['image1'] ) ) ? $instance['image1'] : '';

        $category = ( isset( $instance['category'] ) ) ? $instance['category'] :  'No categories';
        $posts_amount = ( isset( $instance['posts_amount'] ) ) ? $instance['posts_amount'] : 3;
        //----------

        //v4 -------
        $bg_image = ( isset( $instance['background_image'] ) ) ? $instance['background_image'] : '';
        //----------

        //v7
		for ( $i = 1; $i <= 6; $i++ ) {
			${'image_'.$i} = ( isset( $instance['image_'.$i] ) ) ? $instance['image_'.$i] : '';
			${'image_description_'.$i} = ( isset( $instance['image_description_'.$i] ) ) ? $instance['image_description_'.$i] : '';
			${'image_title_'.$i} = ( isset( $instance['image_title_'.$i] ) ) ? $instance['image_title_'.$i] : '';
			${'url_'.$i} = ( isset( $instance['url_'.$i] ) ) ? $instance['url_'.$i] : '';
		}	
        $template_number = ( isset( $instance['template_number'] ) ) ? $instance['template_number'] : 1;

        $what_to_feed = ( isset( $instance['what_to_feed'] ) ) ? $instance['what_to_feed'] : 'posts';

        $title = ( isset( $instance['title'] ) ) ? $instance['title'] : '';
        $main_content = ( isset( $instance['main_content'] ) ) ? $instance['main_content'] : '';
        $posts_per_page = ( isset( $instance['posts_per_page'] ) ) ? $instance['posts_per_page'] : 3;

        $background_image = ( isset( $instance['background_image'] ) ) ? $instance['background_image'] : 3;

        $box_layout = ( isset( $instance['box_layout'] ) ) ? $instance['box_layout'] : 'container';
        $fieldCount = ( isset( $instance['fieldCount'] ) ) ? $instance['fieldCount'] : '0';
        $read_more = ( isset( $instance['read_more'] ) ) ? $instance['read_more'] : 'yes';


        $img_title = ( isset( $instance['img_title'] ) ) ? $instance['img_title'] : '';
        $text_align = ( isset( $instance['text_align'] ) ) ? $instance['text_align'] : 'center';
        $img_align = ( isset( $instance['img_align'] ) ) ? $instance['img_align'] : 'left';

        $template_number = ( isset( $instance['template_number'] ) ) ? $instance['template_number'] : 1;

        $page_id = ( isset( $instance['page_id'] ) ) ? $instance['page_id'] : 'All pages';

        //v3 -----
        $amount = 3;
        for($i = 1; $i <= $amount; $i++){

          ${"name_" . $i} = ( isset( $instance["name_" . $i] ) ) ? $instance["name_" . $i] : "Title " . $i;
          ${"content_" . $i} = ( isset( $instance["content_" . $i] ) ) ? $instance["content_" . $i] : "Content " . $i;
          ${"link_url_" . $i} = ( isset( $instance["link_url_" . $i] ) ) ? $instance["link_url_" . $i] : "Link " . $i;
          ${"url_text_" . $i} = ( isset( $instance["url_text_" . $i] ) ) ? $instance["url_text_" . $i] : "Text " . $i;


        }
        //--------

        //v4 ---------
        $amount = 6;
        for($i = 1; $i <= $amount; $i++){
            ${"title_" . $i} = ( isset( $instance['title_' . $i] ) ) ? $instance['title_' . $i] :  '';
            ${"desc_" . $i} = ( isset( $instance['desc_' . $i] ) ) ? $instance['desc_' . $i] :  '';
            ${"post_icon_" . $i} = ( isset( $instance['post_icon_' . $i] ) ) ? $instance['post_icon_' . $i] :  '';
            ${"post_icon_container_" . $i} = ( isset( $instance['post_icon_container_' . $i] ) ) ? $instance['post_icon_container_' . $i] :  '';
            ${"post_icon_color_" . $i} = ( isset( $instance['post_icon_color_' . $i] ) ) ? $instance['post_icon_color_' . $i] :  '#607d8b';
        }
        //------------
		
		$tempSettingsArray = array(
			"name_",
			"slider_",
			"number_",
			"size_",
			"color_",
			"content_",
			"icon_",
			"icon_container_",
			"icon_color_",
			"desc_",
			"title_",
			"link_url_",
			"url_text_",
			"post_icon_",
			"post_icon_container_",
			"post_icon_color_",
			'image_',
			'image_description_',
			'image_title_',
			'url_'
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
    <?php get_template_part('template-parts/icons'); ?>
        <?php animations_dropdown( $this->get_field_name( 'animation' ), $this->get_field_id( 'animation' ), $animation );?>
            <div id="widget_page" class="titlepage_widget">
                <div class="inf-alert-to-click-save" style="display: none;">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  To move your items into this version click save.
                </div>
                <!-- Remember version of widget -->
                <input hidden id="<?php echo $this->get_field_id( 'template_number' ); ?>" name="<?php echo $this->get_field_name( 'template_number' ); ?>" value="<?php echo $template_number; ?>" type="text">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
                    <!-- Version preview -->
                    <div id="<?php echo $this->get_field_id( 'tooltip' ); ?>"> <img src=""> <span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename(dirname(__FILE__)) ?>"></span> </div>
                    <?php 
					// Generate version tabs//
					for ( $i = 1; $i <= 7; $i++ ) { ?>
						<li class="nav-item"> <a data-toggle="tooltip" data-prev="template_<?php echo $i; ?>" class="nav-link <?php echo ($template_number == $i) ? 'active' : '' ?>" data-toggle="tab" href="#" data-href="#v<?php echo $i; ?>" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version <?php echo $i; ?> <i class="fa fa-eye"></i></a> </li>	
					<?php } ?>					
                </ul>
                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 1-->
                    <div class="tab-pane fade <?php echo ($template_number == 1) ? 'active in' : '' ?>" id="v1" role="tabpanel">
                        <br>
                        <div class="widget_input col-md-12">
                            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                                <?php _e( 'Title:', 'mdw' ); ?>
                            </label>
								<?php $WG->textInput( 'title', ${'title'}, '', $this ) ?>
							<br/>	
						</div>
                        <div class="widget_input col-md-12">
                            <label for="<?php echo $this->get_field_id( 'main_content' ); ?>">
                                <?php _e( 'Content:', 'mdw' ); ?>
                            </label>
							<?php $WG->textareaInput( 'main_content', ${'main_content'} , '', $this ); ?>
							<br/>
						</div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
                            <li class="nav-item" id="posts-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'posts' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#posts" role="tab">
                                    <?php _e( 'Feed posts', 'mdw' ); ?>
                                </a>
                            </li>
                            <li class="nav-item" id="custom-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'custom' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#custom" role="tab">
                                    <?php _e( 'Customize', 'mdw' ); ?>
                                </a>
                            </li>
                        </ul>
                        <div>
                            <!--Posts panel-->
                            <div id="post-panel" <?php echo ($what_to_feed=='custom' ? ' style="display:none"' : ''); ?>>
                                <br>
                                <div class="widget_input col-md-12">
                                    <label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">
                                        <?php _e( 'Posts per page :', 'mdw' ); ?>
                                    </label>
                                    <?php $WG->numberInput( 'posts_per_page', ${'posts_per_page'}, '', $this ) ?>
									<br/>
								</div>
                                <!--Read more select-->
                                <div class="widget_input col-md-12">
                                    <label>
                                        <?php _e( 'Show read more button', 'mdw' ); ?>
                                    </label>
                                    <select style="display:block" id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>">
                                        <option <?php echo ( $read_more=='yes' ? 'selected' : ''); ?> value='yes'>Yes</option>
                                        <option <?php echo ( $read_more=='no' ? 'selected' : ''); ?> value='no'>No</option>
                                    </select>
                                </div>
                                <!--/.Read more select-->
                                <!--Post category dropdown select-->
                                <div class="widget_input col-md-12">
                                    <label>
                                        <?php _e( 'Categories:', 'mdw' ); ?>
                                    </label>
                                    <select style="display:block" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                                        <?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
                                            <option <?php echo ($term->term_id == $category ? 'selected' : ''); ?> value="
                                                <?php echo $term->term_id; ?>">
                                                    <?php
                                                      echo $term->name;
                                                    ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <!--/.Post category dropdown select-->
                            </div>
                            <!--/.Post panel-->
                            <!--Custom panel-->
                            <div id="custom-panel" <?php echo ($what_to_feed=='posts' ? ' style="display:none"' : ''); ?>>
                                <br>
                                <div class="widget_input col-md-6"> <span id="add-feature <?php echo $this->get_field_id( 'result' ); ?>" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e('Add feature', 'mdw'); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
                                <div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel1"><?php _e('Delete feature', 'mdw'); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
                                <input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
                                <input hidden="hidden" type="text" name="post">
                                <div id="<?php echo $this->get_field_name( 'result' ); ?>-panel1">
                                    <?php


                                for($i = 1; $i <= $fieldCount; $i++){ ?>
										<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Feature ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash red-text delete-the-feature pull-right" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
                                        <div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
											<?php $WG->insertIconContainers(  $this, ${'icon_container_'.$i} , ${'icon_color_'.$i}, 'icon_'.$i, 'icon_color_'.$i, 'icon_container_'.$i ) ?>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_id('name_'.$i) ?>">
                                                    <?php _e( 'Text: ', 'mdw' ); ?>
                                                </label>
												<?php $WG->textInput( 'name_'.$i, ${'name_'.$i}, '', $this ) ?>
												<br/>
                                            </div>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_id('content_'.$i); ?>">
                                                    <?php _e( 'Description: ', 'mdw' ); ?>
                                                </label>
												<?php $WG->textareaInput( 'content_'.$i, ${'content_'.$i} , ' ', $this ); ?>
												<br/>
                                            </div>
                                        </div>
                                        <?php }
                             ?>
                                </div>
                            </div>
                            <!--/.Custom panel-->
                            <input hidden id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>" name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>" value="<?php echo $what_to_feed; ?>" type="text"> </div>
                    </div>
                    <!--/.Panel 1-->
                    <!--Panel 2-->
                    <div class="tab-pane fade <?php echo ($template_number == 2) ? 'active in' : '' ?>" id="v2" role="tabpanel">
                        <br>
                        <div class="widget_input col-md-12">
                            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                                <?php _e( 'Title:', 'mdw' ); ?>
                            </label>
							<?php $WG->textInput( 'title', ${'title'}, '', $this ) ?>
							<br/>
                           </div>
                        <div class="widget_input col-md-12">
                            <label for="<?php echo $this->get_field_id( 'main_content' ); ?>">
                                <?php _e( 'Content:', 'mdw' ); ?>
                            </label>
							<?php $WG->textareaInput( 'main_content', ${'main_content'} , '', $this ); ?>
							<br/>
						</div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
                            <li class="nav-item" id="posts-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'posts' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#posts" role="tab">
                                    <?php _e( 'Feed posts', 'mdw' ); ?>
                                </a>
                            </li>
                            <li class="nav-item" id="custom-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'custom' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#custom" role="tab">
                                    <?php _e( 'Customize', 'mdw' ); ?>
                                </a>
                            </li>
                        </ul>
                        <div>
                            <!--Posts panel-->
                            <div id="post-panel" <?php echo ($what_to_feed=='custom' ? ' style="display:none"' : ''); ?>>
                                <br>
                                <div class="widget_input col-md-12">
                                    <label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">
                                        <?php _e( 'Posts per page :', 'mdw' ); ?>
                                    </label>
									<?php $WG->numberInput( 'posts_per_page', ${'posts_per_page'}, '', $this ) ?>
									<br/>
								</div>
                                <!--Read more select-->
                                <div class="widget_input col-md-12">
                                    <label>
                                        <?php _e( 'Show read more button', 'mdw' ); ?>
                                    </label>
                                    <select style="display:block" id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>">
                                        <option <?php echo ( $read_more=='yes' ? 'selected' : ''); ?> value='yes'>Yes</option>
                                        <option <?php echo ( $read_more=='no' ? 'selected' : ''); ?> value='no'>No</option>
                                    </select>
                                </div>
                                <!--/.Read more select-->
                                <!--Post category dropdown select-->
                                <div class="widget_input col-md-12">
                                    <label>
                                        <?php _e( 'Categories:', 'mdw' ); ?>
                                    </label>
                                    <select style="display:block" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                                        <?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
                                            <option <?php echo ($term->term_id == $category ? 'selected' : ''); ?> value="
                                                <?php echo $term->term_id; ?>">
                                                    <?php
                            echo $term->name;
                          ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <!--/.Post category dropdown select-->
                            </div>
                            <!--/.Post panel-->
                            <!--Custom panel-->
                            <div id="custom-panel" <?php echo ($what_to_feed=='posts' ? ' style="display:none"' : ''); ?>>
                                <br>
                                <div class="widget_input col-md-6"> <span id="add-feature" data-version="2" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e('Add feature', 'mdw'); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
                                <div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>-panel2"><?php _e('Delete feature', 'mdw'); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
                                <input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
                                <input hidden="hidden" type="text" name="post">
                                <div id="<?php echo $this->get_field_name( 'result' ); ?>-panel2">
                                    <?php

                            if(isset($instance['name_1'])){
                                for($i = 1; $i <= $fieldCount; $i++){ ?>
										<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Feature ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash red-text delete-the-feature pull-right" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
                                        <div id="<?php echo $this->get_field_id( 'slider_' . $i ) ?>" class="col-md-12" style='display:none;'>
                                            <?php $WG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i  ); ?>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_name('name_'.$i) ?>">
                                                    <?php _e( 'Text:', 'mdw' ); ?>
                                                </label>
												<?php $WG->textInput( 'name_'.$i, ${'name_'.$i}, '', $this ) ?>
												<br/>
											</div>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_name('content_'.$i); ?>">
                                                    <?php _e( 'Description:', 'mdw' ); ?>
                                                </label>
													<?php $WG->textareaInput( 'content_'.$i, ${'content_'.$i} , ' ', $this ); ?>
												<br/>
                                            </div>
                                            <div class='widget_input col-md-6'>
                                                <label for="<?php echo $this->get_field_name('link_url_'.$i) ?>">
                                                    <?php _e( 'Link URL:', 'mdw' ); ?>
                                                </label>
													<?php $WG->textInput( 'link_url_'.$i, ${'link_url_'.$i}, '', $this ) ?>
												<br/>
											</div>
                                            <div class='widget_input col-md-6'>
                                                <label for="<?php echo $this->get_field_name('url_text_'.$i) ?>">
                                                    <?php _e( 'Link text:', 'mdw' ); ?>
                                                </label>
													<?php $WG->textInput( 'url_text_'.$i, ${'url_text_'.$i}, '', $this ) ?>
												<br/>
											</div>
                                        </div>
                                        <?php }
                            }
                        ?>
                                </div>
                            </div>
                            <!--/.Custom panel-->
                            <input hidden id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>" name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>" value="<?php echo $what_to_feed; ?>" type="text"> 
						</div>
                    </div>
                    <!--/.Panel 2-->
                    <!--Panel 3-->
                    <div class="tab-pane fade <?php echo ($template_number == 3) ? 'active in' : '' ?>" id="v3" role="tabpanel">
                        <br>
                        <!--Main heading -->
                        <div class="widget_input col-md-12">
                            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                                <?php _e( 'Title:', 'mdw' ); ?>
                            </label>
								<?php $WG->textInput( 'title', ${'title'}, '', $this ) ?>
							<br/>	
						</div>
                        <!--/.Main heading -->
                        <!--Main description -->
                        <div class="widget_input col-md-12">
							<label for="<?php echo $this->get_field_id( 'title' ); ?>">
                                <?php _e( 'Content:', 'mdw' ); ?>
                            </label>
								<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
							<br/>
						</div>
                        <!--/.Main description -->
                        <!--Image -->
                        <div class="widget_input col-md-12">
							<div class="widget_input">						
								<?php $WG->imageInput( "image", $image, "", 'Select Image', '', $image, $this );?>
							</div>                     
                        </div>
                        <!--/.Image -->
                        <br>
                        <!--Align dropdown select-->
                        <div class="widget_input col-md-6">
                            <label>
                                <?php _e( 'Align text', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
                                <option <?php echo ( $text_align=='center' ? 'selected' : ''); ?> value='center'>
                                    <?php _e('Center', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='top' ? 'selected' : ''); ?> value='top'>
                                    <?php _e('Top', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='bottom' ? 'selected' : ''); ?> value='bottom'>
                                    <?php _e('Bottom', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Align dropdown select-->
                        <!--Image side select-->
                        <div class="widget_input col-md-6">
                            <label>
                                <?php _e( 'Align image', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('img_align'); ?>" name="<?php echo $this->get_field_name('img_align'); ?>">
                                <option <?php echo ( $img_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $img_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Image side select--><span class="col-md-12" style="height: 2rem;"></span>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-pills pills-ins col-md-12" role="tablist">
                            <li class="nav-item" id="posts-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'posts' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#posts" role="tab">
                                    <?php _e( 'Feed posts', 'mdw' ); ?>
                                </a>
                            </li>
                            <li class="nav-item" id="custom-btn">
                                <a class="nav-link <?php echo ($what_to_feed == 'custom' ? " active " : ''); ?>" data-toggle="tab" href="#" data-href="#custom" role="tab">
                                    <?php _e( 'Customize', 'mdw' ); ?>
                                </a>
                            </li>
                        </ul>
                        <!-- /. Nav tabs -->
                        <!-- Tab panels -->
                        <div class="tab-content">
                            <!--Custom panel -->
                            <div id="custom-panel" <?php echo ($what_to_feed=='posts' ? " style='display:none'" : ''); ?>>
                                <br>
                                <div class="widget_input col-md-6"> <span id="add-feature" name="<?php echo $this->get_field_name( 'result' ); ?>"><?php _e('Add feature ', 'mdw'); ?> <i class="fa fa-plus-circle blue-text"></i></span> </div>
                                <div class="widget_input col-md-6"> <span id="delete-feature" name="<?php echo $this->get_field_name( 'result' ); ?>"><?php _e('Delete feature', 'mdw'); ?> <i class="fa fa-minus-circle red-text"></i></span> </div>
                                <input hidden name="<?php echo $this->get_field_name( 'fieldCount' ); ?>" type="text" value="<?php echo $fieldCount ?>" id="<?php echo $this->get_field_name( 'fieldCount' ); ?>">
                                <input hidden="hidden" type="text" name="post">
                                <div id="<?php echo $this->get_field_name( 'result' ); ?>">
                        <?php

						if(isset($instance['name_1'])){
							for($i = 1; $i <= $fieldCount; $i++){ ?>
								<h4 id='toggler' class="col-md-12" onclick='jQuery( this ).next().stop().slideToggle();'><?php _e( 'Feature ', 'mdw' ); ?> <?php echo $i ?> <i class="fa fa-trash red-text delete-the-feature pull-right" name="<?php echo $this->get_field_name( 'delete-the-feature' ); ?>"></i> <i class="pull-right fa fa-caret-down"></i></h4>
                                    <div id="<?php echo $this->get_field_name('slider_'.$i); ?>" class="col-md-12" style="display:none;">
                                        <?php $WG->insertIconContainers( $this, ${'icon_container_' . $i}, ${'icon_color_' . $i}, "icon_".$i, "icon_color_".$i, "icon_container_".$i  ); ?>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_name('name_'.$i); ?>">
                                                    <?php _e( 'Text: ', 'mdw' ); ?>
                                                </label>
													<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
													<br/>
											</div>
                                            <div class='widget_input col-md-12'>
                                                <label for="<?php echo $this->get_field_name('content_'.$i); ?>">
                                                    <?php _e( 'Description: ', 'mdw' ); ?>
                                                </label>
													<?php $WG->textareaInput( 'content_' . $i, ${'content_' . $i} , '', $this ); ?>
													<br/>
                                            </div>
                                        </div>
							<?php }
						} ?>
								</div>
                            </div>
                            <!--/.Custom panel-->
							
                            <!--Posts panel-->
                            <div id="post-panel" <?php echo ($what_to_feed=='custom' ? ' style="display:none"' : ''); ?>>
                                <!-- style set for tabs to work, this one is hidden by default -->
                                <br>
                                <!--Excerpt or content-->
                                <div class='widget_input'> </div>
                                <!--/.Excerpt or content-->
                                <!--Posts amount -->
                                <div class="widget_input col-md-12">
                                    <label for="<?php echo $this->get_field_id( 'posts_amount' ); ?>">
                                        <?php _e( 'Posts per page :', 'mdw' ); ?>
                                    </label>
										<?php $WG->numberInput( 'posts_amount', ${'posts_amount'}, '', $this ) ?>
									<br/>
								</div>
                                <!--/.Posts amount -->
                                <!--Post category dropdown select-->
                                <div class="widget_input col-md-12">
                                    <label>
                                        <?php _e( 'Categories:', 'mdw' ); ?>
                                    </label>
                                    <select style="display:block" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                                        <?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
                                            <option <?php echo ($term->term_id == $category ? 'selected' : ''); ?> value="
                                                <?php echo $term->term_id; ?>">
                                                    <?php
													echo $term->name; ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <!--/.Post category dropdown select-->
                                <br>
                      <?php
                      $amount = 3;
                      for ( $i = 1; $i <= $amount; $i++ ) { ?>
                                    <!-- Feature <?php echo $i ?> icon -->
								<div class="widget_input col-md-4">
									<?php $WG->insertIconContainers( $this, ${'post_icon_container_' . $i}, ${'post_icon_color_' . $i}, "post_icon_".$i, "post_icon_color_".$i, "post_icon_container_".$i  ); ?>
								</div>
                                    <?php } ?>
                            </div>
                            <!--/.Posts panel-->
                        </div>
                        <input style="visibility:hidden" id="<?php echo $this->get_field_id( 'what_to_feed' ); ?>" name="<?php echo $this->get_field_name( 'what_to_feed' ); ?>" value="<?php echo $what_to_feed; ?>" type="text"> </div>
                    <!--/.Panel 3-->
                    <!--Panel 4-->
                    <div class="tab-pane fade <?php echo ($template_number == 4) ? 'active in' : '' ?>" id="v4" role="tabpanel">
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget_input col-md-12">
                                        <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                                            <?php _e( 'Title :', 'mdw' ); ?>
                                        </label>
											<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
										<br/>
									</div>
								</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget_input col-md-12">
                                        <label for="<?php echo $this->get_field_id( 'main_content' ); ?>">
                                            <?php _e( 'Description :', 'mdw' ); ?>
                                        </label>
											<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
											<br/>
									</div>
                                </div>
                            </div>
						
							</div>
							<div class="col-md-4">
								<?php for($i =1 ; $i<=3; $i++){ ?>

									<div class="widget_input">
										<?php
										$WG->textInput( 'title_'.$i, ${'title_'.$i}, 'Title', $this );
										echo '<br/>';
										$WG->insertIconContainers( $this, ${'post_icon_container_' . $i}, ${'post_icon_color_' . $i}, "post_icon_".$i, "post_icon_color_".$i, "post_icon_container_".$i  );
										echo '<br/>';
										$WG->textareaInput( 'desc_'.$i, ${'desc_'.$i} , ' Content ', $this );
										echo '<br/>'; ?>
									</div>
								<?php } ?>	
							</div>
							<div class="widget_input col-md-4">
								<?php $WG->imageInput( "background_image", $background_image, "", 'Select Image', '', $background_image, $this ); ?>
							</div>
							<div class="col-md-4">
							<?php for ( $i = 4; $i <= 6; $i++ ) { ?>
								<div class="widget_input">
									<?php
									$WG->textInput( 'title_'.$i, ${'title_'.$i}, 'Title', $this );
									echo '<br/>';
									$WG->insertIconContainers( $this, ${'post_icon_container_' . $i}, ${'post_icon_color_' . $i}, "post_icon_".$i, "post_icon_color_".$i, "post_icon_container_".$i  );
									echo '<br/>';
									$WG->textareaInput( 'desc_'.$i, ${'desc_'.$i} , ' Content ', $this );
									echo '<br/>'; ?>
								</div>
							<?php } ?>	
							</div>
									
                        </div>
                    </div>
                    <!--/.Panel 4-->
                    <!--Panel 5-->
                    <div class="tab-pane fade <?php echo ($template_number == 5) ? 'active in' : '' ?>" id="v5" role="tabpanel">
                        <br>
                        <br>
                        <!--Main heading -->
                        <div class="widget_input col-md-12">
							<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
							<br/>
						</div>
                        <!--/.Main heading -->
						<div class="col-md-12">
							<div class="widget_input">						
								<?php $WG->imageInput( "image1", $image1, "", 'Select Image', '', $image1, $this );?>
							</div>                     
                        </div>
                        <div class="row">
                            <!--Image -->

							<br>
                            <!--/.Image -->
                            <div class="col-md-6">
                                <!--Image title -->
                                <div class="widget_input col-md-12">
									<?php $WG->textInput( 'img_title', ${'img_title'}, 'Heading', $this ) ?>
									<br/>
								</div>
                                <!--/.Image title -->
                                <!--Main description -->
                                <div class="widget_input col-md-12">
									<?php $WG->textareaInput( 'main_content', ${'main_content'} , 'Content ', $this ); ?>
									<br/>
								</div>
                                <!--/.Main description -->
                            </div>
                        </div>
                        <br>
                        <!--Image side select-->
                        <div class="widget_input col-md-6">
                            <label>
                                <?php _e( 'Align image', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('img_align'); ?>" name="<?php echo $this->get_field_name('img_align'); ?>">
                                <option <?php echo ( $img_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $img_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Image side select-->
                        <!--Align dropdown select-->
                        <div class="widget_input col-md-6">
                            <label>
                                <?php _e( 'Align text', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
                                <option <?php echo ( $text_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='center' ? 'selected' : ''); ?> value='center'>
                                    <?php _e('Center', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Align dropdown select--><span class="col-md-12" style="height: 2rem;"></span> </div>
                    <!--/.Panel 5-->
                    <!--Panel 6-->
                    <div class="tab-pane fade <?php echo ($template_number == 6) ? 'active in' : '' ?>" id="v6" role="tabpanel">
                        <br>
                        <br>
                        <!--Main heading -->
                        <div class="widget_input col-md-12">
							<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
							<br/>
						</div>
						     <div class="row">
                                <div class="col-md-12">
                                    <div class="widget_input col-md-12">
                                        <label for="<?php echo $this->get_field_id( 'main_content' ); ?>">
                                            <?php _e( 'Description :', 'mdw' ); ?>
                                        </label>
										<?php $WG->textareaInput( 'main_content', ${'main_content'} , '', $this ); ?>
										<br/>
									</div>
                                </div>
                            </div>
                        <!--/.Main heading -->
                        <div class="row">
                            <!--Image -->
                            <div class="widget_input col-md-12">
								<?php $WG->imageInput( "image", $image, "", 'Select Image', '', $image, $this );?>
                            </div>
                        </div>
                        <br>
                   
                        <!--Image side select-->
                        <div class="widget_input col-md-12">
                            <label>
                                <?php _e( 'Align image', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('img_align'); ?>" name="<?php echo $this->get_field_name('img_align'); ?>">
                                <option <?php echo ( $img_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $img_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Image side select-->
                        <!--Align dropdown select-->
                        <div class="widget_input col-md-12">
                            <label>
                                <?php _e( 'Align text', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
                                <option <?php echo ( $text_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='center' ? 'selected' : ''); ?> value='center'>
                                    <?php _e('Center', 'mdw'); ?>
                                </option>
                            </select>
                        </div>
                        <!--/.Align dropdown select--><span class="col-md-12" style="height: 2rem;"></span> 
					</div>
                    <!--/.Panel 6-->
                    <!--Panel 7-->
                    <div class="tab-pane fade <?php echo ($template_number == 7) ? 'active in' : '' ?>" id="v7" role="tabpanel">
                        <br>
                        <br>
                        <!--Main heading -->
                        <div class="widget_input col-md-12">
							<?php $WG->textInput( 'title', ${'title'}, 'Title', $this ) ?>
							<br/>
						</div>
                         <div class="widget_input col-md-12">
							<?php $WG->textareaInput( 'main_content', ${'main_content'} , ' Content ', $this ); ?>
							<br/>
						</div>
                        <!--/.Main heading -->
						<div class="row">            
							<?php //generate image, image title, image description, image url inputs
							for ( $i = 1; $i <= 6; $i++ ) { ?>
								<div class="widget_input col-md-4 ">
									<div class="widget_input">
										<?php $WG->imageInput( "image_".$i, ${'image_'.$i}, "", 'Select Image', '', ${'image_'.$i}, $this ); ?>
									</div>
									<div class="widget_input">
										<?php $WG->textInput( 'image_title_'.$i, ${'image_title_'.$i}, 'Image '.$i. ' title:', $this ); ?>
										<br/>
									</div>
									<div class="widget_input">
										<?php $WG->textInput( 'image_description_'.$i, ${'image_description_'.$i}, 'Image '. $i.' description:', $this ); ?>
										<br/>
									</div>
									<div class="widget_input">
										<?php $WG->textInput( 'url_'.$i, ${'url_'.$i}, 'Image '. $i.' url:', $this ); ?>
										<br/>
									</div>
								</div> 
							<?php } ?>
						</div>
                        <br>
						<!--Image side select-->
						<div class="widget_input col-md-6">
							<label>
								<?php _e( 'Align image', 'mdw' ); ?>
							</label>
							<select style="display:block" id="<?php echo $this->get_field_id( 'img_align' ); ?>" name="<?php echo $this->get_field_name( 'img_align' ); ?>">
								<option <?php echo ( $img_align == 'left' ? 'selected' : ''); ?> value='left'>
									<?php _e( 'Left', 'mdw' ); ?>
								</option>
								<option <?php echo ( $img_align == 'right' ? 'selected' : ''); ?> value='right'>
									<?php _e( 'Right', 'mdw' ); ?>
								</option>
							</select>
						</div>
                        <!--/.Image side select-->
                        <!--Align dropdown select-->
                        <div class="widget_input col-md-6">
                            <label>
                                <?php _e( 'Align text', 'mdw' ); ?>
                            </label>
                            <select style="display:block" id="<?php echo $this->get_field_id('text_align'); ?>" name="<?php echo $this->get_field_name('text_align'); ?>">
                                <option <?php echo ( $text_align=='left' ? 'selected' : ''); ?> value='left'>
                                    <?php _e('Left', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='right' ? 'selected' : ''); ?> value='right'>
                                    <?php _e('Right', 'mdw'); ?>
                                </option>
                                <option <?php echo ( $text_align=='center' ? 'selected' : ''); ?> value='center'>
                                    <?php _e('Center', 'mdw'); ?>
                                <!--</option>-->
                            </select>
                        </div>
                        <!--/.Align dropdown select--><span class="col-md-12" style="height: 2rem;"></span>
					</div>
                    <!--/.Panel 7-->
                </div>
                <?php

		$pages = get_pages(array(
			'meta_key' => '_wp_page_template'
		));

		$how_many_pages = count($pages);

		if ($how_many_pages > 1) { ?>
			<!--Site dropdown select-->
			<div class="widget_input col-md-12">
			<label>
				<?php _e( 'Page to display widget: ', 'mdw' ); ?>
			</label>
			<select style="display:block" id="<?php echo $this->get_field_id('page_id'); ?>" name="<?php echo $this->get_field_name('page_id'); ?>">
				<option <?php echo ( $page_id=='All pages' ? 'selected' : ''); ?> value='All pages'>
					<?php _e('All pages', 'mdw'); ?>
				</option>
				<?php
				foreach($pages as $page) {?>
					<option <?php echo ($page->ID == $page_id ? 'selected' : ''); ?> value="<?php echo $page->ID; ?>">
						<?php echo $page->post_title;
						if($page->post_title == ""){
							echo "(empty title)";
						}?>
					</option>
					<?php } ?>
			</select>
			</div>
				<!--/.Site dropdown select-->
				<?php
		}
		if($how_many_pages == 1){ ?>
			<input hidden class="title_text" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>" type="number" value="<?php foreach($pages as $page) { echo $page->ID; }?>">
			<br/>
        <?php } ?>

		<div class="widget_input col-md-12">
			<label for="<?php echo $this->get_field_name( 'box_layout' ); ?>">
				<?php _e('Box layout', 'mdw'); ?>
			</label>
			<br>
			<select id="<?php echo $this->get_field_id( 'box_layout' ); ?>" name="<?php echo $this->get_field_name( 'box_layout' ); ?>" value="<?php echo sanitize_text_field( $box_layout ); ?>">
				<option <?php echo ($box_layout=='container' ) ? 'selected' : '' ?> value="container">
					<?php _e('Boxed', 'mdw'); ?>
				</option>
				<option <?php echo ($box_layout=='container-fluid' ) ? 'selected' : '' ?> value="container-fluid">
					<?php _e('Full width', 'mdw'); ?>
				</option>
			</select>
		</div>
		<p <?php echo ( $widget_id !='' ? '' : 'style="display:none;"' ); ?>> Your widget ID is:
			<?php echo $widget_id; ?>
		</p>
            </div>
<?php }
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

        $instance['template_number'] = ( ! empty( $new_instance['template_number'] ) ) ?  ( $new_instance['template_number'] )  : '1';

      $instance['box_layout'] = ( ! empty( $new_instance['box_layout'] ) ) ?  ( $new_instance['box_layout'] )  : "";

      //v3 -------------
        $instance['widget_id'] = $this->id;
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? ( $new_instance['image'] ) : '';
        $instance['image1'] = ( ! empty( $new_instance['image1'] ) ) ? ( $new_instance['image1'] ) : '';

        /* Post feed variables */
        $instance['posts_amount'] = ( ! empty( $new_instance['posts_amount'] ) ) ?  ( $new_instance['posts_amount'] )  : 3;
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ?  ( $new_instance['category'] )  : '3';
      //----------------

        $instance['what_to_feed'] = ( ! empty( $new_instance['what_to_feed'] ) ) ? ( $new_instance['what_to_feed'] ) : 'posts' ;

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['main_content'] = ( ! empty( $new_instance['main_content'] ) ) ? $new_instance['main_content'] : '';
        $instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? strip_tags( $new_instance['posts_per_page'] ) : '';

        $instance['fieldCount'] = ( ! empty( $new_instance['fieldCount'] ) ) ? strip_tags( $new_instance['fieldCount'] ) : '0';

        $instance['read_more'] = ( ! empty( $new_instance['read_more'] ) ) ? strip_tags( $new_instance['read_more'] ) : 'yes';

        $instance['img_title'] = ( ! empty( $new_instance['img_title'] ) ) ? strip_tags( $new_instance['img_title'] ) : '';
        $instance['text_align'] = ( ! empty( $new_instance['text_align'] ) ) ? strip_tags( $new_instance['text_align'] ) : 'center';
        $instance['img_align'] = ( ! empty( $new_instance['img_align'] ) ) ? strip_tags( $new_instance['img_align'] ) : 'center';

        $instance['page_id'] = ( ! empty( $new_instance['page_id'] ) ) ?  ( $new_instance['page_id'] )  : "All pages";
        $instance['animation'] = ( ! empty( $new_instance['animation'] ) ) ?  ( $new_instance['animation'] )  : "None";


      //v3 -----------
        $amount = $instance['what_to_feed'] == 'custom' ? $instance['fieldCount'] : 3;

        for ( $i = 1; $i <= $amount; $i++ ){

          $instance['name_' . $i] = ( ! empty ( $new_instance['name_' . $i] ) ) ? ( $new_instance['name_' . $i] ) : '';
          $instance['content_' . $i] = ( ! empty ( $new_instance['content_' . $i] ) ) ? ( $new_instance['content_' . $i] ) : '';
          $instance['link_url_' . $i] = ( ! empty ( $new_instance['link_url_' . $i] ) ) ? ( $new_instance['link_url_' . $i] ) : '';
          $instance['url_text_' . $i] = ( ! empty ( $new_instance['url_text_' . $i] ) ) ? ( $new_instance['url_text_' . $i] ) : '';

        }
      //--------------

      //v4 -----------
        $amount = 6;
        $instance['background_image'] = ( ! empty( $new_instance['background_image'] ) ) ? ( $new_instance['background_image'] ) : '';

        for($i = 1; $i <= $amount; $i++){
            $instance['title_' . $i] = ( ! empty( $new_instance['title_' . $i] ) ) ? strip_tags( $new_instance['title_' . $i] ) :  '';
            $instance['desc_' . $i] = ( ! empty( $new_instance['desc_' . $i] ) ) ? strip_tags( $new_instance['desc_' . $i] ) :  '';
            $instance['post_icon_' . $i] = ( ! empty( $new_instance['post_icon_' . $i] ) ) ? strip_tags( $new_instance['post_icon_' . $i] ) :  '';
            $instance['post_icon_container_' . $i] = ( ! empty( $new_instance['post_icon_container_' . $i] ) ) ? strip_tags( $new_instance['post_icon_container_' . $i] ) :  '';
            $instance['post_icon_color_' . $i] = ( ! empty( $new_instance['post_icon_color_' . $i] ) ) ? strip_tags( $new_instance['post_icon_color_' . $i] ) :  '';
        }
      //------------- 
	  $tempSettingsArray = array(
			"name_",
			"slider_",
			"number_",
			"size_",
			"color_",
			"content_",
			"icon_",
			"icon_container_",
			"icon_color_",
			"desc_",
			"title_",
			"link_url_",
			"url_text_",
			"post_icon_",
			"post_icon_container_",
			"post_icon_color_",
		  	'image_',
			'image_description_',
			'image_title_',
			'url_'
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
} // class My_Widget