<?php
if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
	$iOS = stripos( $_SERVER['HTTP_USER_AGENT'], "iOS" );
	$iPod = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
	$iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
	$iPad = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
	$Android = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
}
if ( $iOS || $iPod || $iPhone || $iPad ) {
    $referrer = $_GET['referrer'];
    if (empty($referrer)){
       header( 'Location: https://apps.apple.com/app/apple-store/id483994930?pt=820420&ct=Download%20redirect&mt=8' );
    } else {
       header( 'Location: https://apps.apple.com/app/apple-store/id483994930?pt=820420&ct=' . $referrer . '&mt=8' );
    }
	die();
} else if ( $Android ) {
    $referrer = $_GET['referrer'];
    if (empty($referrer)){
       header( 'Location: https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Ddownload_redirect' );
    } else {
       header( 'Location: https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3D' . $referrer);
    }
	die();
} else { 
	header( 'Location: http://quitnowapp.com#Downloads' );
}
?>
