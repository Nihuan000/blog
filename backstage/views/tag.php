<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-28
 * Time: 上午11:56
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
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
        <li class="active">标签管理</li>
    </ul>
    <!--.breadcrumb-->
</div>
<div class="page-content">
<div class="page-header position-relative">
    <h1>文章标签</h1>
</div>
<!--/.page-header-->

<div class="row-fluid">
<div class="span12">
<!--PAGE CONTENT BEGINS-->
<div class="span4">
    <h4>添加新标签</h4>
        <?php echo form_open();?>
        <fieldset>
            <label>名称</label>
            <?php echo form_input(array('name'=>'tag[tag]','placeholder'=>'标签名称'));?>
            <span class="help-block">这将是它在站点上显示的名字。</span>

            <label>别名</label>
            <?php echo form_input(array('name'=>'tag[en_tag]','placeholder'=>'标签别名,可以为空'));?>
            <span class="help-block">通常使用小写，只能包含字母，数字和连字符（-）.</span>
        </fieldset>
        <?php echo form_submit(array('class'=>'btn btn-small btn-success','name'=>'column_submit','value'=>'添加新标签'));?>
    <?php echo form_close();?>

</div>

<div class="span8">
<div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
    <div class="row-fluid">
        <div class="span3">
            <div id="sample-table-2_length" class="setting-select">
                <?php
                $options = array(
                    '批量操作',
                    '批量暂停',
                    '删除',
                    '移至回收站'
                );
                echo form_open('article/art_set',array('method'=>'get'));
                echo form_dropdown('setting',$options,'','id="form-field-select-1"');
                echo form_submit(array('class'=>'btn btn-mini art-set','value'=>'应用','name'=>'art-set'));
                echo form_close();
                ?>
            </div>
        </div>
        <div class="span9 pull-right">
            <form class="form-search">
                <input type="text" class="input-medium search-query">
                <button onclick="return false;" class="btn btn-purple btn-small">
                    搜索
                    <i class="icon-search icon-on-right bigger-110"></i>
                </button>
            </form>
        </div>
    </div>
    <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable"
           aria-describedby="sample-table-2_info">
        <thead>
        <tr role="row">
            <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 57px;">
                <label>
                    <input type="checkbox">
                    <span class="lbl"></span>
                </label>
            </th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1"
                aria-label="Domain: activate to sort column ascending" style="width: 172px;">标签
            </th>

            <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
                colspan="1" aria-label="Update: activate to sort column ascending" style="width: 188px;">
                别名
            </th>

            <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
                colspan="1" aria-label="Update: activate to sort column ascending" style="width: 188px;">
                文章
            </th>
            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=""
                style="width: 164px;">操作</th>
        </tr>
        </thead>


        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php if(isset($tag_list)){
            foreach($tag_list as $key => $value){
            ?>
        <tr class="odd">
            <td class="center  sorting_1">
                <label>
                    <?php echo form_checkbox(array('name'=>'tagid[]','value'=>$value['t_id']));?>
                    <span class="lbl"></span>
                </label>
            </td>

            <td>
                <a href="<?php echo site_url('tag/edit/' . $value['t_id']);?>"><?php echo $value['tag'];?></a>
            </td>

            <td>
                <?php echo $value['en_tag'];?>
            </td>

            <td class="hidden-480 ">
                <span class="label label-warning"><?php echo isset($value['article']) ? $value['article'] : '未定义';?></span>
            </td>

            <td class="td-actions ">
                <div class="hidden-phone visible-desktop action-buttons">
                    <a class="blue" href="<?php echo home_url('tag/' . $value['en_tag']);?>">
                        <i class="icon-zoom-in bigger-130"></i>
                    </a>

                    <a class="green" href="<?php echo site_url('tag/edit/' . $value['t_id']);?>">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url('tag/delete/' . $value['t_id']);?>">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?php
             }
            }
        ?>
        </tbody>
    </table>
    <?php if(isset($tag_pagination) && !empty($tag_pagination)){?>
    <div class="row-fluid">
        <div class="span6">
        </div>
        <div class="span6">
            <div class="dataTables_paginate paging_bootstrap pagination">
                <?php echo $tag_pagination;?>
            </div>
        </div>
    </div>
    <?php }?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php load_page('pages/footer');?>