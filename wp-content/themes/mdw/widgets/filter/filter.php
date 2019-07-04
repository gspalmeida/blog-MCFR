<?php
/*
  Plugin Name: MDW Filter
  Plugin URI: http://mdwp.io/
  Description: Filtering products by attributes
  Author: MDWP.io
  Version: 4.2.0
  Author URI: http://mdwp.io
 */

// Block direct requests

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WC_Widget' ) ) {

	function add_filter_widget() {
		register_widget( 'MDW_products_filter' );
	}

	add_action( 'widgets_init', 'add_filter_widget' );

	class MDW_products_filter extends WC_Widget {

		public function __construct() {
			$this->widget_cssclass		 = 'mdw_products_filter';
			$this->widget_description	 = __( 'Shows a custom filter for products', 'mdw' );
			$this->widget_id			 = 'mdw_products_filter';
			$this->widget_name			 = __( 'MDW Products Filter', 'mdw' );
			parent::__construct();
		}

		/**
		 * @param $instance
		 */
		public function form( $instance ) {
			$this->init_settings();
			parent::form( $instance );
		}

		public function init_settings() {
			$attribute_array		 = array();
			$attribute_taxonomies	 = wc_get_attribute_taxonomies();

			if ( !empty( $attribute_taxonomies ) ) {

				foreach ( $attribute_taxonomies as $tax ) {

					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
						$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
					}
				}
			}
			?>
			<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
				<!-- Version preview -->
				<div id="<?php echo $this->get_field_id( 'tooltip' ); ?>">
					<!-- Preview container -->
					<img src="">
					<!-- Stores prewiews directory path -->
					<span data-src="<?php echo get_template_directory_uri() . "/widgets/" . basename( dirname( __FILE__ ) ) ?>"></span>
				</div>

				<li class="nav-item">
					<a data-toggle="tooltip" data-prev="template_1" class="nav-link active" data-toggle="tab" href="#" data-href="#v1" role="tab" name="<?php echo $this->get_field_name( 'name' ); ?>">Version 1 <i class="fa fa-eye"></i></a>
				</li>
			</ul>
			<br>
			<br>
			<br>
			<?php
			$this->settings = array(
				'title'		 => array(
					'type'	 => 'text',
					'std'	 => __( 'Filter by', 'mdw' ),
					'label'	 => __( 'Title', 'mdw' )
				),
				'attribute'	 => array(
					'type'		 => 'select',
					'std'		 => '',
					'label'		 => __( 'Attribute', 'mdw' ),
					'options'	 => $attribute_array
				),
				'query_type' => array(
					'type'		 => 'select',
					'std'		 => 'and',
					'label'		 => __( 'Query type', 'mdw' ),
					'options'	 => array(
						'and'	 => __( 'AND', 'mdw' ),
						'or'	 => __( 'OR', 'mdw' )
					)
				)
			);
		}

		/**
		 * @param $new_instance
		 * @param $old_instance
		 */
		public function update( $new_instance, $old_instance ) {
			$this->init_settings();
			return parent::update( $new_instance, $old_instance );
		}

		/**
		 * @param $args
		 * @param $instance
		 * @return null
		 */
		public function widget( $args, $instance ) {

			if ( !is_post_type_archive( 'product' ) && !is_tax( get_object_taxonomies( 'product' ) ) ) {
				return;
			}

			$_chosen_attributes	 = WC_Query::get_layered_nav_chosen_attributes();
			$taxonomy			 = isset( $instance[ 'attribute' ] ) ? wc_attribute_taxonomy_name( $instance[ 'attribute' ] ) : $this->settings[ 'attribute' ][ 'std' ];
			$query_type			 = isset( $instance[ 'query_type' ] ) ? $instance[ 'query_type' ] : $this->settings[ 'query_type' ][ 'std' ];
			$display_type		 = 'list';

			if ( !taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$get_terms_args = array( 'hide_empty' => '1' );

			$orderby = wc_attribute_orderby( $taxonomy );

			switch ( $orderby ) {
				case 'name':
					$get_terms_args[ 'orderby' ]	 = 'name';
					$get_terms_args[ 'menu_order' ]	 = false;
					break;
				case 'id':
					$get_terms_args[ 'orderby' ]	 = 'id';
					$get_terms_args[ 'order' ]		 = 'ASC';
					$get_terms_args[ 'menu_order' ]	 = false;
					break;
				case 'menu_order':
					$get_terms_args[ 'menu_order' ]	 = 'ASC';
					break;
			}

			$terms = get_terms( $taxonomy, $get_terms_args );

			if ( 0 === count( $terms ) ) {
				return;
			}

			switch ( $orderby ) {
				case 'name_num':
					usort( $terms, '_wc_get_product_terms_name_num_usort_callback' );
					break;
				case 'parent':
					usort( $terms, '_wc_get_product_terms_parent_usort_callback' );
					break;
			}

			ob_start();

			$args[ 'before_title' ] = '<h4 class="card-header white-text py-1 my-2 row">';

			$args[ 'after_title' ] = '</h4><div class="my-2 row"></div>';

			$this->widget_start( $args, $instance );

			$found = $this->mdw_product_list( $terms, $taxonomy, $query_type );

			$this->widget_end( $args );

			if ( !is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) ) {
				$found = true;
			}

			if ( !$found ) {
				ob_end_clean();
			} else {
				echo ob_get_clean();
			}
		}

		protected function get_current_taxonomy() {
			return is_tax() ? get_queried_object()->taxonomy : '';
		}

		protected function get_current_term_id() {
			return absint( is_tax() ? get_queried_object()->term_id : 0 );
		}

		protected function get_current_term_slug() {
			return absint( is_tax() ? get_queried_object()->slug : 0 );
		}

		/**
		 * @param $term_ids
		 * @param $taxonomy
		 * @param $query_type
		 */
		protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type ) {
			global $wpdb;

			$tax_query	 = WC_Query::get_main_tax_query();
			$meta_query	 = WC_Query::get_main_meta_query();

			if ( 'or' === $query_type ) {

				foreach ( $tax_query as $key => $query ) {

					if ( $taxonomy === $query[ 'taxonomy' ] ) {
						unset( $tax_query[ $key ] );
					}
				}
			}

			$meta_query		 = new WP_Meta_Query( $meta_query );
			$tax_query		 = new WP_Tax_Query( $tax_query );
			$meta_query_sql	 = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
			$tax_query_sql	 = $tax_query->get_sql( $wpdb->posts, 'ID' );

			$query				 = array();
			$query[ 'select' ]	 = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
			$query[ 'from' ]	 = "FROM {$wpdb->posts}";
			$query[ 'join' ]	 = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql[ 'join' ] . $meta_query_sql[ 'join' ];

			$query[ 'where' ] = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql[ 'where' ] . $meta_query_sql[ 'where' ] . '
			AND terms.term_id IN (' . implode( ',', array_map( 'absint', $term_ids ) ) . ')
		';

			if ( $search = WC_Query::get_main_search_query_sql() ) {
				$query[ 'where' ] .= ' AND ' . $search;
			}

			$query[ 'group_by' ] = 'GROUP BY terms.term_id';
			$query				 = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
			$query				 = implode( ' ', $query );
			$results			 = $wpdb->get_results( $query );

			return wp_list_pluck( $results, 'term_count', 'term_count_id' );
		}

		/**
		 * @param $taxonomy
		 * @return mixed
		 */
		protected function get_page_base_url( $taxonomy ) {

			if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
				$link = home_url();
			} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
				$link = get_post_type_archive_link( 'product' );
			} elseif ( is_product_category() ) {
				$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
			} elseif ( is_product_tag() ) {
				$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
			} else {
				$queried_object	 = get_queried_object();
				$link			 = get_term_link( $queried_object->slug, $queried_object->taxonomy );
			}

			if ( isset( $_GET[ 'min_price' ] ) ) {
				$link = add_query_arg( 'min_price', wc_clean( $_GET[ 'min_price' ] ), $link );
			}

			if ( isset( $_GET[ 'max_price' ] ) ) {
				$link = add_query_arg( 'max_price', wc_clean( $_GET[ 'max_price' ] ), $link );
			}

			if ( isset( $_GET[ 'orderby' ] ) ) {
				$link = add_query_arg( 'orderby', wc_clean( $_GET[ 'orderby' ] ), $link );
			}

			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
			}

			if ( isset( $_GET[ 'post_type' ] ) ) {
				$link = add_query_arg( 'post_type', wc_clean( $_GET[ 'post_type' ] ), $link );
			}

			if ( isset( $_GET[ 'min_rating' ] ) ) {
				$link = add_query_arg( 'min_rating', wc_clean( $_GET[ 'min_rating' ] ), $link );
			}

			if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {

				foreach ( $_chosen_attributes as $name => $data ) {

					if ( $name === $taxonomy ) {
						continue;
					}

					$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );

					if ( !empty( $data[ 'terms' ] ) ) {
						$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data[ 'terms' ] ), $link );
					}

					if ( 'or' == $data[ 'query_type' ] ) {
						$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
					}
				}
			}

			return $link;
		}

		/**
		 * @param $terms
		 * @param $taxonomy
		 * @param $query_type
		 * @return mixed
		 */
		protected function mdw_product_list( $terms, $taxonomy, $query_type ) {

			$term_counts		 = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
			$_chosen_attributes	 = WC_Query::get_layered_nav_chosen_attributes();
			$found				 = false;

			$current_values = isset( $_chosen_attributes[ $taxonomy ][ 'terms' ] ) ? $_chosen_attributes[ $taxonomy ][ 'terms' ] : array();

			global $wp;
			$current_url = home_url( add_query_arg( array(), $wp->request ) );

			echo '<ul class="mdw-filter-ul" data-query="' . $query_type . '" data-filter="' . str_replace( 'pa_', '', $taxonomy ) . '" data-current-values="' . implode( ',', $current_values ) . '" data-link="' . $current_url . '">';

			foreach ( $terms as $term ) {
				$current_values = isset( $_chosen_attributes[ $taxonomy ][ 'terms' ] ) ? $_chosen_attributes[ $taxonomy ][ 'terms' ] : array();

				$option_is_set	 = in_array( $term->slug, $current_values );
				$count			 = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

				if ( $this->get_current_term_id() === $term->term_id ) {
					continue;
				}

				if ( 0 < $count ) {
					$found = true;
				} elseif ( 'and' === $query_type && 0 === $count && !$option_is_set ) {
					continue;
				}

				$filter_name	 = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
				$current_filter	 = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
				$current_filter	 = array_map( 'sanitize_title', $current_filter );

				if ( !in_array( $term->slug, $current_filter ) ) {
					$current_filter[] = $term->slug;
				}

				foreach ( $current_filter as $key => $value ) {

					if ( $value === $term->slug ) {
						$checkbox = $value;
					}
				}

				$id = chr( 64 + rand( 1, 20 ) ) . rand( 1, 100 ) . rand( 1, 100 );

				echo '<li class="mdw-filter-widget-li ' . ($option_is_set ? 'chosen' : '') . '">';

				echo '<input type="checkbox" id="' . $id . '" ' . ($option_is_set ? 'checked' : '') . ' data-val="' . $checkbox . '">';

				echo '<label for="' . $id . '">';

				echo '<span>';

				echo esc_html( $term->name );

				echo '</span> ';

				echo '</li>';
			}

			echo '</ul>';

			echo '<button class="btn btn-primary mb-3 mdw-filter-submit">Filter products</button>';

			return $found;
		}

	}

}
