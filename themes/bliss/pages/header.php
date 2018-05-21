<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" lang="zh-CN">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $GLOBALS['title'];?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico">
    <?php load_css(array('css/bootstrap.css','css/style.css','css/style_002.css','css/style-responsive.css','css/fontello.css','css/wp-synhighlighter.css','css/index.css'),'all');?>
    <?php load_css(array('css/wp-synhighlighter.css'),'screen');?>
    <?php load_js(array('js/jquery.js','js/bootstrap.js','js/wp-synhighlighter.js','js/layout.js','js/mailchimp.js'));?>
    <meta name="description" content="<?php echo $GLOBALS['description'];?>">
    <meta name="keywords" content="<?php echo $GLOBALS['keywords'];?>">
    <meta name="baidu_union_verify" content="1e6b021442b804dd07a07460e7e7614a">
    <meta name="baidu-site-verification" content="PkSDKNPWRB" />
    <link rel="canonical" href="<?php echo site_url();?>">
</head>
