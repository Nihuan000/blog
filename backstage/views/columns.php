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
            <li class="active">栏目管理</li>
        </ul>
        <!--.breadcrumb-->
    </div>
    <div class="page-content">
    <div class="page-header position-relative">
        <h1>分类目录</h1>
    </div>
        <?php
        if(get_message('column_add')){
            echo '<div class="clearfix">' . get_message('column_add') . '</div>';
        }
        ?>
    <!--/.page-header-->

    <div class="row-fluid">
    <div class="span12">
    <!--PAGE CONTENT BEGINS-->
    <div class="span4">
        <h4>添加新分类目录</h4>
        <?php echo form_open();?>
            <fieldset>
                <?php echo form_label('名称');?>
                <?php echo form_input(array('name'=>'columns[cate_name]','placeholder'=>'分类名称'));?>
                <span class="help-block">这将是它在站点上显示的名字。</span>

                <?php echo form_label('别名');?>
                <?php echo form_input(array('name'=>'columns[url_name]','placeholder'=>'分类别名'));?>
                <span class="help-block">通常使用小写，只能包含字母，数字和连字符（-）.</span>

                <?php echo form_label('父级');?>
                <?php
                    echo form_dropdown('columns[pid]',get_columns(),'','id="form-field-select-1"');?>
                <span class="help-block">分类可以有层级关系.</span>

                <?php echo form_label('关键词');?>
                <?php echo form_input(array('name'=>'columns[meta_keyword]','placeholder'=>'关键词1,关键词2'));?>
                <span class="help-block">多个关键词请用英文(,) 分开</span>

                <?php echo form_label('描述');?>
                <?php echo form_textarea(array('name'=>'columns[meta_desc]','class'=>'span10 limited','rows'=>5,'id'=>'form-field-9'));?>
                <span class="help-block">分类描述，会在meta中显示</span>
            </fieldset>
            <?php echo form_submit(array('class'=>'btn btn-small btn-success','name'=>'column_submit','value'=>'添加新分类目录'));?>
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
                aria-label="Domain: activate to sort column ascending" style="width: 172px;">名称
            </th>
            <th class="sorting hidden-phone" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1"
                aria-label="Price: activate to sort column ascending" style="width: 116px;">别名
            </th>
            <th class="hidden-phone sorting" role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1"
                colspan="1" aria-label="Status: activate to sort column ascending" style="width: 179px;">日期
            </th>
            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=""
                style="width: 164px;">操作</th>
        </tr>
        </thead>


        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php
            if(isset($lists) && is_array($lists)){
                foreach($lists as $key => $value){
            ?>
                    <tr>
                        <td class="center  sorting_1">
                            <label>
                                <input type="checkbox" value="<?php echo $value['c_id'];?>">
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td class=" ">
                            <?php echo $value['cate_name'];?>
                        </td>
                        <td class="hidden-480 "><?php echo $value['url_name'];?></td>
                        <td class="hidden-phone "><?php echo date('Y-m-d H:i:s',$value['updated']);?></td>

                        <td class="td-actions ">
                            <div class="visible-desktop action-buttons">
                                <a class="blue" href="<?php echo site_url('columns/update/' . $value['c_id']);?>">
                                    <i class="icon-pencil bigger-130"></i>
                                </a>
                                <a class="red" id="del-column" href="javascript:;" data="<?php echo $value['c_id']; ?>">
                                    <i class="icon-trash bigger-130"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
            <?php
                    if(isset($value['sub']) && !empty($value['sub'])){
                        foreach($value['sub'] as $sk => $sv){
            ?>
                        <tr class="odd">
                            <td class="sorting_1">
                                <label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="<?php echo $sv['c_id'];?>">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                &nbsp;&nbsp;<?php echo $sv['cate_name'];?>
                            </td>
                            <td class="hidden-480 "> &nbsp;&nbsp;<?php echo $sv['url_name'];?></td>
                            <td class="hidden-phone "> &nbsp;&nbsp;<?php echo date('Y-m-d H:i:s',$sv['updated']);?></td>

                            <td class="td-actions ">
                                <div class="visible-desktop action-buttons">
                                    <a class="blue" href="<?php echo site_url('columns/update/' . $sv['c_id']);?>">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>
                                    <a class="red" id="del-column" href="javascript:;" data="<?php echo $sv['c_id']; ?>">
                                        <i class="icon-trash bigger-130"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
            <?php
                        }
                    }
                }
            }
        ?>
        </tbody>
    </table>
    </div>
    <hr>
    <div>
        注意：
        删除分类目录不会把该分类目录下的文章一并删除。文章会被归入“未分类”分类目录。
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sample-table-2').find('a#del-column').click(function () {
            var cata_id = $(this).attr('data');
			var subButton = false;
            if (confirm("将要删除该分类，确定吗?")) {
            	subButton = true;
            }
            if(subButton == true){
				$.post("<?php echo site_url('columns/delete/'); ?>",{cata_id,cata_id},function(data){
					if(data == 'succ'){
						window.location.reload();
					}
				});
            }
        });
    });
</script>
<?php load_page('pages/footer');?>