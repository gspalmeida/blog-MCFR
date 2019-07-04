<?php
    function custom_theme_enqueue_styles() {
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css');
    }
    add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_styles', 11);
?>
