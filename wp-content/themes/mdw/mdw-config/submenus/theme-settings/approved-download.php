<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

	if ( !$_POST[ 'status' ] ) {
		update_option( 'when_horse_dies', $new_date, true );
	}

	$json	 = array();
	set_time_limit( 0 );
	$url	 = "https://mdwp.io/remote/mdw.zip";
	$fp		 = fopen( getcwd() . '/../../../../' . basename( $url ), 'w+' );

	$ch		 = curl_init( $url );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_BINARYTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
	// curl_setopt($ch, CURLOPT_NOPROGRESS, false);
	curl_setopt( $ch, CURLOPT_FILE, $fp );
	curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
	$results = curl_exec( $ch );

	if ( $results === false ) {
		$json[ 'message' ]	 = __( 'There was some connection problem, please try again later.', 'mdw' );
		$json[ 'status' ]	 = "0";
	} else {
		$json[ 'message' ] = "File " . basename( $url ) . " was successfully downloaded. ";

		fclose( $fp );
		// ZIP file name and path
		$file	 = getcwd() . '/../../../../' . basename( $url );
		$path	 = pathinfo( realpath( $file ), PATHINFO_DIRNAME );
		$zip	 = new ZipArchive;
		$res	 = $zip->open( $file );
		if ( $res === TRUE ) {
			$zip->extractTo( $path );
			$zip->close();
			$json[ 'message' ]	 = _e( 'You have the latest version of MDW. Enjoy!', 'mdw' );
			$json[ 'status' ]	 = "1";
			unlink( $file ); // deletes ZIP file
		} else {
			$json[ 'message' ]	 = __( 'There was some connection problem, please try again later.', 'mdw' );
			$json[ 'status' ]	 = 0;
		}
	}
	echo json_encode( $json );
}
?>
