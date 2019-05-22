<?php
/**
 * Transfer (Export) Files Server to Server using PHP FTP
 * @link https://shellcreeper.com/?p=1249
 */

/* FTP Account (Remote Server) */
$ftp_host = 'SOMESITE_URL.com.au'; /* host */
$ftp_user_name = 'copyfiles@SOMESITE_URL.com.au'; /* username */
$ftp_user_pass = 'SOMESITE_PASS'; /* password */

define( 'LOCAL_PATH' , 'files');

// Scan for Files
$dir    = LOCAL_PATH;
$files	= scandir($dir);


/* For each files, get each path and add it in zip */
if( !empty( $files ) ){

	// Remove Directory names . and  ..
	unset( $files[0] , $files[1] );

	if( !empty( $files ) ){

		echo '<pre>';
		print_r( $files );
		echo '<pre>';

		/* Connect using basic FTP */
		$connect_it = ftp_connect( $ftp_host );

		/* Login to FTP */
		$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );

		foreach( $files as $k => $file ) {
			/* File and path to send to remote FTP server */
			$local_file 	= LOCAL_PATH . '/' . $file;

			/* Remote File Name */
			$remote_file	= $file;

			/* Send $local_file to FTP */
			if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
				echo "WOOT! Successfully transfer $local_file\n";
			}
			else {
				echo "Doh! There was a problem\n";
			}

			/* Close the connection */
			ftp_close( $connect_it );
		}
	}
} else {
	echo 'No Files';
}
