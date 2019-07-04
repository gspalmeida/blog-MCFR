<?php

function mdwordpress_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'		 => 'Contact Form 7', // The plugin name.
			'slug'		 => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'	 => true, // If false, the plugin is only 'recommended' instead of required.
		),
		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		array(
			'name'		 => 'MailPoet Newsletters', // The plugin name.
			'slug'		 => 'wysija-newsletters', // The plugin slug (typically the folder name).
			'required'	 => true, // If false, the plugin is only 'recommended' instead of required.
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'			 => 'mdwordpress', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => false, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'mdwordpress_register_required_plugins' );
?>