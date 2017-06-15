<?php

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

if( $iPod || $iPhone || $iPad) {
        header('Location: https://itunes.apple.com/us/app/%EB%94%94%EC%94%A8%EC%95%B1/id698007248?mt=8');
}else if($Android){
        header('Location: https://play.google.com/store/apps/details?id=com.lnidigitalmarketing.dcapp&hl=en');
}else {
        header('Location: https://play.google.com/store/apps/details?id=com.lnidigitalmarketing.dcapp&hl=en');
}

?>

