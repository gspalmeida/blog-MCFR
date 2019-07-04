<div class="container-fluid wraper">

	<h1><?php _e( 'Properties of your theme', 'mdw' ); ?></h1>
	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Name:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Name" ); ?>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Theme URI:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "ThemeURI" ); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Description:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Description" ); ?>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Author:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Author" ); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Author URI:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "AuthorURI" ); ?>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Version:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Version" ); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Template:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Template" ); ?>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Status:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "Status" ); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Tags:", "mdw" ); ?></h4>
			<?php echo implode( ", ", wp_get_theme()->get( "Tags" ) ); ?>
		</div>
		<div class="col-md-6">
			<h4><?php _e( "Text Domain:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "TextDomain" ); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4><?php _e( "Domain Path:", "mdw" ); ?></h4>
			<?php echo wp_get_theme()->get( "DomainPath" ); ?>
		</div>
		<div class="col-md-6">
			<h4></h4>
		</div>
	</div>
</div>
