<?php

function load_theme_translation() {
	load_theme_textdomain( 'mdw', get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'load_theme_translation' );
?>
