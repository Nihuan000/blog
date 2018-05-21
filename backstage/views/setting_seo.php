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
            <li class="active">优化设置</li>
        </ul>
        <!--.breadcrumb-->
    </div>
    <div class="page-content">
        <div class="page-header position-relative">
            <h1>SEO设置</h1>
        </div>

        <?php
        if(get_message('setting_update')){
            echo '<div class="clearfix">' . get_message('setting_update') . '</div>';
        }
        ?>
        <div class="row-fluid">
            <div class="span12">
                <pre>
                    Meta自定义变量
                    {site_name}  网站名称；{title}标题，{category}类别名称，{content}内容摘要
                    标题: {title} - {category} - {site_name}
                    关键词:{tag}
                    描述：{content}
                </pre>
                <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                <div class="control-group">
                    <?php echo form_label('首页 Meta标题','index_meta_title',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客首页的标题','name'=>'setting[index_meta_title]','class'=>'span4','value'=>$this->setting_model->get('index_meta_title')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('首页 Meta关键字','index_meta_keyword',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客首页的关键字','name'=>'setting[index_meta_keyword]','class'=>'span4','value'=>$this->setting_model->get('index_meta_keyword')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('首页 Meta描述','index_meta_desc',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客首页的描述','name'=>'setting[index_meta_desc]','class'=>'span6','value'=>$this->setting_model->get('index_meta_desc')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('栏目 Meta标题','column_meta_title',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客栏目的标题','name'=>'setting[column_meta_title]','class'=>'span4','value'=>$this->setting_model->get('column_meta_title')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('栏目 Meta关键字','column_meta_keyword',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客栏目的关键字','name'=>'setting[column_meta_keyword]','class'=>'span4','value'=>$this->setting_model->get('column_meta_keyword')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('栏目 Meta描述','column_meta_desc',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客栏目的描述','name'=>'setting[column_meta_desc]','class'=>'span6','value'=>$this->setting_model->get('column_meta_desc')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('文章 Meta标题','article_meta_title',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客文章的标题','name'=>'setting[article_meta_title]','class'=>'span4','value'=>$this->setting_model->get('article_meta_title')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('文章 Meta关键字','article_meta_keyword',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客文章的关键字','name'=>'setting[article_meta_keyword]','class'=>'span4','value'=>$this->setting_model->get('article_meta_keyword')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('文章 Meta描述','article_meta_desc',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'博客文章的描述','name'=>'setting[article_meta_desc]','class'=>'span6','value'=>$this->setting_model->get('article_meta_desc')));?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('版权','site_copyright',array('class' => 'control-label'));?>
                    <div class="controls">
                        <?php echo form_input(array('id'=>'form-field-1','placeholder'=>'版权信息','name'=>'setting[site_copyright]','class'=>'span4','value'=>$this->setting_model->get('site_copyright')));?>
                    </div>
                </div>
                <div class="form-actions">
                    <?php echo form_submit(array('class'=>'btn btn-info','name'=>'seo_setting','value'=>'提交'));?>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php load_page('pages/footer');?>