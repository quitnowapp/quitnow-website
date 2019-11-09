<?php
    
    $baseWeb = "https://quitnowapp.com/";
    
    require_once('php/gettext.inc');
    
    $url = $_SERVER['REQUEST_URI'];
    $route = explode('/', parse_url($url, PHP_URL_PATH));
    $lang = array_pop($route);
    
    $locale = "en_EN";
    
    $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $redirectionableLanguage = array('', 'ca', 'de', 'en','es', 'fr', 'it', 'nl', 'pt', 'ru');
    
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
    
    ?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>QuitNow! - <?php t('slogan'); ?></title>
<meta name="description" content="<?php t('description'); ?>">
<meta name="keywords" content="<?php t('keywords'); ?>">

<link rel="icon" type="image/png" href="images/touch/58.png">
<link rel="shortcut icon" href="images/touch/58.png">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,400&subset=latin,latin-ext,cyrillic,greek' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/main.css">
<script src="js/jquery-2.1.3.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css">
<script src="js/vendors/jquery.easings.min.js"></script>
<script type="text/javascript" src="js/vendors/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/jquery.fullPage.js"></script>
<script type="text/javascript" src="js/circle-progress.js"></script>
<script type="text/javascript" src="js/bezier-easing.js"></script>

<link rel="stylesheet" type="text/css" href="css/component.css">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="js/draggabilly.pkgd.min.js"></script>
<script type="text/javascript" src="js/elastiStack.js"></script>

<script src="js/main.js"></script>

<script type="application/ld+json">
{
"@context": "http://schema.org/",
"@type": "Product",
"name": "QuitNow!",
"image": "https://quitnow.app/images/logo.png",
"logo": "https://quitnow.app/images/logo.png",
"description": "<?php t('description'); ?>",
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
    
</head>
<body>

<header>
<img src="images/Quitnow.svg" class="logo" alt="QuitNow!">
<span class="stores">
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'iOS', 'Header button', 1);" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'Android', 'Header button', 1);" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</span>
</header>
<div id="fullpage">
<div class="section home hideScreenshots" id="section0">
<div class="homeCont col col45">
<img src="images/logo.png" alt="QuitNow!" class=" logom block">
<img src="images/Quitnow.svg" alt="QuitNow!" class=" logoquit block">
<p class="subtitle">
<?php t('slogan'); ?>
</p>
<span class="stores">
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'iOS', 'First page button', 1);" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'Android', 'First page button', 1);" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</span>
</div>
<div class="screenshots col col55">
<div class="screenshots-desktop">
<img src="images/L10n/<?php echo $lang; ?>/ios_1.png" alt="Stats" class="screen1 desktop screen active">
<img src="images/L10n/<?php echo $lang; ?>/android_2.png" alt="Community" class="screen2 desktop screen">
<img src="images/L10n/<?php echo $lang; ?>/ios_2.png" alt="Community" class="screen3 desktop screen">
<img src="images/L10n/<?php echo $lang; ?>/android_4.png" alt="Achievements" class="screen4 desktop screen">
<img src="images/L10n/<?php echo $lang; ?>/ios_5.png" alt="Health" class="screen5 desktop screen">
</div>
<div class="screenshots-ios">
<img src="images/L10n/<?php echo $lang; ?>/ios_1.png" alt="Stats" class="screen1 apple screen active">
<img src="images/L10n/<?php echo $lang; ?>/ios_2.png" alt="Community" class="screen2 apple screen">
<img src="images/L10n/<?php echo $lang; ?>/ios_3.png" alt="Achievements" class="screen3 apple screen">
<img src="images/L10n/<?php echo $lang; ?>/ios_4.png" alt="Achievements" class="screen4 apple screen">
<img src="images/L10n/<?php echo $lang; ?>/ios_5.png" alt="Health" class="screen5 apple screen">
</div>
<div class="screenshots-android">
<img src="images/L10n/<?php echo $lang; ?>/android_1.png" alt="Stats" class="screen1 android screen active">
<img src="images/L10n/<?php echo $lang; ?>/android_2.png" alt="Community" class="screen2 android screen">
<img src="images/L10n/<?php echo $lang; ?>/android_3.png" alt="Achievements" class="screen3 android screen">
<img src="images/L10n/<?php echo $lang; ?>/android_4.png" alt="Achievements" class="screen4 android screen">
<img src="images/L10n/<?php echo $lang; ?>/android_5.png" alt="Achievements" class="screen5 android screen">
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
<div><img src="images/faces/face2.jpg" alt="Chat 02"></div>
<p><?php t('community.message2'); ?></p>
</li>
<li class="c03">
<div><img src="images/faces/face3.jpg" alt="Chat 03"></div>
<p><?php t('community.message3'); ?></p>
</li>
<li class="c01">
<div><img src="images/faces/face4.jpg" alt="Chat 04"></div>
<p><?php t('community.message4'); ?></p>
</li>
<li class="c02">
<div><img src="images/faces/face1.jpg" alt="Chat 05"></div>
<p><?php t('community.message5'); ?></p>
</li>
<li class="c03">
<div><img src="images/faces/face2.jpg" alt="Chat 06"></div>
<p><?php t('community.message6'); ?></p>
</li>
<li class="c02">
<div><img src="images/faces/face3.jpg" alt="Chat 07"></div>
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
<div style="background-image: url('images/ach5000.svg')"></div>
<div style="background-image: url('images/achyear.svg')"></div>
<div style="background-image: url('images/achmoney.svg')"></div>
<div style="background-image: url('images/achhearth.svg')"></div>
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
<div class="valign"></div>
<div class="worldFlags">
<div class="worldFlagsPos">
<?php include_once("images/world.svg"); ?>
<img src="images/flags/1.png" alt="us" class="flag flag-us hidden fadeIn">
<img src="images/flags/2.png" alt="en" class="flag flag-en hidden fadeIn">
<img src="images/flags/35.png" alt="de" class="flag flag-de hidden fadeIn">
<img src="images/flags/40.png" alt="es" class="flag flag-es hidden fadeIn">
<img src="images/flags/37.png" alt="fr" class="flag flag-fr hidden fadeIn">
<img src="images/flags/27.png" alt="it" class="flag flag-it hidden fadeIn">
<img src="images/flags/13.png" alt="ru" class="flag flag-ru hidden fadeIn">
<img src="images/flags/44.png" alt="ch" class="flag flag-ch hidden fadeIn">
<img src="images/flags/34.png" alt="gr" class="flag flag-gr hidden fadeIn">
<img src="images/flags/5.png" alt="tk" class="flag flag-tk hidden fadeIn">
</div>
</div>
</div>
</div>
<div class="downContainer">
<img src="images/logo.png" alt="QuitNow!" class="sxs logom block">
<img src="images/Quitnow.svg" alt="QuitNow!" class="sxs logoquit block">
<h2><?php t('last.title'); ?></h2>
<p class="subtitle">
<?php t('last.body'); ?>
</p>
<div class="stores">
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'iOS', 'World page button', 3);" href="https://itunes.apple.com/app/quitnow!-quit-smoking/id483994930"><img src="images/L10n/<?php echo $lang; ?>/app_store.svg" width="150" height="49" alt="<?php t('badge.applestore'); ?>" class="apple"></a>
<a target="_blank" onClick="ga('send', 'event', 'Downloads', 'Android', 'World page button', 3);" href="https://play.google.com/store/apps/details?id=com.EAGINsoftware.dejaloYa&referrer=utm_source%3Dweb%26utm_medium%3Dlink"><img src="images/L10n/<?php echo $lang; ?>/google_play.svg" width="150" height="49" alt="<?php t('badge.googleplay'); ?>" class="android"></a>
</div>
</div>
<div class="footer">
<a id="TermsShow" target="_blank" onClick="ga('send', 'event', 'Footer navigation', 'Terms of Service');" href="http://quitnowapp.com/terms-of-service/index.html"><?php t('footer.tos'); ?></a>
|
<a target="_blank" onClick="ga('send', 'event', 'Footer navigation', 'Press resources');" href="https://quitnowapp.com/press-resources/index.html"><?php t('footer.press'); ?></a>
<div class="powered">
<a href="http://fewlaps.com" target="_blank">
<img src="images/fewlaps.png" alt="Fewlaps">
</a>
</div>
</div>
</div>
</div>
<div class="Terms js-Terms">
<a id="TermsHide" href="#" class="close">X</a>
<div class="wrapper"></div>
</div>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-38049407-7', 'auto');
ga('send', 'pageview');
</script>
</body>
</html>
