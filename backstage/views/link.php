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
                <li class="active">友情链接</li>
            </ul>
            <!--.breadcrumb-->
        </div>
        <div class="page-content">
            <div class="page-header position-relative">
                <h1>友情链接</h1>
            </div>
            <div class="row-fluid">
                <div class="span12">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label>
                            <input type="checkbox">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>友链名称</th>
                    <th>链接地址</th>
                    <th class="hidden-480">启用状态</th>
                    <th class="hidden-480">友链类型</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if(isset($link_list) && is_array($link_list)){
                    foreach($link_list as $key => $value){
                 ?>
                <tr>
                    <td class="center">
                        <label>
                            <?php echo form_checkbox(array('name'=>'linkid[]','value'=>$value->l_id));?>
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td>
                        <?php echo $value->link_name;?>
                    </td>
                    <td><?php echo $value->link_url;?></td>
                    <td class="hidden-phone"><?php echo $value->recommend;?></td>
                    <td class="hidden-480"><?php echo $value->link_type;?></td>

                    <td class="td-actions ">
                        <div class="hidden-phone visible-desktop action-buttons">
                            <a class="blue" href="<?php echo site_url('link/view/' . $value->l_id);?>">
                                <i class="icon-zoom-in bigger-130"></i>
                            </a>

                            <a class="red" href="<?php echo site_url('link/delete/' . $value->l_id);?>">
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
                <?php if(isset($link_pagination) && !empty($link_pagination)){?>
                        <div class="row-fluid">
                            <div class="span6">
                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <?php echo $link_pagination;?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php load_page('pages/footer');?>