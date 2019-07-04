<?php

function my_js_variables() { ?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url( "admin-ajax.php" ); ?>';
		var ajaxnonce = '<?php echo wp_create_nonce( "itr_ajax_nonce" ); ?>';
	</script><?php
}

add_action( 'wp_head', 'my_js_variables' );
?>
