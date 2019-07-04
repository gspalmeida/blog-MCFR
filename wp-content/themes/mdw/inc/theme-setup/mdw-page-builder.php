<?php

/**
 * SAVE A WIDGET AND RETURN ITS SLUG
 * @param type $id_base
 * @param type $options
 * @param type $sidebar
 * @return type
 */
function save_widget( $id_base, $options, $sidebar ) {
	//If this is edited widget set it to true
	$edited			 = false;
	// Get current settings of sidebar
	$active_widgets	 = get_option( 'sidebars_widgets' );

	//It is an index in sidebar's widgets array. For now it's null
	$widget = null;
	// If $id_base has '-' sign it means it has an ID which means that it is edited widget, so we have to remove it and set new settings
	if ( strrpos( $id_base, '-' ) ) {
		//It is edited widget
		$edited			 = true;
		//Save current id because we want to create new widget with the same ID
		$current_index	 = substr( $id_base, strrpos( $id_base, '-' ) + 1 );
		// Search for the widget in the sidebar. It's its index in array. It's necessary for options update
		$widget			 = array_search( $id_base, $active_widgets[ $sidebar ] );
		// Remove the widget from widgets array
		unset( $active_widgets[ $sidebar ][ $widget ] );

		// Save sidebars settings
		update_option( 'sidebars_widgets', $active_widgets );
		// Cut the old ID
		$id_base = substr( $id_base, 0, strrpos( $id_base, '-' ) );
	}

	// Get all sidebars' widgets
	$sidebars_widgets = wp_get_sidebars_widgets();

	// Array containing widgets of type given as $id_base parameter
	$last_widget_of_type = array();

	// In each sidebar look for widget of the type and append it to the array
	foreach ( $sidebars_widgets as $sw ) {

		// Search for widget of the type in each sidebar ($sw)
		$widgets_of_type = preg_grep( '/' . $id_base . '/', array_reverse( $sw ) );
		// If there are widgets of the type, take one with the highest counter value, else start new iteration 
		if ( array_values( $widgets_of_type ) ) {
			$last_widget_in_sidebar	 = array_values( $widgets_of_type );
			$last_widget_in_sidebar	 = $last_widget_in_sidebar[ 0 ];
		} else {
			continue;
		}

		// So if there is a widget with the highest counter value, take the counter and put the widget into array with key value equal to counter value
		$key						 = intval( substr( $last_widget_in_sidebar, strrpos( $last_widget_in_sidebar, '-' ) + 1 ) );
		$last_widget_of_type[ $key ] = $last_widget_in_sidebar;
	}

	// Sort the array by key values
	krsort( $last_widget_of_type );

	// Counter of new widget instance equals to the highest counter value of last existing widget of the same type increased by 1. If there is not existing widget, start with 2
	$counter = count( $last_widget_of_type ) > 0 ? intval( key( $last_widget_of_type ) ) + 1 : 2;
	// If this is edited widget then its ID should be the same as before
	if ( $edited ) {
		$counter = $current_index;
	}

	// Add a widget to the sidebar. If there is set widget index it means that it is edited widget so set it on the same position as before. Else add as new
	if ( isset( $widget ) ) {
		array_splice( $active_widgets[ $sidebar ], $widget, 0, $id_base . '-' . $counter );
	} else {
		$active_widgets[ $sidebar ][] = $id_base . '-' . $counter;
	}

	// Array of options given as $options parameter
	$widget_options = array();

	/* $options parameter is an array of objects e.x.:
	 *
	 * [ {option: title, value: 'title1'}, 
	 *   {option: content, value: 'content1'} ]
	 * 
	 * So we have to pass through the array and take values of 'option' and 'value' keys and put them into $widget_options array
	 */
	foreach ( $options as $o ) {
		$widget_options[ $o[ 'option' ] ] = stripslashes( $o[ 'value' ] );
	}

	// Take widget's current settings and add new. Then save them all
	$new_options			 = get_option( 'widget_' . $id_base );
	$new_options[ $counter ] = $widget_options;

	update_option( 'widget_' . $id_base, $new_options );

	// Save sidebars settings
	update_option( 'sidebars_widgets', $active_widgets );

	// Return a slug of the widget
	return $id_base . '-' . $counter;
}

/**
 * DROP FUNCTION IS CALLED EACH TIME USER DROPS AN ELEMENT
 */
function drop() {
	// Class name of the widget 
	$cname = $_POST[ 'drag_id' ];

	// Create a form for widget settings and send it as ajax response
	echo "<form class='{$_POST[ 'drag_id' ]}' id='{$_POST[ 'id_base' ]}'>";

	$w = new $cname();

	echo $w->form( array() ) . "<i class='btn btn-primary save-settings'>Save</i><form>";

	die();
}

add_action( 'wp_ajax_drop', 'drop' );

/*
 * SAVE_WIDGET_CHANGES IS CALLED EACH TIME USER HITS 'SAVE' BUTTON IN WIDGET SETTINGS FORM
 */

function save_widget_changes() {
	// Create array of widget options
	$widget_options = array();

	/* $_POST['options'] is an array of objects e.x.:
	 *
	 * [ {option: title, value: 'title1'}, 
	 *   {option: content, value: 'content1'} ]
	 * 
	 * So we have to pass through the array and take values of 'option' and 'value' keys and put them into $widget_options array
	 */
	foreach ( $_POST[ 'options' ] as $o ) {
		$widget_options[ $o[ 'option' ] ] = stripslashes( $o[ 'value' ] );
	}

	// Display the widget with given settings and send it as ajax response
	the_widget( $_POST[ 'drag_id' ], $widget_options, array(
		'before_widget'	 => '<div class="widget %1$s" data-widget-id="' . save_widget( $_POST[ 'id_base' ], $_POST[ 'options' ], $_POST[ 'sidebar' ] ) . '">',
		'after_widget'	 => '</div>'
	)
	);

	die();
}

add_action( 'wp_ajax_save_widget_changes', 'save_widget_changes' );

/*
 * EDIT_WIDGET IS CALLED EACH TIME USER HITS 'PENCIL' ICON IN PAGE BUILDER PREVIEW
 */

function edit_widget() {
	// Take id of the widget, its instance name and sidebar the widget is in
	$widget_id		 = $_POST[ 'widget_id' ];
	$widget_instance = $_POST[ 'widget_instance' ];
	$sidebar		 = $_POST[ 'sidebar' ];

	// Get current settings of sidebar
	$active_widgets = get_option( 'sidebars_widgets' );

	// Search for the widget in the sidebar
	$widget_options	 = get_option( $widget_instance );
	//Take all registered widgets
	$widgets		 = $GLOBALS[ 'wp_widget_factory' ]->widgets;
	// For each widget search for one with same 'classname' as $widget_instance variable. In other words, find instance of widget you want to edit
	foreach ( $widgets as $w ) {
		$classname = $w->widget_options[ 'classname' ];
		// If 'classname' field matches then take class name of the widget
		if ( $classname == $widget_instance ) {
			$cname	 = get_class( $w );
			// Create form with current settings
			echo "<form class='$cname' id='$widget_id'>";
			// Take widget identifier from $widget_id
			$index	 = substr( $widget_id, strrpos( $widget_id, '-' ) + 1 );

			$form = $w->form( $widget_options[ $index ] );
			echo $form . "<i class='btn btn-primary save-settings'>Save</i><form>";
			// When form is displayed, break the loop
			break;
		}
	}

	die();
}

add_action( 'wp_ajax_edit_widget', 'edit_widget' );
/*
 * MOVE_WIDGET IS CALLED EACH TIME USER DRAG AND DROP AN EXISTING WIDGET
 */

function move_widget() {
	// 
	$widget_id		 = $_POST[ 'widget_id' ];
	$after_widget_id = $_POST[ 'after_widget_id' ];
	$sidebar		 = $_POST[ 'sidebar' ];

	// Get current settings of sidebar
	$active_widgets = get_option( 'sidebars_widgets' );

	// Search for the widget in the sidebar. It's its index in array. It's necessary for options update
	$widget = array_search( $widget_id, $active_widgets[ $sidebar ] );
	if ( isset( $_POST[ 'after_widget_id' ] ) ) {
		$after_widget = array_search( $after_widget_id, $active_widgets[ $sidebar ] );
	} else {
		$after_widget = count( $active_widgets[ $sidebar ] ) + 1;
	}

	$moved_widget = $active_widgets[ $sidebar ][ $widget ];

	if ( $widget < $after_widget ) {
		array_splice( $active_widgets[ $sidebar ], $after_widget, 0, $moved_widget );

		$widget = array_search( $widget_id, $active_widgets[ $sidebar ] );
		// Remove the widget from widgets array
		unset( $active_widgets[ $sidebar ][ $widget ] );
	} else {

		// Remove the widget from widgets array
		unset( $active_widgets[ $sidebar ][ $widget ] );

		array_splice( $active_widgets[ $sidebar ], $after_widget, 0, $moved_widget );
	}


	$active_widgets[ $sidebar ] = array_values( $active_widgets[ $sidebar ] );

	// Save sidebars settings
	update_option( 'sidebars_widgets', $active_widgets );

	die();
}

add_action( 'wp_ajax_move_widget', 'move_widget' );

/*
 * REMOVE_WIDGET IS CALLED EACH TIME USER HITS 'X' ICON IN PAGE BUILDER PREVIEW
 */

function remove_widget() {
	// Take id of the widget and sidebar the widget is in
	$widget_id	 = $_POST[ 'widget_id' ];
	$sidebar	 = $_POST[ 'sidebar' ];

	// Get current settings of sidebar
	$active_widgets = get_option( 'sidebars_widgets' );

	// Search for the widget in the sidebar
	$widget = array_search( $widget_id, $active_widgets[ $sidebar ] );
	// Remove the widget from widgets array
	unset( $active_widgets[ $sidebar ][ $widget ] );

	// Save sidebars settings
	update_option( 'sidebars_widgets', $active_widgets );

	die();
}

add_action( 'wp_ajax_remove_widget', 'remove_widget' );
?>