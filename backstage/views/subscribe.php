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
            <li class="active">订阅管理</li>
        </ul>
        <!--.breadcrumb-->
    </div>

    <div class="page-content">
    <div class="page-header position-relative">
        <h1>订阅</h1>
    </div>
    <!--/.page-header-->

    <div class="row-fluid">
    <div class="span12">
    <!--PAGE CONTENT BEGINS-->
    <ul class="nav-pills" id="comment-list">
        <li class="active"><a href="edit-comments.php?comment_status=all" class="current">全部</a> |</li>
        <li><a href="edit-comments.php?comment_status=moderated">已停止<span class="count">（<span class="pending-count">0</span>）</span></a> |</li>
        <li><a href="edit-comments.php?comment_status=approved">订阅中</a></li>
    </ul>
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
    <div class="row-fluid">
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
    <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable"
           aria-describedby="sample-table-2_info">
        <thead>
        <tr role="row">
            <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 57px;">
                <label>
                    <?php echo form_checkbox(array('name'=>'subscribe_id[]'));?>
                    <span class="lbl"></span>
                </label>
            </th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1"
                aria-label="Domain: activate to sort column ascending" style="width: 172px;">编号
            </th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1"
                aria-label="Price: activate to sort column ascending" style="width: 116px;">邮箱
            </th>
            <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
                colspan="1" aria-label="Clicks: activate to sort column ascending" style="width: 125px;">是否启用
            </th>
            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=""
                style="width: 164px;">操作</th>
        </tr>
        </thead>


        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php if(isset($subscribe_list)){
            foreach($subscribe_list as $key => $value){
        ?>
            <tr class="odd">
            <td class="center  sorting_1">
                <label>
                    <?php echo form_checkbox(array('name'=>'subscribe_id[]','value'=>$value->su_id));?>
                    <span class="lbl"></span>
                </label>
            </td>

            <td class=" ">
                <?php echo $value->su_id;?>
            </td>

            <td class=" ">
                <?php echo $value->email;?>
            </td>
            <td class=" ">

                    <?php echo ($value->incoming == 1) ? '<span class="label label-success">启用</span>' : '<span class="label label-warning">停用</span>';?>

            </td>
            <td class="td-actions ">
                <div class="hidden-phone visible-desktop action-buttons">

                    <a class="green" href="<?php echo site_url('subscribe/edit/' . $value->su_id);?>">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url('subscribe/delete/' . $value->su_id);?>">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?php
            }
        }?>
        </tbody>
    </table>
        <?php if(isset($subscribe_pagination) && !empty($subscribe_pagination)){?>
        <div class="row-fluid">
            <div class="span12">
                <div class="dataTables_paginate paging_bootstrap pagination">
                   <?php echo $subscribe_pagination;?>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
            });
        })
    </script>
<?php
    load_page('pages/footer');
?>