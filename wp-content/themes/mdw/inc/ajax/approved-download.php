<?php

function approved_download() {

	if ( !$_POST[ 'status' ] ) {
		update_option( 'when_horse_dies', $_POST[ 'when_horse_dies' ] );
	}

	$json	 = array();
	set_time_limit( 0 );
	$url	 = "https://mdwp.io/remote/mdw.zip";
	$fp		 = fopen( __DIR__ . '/../../../' . basename( $url ), 'w+' );

	$ch			 = curl_init( $url );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_BINARYTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
	// curl_setopt($ch, CURLOPT_NOPROGRESS, false);
	curl_setopt( $ch, CURLOPT_FILE, $fp );
	curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
	$results	 = curl_exec( $ch );
	$httpcode	 = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

	if ( $results === false && $httpcode != 200 ) {

		set_time_limit( 0 );
		$url = "http://mdwp.io/remote/mdw.zip";
		$fp	 = fopen( __DIR__ . '/../../../' . basename( $url ), 'w+' );

		$ch			 = curl_init( $url );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_BINARYTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
		// curl_setopt($ch, CURLOPT_NOPROGRESS, false);
		curl_setopt( $ch, CURLOPT_FILE, $fp );
		curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
		$results	 = curl_exec( $ch );
		$httpcode	 = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

		if ( $results === false && $httpcode != 200 ) {
			$json[ 'message' ]	 = __( 'There was some connection problem, please try again later.', 'mdw' );
			$json[ 'status' ]	 = "0";
		} else {

			download_update( $url, $json );
		}
	} else {

		download_update( $url, $json );
	}
	echo json_encode( $json );

	die();
}

add_action( 'wp_ajax_approved_download', 'approved_download' );

function download_update( $url, &$json ) {
	$json[ 'message' ]	 = "File " . basename( $url ) . " was successfully downloaded. ";
	fclose( $fp );
	// ZIP file name and path
	$file				 = __DIR__ . '/../../../' . basename( $url );
	$path				 = pathinfo( realpath( $file ), PATHINFO_DIRNAME );
	$json[ 'message' ]	 = $file;
	$zip				 = new ZipArchive();
	$res				 = $zip->open( $file );

	if ( $res === TRUE ) {
		$zip->extractTo( $path );
		$zip->close();
		$json[ 'message' ]	 = __( 'You have the latest version of MDW. Enjoy!', 'mdw' );
		$json[ 'status' ]	 = "1";
		unlink( $file ); // deletes ZIP file
	} else {
		$json[ 'message' ]	 = __( 'There was some connection problem, please try again later.', 'mdw' );
		$json[ 'status' ]	 = 0;
	}
}

?>