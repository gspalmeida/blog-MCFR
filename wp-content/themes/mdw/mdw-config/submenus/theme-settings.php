<?php
wp_enqueue_media();
wp_enqueue_script( 'jquery' );
wp_register_script( 'mdw-tabs', get_template_directory_uri() . '/js/tabs.js', array( 'jquery', 'media-upload', 'media-views' ) );
wp_enqueue_script( 'mdw-tabs' );
wp_register_script( 'icon-picker', get_template_directory_uri() . '/js/icon-picker.js', array( 'jquery', 'media-upload', 'media-views' ) );
wp_enqueue_script( 'icon-picker' );

wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
wp_enqueue_style( 'Font_Awesome' );
wp_register_style( 'compiled', get_template_directory_uri() . '/css/compiled.min.css' );
wp_enqueue_style( 'compiled' );
wp_register_style( 'Admin_Widget_MDW', get_template_directory_uri() . '/css/admin-widget-mdw.css' );
wp_enqueue_style( 'Admin_Widget_MDW' );
wp_register_style( 'MDW_Config_CSS', get_template_directory_uri() . '/mdw-config/css/mdw-config.css' );
wp_enqueue_style( 'MDW_Config_CSS' );
?>
<div class="container mdw-config">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link active in" data-toggle="tab" href="#" data-href="#about" role="tab"><?php _e( 'About', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#general" role="tab"><?php _e( 'General', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#site-identity" role="tab"><?php _e( 'Site identity', 'mdw' ); ?></a>
		</li> 
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#post-page" role="tab"><?php _e( 'Post page', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#categories" role="tab"><?php _e( 'Categories', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#social-options" role="tab"><?php _e( 'Social options', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#author-page" role="tab"><?php _e( 'Author page', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#page-generator" role="tab"><?php _e( 'Page generator', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link " data-toggle="tab" href="#" data-href="#update" role="tab"><?php _e( 'Update', 'mdw' ); ?></a>
		</li>
	</ul>

	<!-- Tab panels -->
	<div class="tab-content card container">

		<!--Panel About-->
		<div class="tab-pane fade in active" id="about" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/about' ); ?>
		</div>
		<!--/.Panel About-->

		<!--Panel General-->
		<div class="tab-pane fade" id="general" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/general' ); ?>
		</div>
		<!--/.Panel General-->
		<!--Panel Site Identity-->
		<div class="tab-pane fade" id="site-identity" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/site-identity' ); ?>
		</div>
		<!--/.Panel Site Identity-->

		<!--Panel Post Page-->
		<div class="tab-pane fade" id="post-page" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/post-page' ); ?>
		</div>
		<!--/.Panel Post Page-->

		<!--Panel Categories-->
		<div class="tab-pane fade" id="categories" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/categories' ); ?>
		</div>
		<!--/.Panel Categories-->

		<!--Panel Social Options-->
		<div class="tab-pane fade" id="social-options" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/social-options' ); ?>
		</div>
		<!--/.Panel Social Options-->

		<!--Panel Author Page-->
		<div class="tab-pane fade" id="author-page" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/author-page' ); ?>
		</div>
		<!--/.Panel Author Page-->

		<!--Panel Dummy Content-->
		<div class="tab-pane fade" id="page-generator" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/page-generator' ); ?>
		</div>
		<!--/.Panel Dummy Content-->

		<!--Panel Update-->
		<div class="tab-pane fade" id="update" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/theme-settings/up-date' ); ?>
		</div>
		<!--/.Panel Update-->
	</div>
</div>
<script>
    function resetButton( btn, text ) {

        var text = ( typeof text == 'undefined' ) ? 'Save' : text;

        setTimeout( function () {
            btn.html( text );
            btn.attr( "class", "btn btn-primary" );
        }, 1500 );
    }
</script>
