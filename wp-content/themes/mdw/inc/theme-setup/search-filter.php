<?php

/**
 * Filters empty search requests
 * Whenever smn search for an empty phrase puts whitespace instead
 * @param object $query_vars Searched query
 * @return object or string ' ' for an empty search query
 */
function empty_search_request_filter( $query_vars ) {
	if ( isset( $_GET[ 's' ] ) && empty( $_GET[ 's' ] ) ) {
		$query_vars[ 's' ] = " ";
	}
	return $query_vars;
}

add_filter( 'request', 'empty_search_request_filter' );
?>
