<?php

###########################################################################################
####                                                                                   ####
####                           P A G E  G E N E R A T O R                              ####
####                                                                                   ####
###########################################################################################

/**
 * Loads Demo Landing Page to your wordpress 
 */
function load_landing_page() {

	$data = array(
		'page_id'		 => array(),
		'widgets'		 => array(),
		'posts'			 => array(),
		'categories'	 => array(),
		'attachments'	 => array(),
		'templates'		 => array()
	);

	$landing_page_id = wp_insert_post( array(
		'post_type'		 => 'page',
		'post_title'	 => 'landing-page-demo',
		'post_status'	 => 'publish'
	) );
	add_post_meta( $landing_page_id, '_wp_page_template', 'template-landing-page.php' );

	$data[ 'page_id' ][]	 = $landing_page_id;
	$data[ 'templates' ][]	 = 'landing-page';

	$widgets = array(
		'widget_mdw_intro_cta_0'			 => array(
			'temp_sidebar'		 => 'intro_area',
			'widget_id'			 => 'mdw_intro_cta',
			'page_id'			 => $landing_page_id,
			'title'				 => 'Software Landing Page',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti consequuntur, nihil voluptatem modi nobis veniam illum doloremque aliquid.',
			'image'				 => 'http://mdbootstrap.com/img/Photos/Horizontal/Technology/full%20page/1.jpg',
			'big_font'			 => 'checked',
			'mask'				 => 'checked',
			'icon_container_1'	 => 'fa fa-cube',
			'icon_color_1'		 => '#00bcd4',
			'button_text_1'		 => 'View live demo',
			'button_href_1'		 => '#',
			'icon_container_2'	 => 'fa fa-magic',
			'icon_color_2'		 => '#f06292',
			'button_text_2'		 => 'Explore features',
			'button_href_2'		 => '#'
		),
		'widget_mdw_features_1'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_features',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'what_to_feed'		 => 'custom',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => 'Features',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad voluptas, animi obcaecati adipisci sapiente mollitia? Autem delectus quod accusamus tempora.',
			'fieldCount'		 => 3,
			'icon_container_1'	 => 'fa fa-gears',
			'icon_color_1'		 => '#cc1199',
			'name_1'			 => 'Customization',
			'content_1'			 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.',
			'icon_container_2'	 => 'fa fa-book',
			'icon_color_2'		 => '#5ec2d5',
			'name_2'			 => 'Tutorials',
			'content_2'			 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.',
			'icon_container_3'	 => 'fa fa-group',
			'icon_color_3'		 => '#0080ff',
			'name_3'			 => 'Support',
			'content_3'			 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.'
		),
		'widget_mdw_divider_2'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => '',
			'color'				 => '#dbdbdb'
		),
		'widget_mdw_downloader_3'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_downloader',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'text_align'		 => 'left',
			'img_align'			 => 'left',
			'title'				 => 'Powerful Material Design UI KIT',
			'content'			 => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
			'image'				 => 'http://mdbootstrap.com/img/Mockups/Transparent/Small/ipad2.jpg',
			'filled_buttons'	 => 'checked',
			'main_title'		 => 'GET FREE SUPPORT',
			'button_text'		 => 'Get software',
			'button_href'		 => '#',
			'icon_color_1'		 => '#0dcbec',
			'icon_container_1'	 => 'fa fa-download'
		),
		'widget_mdw_divider_4'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => '',
			'color'				 => '#dbdbdb'
		),
		'widget_mdw_downloader_5'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_downloader',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'text_align'		 => 'left',
			'img_align'			 => 'right',
			'title'				 => 'Get The Most Amazing Builder',
			'content'			 => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
			'image'				 => 'http://mdbootstrap.com/img/Mockups/Transparent/Small/ipad8.png',
			'filled_buttons'	 => 'checked',
			'main_title'		 => 'MANY FREE TEMPLATES',
			'button_text'		 => 'Live demo',
			'button_href'		 => '#',
			'icon_color_1'		 => '#4285F4',
			'icon_container_1'	 => 'fa fa-eye'
		),
		'widget_mdw_divider_6'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => '',
			'color'				 => '#dbdbdb'
		),
		'widget_mdw_testimonials_7'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_testimonials',
			'template_number'	 => '3',
			'fieldCount'		 => '3',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => 'What Clients said:',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam.',
			'name_1'			 => 'Anna Deynah',
			'quote_1'			 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab.',
			'color_1'			 => '#607d8b',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Avatars/img%20%2820%29.jpg',
			'job_1'				 => 'Web Designer',
			'name_2'			 => 'John Doe',
			'quote_2'			 => 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi.',
			'color_2'			 => '#607d8b',
			'image_2'			 => 'http://mdbootstrap.com/img/Photos/Avatars/img%20%289%29.jpg',
			'job_2'				 => 'Web Developer',
			'name_3'			 => 'Maria Kate',
			'quote_3'			 => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.',
			'color_3'			 => '#607d8b',
			'image_3'			 => 'http://mdbootstrap.com/img/Photos/Avatars/img%20%2817%29.jpg',
			'job_3'				 => 'Photographer'
		),
		'widget_mdw_divider_8'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => '',
			'color'				 => '#dbdbdb'
		),
		'widget_mdw_full_width_section_9'	 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_full_width_section',
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => 'Take a Quick Look',
			'title_description'	 => 'The Best Companies Trust Our Digital Goods',
			'background_image'	 => 'http://mdbootstrap.com/img/Photos/Horizontal/Technology/full%20page/1.jpg',
			'big_font'			 => 'checked'
		),
		'widget_mdw_media_10'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_media',
			'template_number'	 => '2',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'icon_container'	 => 'fa fa-flag-checkered chosen',
			'icon_color'		 => '#4285F4',
			'video'				 => 'https://www.youtube.com/watch?v=vlDzYIIOYmM',
			'title'				 => 'See MDW Demo',
			'main_content'		 => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
		),
		'widget_mdw_divider_11'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'title'				 => '',
			'color'				 => '#dbdbdb'
		),
		'widget_mdw_downloader_12'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_downloader',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $landing_page_id,
			'text_align'		 => 'left',
			'img_align'			 => 'left',
			'title'				 => 'Download Software From MDW Today!',
			'content'			 => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
			'image'				 => 'http://mdbootstrap.com/img/Mockups/Transparent/Small/iphone2.png',
			'filled_buttons'	 => 'checked',
			'button_text'		 => 'Download MDW',
			'button_href'		 => '#',
			'icon_color_1'		 => '#00c1c1',
			'icon_container_1'	 => 'fa fa-download'
		),
		'widget_mdw_full_width_section_13'	 => array(
			'temp_sidebar'			 => 'footer_area_middle',
			'widget_id'				 => 'mdw_full_width_section',
			'template_number'		 => '3',
			'page_id'				 => $landing_page_id,
			'title_2'				 => 'Subscribe to get news',
			'title_description_2'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
			'filled_buttons'		 => '',
			'button_text_2'			 => 'Subscribe',
			'button_href'			 => '#',
			'icon_color_1'			 => '#e91e63',
			'icon_container_1'		 => 'fa fa-code'
		),
		'widget_mdw_contact_14'				 => array(
			'temp_sidebar'		 => 'footer_area_middle',
			'widget_id'			 => 'mdw_contact',
			'template_number'	 => '3',
			'page_id'			 => $landing_page_id,
			'animation'			 => 'fadeIn',
			'day_1'				 => 'Mon - Thu:',
			'day_2'				 => 'Fri - Sat:',
			'day_3'				 => 'Sunday:',
			'hour_1'			 => '8am - 9pm',
			'hour_2'			 => '8am - 1am',
			'hour_3'			 => '9am - 10pm',
			'address'			 => 'Allen Street 5',
			'country'			 => 'New York, NY 10012',
			'name'				 => 'Mr. Danny Smith',
			'phone'				 => '+ 01 234 567 89',
			'email_1'			 => 'info@gmail.com',
			'icon_url_1'		 => '#',
			'icon_container_1'	 => 'fa fa-facebook-f',
			'icon_color_1'		 => '#3B5998',
			'icon_url_2'		 => '#',
			'icon_container_2'	 => 'fa fa-twitter',
			'icon_color_2'		 => '#55ACEE',
			'icon_url_3'		 => '#',
			'icon_container_3'	 => 'fa fa-google-plus',
			'icon_color_3'		 => '#DD4B39'
		)
	);

	$landing_page_intro_widgets	 = array();
	$landing_page_widgets		 = array();
	$landing_page_footer_widgets = array();

	foreach ( $widgets as $name => $settings ) {
		$name			 = substr( $name, 0, strrpos( $name, '_' ) );
		$current_options = get_option( $name );

		reset( $current_options );
		$first_key = key( $current_options );

		if ( '' == $current_options || count( $current_options ) == 1 && ('_multiwidget' == $first_key || '0' == $first_key) ) {
			$current_options = array();
			array_unshift( $current_options, '', '' );
			unset( $current_options[ 0 ] );
			unset( $current_options[ 1 ] );
		}

		$current_ids = array();

		foreach ( $current_options as $co ) {
			$current_ids[] = $co[ 'widget_id' ];
		}

		//sort array by values descending
		natsort( $current_ids );
		$current_ids = array_reverse( $current_ids );
		//reset indexes
		$current_ids = array_values( $current_ids );

		$last_id			 = count( $current_ids ) ? $current_ids[ 0 ] : '';
		$last_id_index		 = substr( $last_id, strrpos( $last_id, '-' ) + 1 );
		$new_widget_id_index = ('' != $last_id_index) ? $last_id_index + 1 : 2;

		$settings[ 'widget_id' ] .= '-' . $new_widget_id_index;

		$data[ 'widgets' ][] = $settings[ 'widget_id' ];

		if ( 'intro_area' == $settings[ 'temp_sidebar' ] ) {
			$landing_page_intro_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'widget_area' == $settings[ 'temp_sidebar' ] ) {
			$landing_page_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_middle' == $settings[ 'temp_sidebar' ] ) {
			$landing_page_footer_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		}

		$current_options[]					 = $settings;
		$current_options[ '_multiwidget' ]	 = 1;
		update_option( $name, $current_options );
	}

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( !isset( $sidebars_widgets[ 'landing-page-intro' ] ) ) {
		$sidebars_widgets[ 'landing-page-intro' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'landing-page' ] ) ) {
		$sidebars_widgets[ 'landing-page' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-middle' ] ) ) {
		$sidebars_widgets[ 'footer-middle' ] = array();
	}

	$sidebars_widgets[ 'landing-page-intro' ]	 = array_merge( $sidebars_widgets[ 'landing-page-intro' ], $landing_page_intro_widgets );
	$sidebars_widgets[ 'landing-page' ]			 = array_merge( $sidebars_widgets[ 'landing-page' ], $landing_page_widgets );
	$sidebars_widgets[ 'footer-middle' ]		 = array_merge( $sidebars_widgets[ 'footer-middle' ], $landing_page_footer_widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	set_theme_mod( 'color_scheme', 'indigo-skin' );
	set_theme_mod( 'footer_type', 'advanced' );
	set_theme_mod( 'load_more_posts', 'pagination' );

	update_post_meta( $landing_page_id, 'meta-navigation-type', 'navbar' );
	update_post_meta( $landing_page_id, 'meta-navbar-type', 'scrolling' );
	update_post_meta( $landing_page_id, 'meta-transparent-type', 'yes' );

	$current_data	 = get_option( 'dummy_content' ) ? get_option( 'dummy_content' ) : array();
	$updated_data	 = array_merge_recursive( $current_data, $data );
    $links = array( 
        "links" => array (
            "landing-page" => get_permalink( $landing_page_id ),
        )
    );
    $updated_data    = array_merge_recursive( $links, $updated_data );
	update_option( 'dummy_content', $updated_data );

	$response = array(
		'link'		 => get_permalink( $landing_page_id ),
		'status'	 => 'ok',
		'message'	 => 'Loaded!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_load_landing_page', 'load_landing_page' );

/**
 * Loads Demo Portfolio Page to your wordpress 
 */
function load_portfolio_page() {

	$data = array(
		'page_id'		 => array(),
		'widgets'		 => array(),
		'posts'			 => array(),
		'categories'	 => array(),
		'attachments'	 => array(),
		'templates'		 => array(),
        'comments'       => array()
	);

	$portfolio_page_id = wp_insert_post( array(
		'post_type'		 => 'page',
		'post_title'	 => 'portfolio-demo',
		'post_status'	 => 'publish'
	) );
	add_post_meta( $portfolio_page_id, '_wp_page_template', 'template-portfolio.php' );

	$data[ 'page_id' ][]	 = $portfolio_page_id;
	$data[ 'templates' ][]	 = 'portfolio';

	$post_id_3 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Italia - the people, customs and delicious food.',
		'post_content'	 => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro qui dolorem ipsum quia sit amet, consectetur.',
		'post_status'	 => 'publish'
	) );
    $comment_3 = array(
        'comment_ID' => "541",
        'comment_post_ID' => $post_id_3,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 11:22:25',
        'comment_content' => 'Looks nice!',
        'user_id'         => '1'

    );

	$thumb_id_3 = Generate_Featured_Image( 'http://mdbootstrap.com/images/regular/city/img%20(33).jpg', $post_id_3 );

	$post_id_2 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Gain work experience while traveling.',
		'post_content'	 => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident et dolorum fuga.',
		'post_status'	 => 'publish'
	) );
    $comment_2 = array(
        'comment_ID' => "542",
        'comment_post_ID' => $post_id_2,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 12:22:25',
        'comment_content' => 'Great Job!',
        'user_id'         => '1'

    );
	$thumb_id_2 = Generate_Featured_Image( 'http://mdbootstrap.com/images/regular/people/img%20(84).jpg', $post_id_2 );

	$post_id_1 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to organize an expedition to Mount Everest?',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish'
	) );
    $comment_3 = array(
        'comment_ID' => "543",
        'comment_post_ID' => $post_id_1,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Awansome!',
        'user_id'         => '1'

    );
	$thumb_id_1 = Generate_Featured_Image( 'http://mdbootstrap.com/images/regular/nature/img%20(75).jpg', $post_id_1 );

	$data[ 'posts' ]		 = array( $post_id_1, $post_id_2, $post_id_3 );
	$data[ 'attachments' ]	 = array( $thumb_id_1, $thumb_id_2, $thumb_id_3 );
    $data[ 'comments' ]      = array( $comments );
    wp_insert_comment( $comment_3);
    wp_insert_comment($comment_2);
    wp_insert_comment($comment_1);

	if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
		$posts				 = get_posts( array(
			'post_type'		 => 'wpcf7_contact_form',
			'post_status'	 => 'publish'
		)
		);
		$dummy_contact_name	 = $posts[ 0 ]->post_title;
		$dummy_contact_id	 = $posts[ 0 ]->ID;
		$dummy_contact_id	 = strval( $dummy_contact_id );
	}

	$widgets = array(
		'widget_mdw_intro_cta_0'			 => array(
			'temp_sidebar'		 => 'intro_area',
			'widget_id'			 => 'mdw_intro_cta',
			'page_id'			 => $portfolio_page_id,
			'title'				 => 'I am Jessie Doe',
			'main_content'		 => "And I'm supermodel",
			'image'				 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(28).jpg',
			'big_font'			 => 'checked',
			'icon_container_1'	 => '',
			'icon_color_1'		 => '#ffffff',
			'button_text_1'		 => 'See my portfolio',
			'button_href_1'		 => '#'
		),
		'widget_mdw_features_1'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_features',
			'page_id'			 => $portfolio_page_id,
			'template_number'	 => '5',
			'title'				 => 'About us',
			'image1'				 =>	'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(28).jpg',
			'img_title'			 => 'Hello, my name is Jessie Doe',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo animi soluta ratione quisquam, dicta ab cupiditate iure eaque? Repellendus voluptatum, magni impedit eaque delectus, beatae maxime temporibus maiores quibusdam quasi.Rem magnam ad perferendis iusto sint tempora ea voluptatibus iure, animi excepturi modi aut possimus in hic molestias repellendus illo ullam odit quia velit. Qui expedita sit quo, maxime molestiae.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi sapiente, consequuntur dolore praesentium non suscipit minus repudiandae, nesciunt placeat, vel nostrum magni pariatur accusantium laudantium.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure quos recusandae, cum assumenda similique libero aspernatur sed autem? Vel voluptate quibusdam repellendus debitis. Porro nostrum maiores, animi reiciendis optio odit?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut atque beatae, eaque temporibus reprehenderit ut, in at quam accusantium ullam eveniet deleniti iusto voluptatum perspiciatis nam debitis numquam, harum quae. ipsum dolor sit amet, consectetur adipisicing elit. Dolorum omnis, natus! Inventore aperiam laudantium ducimus id. Obcaecati eligendi in, fuga molestias, explicabo tempore velit natus, nostrum dolorum nulla ratione qui.',
			'image'				 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(25).jpg',
			'text_align'		 => 'left',
			'img_align'			 => 'left'
		),
		'widget_mdw_full_width_section_2'	 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_full_width_section',
			'page_id'			 => $portfolio_page_id,
			'template_number'	 => '2',
			'title_1'			 => 'My last TV show',
			'button_text_1'		 => 'See the gallery',
			'button_url_1'		 => '#',
			'background_image_1' => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(39).jpg'
		),
		'widget_mdw_portfolio_3'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_portfolio',
			'page_id'			 => $portfolio_page_id,
			'title'				 => 'My portfolio',
			'title_description'	 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet maiores aspernatur aut animi debitis. Ad excepturi dolor tempora at aperiam earum veritatis ullam. Culpa tempora possimus necessitatibus excepturi, quisquam officia.',
			'image1'			 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(27).jpg',
			'image2'			 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(33).jpg',
			'image3'			 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(28).jpg',
			'image4'			 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(32).jpg',
			'image5'			 => 'http://mdbootstrap.com/live/_MDB/templates/Portfolio/img/img%20(36).jpg'
		),
		'widget_mdw_blog_4'					 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_blog',
			'page_id'			 => $portfolio_page_id,
			'template_number'	 => '2',
			'animation'			 => 'fadeIn',
			'title'				 => 'Blog',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia iste provident, voluptatum voluptatibus aut modi aspernatur autem impedit, eius, debitis earum voluptatem. Quaerat hic aspernatur laborum magni earum. At, officiis!',
			'display_author'	 => 'on',
			'display_date'		 => 'on',
			'amount'			 => '3',
			'category'			 => 'No categories',
			'words_per_excerpt'	 => '30',
			'columns_amount'	 => '3'
		),
		'widget_mdw_contact_5'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_contact',
			'page_id'			 => $portfolio_page_id,
			'template_number'	 => '2',
			'animation'			 => 'fadeIn',
			'title'				 => 'Contact me',
			'main_content'		 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?',
			'form'				 => "[contact-form-7 id='" . $dummy_contact_id . "' title='" . $dummy_contact_name . "']",
			'icon_container_1'	 => 'fa fa-map-marker',
			'icon_color_1'		 => '#424242',
			'icon_text_1'		 => 'New York, NY 10012, USA',
			'icon_container_2'	 => 'fa fa-phone',
			'icon_color_2'		 => '#424242',
			'icon_text_2'		 => '+ 01 234 567 89',
			'icon_container_3'	 => 'fa fa-envelope',
			'icon_color_3'		 => '#424242',
			'icon_text_3'		 => 'contact@mdbootstrap.com'
		),
		'widget_mdw_quote_6'				 => array(
			'temp_sidebar'	 => 'widget_area',
			'widget_id'		 => 'mdw_quote',
			'page_id'		 => $portfolio_page_id,
			'author'		 => 'Arizona Muse',
			'quote'			 => 'Modeling is really silent acting'
		)
	);

	$portfolio_page_intro_widgets	 = array();
	$portfolio_page_widgets			 = array();

	foreach ( $widgets as $name => $settings ) {
		$name			 = substr( $name, 0, strrpos( $name, '_' ) );
		$current_options = get_option( $name );

		reset( $current_options );
		$first_key = key( $current_options );

		if ( '' == $current_options || count( $current_options ) == 1 && ('_multiwidget' == $first_key || '0' == $first_key) ) {
			$current_options = array();
			array_unshift( $current_options, '', '' );
			unset( $current_options[ 0 ] );
			unset( $current_options[ 1 ] );
		}

		$current_ids = array();

		foreach ( $current_options as $co ) {
			$current_ids[] = $co[ 'widget_id' ];
		}

		//sort array by values descending
		natsort( $current_ids );
		$current_ids = array_reverse( $current_ids );
		//reset indexes
		$current_ids = array_values( $current_ids );

		$last_id			 = count( $current_ids ) ? $current_ids[ 0 ] : '';
		$last_id_index		 = substr( $last_id, strrpos( $last_id, '-' ) + 1 );
		$new_widget_id_index = ('' != $last_id_index) ? $last_id_index + 1 : 2;

		$settings[ 'widget_id' ] .= '-' . $new_widget_id_index;

		$data[ 'widgets' ][] = $settings[ 'widget_id' ];

		if ( 'intro_area' == $settings[ 'temp_sidebar' ] ) {
			$portfolio_page_intro_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'widget_area' == $settings[ 'temp_sidebar' ] ) {
			$portfolio_page_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		}

		$current_options[]					 = $settings;
		$current_options[ '_multiwidget' ]	 = 1;
		update_option( $name, $current_options );
	}

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( !isset( $sidebars_widgets[ 'portfolio-page-intro' ] ) ) {
		$sidebars_widgets[ 'portfolio-page-intro' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'portfolio-page' ] ) ) {
		$sidebars_widgets[ 'portfolio-page' ] = array();
	}

	$sidebars_widgets[ 'portfolio-page-intro' ]	 = array_merge( $sidebars_widgets[ 'portfolio-page-intro' ], $portfolio_page_intro_widgets );
	$sidebars_widgets[ 'portfolio-page' ]		 = array_merge( $sidebars_widgets[ 'portfolio-page' ], $portfolio_page_widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	set_theme_mod( 'color_scheme', 'grey-skin' );
	set_theme_mod( 'footer_type', '' );
	set_theme_mod( 'load_more_posts', 'pagination' );

	update_post_meta( $portfolio_page_id, 'meta-navigation-type', 'navbar' );
	update_post_meta( $portfolio_page_id, 'meta-navbar-type', 'scrolling' );
	update_post_meta( $portfolio_page_id, 'meta-transparent-type', 'yes' );

	$current_data	 = get_option( 'dummy_content' ) ? get_option( 'dummy_content' ) : array();
	$updated_data	 = array_merge_recursive( $current_data, $data );
    $links = array( 
        "links" => array (
            "portfolio" => get_permalink( $portfolio_page_id ),
        )
    );
    $updated_data    = array_merge_recursive( $links, $updated_data );
	update_option( 'dummy_content', $updated_data );

	$response = array(
		'link'		 => get_permalink( $portfolio_page_id ),
		'status'	 => 'ok',
		'message'	 => 'Loaded!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_load_portfolio_page', 'load_portfolio_page' );

/**
 * Loads Demo Magazine Page to your wordpress 
 */
function load_magazine_page() {

	$data = array(
		'page_id'		 => array(),
		'widgets'		 => array(),
		'posts'			 => array(),
		'categories'	 => array(),
		'attachments'	 => array(),
		'templates'		 => array()
	);

	$magazine_page_id = wp_insert_post( array(
		'post_type'		 => 'page',
		'post_title'	 => 'magazine-demo',
		'post_status'	 => 'publish'
	) );
	add_post_meta( $magazine_page_id, '_wp_page_template', 'template-magazine.php' );

	$data[ 'page_id' ][]	 = $magazine_page_id;
	$data[ 'templates' ][]	 = 'magazine';

	//Categories
	$cat_entertainment_id	 = wp_create_category( 'Entertainment' );
	$cat_business_id		 = wp_create_category( 'Business' );

	$cat_travels_id	 = wp_create_category( 'Travels' );
	$cat_hobby_id	 = wp_create_category( 'Hobby' );

	$cat_health_id		 = wp_create_category( 'Health' );
	$cat_lifestyle_id	 = wp_create_category( 'Lifestyle' );
	$cat_fashion_id		 = wp_create_category( 'Fashion' );

	$cat_education_id	 = wp_create_category( 'Education' );
	$cat_culture_id		 = wp_create_category( 'Culture' );
	$cat_adventure_id	 = wp_create_category( 'Adventure' );

	$cat_photography_id	 = wp_create_category( 'Photography' );
	$cat_design_id		 = wp_create_category( 'Design' );

	$cat_ids	 = array(
		array(
			'id'	 => $cat_entertainment_id,
			'color'	 => '#3F51B5',
			'icon'	 => 'fa fa-star-half-o'
		),
		array(
			'id'	 => $cat_business_id,
			'color'	 => '#9C27B0',
			'icon'	 => 'fa fa-money'
		),
		array(
			'id'	 => $cat_travels_id,
			'color'	 => '#2196F3',
			'icon'	 => 'fa fa-plane'
		),
		array(
			'id'	 => $cat_hobby_id,
			'color'	 => '#F44336',
			'icon'	 => 'fa fa-music'
		),
		array(
			'id'	 => $cat_health_id,
			'color'	 => '#ff9800',
			'icon'	 => 'fa fa-coffee'
		),
		array(
			'id'	 => $cat_lifestyle_id,
			'color'	 => '#3F51B5',
			'icon'	 => 'fa fa-camera'
		),
		array(
			'id'	 => $cat_fashion_id,
			'color'	 => '#E91E63',
			'icon'	 => 'fa fa-heart'
		),
		array(
			'id'	 => $cat_education_id,
			'color'	 => '#9C27B0',
			'icon'	 => 'fa fa-graduation-cap'
		),
		array(
			'id'	 => $cat_culture_id,
			'color'	 => '#FF9800',
			'icon'	 => 'fa fa-fire'
		),
		array(
			'id'	 => $cat_adventure_id,
			'color'	 => '#00BCD4',
			'icon'	 => 'fa fa-map'
		),
		array(
			'id'	 => $cat_photography_id,
			'color'	 => '#E91E63',
			'icon'	 => 'fa fa-camera'
		),
		array(
			'id'	 => $cat_design_id,
			'color'	 => '#FF9800',
			'icon'	 => 'fa fa-crop'
		)
	);
	$category	 = get_theme_mod( 'categories' );

	foreach ( $cat_ids as $key => $val ) {
		$cat = get_category( $val[ 'id' ] );

		$id		 = $cat->term_id;
		$name	 = $cat->name;
		$slug	 = $cat->slug;
		$color	 = $val[ 'color' ];
		$icon	 = $val[ 'icon' ];

		$category[ $slug ] = array(
			'cat_id'	 => $cat->term_id,
			'cat_slug'	 => $cat->slug,
			'cat_name'	 => $cat->name,
			'color'		 => $color,
			'icon'		 => $icon
		);
	}

	$old_value = get_theme_mod( 'categories' );

	if ( '' == $old_value ) {
		$old_value = explode( ',', $old_value );
	}

	$result = array_unique( array_merge( $old_value, $category ), SORT_REGULAR );

	set_theme_mod( 'categories', $result );
	remove_theme_mod( 'categories2' );

	//Posts
	$post_ent_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Why you need to see San Francisco.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_entertainment_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_ent_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(25).jpg', $post_ent_4 );
    $comment_1 = array(
        'comment_ID' => "544",
        'comment_post_ID' => $post_ent_4,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Life is full of temporary situations, ultimately ending in a permanent solution.',
        'user_id'         => '1'

    );

	$post_ent_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to start surfing in Hawaii?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_entertainment_id, $cat_adventure_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_ent_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(64).jpg', $post_ent_3 );

	$post_ent_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'A journey through the woods.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_entertainment_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_ent_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(79).jpg', $post_ent_2 );

	$post_ent_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Top 5 places to visit in Italy.',
		'post_content'	 => "There is nothing more beautiful and amazing than Italy. Really. These views, people, pastas, pizzas, designers and first of all atmosphere. When I'm in Italy I'm smiling all the time.",
		'post_category'	 => array( $cat_entertainment_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_ent_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(27).jpg', $post_ent_1 );
    $comment_2 = array(
        'comment_ID' => "546",
        'comment_post_ID' => $post_ent_1,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );

	$post_bus_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Marketing for luxury products.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_business_id, $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_bus_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(30).jpg', $post_bus_4 );

	$post_bus_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Top 6 startups from Berlin.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_business_id, $cat_culture_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_bus_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20(30).jpg', $post_bus_3 );

	$post_bus_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Find the best office in San Francisco.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_business_id, $cat_culture_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_bus_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(9).jpg', $post_bus_2 );

	$post_bus_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to start career in New York?',
		'post_content'	 => 'Oh, New York, New York! The city of my life. I think most of us would like live and work in NY. As a businessman, artist, fashion designer or like Carrie Bradshaw as a top journalist.',
		'post_category'	 => array( $cat_business_id, $cat_culture_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_bus_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(85).jpg', $post_bus_1 );

	$post_tra_5	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'The most beautiful winter photography.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(77).jpg', $post_tra_5 );
    $comment_3 = array(
        'comment_ID' => "548",
        'comment_post_ID' => $post_tra_5,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );

	$post_tra_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Various sweets in European countries.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(16).jpg', $post_tra_4 );

	$post_tra_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Beautiful wild nature in Bialowieza.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(74).jpg', $post_tra_3 );

	$post_tra_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Prepare for an expedition to Mount Everest.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(75).jpg', $post_tra_2 );

	$post_tra_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Discover unique mountain world.',
		'post_content'	 => 'There is many of breathtaking places in the world. For me mountains are the best of them. Travelling in the mountains can be difficult but views of the nature are worth it.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Slides/img%20%2821%29.jpg', $post_tra_1 );
    $comment_4 = array(
        'comment_ID' => "549",
        'comment_post_ID' => $post_tra_1,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );
	$post_hob_5	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to choose a lens to reportage?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_hobby_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hob_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Photography/4-col/img%20(12).jpg', $post_hob_5 );

	$post_hob_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Vegan lunch with spinach and bean.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_photography_id, $cat_hobby_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hob_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(13).jpg', $post_hob_4 );

	$post_hob_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Summer holidays with a pet.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_hobby_id, $cat_adventure_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hob_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(76).jpg', $post_hob_3 );

	$post_hob_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'The best donuts in Paris.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_hobby_id, $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hob_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(86).jpg', $post_hob_2 );
    $comment_4 = array(
        'comment_ID' => "550",
        'comment_post_ID' => $post_hob_2,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );
	$post_hob_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Summer music festivals in Europe.',
		'post_content'	 => "We want to present you top 5 summer music festivals take place in different countries in Europe. One of them is A Summer's Tale, Germany, then Weather Festival, France.",
		'post_category'	 => array( $cat_hobby_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hob_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Slides/img%20%2838%29.jpg', $post_hob_1 );

	$post_hea_5	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => '5 Recipes You Need to Try.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_health_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hea_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(78).jpg', $post_hea_5 );

	$post_hea_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => "8 Reasons You're Always Hungry.",
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_health_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hea_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(78).jpg', $post_hea_4 );

	$post_hea_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to Make a Beet Cocktail?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_health_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hea_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(78).jpg', $post_hea_3 );
    $comment_5 = array(
        'comment_ID' => "551",
        'comment_post_ID' => $post_hea_3,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );
	$post_hea_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => '24 Food Swaps That Slash Calories.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_health_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hea_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(78).jpg', $post_hea_2 );

	$post_hea_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => '6 Big Myths About Hydration.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_health_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_hea_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(78).jpg', $post_hea_1 );

	$post_lif_5	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Polish best-dressed celebrities.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_lifestyle_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_lif_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(82).jpg', $post_lif_5 );

	$post_lif_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'What camera take for holidays?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_lifestyle_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_lif_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(82).jpg', $post_lif_4 );

	$post_lif_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'The best lunch in Warsaw.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_lifestyle_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_lif_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(82).jpg', $post_lif_3 );

	$post_lif_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Trends in the blogosphere for 2016.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_lifestyle_id, $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_lif_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(82).jpg', $post_lif_2 );
    $comment_6 = array(
        'comment_ID' => "551",
        'comment_post_ID' => $post_lif_2,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Why go to college? There is Google.',
        'user_id'         => '1'

    );
	$post_lif_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Top 5 places for photographs.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_lifestyle_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_lif_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(82).jpg', $post_lif_1 );

	$post_fas_5	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Choose best swimsuit for summer.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_fashion_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_fas_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(81).jpg', $post_fas_5 );

	$post_fas_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Best bags designers in Italy.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_fashion_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_fas_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(81).jpg', $post_fas_4 );

	$post_fas_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'London Fashion Week - see online.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_fashion_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_fas_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(81).jpg', $post_fas_3 );
    $comment_7 = array(
        'comment_ID' => "552",
        'comment_post_ID' => $post_fas_3,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Great article, I cannot wait for more!',
        'user_id'         => '1'

    );
	$post_fas_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Top models in Poland.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_fashion_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_fas_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(81).jpg', $post_fas_2 );

	$post_fas_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'What colors fit to blonde girl?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_fashion_id, $cat_education_id, $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_fas_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(81).jpg', $post_fas_1 );

	$post_edu_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => '10 best pizzerias in Europe.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_education_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_edu_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(3).jpg', $post_edu_3 );

	$post_edu_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Safe summer holidays with kids.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_education_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_edu_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(89).jpg', $post_edu_2 );

//post_edu_1- multicat (fas, edu, pho)
//post_cul_3- multicat (bus, cul)
//post_cul_2- multicat (bus, cul)
	//post_cul_1- multicat (bus, cul)

	$post_adv_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Prepare for expedition to Mount Everest.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_adventure_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_adv_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(75).jpg', $post_adv_3 );



	$post_des_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Beauty of Scandinavian style',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_design_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_des_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Things/4-col/img%20%289%29.jpg', $post_des_3 );
    $comment_8 = array(
        'comment_ID' => "553",
        'comment_post_ID' => $post_des_3,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Great article, I cannot wait for more!',
        'user_id'         => '1'

    );
	$post_des_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to sew curtains - tutorial',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_design_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_des_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Things/4-col/img%20%287%29.jpg', $post_des_2 );

	$post_des_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Change room with accessories',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nibh ac elementum faucibus, tortor orci lobortis mauris, at accumsan ipsum orci sit amet tortor. Donec porta erat dolor, a porttitor arcu fringilla nec. Suspendisse posuere venenatis erat nec eleifend. Morbi ornare quis urna quis convallis.',
		'post_category'	 => array( $cat_design_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_des_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Things/4-col/img%20%286%29.jpg', $post_des_1 );

	$data[ 'posts' ]		 = array(
		$post_ent_4, $post_ent_3, $post_ent_2, $post_ent_1,
		$post_bus_4, $post_bus_3, $post_bus_2, $post_bus_1,
		$post_tra_5, $post_tra_4, $post_tra_3, $post_tra_2, $post_tra_1,
		$post_hob_5, $post_hob_4, $post_hob_3, $post_hob_2, $post_hob_1,
		$post_hea_5, $post_hea_4, $post_hea_3, $post_hea_2, $post_hea_1,
		$post_lif_5, $post_lif_4, $post_lif_3, $post_lif_2, $post_lif_1,
		$post_fas_5, $post_fas_4, $post_fas_3, $post_fas_2, $post_fas_1,
		$post_edu_3, $post_edu_2, $post_adv_3,
		$post_des_3, $post_des_2, $post_des_1
	);
	$data[ 'categories' ]	 = array(
		$cat_entertainment_id,
		$cat_business_id,
		$cat_travels_id,
		$cat_hobby_id,
		$cat_health_id,
		$cat_lifestyle_id,
		$cat_fashion_id,
		$cat_education_id,
		$cat_culture_id,
		$cat_adventure_id,
		$cat_photography_id,
		$cat_design_id
	);
	$data[ 'attachments' ]	 = array(
		$thumb_ent_4, $thumb_ent_3, $thumb_ent_2, $thumb_ent_1,
		$thumb_bus_4, $thumb_bus_3, $thumb_bus_2, $thumb_bus_1,
		$thumb_tra_5, $thumb_tra_4, $thumb_tra_3, $thumb_tra_2, $thumb_tra_1,
		$thumb_hob_5, $thumb_hob_4, $thumb_hob_3, $thumb_hob_2, $thumb_hob_1,
		$thumb_hea_5, $thumb_hea_4, $thumb_hea_3, $thumb_hea_2, $thumb_hea_1,
		$thumb_lif_5, $thumb_lif_4, $thumb_lif_3, $thumb_lif_2, $thumb_lif_1,
		$thumb_fas_5, $thumb_fas_4, $thumb_fas_3, $thumb_fas_2, $thumb_fas_1,
		$thumb_edu_3, $thumb_edu_2, $thumb_adv_3,
		$thumb_des_3, $thumb_des_2, $thumb_des_1
	);

	$widgets = array(
		'widget_mdw_carousel_0'		 => array(
			'temp_sidebar'		 => 'header_area',
			'widget_id'			 => 'mdw_carousel',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'box_layout'		 => 'container-fluid',
			'fieldCount'		 => '3',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Others/slide%20%2828%29.jpg',
			'caption_heading_1'	 => 'American Football',
			'caption_1'			 => "Monday's match between Chicago Bears and Houston Texans",
			'image_2'			 => 'https://mdbootstrap.com/img/Photos/Others/slide%20%2826%29.jpg',
			'caption_heading_2'	 => 'Fashion & Lifestyle',
			'caption_2'			 => 'Check out the most fashionable models of jeans this summer',
			'image_3'			 => 'https://mdbootstrap.com/img/Photos/Others/slide%20%2827%29.jpg',
			'caption_heading_3'	 => 'Parenting',
			'caption_3'			 => "Top 5 ideas for spending Mother's Day with your kids"
		),
		'widget_mdw_divider_1'		 => array(
			'temp_sidebar'		 => 'header_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'box_layout'		 => 'container-fluid',
			'color'				 => '#666666',
			'title'				 => "What's new?"
		),
		'widget_mdw_magazine_2'		 => array(
			'temp_sidebar'				 => 'widget_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '1',
			'box_layout'				 => 'container',
			'left_amount'				 => '4',
			'left_category'				 => $cat_entertainment_id,
			'left_words_per_excerpt'	 => '30',
			'right_amount'				 => '4',
			'right_category'			 => $cat_business_id,
			'right_words_per_excerpt'	 => '30'
		),
		'widget_mdw_divider_3'		 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'color'				 => '#666666',
			'title'				 => 'Tourism'
		),
		'widget_mdw_magazine_4'		 => array(
			'temp_sidebar'				 => 'widget_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '2',
			'box_layout'				 => 'container',
			'main_content'				 => "The best articles and reports, the latest news, useful tips and the most beautiful photos and videos you'll find here. Join us and enjoy traveling around the world.",
			'middle_amount'				 => '5',
			'middle_category'			 => $cat_travels_id,
			'middle_words_per_excerpt'	 => '30'
		),
		'widget_mdw_divider_5'		 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'color'				 => '#666666',
			'title'				 => 'Culture & Hobby'
		),
		'widget_mdw_magazine_6'		 => array(
			'temp_sidebar'				 => 'widget_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '2',
			'box_layout'				 => 'container',
			'main_content'				 => 'Passion is everything, we know how important it is in our lives. You can find a lot of interesting articles and tips on photography, film, cooking and many other fields. In addition, we inform about the latest exhibitions and cultural events.',
			'middle_amount'				 => '5',
			'middle_category'			 => $cat_hobby_id,
			'middle_words_per_excerpt'	 => '30'
		),
		'widget_mdw_divider_7'		 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'color'				 => '#666666',
			'title'				 => 'Lifestyle & Celebrities'
		),
		'widget_mdw_magazine_8'		 => array(
			'temp_sidebar'				 => 'widget_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '3',
			'box_layout'				 => 'container',
			'main_content'				 => 'Health, style, sport or anything from lifestyle. We will inform you about new trends in fashion, healthy nutrition and about what happened in the world of celebrities.',
			'left_amount'				 => '5',
			'left_category'				 => $cat_health_id,
			'left_words_per_excerpt'	 => '30',
			'middle_amount'				 => '5',
			'middle_category'			 => $cat_lifestyle_id,
			'middle_words_per_excerpt'	 => '30',
			'right_amount'				 => '5',
			'right_category'			 => $cat_fashion_id,
			'right_words_per_excerpt'	 => '30'
		),
		'widget_mdw_tabs_9'			 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_tabs',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'template_number'	 => '6',
			'background_color'	 => '#37474f',
			'category_1'		 => $cat_education_id,
			'post_number_1'		 => '3',
			'category_2'		 => $cat_culture_id,
			'post_number_2'		 => '3',
			'category_3'		 => $cat_adventure_id,
			'post_number_3'		 => '3'
		),
		'widget_mdw_carousel_10'	 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_carousel',
			'page_id'			 => $magazine_page_id,
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'fieldCount'		 => '3',
			'title'				 => 'GALLERY',
			'what_to_feed'		 => 'custom',
			'box_layout'		 => 'container',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2842%29.jpg',
			'image_2'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2843%29.jpg',
			'image_3'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2852%29.jpg'
		),
		'widget_mdw_magazine_11'	 => array(
			'temp_sidebar'				 => 'sidebar_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '4',
			'title'						 => 'POPULAR POSTS',
			'middle_amount'				 => '5',
			'middle_category'			 => $cat_photography_id,
			'middle_words_per_excerpt'	 => '30'
		),
		'widget_mdw_magazine_12'	 => array(
			'temp_sidebar'				 => 'sidebar_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $magazine_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '5',
			'title'						 => 'FEATURED POSTS',
			'middle_amount'				 => '3',
			'middle_category'			 => $cat_design_id,
			'middle_words_per_excerpt'	 => '30'
		),
		'widget_text_13'			 => array(
			'temp_sidebar'	 => 'footer_area_left',
			'widget_id'		 => 'text',
			'title'			 => '',
			'text'			 => 'ABOUT MATERIAL DESIGN
                <br><br>
                Material Design (codenamed Quantum Paper) is a design language developed by Google.
                <br><br>
                Material Design for Bootstrap (MDB) is a powerful Material Design UI KIT for most popular HTML, CSS, and JS framework - Bootstrap.',
			'filter'		 => false
		),
		'widget_text_14'			 => array(
			'temp_sidebar'	 => 'footer_area_middle',
			'widget_id'		 => 'text',
			'title'			 => '',
			'text'			 => 'CONTACT INFO
                <br><br>
                New York, NY 10012<br>
                United States<br>
                + 01 234 567 89<br>
                info@gmail.com',
			'filter'		 => false
		),
		'widget_mdw_social_media_15' => array(
			'temp_sidebar'		 => 'footer_area_right',
			'widget_id'			 => 'mdw_social_media',
			'page_id'			 => $magazine_page_id,
			'template_number'	 => '2',
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'title'				 => 'INSTAGRAM FEED',
			'insta'				 => 'mdwpresentation',
			'insta_url'			 => '',
			'img_count'			 => '6',
			'fieldCount'		 => '0'
		)
	);
    
    for($i=1; $i<=7; $i++){
        wp_insert_comment( ${'comment_'.$i});
    }

	$magazine_page_header_widgets	 = array();
	$magazine_page_widgets			 = array();
	$magazine_sidebar_widgets		 = array();
	$magazine_footer_left_widgets	 = array();
	$magazine_footer_middle_widgets	 = array();
	$magazine_footer_right_widgets	 = array();

	foreach ( $widgets as $name => $settings ) {
		$name			 = substr( $name, 0, strrpos( $name, '_' ) );
		$current_options = get_option( $name );

		reset( $current_options );
		$first_key = key( $current_options );

		if ( '' == $current_options || count( $current_options ) == 1 && ('_multiwidget' == $first_key || '0' == $first_key) ) {
			$current_options = array();
			array_unshift( $current_options, '', '' );
			unset( $current_options[ 0 ] );
			unset( $current_options[ 1 ] );
		}

		$current_ids = array();

		foreach ( $current_options as $co ) {
			$current_ids[] = $co[ 'widget_id' ];
		}

		//sort array by values descending
		natsort( $current_ids );
		$current_ids = array_reverse( $current_ids );
		//reset indexes
		$current_ids = array_values( $current_ids );

		$last_id			 = count( $current_ids ) ? $current_ids[ 0 ] : '';
		$last_id_index		 = substr( $last_id, strrpos( $last_id, '-' ) + 1 );
		$new_widget_id_index = ('' != $last_id_index) ? $last_id_index + 1 : 2;

		$settings[ 'widget_id' ] .= '-' . $new_widget_id_index;

		$data[ 'widgets' ][] = $settings[ 'widget_id' ];

		if ( 'header_area' == $settings[ 'temp_sidebar' ] ) {
			$magazine_page_header_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'widget_area' == $settings[ 'temp_sidebar' ] ) {
			$magazine_page_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'sidebar_area' == $settings[ 'temp_sidebar' ] ) {
			$magazine_sidebar_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_left' == $settings[ 'temp_sidebar' ] ) {
			$magazine_footer_left_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_middle' == $settings[ 'temp_sidebar' ] ) {
			$magazine_footer_middle_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_right' == $settings[ 'temp_sidebar' ] ) {
			$magazine_footer_right_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		}

		$current_options[]					 = $settings;
		$current_options[ '_multiwidget' ]	 = 1;
		update_option( $name, $current_options );
	}

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( !isset( $sidebars_widgets[ 'magazine-header' ] ) ) {
		$sidebars_widgets[ 'magazine-header' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'magazine-page' ] ) ) {
		$sidebars_widgets[ 'magazine-page' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'magazine-sidebar' ] ) ) {
		$sidebars_widgets[ 'magazine-sidebar' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-left' ] ) ) {
		$sidebars_widgets[ 'footer-left' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-middle' ] ) ) {
		$sidebars_widgets[ 'footer-middle' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-right' ] ) ) {
		$sidebars_widgets[ 'footer-right' ] = array();
	}

	$sidebars_widgets[ 'magazine-header' ]	 = array_merge( $sidebars_widgets[ 'magazine-header' ], $magazine_page_header_widgets );
	$sidebars_widgets[ 'magazine-page' ]	 = array_merge( $sidebars_widgets[ 'magazine-page' ], $magazine_page_widgets );
	$sidebars_widgets[ 'magazine-sidebar' ]	 = array_merge( $sidebars_widgets[ 'magazine-sidebar' ], $magazine_sidebar_widgets );
	$sidebars_widgets[ 'footer-left' ]		 = array_merge( $sidebars_widgets[ 'footer-left' ], $magazine_footer_left_widgets );
	$sidebars_widgets[ 'footer-middle' ]	 = array_merge( $sidebars_widgets[ 'footer-middle' ], $magazine_footer_middle_widgets );
	$sidebars_widgets[ 'footer-right' ]		 = array_merge( $sidebars_widgets[ 'footer-right' ], $magazine_footer_right_widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	set_theme_mod( 'color_scheme', 'indigo-skin' );
	set_theme_mod( 'footer_type', 'advanced' );
	set_theme_mod( 'load_more_posts', 'pagination' );

	update_post_meta( $magazine_page_id, 'meta-navigation-type', 'both' );
	update_post_meta( $magazine_page_id, 'meta-navbar-type', 'scrolling' );
	update_post_meta( $magazine_page_id, 'meta-sidenav-type', 'fixed' );
	update_post_meta( $magazine_page_id, 'meta-transparent-type', 'no' );
	update_post_meta( $magazine_page_id, 'custom-layout-meta-box-dropdown', 'full_sidebar' );

	$current_data	 = get_option( 'dummy_content' ) ? get_option( 'dummy_content' ) : array();
	$updated_data	 = array_merge_recursive( $current_data, $data );
    $links = array( 
        "links" => array (
            "magazine" => get_permalink( $magazine_page_id ),
        )
    );
    $updated_data    = array_merge_recursive( $links, $updated_data );
	update_option( 'dummy_content', $updated_data );

	$response = array(
		'link'		 => get_permalink( $magazine_page_id ),
		'status'	 => 'ok',
		'message'	 => 'Loaded!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_load_magazine_page', 'load_magazine_page' );

/**
 * Loads Demo Blog Page to your wordpress 
 */
function load_blog_page() {

	$data = array(
		'page_id'		 => array(),
		'widgets'		 => array(),
		'posts'			 => array(),
		'categories'	 => array(),
		'attachments'	 => array(),
		'templates'		 => array()
	);

	$blog_page_id = wp_insert_post( array(
		'post_type'		 => 'page',
		'post_title'	 => 'blog-demo',
		'post_status'	 => 'publish'
	) );
	add_post_meta( $blog_page_id, '_wp_page_template', 'template-blog.php' );

	$data[ 'page_id' ][]	 = $blog_page_id;
	$data[ 'templates' ][]	 = 'blog';

	$cat_wildlife_id	 = wp_create_category( 'Wild Life' );
	$cat_travels_id		 = wp_create_category( 'Travels' );
	$cat_pets_id		 = wp_create_category( 'Pets' );
	$cat_photography_id	 = wp_create_category( 'Photography' );

	$cat_ids	 = array(
		array(
			'id'	 => $cat_wildlife_id,
			'color'	 => '#4CAF50',
			'icon'	 => 'fa fa-map'
		),
		array(
			'id'	 => $cat_travels_id,
			'color'	 => '#00BCD4',
			'icon'	 => 'fa fa-plane'
		),
		array(
			'id'	 => $cat_pets_id,
			'color'	 => '#FFC107',
			'icon'	 => 'fa fa-paw'
		),
		array(
			'id'	 => $cat_photography_id,
			'color'	 => '#E91E63',
			'icon'	 => 'fa fa-camera'
		)
	);
	$category	 = get_theme_mod( 'categories' );

	foreach ( $cat_ids as $key => $val ) {
		$cat = get_category( $val[ 'id' ] );

		$id		 = $cat->term_id;
		$name	 = $cat->name;
		$slug	 = $cat->slug;
		$color	 = $val[ 'color' ];
		$icon	 = $val[ 'icon' ];

		$category[ $slug ] = array(
			'cat_id'	 => $cat->term_id,
			'cat_slug'	 => $cat->slug,
			'cat_name'	 => $cat->name,
			'color'		 => $color,
			'icon'		 => $icon
		);
	}

	$old_value = get_theme_mod( 'categories' );

	if ( '' == $old_value ) {
		$old_value = explode( ',', $old_value );
	}

	$result = array_unique( array_merge( $old_value, $category ), SORT_REGULAR );

	set_theme_mod( 'categories', $result );

	//post_pho_5- multicat (pet, pho)

	$post_pho_4	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Paradise on tropical island',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pho_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2891%29.jpg', $post_pho_4 );
    $comment_1 = array(
        'comment_ID' => "558",
        'comment_post_ID' => $post_pho_4,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'This colour palette blew my mind.',
        'user_id'         => '1'

    );
	$post_pho_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Five tips for studying in New York.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pho_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/8-col/img%20%2834%29.jpg', $post_pho_3 );

	$post_pho_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Play music around the world.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pho_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20%2841%29.jpg', $post_pho_2 );

	$post_pho_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => '5 tips on how to photograph wild animals',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',
		'post_category'	 => array( $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pho_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2884%29.jpg', $post_pho_1 );
    $comment_2 = array(
        'comment_ID' => "559",
        'comment_post_ID' => $post_pho_1,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Typography, style, idea, design – clean =)',
        'user_id'         => '1'

    );
	$post_wil_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Admire lions on the savannah.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_wildlife_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_wil_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2892%29.jpg', $post_wil_1 );

	$post_wil_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Owls and their mysterious nightlife',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_wildlife_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_wil_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2889%29.jpg', $post_wil_2 );

	$post_wil_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Six amazing months on Madagascar',
		'post_content'	 => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
		'post_category'	 => array( $cat_wildlife_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_wil_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2886%29.jpg', $post_wil_3 );
    $comment_3 = array(
        'comment_ID' => "566",
        'comment_post_ID' => $post_wil_3,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Typography, style, idea, design – clean =)',
        'user_id'         => '1'

    );
	$post_tra_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'The first journey of my cat.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2890%29.jpg', $post_tra_3 );

	$post_tra_2	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'Amazing trip of my friend Carmen and her dog.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_travels_id, $cat_pets_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/8-col/img%20%2898%29.jpg', $post_tra_2 );

	$post_tra_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'My journey around Australia and Oceania',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam quia consequuntur maxime nobis mollitia autem iusto, consequatur dicta ad rem quisquam doloribus molestiae voluptas, asperiores, quod libero dignissimos, saepe odit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod ullam porro alias velit repudiandae voluptatum itaque ea ipsam rerum necessitatibus, deleniti.',
		'post_category'	 => array( $cat_travels_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_tra_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2888%29.jpg', $post_tra_1 );
    $comment_4 = array(
        'comment_ID' => "567",
        'comment_post_ID' => $post_tra_1,
        'comment_author'  => 'MDW Team',
        'comment_date'    => '2017-03-01 10:22:25',
        'comment_content' => 'Typography, style, idea, design – clean =)',
        'user_id'         => '1'

    );
	$post_pet_3	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'New friend - French Bulldog.',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_pets_id, $cat_photography_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pet_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20%2899%29.jpg', $post_pet_3 );

	//post_pet_2- multicat(tra, pet)

	$post_pet_1	 = wp_insert_post( array(
		'post_type'		 => 'post',
		'post_title'	 => 'How to travel with a cat?',
		'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
		'post_category'	 => array( $cat_pets_id ),
		'post_status'	 => 'publish'
	) );
	$thumb_pet_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2890%29.jpg', $post_pet_1 );

	$data[ 'posts' ]		 = array(
		$post_pho_4, $post_pho_3, $post_pho_2, $post_pho_1,
		$post_wil_1, $post_wil_2, $post_wil_3, $post_tra_3,
		$post_tra_2, $post_tra_1,
		$post_pet_3, $post_pet_1
	);
	$data[ 'categories' ]	 = array(
		$cat_wildlife_id,
		$cat_travels_id,
		$cat_pets_id,
		$cat_photography_id
	);
	$data[ 'attachments' ]	 = array(
		$thumb_pho_4, $thumb_pho_3, $thumb_pho_2, $thumb_pho_1,
		$thumb_wil_1, $thumb_wil_2, $thumb_wil_3, $thumb_tra_3,
		$thumb_tra_2, $thumb_tra_1,
		$thumb_pet_3, $thumb_pet_1
	);

	$widgets = array(
		'widget_mdw_blog_0'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_blog',
			'page_id'			 => $blog_page_id,
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'template_number'	 => '13',
			'display_date'		 => 'on',
			'display_author'	 => 'on',
			'amount'			 => '5',
			'category'			 => 'No categories',
			'words_per_excerpt'	 => '30',
			'columns_amount'	 => '1',
			'orderby'			 => 'date',
			'order'				 => 'DESC'
		),
		'widget_mdw_testimonials_1'	 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_testimonials',
			'fieldCount'		 => '1',
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'page_id'			 => $blog_page_id,
			'box_layout'		 => 'container',
			'name_1'			 => 'Martha Barnett',
			'quote_1'			 => "Hello, I'm Martha. I've 22 years old and my biggest passion is photography. I love travel around the world and take photos of wild animals, landscapes and local people.",
			'color_1'			 => '#5da9c3',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Avatars/img%20%284%29.jpg'
		),
		'widget_mdw_divider_2'		 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $blog_page_id,
			'animation'			 => 'fadeIn',
			'title'				 => 'Popular posts',
			'color'				 => '#666666',
			'template_number'	 => '1',
			'box_layout'		 => 'container'
		),
		'widget_mdw_magazine_3'		 => array(
			'temp_sidebar'				 => 'sidebar_area',
			'widget_id'					 => 'mdw_magazine',
			'page_id'					 => $blog_page_id,
			'animation'					 => 'fadeIn',
			'template_number'			 => '5',
			'box_layout'				 => 'container-fluid',
			'middle_amount'				 => '3',
			'middle_category'			 => $cat_wildlife_id,
			'middle_words_per_excerpt'	 => '30'
		),
		'widget_mdw_divider_4'		 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $blog_page_id,
			'animation'			 => 'fadeIn',
			'title'				 => 'Recent posts',
			'color'				 => '#666666',
			'template_number'	 => '1',
			'box_layout'		 => 'container'
		),
		'widget_mdw_magazine_5'		 => array(
			'temp_sidebar'				 => 'sidebar_area',
			'widget_id'					 => 'mdw_magazine',
			'animation'					 => 'fadeIn',
			'template_number'			 => '4',
			'page_id'					 => $blog_page_id,
			'box_layout'				 => 'container',
			'middle_amount'				 => '5',
			'middle_category'			 => 'No categories',
			'middle_words_per_excerpt'	 => '30',
			'what_to_feed'				 => 'posts'
		),
		'widget_mdw_divider_6'		 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_divider',
			'page_id'			 => $blog_page_id,
			'animation'			 => 'fadeIn',
			'title'				 => 'Featured posts',
			'color'				 => '#666666',
			'template_number'	 => '1',
			'box_layout'		 => 'container'
		),
		'widget_mdw_carousel_7'		 => array(
			'temp_sidebar'		 => 'sidebar_area',
			'widget_id'			 => 'mdw_carousel',
			'page_id'			 => $blog_page_id,
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'fieldCount'		 => '3',
			'what_to_feed'		 => 'custom',
			'box_layout'		 => 'container',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(93).jpg',
			'caption_heading_1'	 => 'Your pet',
			'caption_1'			 => 'Take care of a cat activity.',
			'image_2'			 => 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20(101).jpg',
			'caption_heading_2'	 => 'Sea adventure',
			'caption_2'			 => "Harry's life in Australia.",
			'image_3'			 => 'http://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(35).jpg',
			'caption_heading_3'	 => 'Beautiful interiors',
			'caption_3'			 => 'Meet beautiful Italian homes.'
		),
		'widget_text_8'				 => array(
			'temp_sidebar'	 => 'footer_area_left',
			'widget_id'		 => 'text',
			'title'			 => '',
			'text'			 => 'ABOUT MATERIAL DESIGN
                <br><br>
                Material Design (codenamed Quantum Paper) is a design language developed by Google.
                <br><br>
                Material Design for Bootstrap (MDB) is a powerful Material Design UI KIT for most popular HTML, CSS, and JS framework - Bootstrap.',
			'filter'		 => false
		),
		'widget_text_9'				 => array(
			'temp_sidebar'	 => 'footer_area_middle',
			'widget_id'		 => 'text',
			'title'			 => '',
			'text'			 => 'CONTACT INFO
                <br><br>
                New York, NY 10012<br>
                United States<br>
                + 01 234 567 89<br>
                info@gmail.com',
			'filter'		 => false
		),
		'widget_mdw_social_media_10' => array(
			'temp_sidebar'		 => 'footer_area_middle',
			'widget_id'			 => 'mdw_social_media',
			'animation'			 => 'fadeIn',
			'template_number'	 => '1',
			'page_id'			 => $blog_page_id,
			'box_layout'		 => 'container',
			'fieldCount'		 => '3',
			'icon_container_1'	 => 'fa fa-facebook',
			'icon_color_1'		 => '#3b5998',
			'icon_url_1'		 => '#',
			'icon_container_2'	 => 'fa fa-twitter',
			'icon_color_2'		 => '#55aceb',
			'icon_url_2'		 => '#',
			'icon_container_3'	 => 'fa fa-linkedin',
			'icon_color_3'		 => '#0082ca',
			'icon_url_3'		 => '#'
		),
		'widget_mdw_social_media_11' => array(
			'temp_sidebar'		 => 'footer_area_right',
			'widget_id'			 => 'mdw_social_media',
			'page_id'			 => $blog_page_id,
			'template_number'	 => '2',
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'title'				 => 'INSTAGRAM FEED',
			'insta'				 => 'mdwpresentation',
			'insta_url'			 => '',
			'img_count'			 => '6',
			'fieldCount'		 => '0'
		)
	);

    for($i=1; $i<=4; $i++){
        wp_insert_comment( ${'comment_'.$i});
    }

	$blog_page_widgets			 = array();
	$blog_sidebar_widgets		 = array();
	$blog_footer_left_widgets	 = array();
	$blog_footer_middle_widgets	 = array();
	$blog_footer_right_widgets	 = array();

	foreach ( $widgets as $name => $settings ) {
		$name			 = substr( $name, 0, strrpos( $name, '_' ) );
		$current_options = get_option( $name );

		reset( $current_options );
		$first_key = key( $current_options );

		if ( '' == $current_options || count( $current_options ) == 1 && ('_multiwidget' == $first_key || '0' == $first_key) ) {
			$current_options = array();
			array_unshift( $current_options, '', '' );
			unset( $current_options[ 0 ] );
			unset( $current_options[ 1 ] );
		}

		$current_ids = array();

		foreach ( $current_options as $co ) {
			$current_ids[] = $co[ 'widget_id' ];
		}

		//sort array by values descending
		natsort( $current_ids );
		$current_ids = array_reverse( $current_ids );
		//reset indexes
		$current_ids = array_values( $current_ids );

		$last_id			 = count( $current_ids ) ? $current_ids[ 0 ] : '';
		$last_id_index		 = substr( $last_id, strrpos( $last_id, '-' ) + 1 );
		$new_widget_id_index = ('' != $last_id_index) ? $last_id_index + 1 : 2;

		$settings[ 'widget_id' ] .= '-' . $new_widget_id_index;

		$data[ 'widgets' ][] = $settings[ 'widget_id' ];

		if ( 'widget_area' == $settings[ 'temp_sidebar' ] ) {
			$blog_page_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'sidebar_area' == $settings[ 'temp_sidebar' ] ) {
			$blog_sidebar_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_left' == $settings[ 'temp_sidebar' ] ) {
			$blog_footer_left_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_middle' == $settings[ 'temp_sidebar' ] ) {
			$blog_footer_middle_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_right' == $settings[ 'temp_sidebar' ] ) {
			$blog_footer_right_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		}

		$current_options[]					 = $settings;
		$current_options[ '_multiwidget' ]	 = 1;
		update_option( $name, $current_options );
	}

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( !isset( $sidebars_widgets[ 'blog-homepage' ] ) ) {
		$sidebars_widgets[ 'blog-homepage' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'blog-sidebar' ] ) ) {
		$sidebars_widgets[ 'blog-sidebar' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-left' ] ) ) {
		$sidebars_widgets[ 'footer-left' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-middle' ] ) ) {
		$sidebars_widgets[ 'footer-middle' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-right' ] ) ) {
		$sidebars_widgets[ 'footer-right' ] = array();
	}

	$sidebars_widgets[ 'blog-homepage' ] = array_merge( $sidebars_widgets[ 'blog-homepage' ], $blog_page_widgets );
	$sidebars_widgets[ 'blog-sidebar' ]	 = array_merge( $sidebars_widgets[ 'blog-sidebar' ], $blog_sidebar_widgets );
	$sidebars_widgets[ 'footer-left' ]	 = array_merge( $sidebars_widgets[ 'footer-left' ], $blog_footer_left_widgets );
	$sidebars_widgets[ 'footer-middle' ] = array_merge( $sidebars_widgets[ 'footer-middle' ], $blog_footer_middle_widgets );
	$sidebars_widgets[ 'footer-right' ]	 = array_merge( $sidebars_widgets[ 'footer-right' ], $blog_footer_right_widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	set_theme_mod( 'color_scheme', 'grey-skin' );
	set_theme_mod( 'footer_type', 'advanced' );
	set_theme_mod( 'load_more_posts', 'pagination' );

	update_post_meta( $blog_page_id, 'meta-navigation-type', 'both' );
	update_post_meta( $blog_page_id, 'meta-navbar-type', 'scrolling' );
	update_post_meta( $blog_page_id, 'meta-sidenav-type', 'fixed' );
	update_post_meta( $blog_page_id, 'meta-transparent-type', 'no' );
	update_post_meta( $blog_page_id, 'custom-layout-meta-box-dropdown', 'container_sidebar' );

	$current_data	 = get_option( 'dummy_content' ) ? get_option( 'dummy_content' ) : array();
	$updated_data	 = array_merge_recursive( $current_data, $data );
    $links = array( 
        "links" => array (
            "blog" => get_permalink( $blog_page_id ),
        )
    );
    $updated_data    = array_merge_recursive( $links, $updated_data );
	update_option( 'dummy_content', $updated_data );

	$response = array(
		'link'		 => get_permalink( $blog_page_id ),
		'status'	 => 'ok',
		'message'	 => 'Loaded!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_load_blog_page', 'load_blog_page' );

/**
 * Loads Demo Ecommerce Page to your wordpress 
 */
function load_ecommerce_page() {

	if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		$response = array(
			'link'		 => '',
			'status'	 => 'error',
			'message'	 => 'In order to use this feature you have to install, activate and configure WooCommerce plugin.'
		);
		echo json_encode( $response );
		exit();
	}

	$data = array(
		'page_id'		 => array(),
		'widgets'		 => array(),
		'posts'			 => array(),
		'categories'	 => array(),
		'attachments'	 => array(),
		'templates'		 => array()
	);

	$ecommerce_page_id = wp_insert_post( array(
		'post_type'		 => 'page',
		'post_title'	 => 'ecommerce-demo',
		'post_status'	 => 'publish'
	) );
	add_post_meta( $ecommerce_page_id, '_wp_page_template', 'template-ecommerce.php' );

	$data[ 'page_id' ][]	 = $ecommerce_page_id;
	$data[ 'templates' ][]	 = 'ecommerce';

	//Categories
	$cat_accessories = wp_insert_term(
	'Accessories', // the term
 'product_cat', // the taxonomy
 array(
		'slug' => 'accessories'
	)
	);
	$thumb_acc_id	 = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/vertical/img%20(12).jpg', $cat_accessories[ 'term_id' ] );
	update_woocommerce_term_meta( $cat_accessories[ 'term_id' ], 'thumbnail_id', $thumb_acc_id );

	$cat_dresses	 = wp_insert_term(
	'Dresses', // the term
 'product_cat', // the taxonomy
 array(
		'slug' => 'dresses'
	)
	);
	$thumb_dre_id	 = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/vertical/img%20(10).jpg', $cat_dresses[ 'term_id' ] );
	update_woocommerce_term_meta( $cat_dresses[ 'term_id' ], 'thumbnail_id', $thumb_dre_id );

	$cat_shorts		 = wp_insert_term(
	'Shorts', // the term
 'product_cat', // the taxonomy
 array(
		'slug' => 'shorts'
	)
	);
	$thumb_sho_id	 = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/vertical/lq/img%20(3).jpg', $cat_shorts[ 'term_id' ] );
	update_woocommerce_term_meta( $cat_shorts[ 'term_id' ], 'thumbnail_id', $thumb_sho_id );

	$cat_tops		 = wp_insert_term(
	'Tops', // the term
 'product_cat', // the taxonomy
 array(
		'slug' => 'tops'
	)
	);
	$thumb_top_id	 = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/vertical/lq/img%20(1).jpg', $cat_tops[ 'term_id' ] );
	update_woocommerce_term_meta( $cat_tops[ 'term_id' ], 'thumbnail_id', $thumb_top_id );

	//Products
	$prod_running_shoes = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => 'Running shoes',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_wc_average_rating' => '5'
		)
	) );

	$thumb_run = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(13).jpg', $prod_running_shoes );
	wp_set_object_terms( $prod_running_shoes, $cat_accessories[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_running_shoes, 'simple', 'product_type' );

	update_post_meta( $prod_running_shoes, '_visibility', 'visible' );
	update_post_meta( $prod_running_shoes, '_stock_status', 'instock' );
	update_post_meta( $prod_running_shoes, '_regular_price', '129' );
	update_post_meta( $prod_running_shoes, '_sale_price', '69' );
	update_post_meta( $prod_running_shoes, '_price', '69' );

	$prod_school_bag = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => 'School bag',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_wc_average_rating' => '5'
		)
	) );

	$thumb_sch = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(17).jpg', $prod_school_bag );
	wp_set_object_terms( $prod_school_bag, $cat_accessories[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_school_bag, 'simple', 'product_type' );

	update_post_meta( $prod_school_bag, '_visibility', 'visible' );
	update_post_meta( $prod_school_bag, '_stock_status', 'instock' );
	update_post_meta( $prod_school_bag, '_regular_price', '120' );
	update_post_meta( $prod_school_bag, '_sale_price', '99' );
	update_post_meta( $prod_school_bag, '_price', '99' );

	$prod_womens_watch = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => "Women's watch",
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_regular_price'	 => '129',
			'_sale_price'		 => '69',
			'_wc_average_rating' => '5'
		)
	) );

	$thumb_wom = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(9).jpg', $prod_womens_watch );
	wp_set_object_terms( $prod_womens_watch, $cat_accessories[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_womens_watch, 'simple', 'product_type' );

	update_post_meta( $prod_womens_watch, '_visibility', 'visible' );
	update_post_meta( $prod_womens_watch, '_stock_status', 'instock' );
	update_post_meta( $prod_womens_watch, '_regular_price', '129' );
	update_post_meta( $prod_womens_watch, '_sale_price', '69' );
	update_post_meta( $prod_womens_watch, '_price', '69' );

	$prod_fashion_sneakers = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => 'Fashion sneakers',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_wc_average_rating' => '4'
		)
	) );

	$thumb_fas = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(12).jpg', $prod_fashion_sneakers );
	wp_set_object_terms( $prod_fashion_sneakers, $cat_dresses[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_fashion_sneakers, 'simple', 'product_type' );

	update_post_meta( $prod_fashion_sneakers, '_visibility', 'visible' );
	update_post_meta( $prod_fashion_sneakers, '_stock_status', 'instock' );
	update_post_meta( $prod_fashion_sneakers, '_regular_price', '89' );
	update_post_meta( $prod_fashion_sneakers, '_sale_price', '49' );
	update_post_meta( $prod_fashion_sneakers, '_price', '49' );

	$prod_outdoor_dress = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => 'Outdoor dress',
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_wc_average_rating' => '4'
		)
	) );

	$thumb_out = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(8).jpg', $prod_outdoor_dress );
	wp_set_object_terms( $prod_outdoor_dress, $cat_dresses[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_outdoor_dress, 'simple', 'product_type' );

	update_post_meta( $prod_outdoor_dress, '_visibility', 'visible' );
	update_post_meta( $prod_outdoor_dress, '_stock_status', 'instock' );
	update_post_meta( $prod_outdoor_dress, '_regular_price', '89' );
	update_post_meta( $prod_outdoor_dress, '_sale_price', '49' );
	update_post_meta( $prod_outdoor_dress, '_price', '49' );

	$prod_womens_sneakers = wp_insert_post( array(
		'post_type'		 => 'product',
		'post_title'	 => "Women's sneakers",
		'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis aut rerum.',
		'post_status'	 => 'publish',
		'meta_input'	 => array(
			'_wc_average_rating' => '5'
		)
	) );

	$thumb_wom = Generate_Featured_Image( 'http://mdbootstrap.com/images/ecommerce/reg/reg%20(7).jpg', $prod_womens_sneakers );
	wp_set_object_terms( $prod_womens_sneakers, $cat_dresses[ 'term_id' ], 'product_cat' );
	wp_set_object_terms( $prod_womens_sneakers, 'simple', 'product_type' );

	update_post_meta( $prod_womens_sneakers, '_visibility', 'visible' );
	update_post_meta( $prod_womens_sneakers, '_stock_status', 'instock' );
	update_post_meta( $prod_womens_sneakers, '_regular_price', '120' );
	update_post_meta( $prod_womens_sneakers, '_sale_price', '49' );
	update_post_meta( $prod_womens_sneakers, '_price', '49' );

	$data[ 'posts' ]		 = array(
		$prod_running_shoes,
		$prod_school_bag,
		$prod_womens_watch,
		$prod_fashion_sneakers,
		$prod_outdoor_dress,
		$prod_womens_sneakers
	);
	$data[ 'categories' ]	 = array(
		$cat_accessories[ 'term_id' ],
		$cat_dresses[ 'term_id' ],
		$cat_shorts[ 'term_id' ],
		$cat_tops[ 'term_id' ]
	);
	$data[ 'attachments' ]	 = array(
		$thumb_run,
		$thumb_sch,
		$thumb_wom,
		$thumb_fas,
		$thumb_out,
		$thumb_wom
	);

	$widgets = array(
		'widget_mdw_carousel_0'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_carousel',
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'box_layout'		 => 'container',
			'what_to_feed'		 => 'custom',
			'fieldCount'		 => '3',
			'image_1'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2836%29.jpg',
			'caption_heading_1'	 => 'Take a look at our Trends and prepare for Fall Season',
			'caption_1'			 => 'New Fall / Winter handbags',
			'image_2'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2837%29.jpg',
			'caption_heading_2'	 => "Choose your favourite one and you're never be cold",
			'caption_2'			 => 'Best sweaters for winter',
			'image_3'			 => 'http://mdbootstrap.com/img/Photos/Slides/img%20%2838%29.jpg',
			'caption_heading_3'	 => 'Go for holidays with our shirts and sunglasses',
			'caption_3'			 => 'New arrivals for summer'
		),
		'widget_mdw_divider_1'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'title'				 => 'Featured Collections',
			'color'				 => '#666666'
		),
		'widget_mdw_ecommerce_2'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_ecommerce',
			'template_number'	 => '4',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'box_layout'		 => 'container',
			'prod_category'		 => 'All categories',
			'amount'			 => '4'
		),
		'widget_mdw_divider_3'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'title'				 => 'New Arrivals',
			'color'				 => '#666666'
		),
		'widget_mdw_ecommerce_4'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_ecommerce',
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'box_layout'		 => 'container',
			'prod_category'		 => $cat_dresses,
			'amount'			 => '3',
			'columns_amount'	 => '3'
		),
		'widget_mdw_divider_5'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_divider',
			'template_number'	 => '1',
			'box_layout'		 => 'container',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'title'				 => 'Featured Products',
			'color'				 => '#666666'
		),
		'widget_mdw_ecommerce_6'			 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_ecommerce',
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'page_id'			 => $ecommerce_page_id,
			'box_layout'		 => 'container',
			'prod_category'		 => $cat_accessories,
			'amount'			 => '3',
			'columns_amount'	 => '3'
		),
		'widget_mdw_full_width_section_7'	 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_full_width_section',
			'template_number'	 => '2',
			'page_id'			 => $ecommerce_page_id,
			'title_1'			 => '500+ happy customers',
			'background_image_1' => 'http://mdbootstrap.com/images/ecommerce/slides/slide%20(3).jpg',
			'big_font_1'		 => 'checked'
		),
		'widget_mdw_features_8'				 => array(
			'temp_sidebar'		 => 'widget_area',
			'widget_id'			 => 'mdw_features',
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'fieldCount'		 => '3',
			'what_to_feed'		 => 'custom',
			'icon_container_1'	 => 'fa fa-trophy',
			'icon_color_1'		 => '#373a3c',
			'name_1'			 => 'Quality guaranteed',
			'icon_container_2'	 => 'fa fa-truck',
			'icon_color_2'		 => '#373a3c',
			'name_2'			 => 'Free delivery',
			'icon_container_3'	 => 'fa fa-lock',
			'icon_color_3'		 => '#373a3c',
			'name_3'			 => 'Secure payment'
		),
		'widget_mdw_social_media_9'			 => array(
			'temp_sidebar'		 => 'footer_area_left',
			'widget_id'			 => 'mdw_social_media',
			'page_id'			 => $ecommerce_page_id,
			'template_number'	 => '1',
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'fieldCount'		 => '8',
			'icon_container_1'	 => 'fa fa-facebook',
			'icon_color_1'		 => '#3B5998',
			'icon_url_1'		 => '#',
			'icon_container_2'	 => 'fa fa-instagram',
			'icon_color_2'		 => '#3F729B',
			'icon_url_2'		 => '#',
			'icon_container_3'	 => 'fa fa-twitter',
			'icon_color_3'		 => '#55ACEE',
			'icon_url_3'		 => '#',
			'icon_container_4'	 => 'fa fa-youtube',
			'icon_color_4'		 => '#cd201f',
			'icon_url_4'		 => '#',
			'icon_container_5'	 => 'fa fa-linkedin',
			'icon_color_5'		 => '#0082ca',
			'icon_url_5'		 => '#',
			'icon_container_6'	 => 'fa fa-dribbble',
			'icon_color_6'		 => '#c32361',
			'icon_url_6'		 => '#',
			'icon_container_7'	 => 'fa fa-pinterest',
			'icon_color_7'		 => '#c61118',
			'icon_url_7'		 => '#',
			'icon_container_8'	 => 'fa fa-google-plus',
			'icon_color_8'		 => '#DD4B39',
			'icon_url_8'		 => '#'
		),
		'widget_text_10'					 => array(
			'temp_sidebar'	 => 'footer_area_middle',
			'widget_id'		 => 'text',
			'title'			 => '',
			'text'			 => 'CONTACT INFO
                <br><br>
                New York, NY 10012<br>
                United States<br>
                + 01 234 567 89<br>
                info@gmail.com',
			'filter'		 => false
		),
		'widget_mdw_social_media_11'		 => array(
			'temp_sidebar'		 => 'footer_area_right',
			'widget_id'			 => 'mdw_social_media',
			'page_id'			 => $ecommerce_page_id,
			'template_number'	 => '2',
			'animation'			 => 'fadeIn',
			'box_layout'		 => 'container',
			'title'				 => 'INSTAGRAM FEED',
			'insta'				 => 'mdwpresentation',
			'insta_url'			 => '',
			'img_count'			 => '6',
			'fieldCount'		 => '0'
		)
	);

	$ecommerce_page_widgets			 = array();
	$ecommerce_footer_left_widgets	 = array();
	$ecommerce_footer_middle_widgets = array();
	$ecommerce_footer_right_widgets	 = array();

	foreach ( $widgets as $name => $settings ) {
		$name			 = substr( $name, 0, strrpos( $name, '_' ) );
		$current_options = get_option( $name );

		reset( $current_options );
		$first_key = key( $current_options );

		if ( '' == $current_options || count( $current_options ) == 1 && ('_multiwidget' == $first_key || '0' == $first_key) ) {
			$current_options = array();
			array_unshift( $current_options, '', '' );
			unset( $current_options[ 0 ] );
			unset( $current_options[ 1 ] );
		}

		$current_ids = array();

		foreach ( $current_options as $co ) {
			$current_ids[] = $co[ 'widget_id' ];
		}

		//sort array by values descending
		natsort( $current_ids );
		$current_ids = array_reverse( $current_ids );
		//reset indexes
		$current_ids = array_values( $current_ids );

		$last_id			 = count( $current_ids ) ? $current_ids[ 0 ] : '';
		$last_id_index		 = substr( $last_id, strrpos( $last_id, '-' ) + 1 );
		$new_widget_id_index = ('' != $last_id_index) ? $last_id_index + 1 : 2;

		$settings[ 'widget_id' ] .= '-' . $new_widget_id_index;

		$data[ 'widgets' ][] = $settings[ 'widget_id' ];

		if ( 'widget_area' == $settings[ 'temp_sidebar' ] ) {
			$ecommerce_page_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_left' == $settings[ 'temp_sidebar' ] ) {
			$ecommerce_footer_left_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_middle' == $settings[ 'temp_sidebar' ] ) {
			$ecommerce_footer_middle_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		} elseif ( 'footer_area_right' == $settings[ 'temp_sidebar' ] ) {
			$ecommerce_footer_right_widgets[] = $settings[ 'widget_id' ];
			unset( $settings[ 'temp_sidebar' ] );
		}

		$current_options[]					 = $settings;
		$current_options[ '_multiwidget' ]	 = 1;
		update_option( $name, $current_options );
	}

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( !isset( $sidebars_widgets[ 'ecommerce-page' ] ) ) {
		$sidebars_widgets[ 'ecommerce-page' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-left' ] ) ) {
		$sidebars_widgets[ 'footer-left' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-middle' ] ) ) {
		$sidebars_widgets[ 'footer-middle' ] = array();
	}

	if ( !isset( $sidebars_widgets[ 'footer-right' ] ) ) {
		$sidebars_widgets[ 'footer-right' ] = array();
	}

	$sidebars_widgets[ 'ecommerce-page' ]	 = array_merge( $sidebars_widgets[ 'ecommerce-page' ], $ecommerce_page_widgets );
	$sidebars_widgets[ 'footer-left' ]		 = array_merge( $sidebars_widgets[ 'footer-left' ], $ecommerce_footer_left_widgets );
	$sidebars_widgets[ 'footer-middle' ]	 = array_merge( $sidebars_widgets[ 'footer-middle' ], $ecommerce_footer_middle_widgets );
	$sidebars_widgets[ 'footer-right' ]		 = array_merge( $sidebars_widgets[ 'footer-right' ], $ecommerce_footer_right_widgets );

	update_option( 'sidebars_widgets', $sidebars_widgets );

	set_theme_mod( 'color_scheme', 'pink-skin' );
	set_theme_mod( 'footer_type', 'advanced' );
	set_theme_mod( 'load_more_posts', 'pagination' );

	update_post_meta( $ecommerce_page_id, 'meta-navigation-type', 'both' );
	update_post_meta( $ecommerce_page_id, 'meta-navbar-type', 'scrolling' );
	update_post_meta( $ecommerce_page_id, 'meta-sidenav-type', 'hidden' );
	update_post_meta( $ecommerce_page_id, 'meta-transparent-type', 'no' );
	update_post_meta( $ecommerce_page_id, 'custom-layout-meta-box-dropdown', 'full' );

	$current_data	 = get_option( 'dummy_content' ) ? get_option( 'dummy_content' ) : array();
	$updated_data	 = array_merge_recursive( $current_data, $data );
    $links = array( 
        "links" => array (
            "ecomerce" => get_permalink( $ecommerce_page_id ),
        )
    );
    $updated_data    = array_merge_recursive( $links, $updated_data );
	update_option( 'dummy_content', $updated_data );

	$response = array(
		'link'		 => get_permalink( $ecommerce_page_id ),
		'status'	 => 'ok',
		'message'	 => 'Loaded!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_load_ecommerce_page', 'load_ecommerce_page' );

function load_all() {

	echo 'Loaded!';
	exit();
}

add_action( 'wp_ajax_load_all', 'load_all' );

/**
 * Clears dummy content from your wordpress
 */
function clear_dummy_content() {
	$current_data		 = get_option( 'dummy_content' );
	$sidebars_widgets	 = get_option( 'sidebars_widgets' );

	foreach ( $current_data[ 'widgets' ] as $key => $id ) {

		foreach ( $sidebars_widgets as $sidebar => $widgets ) {

			if ( is_array( $widgets ) ) {
				$found_index = array_search( $id, $sidebars_widgets[ $sidebar ] );
			}

			if ( false !== $found_index ) {
				unset( $sidebars_widgets[ $sidebar ][ $found_index ] );
				update_option( 'sidebars_widgets', $sidebars_widgets );
				$widget_option	 = 'widget_' . substr( $id, 0, strrpos( $id, '-' ) );
				$widget_settings = get_option( $widget_option );

				foreach ( $widget_settings as $key => $settings ) {

					if ( isset( $widget_settings[ $key ][ 'widget_id' ] ) && $widget_settings[ $key ][ 'widget_id' ] == $id ) {
						unset( $widget_settings[ $key ] );
						update_option( $widget_option, $widget_settings );
					}
				}
			}
		}
	}

	foreach ( $current_data[ 'page_id' ] as $index => $id ) {
		wp_delete_post( $id );
	}

	foreach ( $current_data[ 'posts' ] as $index => $id ) {
		wp_delete_post( $id );
	}

	foreach ( $current_data[ 'attachments' ] as $index => $id ) {
		wp_delete_attachment( $id );
	}

	foreach ( $current_data[ 'categories' ] as $index => $id ) {

		if ( 1 != $id ) {

			if ( !wp_delete_term( $id, 'category' ) ) {
				wp_delete_term( $id, 'product_cat' );
			}
		}
	}

	delete_option( 'dummy_content' );

	$response = array(
		'status'	 => 'ok',
		'message'	 => 'Content erased!'
	);
	echo json_encode( $response );
	exit();
}

add_action( 'wp_ajax_clear_dummy_content', 'clear_dummy_content' );

