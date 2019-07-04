<?php
$color_scheme		 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$background_color	 = get_theme_mod( "background_color", "#ffffff" );
?>

<body <?php body_class( array( $color_scheme, $nav ) ); ?> style= " background-color: <?php echo $background_color ?>">