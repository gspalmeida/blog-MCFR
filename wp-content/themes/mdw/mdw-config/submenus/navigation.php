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
	<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link active" data-toggle="tab" href="#" data-href="#navigation-settings" role="tab"><?php _e( 'Navigation settings', 'mdw' ); ?></a>
		</li>
		<li class="nav-item">
			<a data-toggle="tooltip" class="nav-link" data-toggle="tab" href="#" data-href="#navigation-identity" role="tab"><?php _e( 'Navigation identity', 'mdw' ); ?></a>
		</li>

	</ul>
	<div class="tab-content card container">

		<!--Panel About-->
		<div class="tab-pane fade in active " id="navigation-settings" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/navigation-tabs/navigation-settings' ); ?>
		</div>
		<!--/.Panel About-->

		<!--Panel General-->
		<div class="tab-pane fade" id="navigation-identity" role="tabpanel">
			<?php get_template_part( 'mdw-config/submenus/navigation-tabs/navigation-identity' ); ?>
		</div>
		<!--/.Panel General-->

	</div>	



