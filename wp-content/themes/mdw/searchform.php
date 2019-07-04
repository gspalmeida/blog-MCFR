<?php
$navigation_type = get_theme_mod( 'navigation_type', '' );

if ( get_post_meta( get_the_ID(), 'meta-navigation-type', FALSE ) ) {
	$navigation_type = get_post_meta( get_the_ID(), 'meta-navigation-type', FALSE );
	$navigation_type = $navigation_type[ 0 ];
} else {
	$navigation_type = get_theme_mod( 'navigation_type', 'navbar' );
}


if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) { 
	?>
	<!-- Sidenav search form -->
	<form class="search-form" role="search" method="get"  action="<?php echo home_url( '/' ); ?>">
		<div class="form-group waves-light waves-effect waves-light">
			<input
				type="text"
				class="form-control mb-0"
				placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mdw' ); ?>"
				value="<?php echo get_search_query(); ?>"
				name="s"
				title="<?php echo esc_attr_x( 'Search', 'label', 'mdw' ); ?>"
				/>
		</div>
	</form>
	<!-- ./Sidenav search form -->
<?php } else if ( $navigation_type == 'navbar' || $navigation_type == 'both' ) { ?>
	<!-- Navbar search form -->
	<form class="form-inline" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">

		<input class="form-control"
			   type="text"
			   placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mdw' ); ?>"
			   value="<?php echo get_search_query(); ?>"
			   name="s"
			   title="<?php echo esc_attr_x( 'Search', 'label', 'mdw' ); ?>"
			   />

	</form>
	<!-- ./Navbar search form -->
<?php } else {  ?>

	<!-- Default searchform WP -->
	<form role="search" method="get" class="ml-2 search-form" action="<?php echo home_url( '/' ); ?>">
		<label>
			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'mdw' ); ?></span>
			<input type="search" class="search-field"
				   placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mdw' ); ?>"
				   value="<?php echo get_search_query() ?>" name="s"
				   title="<?php echo esc_attr_x( 'Search', 'label', 'mdw' ); ?>" />
		</label>
	</form>
	<!-- Default searchform WP -->

<?php } ?>