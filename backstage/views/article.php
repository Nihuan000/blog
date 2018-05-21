<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
            <li class="active">文章管理</li>
        </ul>
        <!--.breadcrumb-->
    </div>
    <div class="page-content">
    <div class="page-header position-relative">
        <h1>
            文章管理
            <small>
                <i class="icon-double-angle-right"></i>
            </small>
            <a href="<?php echo site_url('article/create'); ?>">
                <button class="btn btn-small btn-primary">
                    <i class="icon-edit"></i>
                    写篇文章
                </button>
            </a>
            <a href="<?php echo site_url('article/search'); ?>">
                <button class="btn btn-small btn-info">
                    <i class="icon-search"></i>
                    文章搜索
                </button>
            </a>
        </h1>
    </div>
    <!--/.page-header-->

    <div class="row-fluid">
    <div class="span12">
    <?php
    if(get_message('article_add')){
        echo '<div class="clearfix">' . get_message('article_add') . '</div>';
    }
    ?>
    <!--PAGE CONTENT BEGINS-->
    <?php
    if(get_message('column_add')){
        echo '<div class="clearfix">' . get_message('article_add') . '</div>';
    }
    ?>
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
    <div class="row-fluid">
        <div class="span2">
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
        <div class="span6" id="search-form">
            <div id="sample-table-2_length" class="search-select">
                <?php
                    echo form_open('article/search',array('method'=>'get'));
                    echo form_dropdown('search_time_key',array(0 => '显示所有日期'));
                    echo form_dropdown('search_cate_key',array(0 => '查看所有分类目录'),'','id="cat" class="postform"');
                    echo form_submit(array('class'=>'btn btn-mini art-set','value'=>'筛选','name'=>'art-search'));
                ?>
            </div>
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
            aria-label="Domain: activate to sort column ascending" style="width: 172px;">标题
        </th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1"
            aria-label="Price: activate to sort column ascending" style="width: 116px;">作者
        </th>
        <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
            colspan="1" aria-label="Clicks: activate to sort column ascending" style="width: 125px;">分类目录
        </th>
        <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
            colspan="1" aria-label="Update: activate to sort column ascending" style="width: 188px;">
            标签
        </th>
        <th class="hidden-480 sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
            colspan="1" aria-label="Status: activate to sort column ascending" style="width: 179px;">日期
        </th>
        <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=""
            style="width: 164px;">操作</th>
    </tr>
    </thead>


    <tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php if(isset($article_list) && !empty($article_list)){
        foreach($article_list as $key => $value){
            $tag_array = get_articte_tag($value->a_id);
            $tags = array_to_string($tag_array);
    ?>
    <tr class="odd">
        <td class="center sorting_1">
            <label>
                <?php echo form_checkbox(array('name'=>'a_id[]','value'=>$value->a_id));?>
                <span class="lbl"></span>
            </label>
        </td>

        <td class="span6">
            <a href="<?php echo site_url('article/update/' . $value->a_id)?>"><?php echo $value->title?></a>
        </td>
        <td class=" "><?php echo $value->uid;?></td>
        <td class="hidden-480 "><?php echo $value->c_id;?></td>
        <td class="hidden-phone "><?php echo empty($tags) ? '--' : $tags;?></td>

        <td class="hidden-480 ">
            <?php echo date('Y年m月d日',$value->post_time);?>
        </td>

        <td class="td-actions ">
            <div class="hidden-phone visible-desktop action-buttons">
                <a class="blue" href="<?php echo site_url('article/preview/' . $value->a_id);?>">
                    <i class="icon-zoom-in bigger-130"></i>
                </a>

                <a class="green" href="<?php echo site_url('article/update/' . $value->a_id);?>">
                    <i class="icon-pencil bigger-130"></i>
                </a>

				<a class="red" href="javascript:;" onclick="delThis('<?php echo $value->a_id;?>');">
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
    <?php if(isset($article_pagination) && !empty($article_pagination)){?>
        <div class="row-fluid">
            <div class="span6">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <?php echo $article_pagination;?>
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
        });
		function delThis(id){
			 var subButton = false;
			  if (confirm("如果继续该操作，文章将被删除，确定吗?")) {
				subButton = true;
			 }
			 if(subButton == true){
				 $.post("<?php echo site_url('article/delete');?>",{article_id:id},function(data){
					 if(data){
						alert('文章已删除!');
						window.location.reload();
					 } 
				 });
			 }
		}
    </script>
<?php load_page('pages/footer'); ?>
