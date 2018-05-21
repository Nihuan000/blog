<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>博客管理 - 登录系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php load_css(array('css/bootstrap.min.css', 'css/font-awesome.min.css', 'css/ace.min.css', 'css/login.css'), ''); ?>
    <!--basic styles-->
    <?php load_js(array('js/jquery-2.0.3.min.js')); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body class="login-layout">
<div class="main-container container-fluid">
    <div class="main-content">
        <div class="row-fluid">
            <div class="span12">
                <div class="login-container">
                    <div class="row-fluid">
                        <div class="center">
                            <h1>
                                <i class="icon-leaf green"></i>
                                <span class="red">博客系统</span>
                                <span class="white">Sign In</span>
                            </h1>
                            <h4 class="blue">&copy; 唐朝网络</h4>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="row-fluid">
                        <div class="position-relative">
                            <div id="login-box" class="login-box visible widget-box no-border">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <h4 class="header blue lighter bigger">
                                            <i class="icon-coffee green"></i>
                                            登 录 信 息
                                        </h4>

                                        <div class="space-6"></div>
                                        <?php echo form_open(site_url('main/')); ?>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <?php echo form_input(array('name'=>'login_name','class'=>'span12','placeholder'=>'用户名','id'=>'login_name'));?>
                                                <i class="icon-user"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <?php echo form_password(array('name'=>'login_password','class'=>'span12','placeholder'=>'密  码','id'=>'login_password'));?>
                                                <i class="icon-lock"></i>
                                            </span>
                                        </label>
                                        <label>
                                            <span class="input-icon input-icon-right verify-code">
                                                 <?php echo form_input(array('name'=>'captcha','class'=>'span6','placeholder'=>'验证码','id'=>'verifyCode'));?>
                                                <?php echo load_captcha(2);?>
                                            </span>
                                        </label>

                                        <div style="clear: both"></div>
                                        <div class="space"></div>

                                        <div class="clearfix center">
                                            <?php echo form_submit(array('name'=>'submit','value'=>'登录','id'=>'login-submit','class'=>'width-35 btn btn-small btn-primary'));?>
                                        </div>

                                        <div class="space-4"></div>
                                        </fieldset>
                                        <?php echo form_close(); ?>
                                        <div class="social-or-login center">
                                            <span class="bigger-110">Login Form</span>
                                        </div>
                                        <div class="social-login center">
                                            <?php 
                                            if(get_message('login_error')){
                                                get_message('login_error');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--/widget-body-->
                                </div>
                                <!--/login-box-->
                            </div>
                            <!--/position-relative-->
                        </div>
                    </div>
                </div>
                <!--/.span-->
            </div>
            <!--/.row-fluid-->
        </div>
    </div>
    <!--/.main-container-->
</body>
</html>
