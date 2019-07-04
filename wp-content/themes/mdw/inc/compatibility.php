<?php
$php_reccomended_v = '5.6';

$php_current_v = phpversion();

function php_version_notice() {
	?>
	<div class="notice notice-error" style="padding:1rem 0.5rem">
		<b>Your server is running on PHP version <?php echo phpversion(); ?></b><br>
		WordPress recommends using PHP version 5.6 or greater.
	</div>
	<?php
}

if ( $php_current_v < $php_reccomended_v ) {
	add_action( 'admin_notices', 'php_version_notice' );
}


if ( !extension_loaded( 'curl' ) || !extension_loaded( 'openssl' ) )
	add_action( 'admin_notices', function() {

		$req_ext = array(
			'curl'		 => array(
				'libname'	 => 'Client URL Library',
				'libfeature' => 'Remote Updates and Upgrade'
			),
			'openssl'	 => array(
				'libname'	 => 'OpenSSL',
				'libfeature' => 'Social share counters'
			)
		);
		?>

		<div class="notice notice-error is-dismissable" style="padding:1rem 0.5rem">
			<b>This theme requires libraries that your server doesn't support</b><br>
			It is reccomended to upgrade your PHP to the latest version or install required dependencies. Otherwise following features may not work or will have limited functionality:<br>
			<ul>
				<?php
				foreach ( $req_ext as $ext => $prop ) {
					if ( !extension_loaded( $ext ) )
						
						?>
					<li><i class="fa fa-caret-right"></i> <?php echo $prop[ 'libfeature' ] ?></li>
				<?php } ?>
			</ul>
			Check if you have installed following extensions:
			<ul>
				<?php
				foreach ( $req_ext as $ext => $prop ) {
					if ( !extension_loaded( $ext ) )
						
						?>
					<li><i class="fa fa-caret-right"></i> <?php echo $prop[ 'libname' ] ?></li>
					<?php } ?>
			</ul>
			<br>
			Please contact your hosting provider or contact us (contact@mdwp.io)
		</div>

	<?php } );
?>