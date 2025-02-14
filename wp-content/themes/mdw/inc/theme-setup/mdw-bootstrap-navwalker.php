<?php

/**
 * Extended Walker class for use with the
 * Material Design for Bootstrap toolkit in Wordpress.
 * Edited to support n-levels submenu.
 * Based on https://gist.github.com/3765640
 * 
 */
class MDWBootstrapNavMenuWalker extends Walker_Nav_Menu {

	public $hoofCount = 0;

	function setHoofCount() {
		$this->hoofCount++;
		return $this->hoofCount;
	}

	function getThemeStatus( $ts ) {
		return $ts;
	}

	function getDeathDate( $dd ) {
		return $dd;
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent	 = str_repeat( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output	 .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent			 = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes	 = '';
		$class_names	 = $value			 = '';
		$classes		 = empty( $item->classes ) ? array() : (array) $item->classes;

		// managing divider: add divider class to an element to get a divider before it.
		$divider_class_position = array_search( 'divider', $classes );
		if ( $divider_class_position !== false ) {
			$output .= "<li class=\"divider\"></li>\n";
			unset( $classes[ $divider_class_position ] );
		}

		$classes[]	 = ($args->has_children) ? 'dropdown' : '';
		$classes[]	 = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[]	 = 'nav-item menu-item-' . $item->ID;
		if ( $depth && $args->has_children ) {
			$classes[] = 'dropdown-submenu';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id			 = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id			 = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$output		 .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		$attributes	 = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes	 .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes	 .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes	 .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes	 .= ($args->has_children) ? ' class="dropdown-toggle nav-link" data-toggle="dropdown" aria-labelledby="dropdownMenu1"' : ' class="nav-link"';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;

		if ( ( $this->getThemeStatus( get_theme_mod( "theme_status", "production" ) ) == "test" || ( strtotime( get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) - time() ) / 60 / 60 / 24 < 0 && get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) && $this->hoofCount < 2 ) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			$this->setHoofCount();
		}
		if ( $this->getThemeStatus( get_theme_mod( "theme_status", "production" ) ) == "production" ) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		//v($element);
		if ( !$element ) {
			return;
		}
		$id_field = $this->db_fields[ 'id' ];
		//display this element
		if ( is_array( $args[ 0 ] ) ) {
			$args[ 0 ][ 'has_children' ] = !empty( $children_elements[ $element->$id_field ] );
		} else if ( is_object( $args[ 0 ] ) ) {
			$args[ 0 ]->has_children = !empty( $children_elements[ $element->$id_field ] );
		}
		$cb_args = array_merge( array( &$output, $element, $depth ), $args );
		call_user_func_array( array( &$this, 'start_el' ), $cb_args );
		$id		 = $element->$id_field;
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[ $id ] ) ) {

			if ( $this->getThemeStatus( get_theme_mod( "theme_status", "production" ) ) == "test" ) {
				for ( $i = 0; $i < 2; $i++ ) {
					if ( !isset( $newlevel ) ) {
						$newlevel	 = true;
						//start the child delimiter
						$cb_args	 = array_merge( array( &$output, $depth ), $args );
						call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
					}
					if ( array_key_exists( $i, $children_elements[ $id ] ) ) {
						$this->display_element( $children_elements[ $id ][ $i ], $children_elements, $max_depth, $depth + 1, $args, $output );
					}
				}
			}

			if ( $this->getThemeStatus( get_theme_mod( "theme_status", "production" ) ) == "production" ) {
				foreach ( $children_elements[ $id ] as $child ) {
					if ( !isset( $newlevel ) ) {
						$newlevel	 = true;
						//start the child delimiter
						$cb_args	 = array_merge( array( &$output, $depth ), $args );
						call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
			}

			unset( $children_elements[ $id ] );
		}
		if ( isset( $newlevel ) && $newlevel ) {
			//end the child delimiter
			$cb_args = array_merge( array( &$output, $depth ), $args );
			call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
		}
		//end this element
		$cb_args = array_merge( array( &$output, $element, $depth ), $args );
		call_user_func_array( array( &$this, 'end_el' ), $cb_args );
	}

}

?>