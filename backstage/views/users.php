<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 上午10:51
 */
load_page('pages/header');
?>
    <div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="<?php echo site_url(); ?>">首页</a>
                    <span class="divider">
                        <i class="icon-angle-right arrow-icon"></i>
                    </span>
            </li>
            <li class="active">用户</li>
        </ul>
        <!--.breadcrumb-->
    </div>
    <div class="page-content">
    <div class="page-header position-relative">
        <h1>用户信息</h1>
    </div>
    <?php
    if(get_message('user_update')){
        echo '<div class="clearfix">' . get_message('user_update') . '</div>';
    }
    ?>
    <div class="row-fluid">
    <div class="span12">
    <div id="user-profile-3" class="user-profile row-fluid">
    <div class="offset1 span10">

    <div class="space"></div>

    <?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
    <div class="tabbable">
        <ul class="nav nav-tabs padding-16">
            <li class="active">
                <a data-toggle="tab" href="#edit-basic">
                    <i class="green icon-edit bigger-125"></i>
                    基本信息
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#edit-settings">
                    <i class="purple icon-cog bigger-125"></i>
                    用户设置
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#edit-password">
                    <i class="blue icon-key bigger-125"></i>
                    密码选项
                </a>
            </li>
        </ul>

        <div class="tab-content profile-edit-tab-content">
            <div id="edit-basic" class="tab-pane in active">
                <h4 class="header blue bolder smaller">一般信息</h4>

                <div class="row-fluid">
                    <div class="span4">
                        <?php if(!empty($user->photo)){?>
                            <img src="<?php echo $user->photo;?>" />
                            <hr>
                        <?php }?>
                        <?php echo form_upload(array('name' => 'users')); ?>
                    </div>

                    <div class="vspace"></div>

                    <div class="span8">
                        <div class="control-group">
                            <label class="control-label" for="form-field-username">用户名</label>

                            <div class="controls">
                                <?php echo form_input(array('name' => 'users[username]', 'value' => $user->username, 'id' => 'form-field-username', 'placeholder' => '用户名')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-first">名称</label>

                            <div class="controls">
                                <?php echo form_input(array('name' => 'users[name]', 'class' => 'input-small', 'value' => $user->name, 'id' => 'form-field-first', 'placeholder' => '前台显示名称')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-comment">格言</label>

                            <div class="controls">
                                <?php echo form_textarea(array('name'=>'users[maxim]','id'=>'form-field-comment','value'=>$user->maxim,'placeholder'=>'个人格言'));?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space"></div>
                <h4 class="header blue bolder smaller">联系方式</h4>

                <div class="control-group">
                    <label class="control-label" for="form-field-email">邮箱</label>

                    <div class="controls">
                <span class="input-icon input-icon-right">
                    <?php echo form_input(array('name' => 'users[email]', 'value' => $user->email, 'id' => 'form-field-email', 'placeholder' => 'alexdoe@gmail.com')); ?>
                    <i class="icon-envelope"></i>
                </span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-website">QQ</label>

                    <div class="controls">
                        <span class="input-icon input-icon-right">
                            <?php echo form_input(array('name'=>'users[qq]','value'=>$user->qq,'id'=>'form-field-qq'));?>
                            <i class="icon-comment"></i>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-website">新浪微博</label>

                    <div class="controls">
                        <span class="input-icon input-icon-right">
                            <?php echo form_input(array('name'=>'users[sina]','value'=>$user->sina,'id'=>'form-field-sina'));?>
                            <i class="icon-comments"></i>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-website">腾讯微博</label>

                    <div class="controls">
                        <span class="input-icon input-icon-right">
                            <?php echo form_input(array('name'=>'users[txweibo]','value'=>$user->txweibo,'id'=>'form-field-txweibo'));?>
                            <i class="icon-comments"></i>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-website">微信</label>

                    <div class="controls">
                        <span class="input-icon input-icon-right">
                            <?php echo form_input(array('name'=>'users[weixin]','value'=>$user->weixin,'id'=>'form-field-weixin'));?>
                            <i class="icon-comments"></i>
                        </span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-phone">电话</label>

                    <div class="controls">
                        <span class="input-icon input-icon-right">
                            <?php echo form_input(array('name'=>'users[phone]','class'=>'input-medium input-mask-phone','value'=>$user->phone,'id'=>'form-field-phone'));?>
                            <i class="icon-phone icon-flip-horizontal"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div id="edit-settings" class="tab-pane">
                <div class="space-10"></div>

                <div>
                    <label class="inline">
                        <input type="checkbox" name="form-field-checkbox"/>
                        <span class="lbl"> Make my profile public</span>
                    </label>
                </div>

                <div class="space-8"></div>

                <div>
                    <label class="inline">
                        <input type="checkbox" name="form-field-checkbox"/>
                        <span class="lbl"> Email me new updates</span>
                    </label>
                </div>

                <div class="space-8"></div>

                <div>
                    <label class="inline">
                        <input type="checkbox" name="form-field-checkbox"/>
                        <span class="lbl"> Keep a history of my conversations</span>
                    </label>

                    <label class="inline">
                        <span class="space-2 block"></span>

                        for
                        <input type="text" class="input-mini" maxlength="3"/>
                        days
                    </label>
                </div>
            </div>

            <div id="edit-password" class="tab-pane">
                <div class="space-10"></div>

                <div class="control-group">
                    <label class="control-label" for="form-field-pass1">New Password</label>

                    <div class="controls">
                        <input type="password" id="form-field-pass1"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-pass2">Confirm Password</label>

                    <div class="controls">
                        <input type="password" id="form-field-pass2"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?php echo form_submit(array('class'=>'btn btn-info','name'=>'user_update','value'=>'更新'));?>

        &nbsp; &nbsp; &nbsp;
        <?php echo form_reset(array('class'=>'btn','value'=>'重置'));?>
    </div>
    <?php echo form_close(); ?>
    </div>
    <!--/span-->
    </div>
    <!--/user-profile-->
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $('#user-profile-3')
            .find('input[type=file]').ace_file_input({
                style: 'well',
                btn_change: null,
                no_icon: 'icon-picture',
                thumbnail: 'small',
                droppable: true,
                before_change: function (files, dropped) {
                    var file = files[0];
                    if (typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
                        if (!(/\.(jpe?g|png|gif)$/i).test(file)) return false;
                    }
                    else {//file is a File object
                        var type = $.trim(file.type);
                        if (( type.length > 0 && !(/^image\/(jpe?g|png|gif)$/i).test(type) )
                            || ( type.length == 0 && !(/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
                        ) return false;

                        if (file.size > 110000) {//~100Kb
                            return false;
                        }
                    }

                    return true;
                }
            })

    </script>
<?php load_page('pages/footer'); ?>