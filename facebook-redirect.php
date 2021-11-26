<?php
if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
	$iOS = stripos( $_SERVER['HTTP_USER_AGENT'], "iOS" );
	$iPod = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
	$iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
	$iPad = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
	$Android = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
}
if ( $iOS || $iPod || $iPhone || $iPad ) {
	header( 'Location: https://apps.apple.com/app/apple-store/id483994930?pt=820420&ct=Facebook%20Web&mt=8' );
	die();
} else if ( $Android ) {
	header( 'Location: https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dfacebook_web' );
	die();
} else { 
	header( 'Location: http://quitnowapp.com' );
}
?>
