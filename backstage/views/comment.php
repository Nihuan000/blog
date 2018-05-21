<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-29
 * Time: 下午2:45
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
            <li class="active">评论管理</li>
        </ul>
        <!--.breadcrumb-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>评论管理</h1>
        </div>
        <!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <ul class="nav-pills" id="comment-list">
                    <li class="active"><a href="edit-comments.php?comment_status=all" class="current">全部</a> |</li>
                    <li><a href="edit-comments.php?comment_status=moderated">待审<span class="count">（<span
                                    class="pending-count">0</span>）</span></a> |
                    </li>
                    <li><a href="edit-comments.php?comment_status=approved">获准</a> |</li>
                    <li><a href="edit-comments.php?comment_status=spam">垃圾评论<span class="count">（<span
                                    class="spam-count">0</span>）</span></a> |
                    </li>
                    <li><a href="edit-comments.php?comment_status=trash">回收站<span class="count">（<span
                                    class="trash-count">0</span>）</span></a></li>
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
                            echo form_open('comment/setting', array('method' => 'get'));
                            echo form_dropdown('setting', $options, '', 'id="form-field-select-1"');
                            echo form_submit(array('class' => 'btn btn-mini art-set', 'value' => '应用', 'name' => 'art-set'));
                            echo form_close();
                            ?>
                        </div>
                    </div>
                    <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable"
                           aria-describedby="sample-table-2_info">
                        <thead>
                        <tr role="row">
                            <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1"
                                aria-label="" style="width: 57px;">
                                <label>
                                    <input type="checkbox">
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2"
                                rowspan="1" colspan="1"
                                aria-label="Domain: activate to sort column ascending" style="width: 172px;">作者
                            </th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2"
                                rowspan="1" colspan="1"
                                aria-label="Price: activate to sort column ascending" style="width: 116px;">评论
                            </th>
                            <th class="hidden-phone sorting" role="columnheader" tabindex="0"
                                aria-controls="sample-table-2" rowspan="1"
                                colspan="1" aria-label="Update: activate to sort column ascending"
                                style="width: 188px;">
                                回应给
                            </th>
                            <th class="hidden-480 sorting" role="columnheader" tabindex="0"
                                aria-controls="sample-table-2" rowspan="1"
                                colspan="1" aria-label="Status: activate to sort column ascending"
                                style="width: 179px;">日期
                            </th>
                            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=""
                                style="width: 164px;">操作
                            </th>
                        </tr>
                        </thead>


                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if(isset($comment) && is_array($comment)){?>
                            <?php foreach($comment as $key => $value){?>
                        <tr class="odd">
                            <td class="center  sorting_1">
                                <label>
                                    <?php echo form_checkbox(array('name'=>'ids[]','value'=>$value->id));?>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td class=" ">
                                <a href="<?php echo !empty($value->site_url) ? $value->site_url : 'javascript:;';?>">
                                    <?php echo $value->name;?>
                                </a>
                            </td>
                            <td class="hidden-480 "><?php echo $value->comment;?></td>
                            <td class="hidden-480 ">
                                <span class="label label-info arrowed-right arrowed-in"><?php echo $value->article_id;?></span>
                            </td>
                            <td class="hidden-phone "><?php echo date('Y年m月d日 H-i-s');?></td>


                            <td class="td-actions ">
                                <div class="hidden-phone visible-desktop action-buttons">
                                    <a class="blue" id="is-passed" data="<?php echo $value->id;?>" href="javascript:;">
                                        <i class="icon-zoom-in bigger-130"></i>
                                    </a>

                                    <a class="green" href="<?php echo site_url('comment/reply/' . $value->id);?>">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" href="<?php echo site_url('comment/delete/' . $value->id);?>">
                                        <i class="icon-trash bigger-130"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                            <?php }?>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php if(isset($comment_pagination) && !empty($comment_pagination)){?>
                        <div class="row-fluid">
                            <div class="span6">
                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <?php echo $comment_pagination;?>
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
    $(function () {
        $('table th input:checkbox').on('click', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });
        $('#is-passed').click(function () {
            var comm_id = $(this).attr('data');
            $.post("<?php echo site_url('comment/ajaxPass');?>",{id:comm_id},function(data){
                if(data == 'succ'){
                    window.location.reload();
                }
            });
        });
    })
</script>
<?php load_page('pages/footer'); ?>
