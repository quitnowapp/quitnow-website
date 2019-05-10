<?php
if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
	$iOS = stripos( $_SERVER['HTTP_USER_AGENT'], "iOS" );
	$iPod = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
	$iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
	$iPad = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
	$Android = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
}
if ( $iOS || $iPod || $iPhone || $iPad ) {
	header( 'Location: https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930' );
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
