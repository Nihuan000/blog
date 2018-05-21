<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-4
 * Time: 下午2:17
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
                <li class="active">
                    <a href="<?php echo site_url('columns/index'); ?>">栏目管理</a>
                    <span class="divider">
                        <i class="icon-angle-right arrow-icon"></i>
                    </span>
                </li>
                <li class="active">
                    栏目更新
                </li>
            </ul>
            <!--.breadcrumb-->
        </div>
    <div class="page-content">
        <div class="page-header position-relative">
            <h1><?php echo $column->cate_name;?></h1>
        </div>
        <!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <?php
                if(get_message('column_update')){
                    echo '<div class="clearfix">' . get_message('column_update') . '</div>';
                }
                echo form_open();?>
                <fieldset>
                    <?php echo form_label('名称');?>
                    <?php echo form_input(array('name'=>'columns[cate_name]','placeholder'=>'分类名称','value'=>isset($column->cate_name) ? $column->cate_name : ''));?>
                    <span class="help-block">这将是它在站点上显示的名字。</span>

                    <?php echo form_label('别名');?>
                    <?php echo form_input(array('name'=>'columns[url_name]','placeholder'=>'分类别名','value'=>isset($column->url_name) ? $column->url_name : ''));?>
                    <span class="help-block">通常使用小写，只能包含字母，数字和连字符（-）.</span>

                    <?php echo form_label('父级');?>
                    <?php
                    echo form_dropdown('columns[pid]',get_columns(),isset($column->pid) ? $column->pid : '','id="form-field-select-1"');?>
                    <span class="help-block">分类可以有层级关系.</span>

                    <?php echo form_label('关键词');?>
                    <?php echo form_input(array('name'=>'columns[meta_keyword]','placeholder'=>'关键词1,关键词2','value'=>isset($column->meta_keyword) ? $column->meta_keyword : ''));?>
                    <span class="help-block">多个关键词请用英文(,) 分开</span>

                    <?php echo form_label('描述');?>
                    <?php echo form_textarea(array('name'=>'columns[meta_desc]','class'=>'span10 limited','rows'=>5,'id'=>'form-field-9','value'=>isset($column->meta_desc) ? $column->meta_desc : ''));?>
                    <span class="help-block">分类描述，会在meta中显示</span>
                </fieldset>
                <?php echo form_submit(array('class'=>'btn btn-small btn-success','name'=>'column_submit','value'=>'更新分类目录'));?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    </div>
<?php
load_page('pages/footer');