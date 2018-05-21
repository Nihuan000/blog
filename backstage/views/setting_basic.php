<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 下午1:23
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
                <li class="active">常规设置</li>
            </ul>
            <!--.breadcrumb-->
        </div>
        <div class="page-content">
            <div class="page-header position-relative">
                <h1>常规设置</h1>
            </div>
            <?php
            if(get_message('setting_update')){
                echo '<div class="clearfix">' . get_message('setting_update') . '</div>';
            }
            ?>
            <div class="row-fluid">
                <div class="span12">
                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                    <div class="control-group">
                        <?php echo form_label('站点标题','site_name',array('class'=>'control-label'));?>

                        <div class="controls">
                            <div class="span12">
                                <?php echo form_input(array('name'=>'setting[site_name]','class'=>'span6','id'=>'site_name','value'=>$this->setting_model->get('site_name')));?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo form_label('副标题','second_name',array('class'=>'control-label'));?>

                        <div class="controls">
                            <div class="span12">
                                <?php echo form_input(array('name'=>'setting[second_name]','class'=>'span6','id'=>'second_name','value'=>$this->setting_model->get('second_name')));?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo form_label('博客地址(URL)','site_url',array('class'=>'control-label'));?>

                        <div class="controls">
                            <div class="span12">
                                <?php echo form_input(array('name'=>'setting[site_url]','class'=>'span6','id'=>'site_url','value'=>$this->setting_model->get('site_url')));?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo form_label('博客标志','site_logo',array('class'=>'control-label'));?>
                        <div class="span4" id="upload-file">
                            <?php
                            $site_logo = $this->setting_model->get('site_logo');
                            if(!empty($site_logo)){?>
                                <img src="<?php echo $site_logo;?>" />
                                <hr>
                            <?php }?>
                            <?php echo form_upload(array('name'=>'site_logo'));?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php
                            echo form_label('日期格式','date_format',array('class'=>'control-label'));
                            $date_format = $this->setting_model->get('date_format');
                        ?>

                        <div class="controls">
                            <label>
                                <?php echo form_radio(array('name'=>'setting[date_format]','value'=>'Y年m月d日','checked'=> (isset($date_format) && $date_format == 'Y年m月d日') ? 'checked' : ''));?>
                                <span class="lbl"> 2014年10月30日</span>
                            </label>

                            <label>
                                <?php echo form_radio(array('name'=>'setting[date_format]','value'=>'Y/m/d H:i A','checked'=> (isset($date_format) && $date_format == 'Y/m/d H:i A') ? 'checked' : ''));?>
                                <span class="lbl"> 2014/10/30 4:02 下午</span>
                            </label>

                            <label>
                                <?php echo form_radio(array('name'=>'setting[date_format]','value'=>'m/d/Y H:i','checked'=> (isset($date_format) && $date_format == 'm/d/Y H:i') ? 'checked' : ''));?>
                                <span class="lbl"> 10/30/2014 16:02</span>
                            </label>

                            <label>
                                <?php echo form_radio(array('name'=>'setting[date_format]','value'=>'d/m/Y','checked'=> (isset($date_format) && $date_format == 'd/m/Y') ? 'checked' : ''));?>
                                <span class="lbl"> 30/10/2014</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <?php
                            echo form_submit(array('class'=>'btn btn-primary','value'=>'保存更改'));
                        ?>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('#upload-file')
        .find('input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'Change avatar',
            btn_change:null,
            no_icon:'icon-picture',
            thumbnail:'large',
            droppable:true,
            before_change: function(files, dropped) {
                var file = files[0];
                if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
                    if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
                }
                else {//file is a File object
                    var type = $.trim(file.type);
                    if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
                        || ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
                    ) return false;

                    if( file.size > 110000 ) {//~100Kb
                        return false;
                    }
                }

                return true;
            }
        })
</script>
<?php load_page('pages/footer');?>