<?php

//if user has active mdw theme and has only 1 default wordpress post insert 6 custom MDW posts
//
function insert_initial_posts() {


	$insert =  get_theme_mod( 'insert-post-initial' );
    $all_menus = get_terms(array("taxonomy" => 'nav_menu'));

	if ( $insert != true ) {
	if (empty($all_menus)){

		$theme		 = wp_get_theme();
		$theme_name	 = $theme->Name;
		$args		 = array(
			'post_type' => 'post',
		);

		$posts_count	 = wp_count_posts();
		$current_post	 = get_posts( $args );


			// Check if the menu exists
			$menu_name = 'My First MDW Menu';
			$menu_exists = wp_get_nav_menu_object( $menu_name );

			// If it doesn't exist, let's create it.
			if( !$menu_exists ){
				$menu_id = wp_create_nav_menu($menu_name);

				// Set up default menu items
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title' =>  __('Home'),
					'menu-item-classes' => 'home',
					'menu-item-url' => home_url( '/' ), 
					'menu-item-status' => 'publish'));
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title' =>  __('Sample Page'),
					'menu-item-url' => home_url( '/' ), 
					'menu-item-status' => 'publish'));

				$locations = get_theme_mod( 'nav_menu_locations' );
				if(!$locations){
					$locations= array(
						'navbar' => '',
						'sidenav' => '',
					);
				}

				if(!empty($locations))
				{
					foreach($locations as $locationId => $menuValue)
					{
						$menu = get_term_by('name', $menu_name, 'nav_menu');

						if(isset($menu))
						{
							$locations[$locationId] = $menu->term_id;
						}
					}

					set_theme_mod('nav_menu_locations', $locations);
				}
			}
        }
		if (wp_count_posts()->publish <= '3' && $insert != 'true'){
			$post_1	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => 'Paradise on tropical island',
				'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_1 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2891%29.jpg', $post_1 );
			$comment_1 = array(
				'comment_ID' => "568",
				'comment_post_ID' => $post_1,
				'comment_author'  => 'MDW Team',
				'comment_date'    => '2017-03-01 10:22:25',
				'comment_content' => 'Typography, style, idea, design – clean =)',
				'user_id'         => '1'

			);
			$post_2	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => 'Five tips for studying in New York.',
				'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_2 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/City/8-col/img%20%2834%29.jpg', $post_2 );

			$post_3	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => 'Play music around the world.',
				'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_3 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/People/4-col/img%20%2841%29.jpg', $post_3 );
			$comment_2 = array(
				'comment_ID' => "569",
				'comment_post_ID' => $post_3,
				'comment_author'  => 'MDW Team',
				'comment_date'    => '2017-03-01 10:22:25',
				'comment_content' => 'This is elegant work :)',
				'user_id'         => '1'

			);
			$post_4	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => '5 tips on how to photograph wild animals',
				'post_content'	 => 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_4 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2884%29.jpg', $post_4 );

			$post_5	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => 'Admire lions on the savannah.',
				'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_5 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%2892%29.jpg', $post_5 );

			$post_6	 = wp_insert_post( array(
				'post_type'		 => 'post',
				'post_title'	 => 'Owls and their mysterious nightlife',
				'post_content'	 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus viverra eros, nec accumsan ligula fringilla nec. Fusce at sapien neque. Curabitur sed augue sem. Suspendisse non hendrerit nisi, in finibus ante. Aenean vel magna urna. Nulla ac est non risus fringilla iaculis id ut ex.',
				'post_category'	 => array(
					'id'	 => '1',
					'color'	 => '#4CAF50',
					'icon'	 => 'fa fa-camera'
				),
				'post_status'	 => 'publish'
			) );
			$thumb_6 = Generate_Featured_Image( 'http://mdbootstrap.com/img/Photos/Horizontal/Nature/8-col/img%20%2889%29.jpg', $post_6 );
			for($i=1; $i<=2; $i++){
				wp_insert_comment( ${'comment_'.$i});
			}
		}

		set_theme_mod( 'insert-post-initial', 'true' );

	}

}

insert_initial_posts();
