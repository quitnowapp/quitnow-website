<?php
    
    // base
    $baseWeb = "https://quitnowapp.com/";
    
    // translations
    require_once('php/gettext.inc');
    
    $url = $_SERVER['REQUEST_URI'];
    $route = explode('/', parse_url($url, PHP_URL_PATH));
    $lang = array_pop($route);
    
    $locale = "en_EN";
    
    $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $redirectionableLanguage = array('', 'ca', 'de', 'en','es', 'fr', 'it', 'nl', 'pt', 'ru', 'he');
    
    if($lang == ''){
        if(array_search($browserLang, $redirectionableLanguage)){
            header("Location: $baseWeb$browserLang");
            die;
        }
        else{
            header("Location: $baseWeb" . 'en');
            die;
        }
    }
    
    if(!array_search($lang, $redirectionableLanguage) or $url != '/'.$lang){
        header("Location: $baseWeb" . 'en');
        die;
    }
    
    
    switch ($lang) {
        case 'en': $locale = "en_EN";break;
        case 'ca': $locale = "ca_ES";break;
        case 'de': $locale = "de_DE";break;
        case 'es': $locale = "es_ES";break;
        case 'fr': $locale = "fr_FR";break;
        case 'it': $locale = "it_IT";break;
        case 'nl': $locale = "nl_NL";break;
        case 'pt': $locale = "pt_PT";break;
        case 'ru': $locale = "ru_RU";break;
        case 'he': $locale = "he_IL";break;
        default:
            header('Status: 404 Not found', false, 404);
            header("Location: $baseWeb");
            die;
            break;
    }
    
    $directory = dirname(__FILE__).'/locale';
    $domain    = 'messages';
    $default_locale = $locale;
    $supported_locales = array($locale);
    
    T_setlocale(LC_ALL, $locale);
    T_bindtextdomain($domain, $directory);
    T_textdomain($domain);
    T_bind_textdomain_codeset($domain, 'UTF-8');
    
    function t($name){
        echo T_gettext($name);
    }

    // variables
    if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
      $iOS = stripos( $_SERVER['HTTP_USER_AGENT'], "iOS" )
        || stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" )
        || stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" )
        || stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );

      $Android = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
    }
    
    ?><!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>

<meta charset="utf-8">
<title>QuitNow! - <?php t('slogan'); ?></title>
<meta name="description" content="<?php t('description'); ?>">
<meta name="keywords" content="<?php t('keywords'); ?>">

<link rel="icon" type="image/png" href="images/touch/58.png">
<link rel="shortcut icon" href="images/touch/58.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
    
<meta property="og:title" content="<?php t('slogan'); ?>" />
<meta property="og:site_name" content="QuitNow!"/>
<meta property="og:url" content="https://quitnowapp.com/<?php echo $lang; ?>" />
<meta property="og:description" content="<?php t('description'); ?>" />
<meta property="fb:app_id" content="156729571066410" />

<meta property="og:image" content="https://quitnowapp.com/images/quitnow-facebook-share.png" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1910">
<meta property="og:image:height" content="1000">

<meta property="og:image" content="https://quitnowapp.com/images/opengraph/quitnow-square-300.png" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">

<meta property="og:image" content="https://quitnowapp.com/images/opengraph/quitnow-square-1024.png" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1024">
<meta property="og:image:height" content="1024">

<meta name="twitter:card" content="app">
<meta name="twitter:site" content="@QuitNowApp">
<meta name="twitter:description" content="<?php t('description'); ?>">
<meta name="twitter:app:name:iphone" content="QuitNow!">
<meta name="twitter:app:id:iphone" content="483994930">
<meta name="twitter:app:name:ipad" content="QuitNow!">
<meta name="twitter:app:id:ipad" content="483994930">
<meta name="twitter:app:name:googleplay" content="QuitNow!">
<meta name="twitter:app:id:googleplay" content="com.EAGINsoftware.dejaloYa">
<meta name="twitter:image" content="https://quitnowapp.com/images/quitnow-twitter-share.png" />

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=42">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=42">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=42">
<link rel="manifest" href="/site.webmanifest?v=42">
<link rel="mask-icon" href="/safari-pinned-tab.svg?v=42" color="#3d91e6">
<link rel="shortcut icon" href="/favicon.ico?v=42">
<meta name="apple-mobile-web-app-title" content="QuitNow!">
<meta name="application-name" content="QuitNow!">
<meta name="msapplication-TileColor" content="#3d91e6">
<meta name="theme-color" content="#3d91e6">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,400&subset=latin,latin-ext,cyrillic,greek&display=swap' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="css/bundle.css">
<!-- JS bundle at the end of the code -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38049407-7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-38049407-7');
  gtag('config', 'AW-965642934');
</script>

<script>
function gtag_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
    'send_to': 'AW-965642934/siEMCNmR2rgBELaVuswD',
    'transaction_id': '',
    'event_callback': callback
  });
  return false;
}
</script>


<script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "Product",
    "name": "QuitNow!",
    "image": "https://quitnow.app/images/logo.png",
    "logo": "https://quitnow.app/images/logo.png",
    "description": "<?php t('description'); ?>",
    "slogan": "<?php t('slogan'); ?>",
    "brand": {
      "@type": "Thing",
      "name": "Fewlaps"
      },
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "availability": "InStock",
      "priceValidUntil": "2100-01-01",
      "url": "https://quitnow.app/download"
      }
  }
</script>

</head>
<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '156729571066410',
      xfbml      : true,
      version    : 'v6.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    
<header>
<img src="images/Quitnow.svg" class="logo" alt="QuitNow!">
<span class="stores">
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'iOS', {'event_category':'Downloads', 'event_label':'Header button'});" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'Android', {'event_category':'Downloads', 'event_label':'Header button' });" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</span>
</header>
<div id="fullpage">
<div class="section home hideScreenshots" id="section0">
<div class="homeCont col col45">
<img src="images/logo.svg" alt="QuitNow!" class=" logom block">
<img src="images/Quitnow.svg" alt="QuitNow!" class=" logoquit block">
<p class="subtitle">
<?php t('slogan'); ?>
</p>
<span class="stores">
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'iOS', {'event_category':'Downloads', 'event_label':'First page button' });" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'Android', {'event_category':'Downloads', 'event_label':'First page button' });" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</span>
</div>
<div class="screenshots col col55">
  <div class="screenshots-desktop">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_1.png" alt="Stats" class="screen1 desktop screen active">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_2.png" alt="Community" class="screen2 desktop screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_2.png" alt="Community" class="screen3 desktop screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_4.png" alt="Achievements" class="screen4 desktop screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_5.png" alt="Health" class="screen5 desktop screen">
  </div>
  <div class="screenshots-ios">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_1.png" alt="Stats" class="screen1 apple screen active">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_2.png" alt="Community" class="screen2 apple screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_3.png" alt="Achievements" class="screen3 apple screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_4.png" alt="Achievements" class="screen4 apple screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/ios_5.png" alt="Health" class="screen5 apple screen">
  </div>
  <div class="screenshots-android">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_1.png" alt="Stats" class="screen1 android screen active">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_2.png" alt="Community" class="screen2 android screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_3.png" alt="Achievements" class="screen3 android screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_4.png" alt="Achievements" class="screen4 android screen">
    <img data-presrc="images/L10n/<?php echo $lang; ?>/android_5.png" alt="Achievements" class="screen5 android screen">
  </div>
  <img src="images/arrow-l.png" alt="<?php t('arrow.prev'); ?>" class="arrow arrowL">
  <img src="images/arrow-r.png" alt="<?php t('arrow.next'); ?>" class="arrow arrowR">
</div>
</div>
<div class="section chat" id="section1">
<div class="homeCont col col45">
<ul id="chatting" class="elasticstack">
<li class="c01">
<div><img src="images/faces/face1.jpg" alt="Chat 01"></div>
<p><?php t('community.message1'); ?></p>
</li>
<li class="c02">
<div><img data-autoload data-presrc="images/faces/face2.jpg" alt="Chat 02"></div>
<p><?php t('community.message2'); ?></p>
</li>
<li class="c03">
<div><img data-autoload data-presrc="images/faces/face3.jpg" alt="Chat 03"></div>
<p><?php t('community.message3'); ?></p>
</li>
<li class="c01">
<div><img data-autoload data-presrc="images/faces/face4.jpg" alt="Chat 04"></div>
<p><?php t('community.message4'); ?></p>
</li>
<li class="c02">
<div><img data-autoload data-presrc="images/faces/face1.jpg" alt="Chat 05"></div>
<p><?php t('community.message5'); ?></p>
</li>
<li class="c03">
<div><img data-autoload data-presrc="images/faces/face2.jpg" alt="Chat 06"></div>
<p><?php t('community.message6'); ?></p>
</li>
<li class="c02">
<div><img data-autoload data-presrc="images/faces/face3.jpg" alt="Chat 07"></div>
<p><?php t('community.message7'); ?></p>
</li>
</ul>
</div>
<div class="col col55 onCol-alignLeft">
<h2><?php t('community.title'); ?></h2>
<p class="subtitle">
<span class="bl bls"><?php t('community.body'); ?></span>
</p>
</div>
</div>
<div class="section achievements" id="section2">
<div class="col col45 onCol-paddingLeft">
<div id="achiev">
<div class="visible" style="background-image: url('images/achday.svg')"></div>
<div data-autoload data-prestyle="background-image: url('images/ach5000.svg')"></div>
<div data-autoload data-prestyle="background-image: url('images/achyear.svg')"></div>
<div data-autoload data-prestyle="background-image: url('images/achmoney.svg')"></div>
<div data-autoload data-prestyle="background-image: url('images/achhearth.svg')"></div>
</div>
<div class="achievShadow"></div>
</div>
<div class="col col55 onCol-alignLeft">
<h2><?php t('achievements.title'); ?></h2>
<p class="subtitle">
<span class="bl bls"><?php t('achievements.body'); ?></span>
</p>
</div>
</div>
<div class="section circleProgress" id="section3">
<div class="col col45 onCol-paddingLeft">
<div id="circle">
<div class="hiddenCircle"></div>
<div class="progress">
<span class="number">12</span>
</div>
</div>
</div>
<div class="col col55 onCol-alignLeft">
<h2>
<span class="showOnComplete"><?php t('health.completed.title'); ?></span>
<span class="hideOnComplete"><?php t('health.loading.title'); ?></span>
</h2>
<p class="subtitle showOnComplete">
<span class="bl"><?php t('health.completed.body'); ?></span>
</p>
<p class="subtitle hideOnComplete">
<span class="bl"><?php t('health.loading.body'); ?></span>
</p>
</div>
</div>
<div class="section downloads" id="section4">
<div>
  <div class="worldContainer">
    <div class="worldFlags">
      <div class="worldFlagsPos">
        <?php include_once("images/world.svg"); ?>
        <img data-fastautoload data-presrc="images/flags/1.png" alt="us" class="flag flag-us hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/2.png" alt="en" class="flag flag-en hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/35.png" alt="de" class="flag flag-de hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/40.png" alt="es" class="flag flag-es hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/37.png" alt="fr" class="flag flag-fr hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/27.png" alt="it" class="flag flag-it hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/13.png" alt="ru" class="flag flag-ru hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/44.png" alt="ch" class="flag flag-ch hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/34.png" alt="gr" class="flag flag-gr hidden fadeIn">
        <img data-fastautoload data-presrc="images/flags/5.png" alt="tk" class="flag flag-tk hidden fadeIn">
      </div>
    </div>
  </div>
</div>
<div class="downContainer">
<img src="images/logo.svg" alt="QuitNow!" class="sxs logom block">
<img src="images/Quitnow.svg" alt="QuitNow!" class="sxs logoquit block">
<h2><?php t('last.title'); ?></h2>
<p class="subtitle">
<?php t('last.body'); ?>
</p>
<div class="stores">
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'iOS', {'event_category':'Downloads', 'event_label':'World page button' });" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" rel="noopener" onClick="gtag_conversion(); gtag('event', 'Android', {'event_category':'Downloads', 'event_label':'World page button' });" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</div>
</div>
<div class="footer">
<a id="TermsShow" target="_blank" rel="noopener" onClick="gtag('event', 'Terms of service', {'event_category':'Footer navigation' });" href="terms-of-service/"><?php t('footer.tos'); ?></a>
|
<a target="_blank" rel="noopener" onClick="gtag('event', 'Press resources', {'event_category':'Footer navigation' });" href="press-resources/"><?php t('footer.press'); ?></a>
<div class="powered">
<a href="https://fewlaps.com" target="_blank" rel="noopener">
<img width="134" height="38" src="images/fewlaps.svg" alt="Fewlaps">
</a>
</div>
</div>
</div>
</div>
<div class="Terms js-Terms">
<a id="TermsHide" href="#" class="close">X</a>
<div class="wrapper"></div>
</div>
</body>
</html>

<script src="js/bundle.js" defer></script>
