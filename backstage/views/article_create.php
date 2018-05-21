<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
load_page('pages/header');
load_css(array('css/simditor.css','css/app.css'));
load_js(array('js/mobilecheck.js','js/module.js','js/uploader.js','js/hotkeys.js','js/simditor.js','js/editor_use.js'));
?>
<script type="text/javascript">
    if(mobilecheck()){
        $('<link/>', {
            media: 'all',
            rel: 'stylesheet',
            type: 'text/css',
            href: '/backstage/views/css/mobile.css'
        }).appendTo('head')
    }
</script>
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
				<li>
					<a href="<?php echo site_url('article'); ?>">文章管理</a>
				<span class="divider">
					<i class="icon-angle-right arrow-icon"></i>
				</span>
				</li>
				<li class="active">写文章</li>
			</ul>
			<!--.breadcrumb-->
		</div>
		<div class="page-content">
			<div class="page-header position-relative">
				<h1>
					写新文章
				</h1>
			</div>
			<!--/.page-header-->

			<div class="row-fluid">
				<?php echo form_open('',array('id'=>'article-add'));
                      echo form_hidden('article[a_id]',isset($post->a_id) ? $post->a_id : '');
                ?>
				<div class="span8">
					<!--PAGE CONTENT BEGINS-->
					<h4 class="header green clearfix">
						在此输入标题
					</h4>
					<div class="controls article-create">
						<?php echo form_input(array('class'=>'span11','name'=>'article[post_title]','value'=>isset($post->title) ? $post->title : '','size'=>30,'id'=>'title','autocomplete'=>'off'));?>
					</div>
					<h4 class="header green clearfix">
						在此输入内容
					</h4>
					<div class="controls article-create">
                        <textarea id="txt-content" name="article[content]" data-autosave="editor-content" autofocus>
                           <?php echo isset($post->content) ? stripslashes($post->content) : '';?>
                        </textarea>

                    </div>

					<h4 class="header green clearfix">
						在此输入Meta 关键字
					</h4>
					<div class="controls article-create">
						<?php echo form_input(array('class'=>'span11','name'=>'article[meta_keyword]','value'=>isset($post->meta_keyword) ? $post->meta_keyword : '','id'=>'meta_keyword','autocomplete'=>'off'));?>
					</div>
					<h4 class="header green clearfix">
						在此输入Meta 描述
					</h4>
					<div class="controls">
						<?php echo form_textarea(array('class'=>'span11','name'=>'article[meta_desc]','value'=>isset($post->meta_desc) ? $post->meta_desc : '','id'=>'meta_desc','cols'=>'10','rows'=>5));?>
					</div>
					<div class="hr hr-double dotted"></div>
				</div>
				<div class="span3 widget-container-span ui-sortable">
					<h4 class="header green clearfix">
						选择分类
					</h4>
					<div class="widget-box">
						<div class="widget-header">
							<div class="widget-toolbar no-border">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#category-all">所有分类</a>
									</li>

<!--                                    <li>-->
<!--                                        <a data-toggle="tab" href="#category-addr">新建分类</a>-->
<!--                                    </li>-->
								</ul>
							</div>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-6">
								<div class="tab-content">
									<?php if(isset($category) && !empty($category)){?>
									<div class="tab-pane category-all active" id="category-all">
										<?php foreach($category as $k => $v){?>
										<label>
											<input name="article[c_id]" value="<?php echo $k?>" class="ace-checkbox-2" type="checkbox" <?php if(isset($post->c_id) && $post->c_id == $k){ echo 'checked="true"'; }?>>
											<span class="lbl"> <?php echo $v['cate_name'];?></span>
										</label>
                                            <?php
                                            if(isset($v['sec_column']) && !empty($v['sec_column'])){
                                                foreach($v['sec_column'] as $key => $value){
                                            ?>
												<label class="sub-column">
													<input name="article[c_id]" value="<?php echo $key;?>" class="ace-checkbox-2" type="checkbox" <?php if(isset($post->c_id) && $post->c_id == $key){ echo 'checked="true"'; }?>>
													<span class="lbl"> <?php echo $value['cate_name'];?></span>
												</label>
                                            <?php
                                                }
                                            }
                                            ?>
										<?php }?>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					<h4 class="header green clearfix">
						标签
					</h4>
					<div class="controls">
						<?php echo form_input(array('name'=>'article[tags]','class'=>'span10','value'=>isset($tags) ? $tags : ''));?>
						<span class="help-block">多个标签请用英文(,) 分开</span>
					</div>

					<h4 class="header green clearfix">
						发布
					</h4>
					<div class="controls">
						<?php 
							$submit = '发布文章';
							if(isset($post->a_id)){
								$submit = '更新文章';
							}
							echo form_submit(array('class'=>'btn btn-small btn-primary','name'=>'create','value'=>$submit));?>
						<?php echo form_button(array('class'=>'btn btn-small btn-pink','name'=>'outline','id'=>'outline','content'=>'保存草稿'));?>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
<?php load_page('pages/footer'); ?>
