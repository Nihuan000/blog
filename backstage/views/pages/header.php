<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard - 博客管理</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<?php load_css(array('css/bootstrap.min.css','css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/ace.min.css','css/ace-responsive.min.css','css/admin.css'));?>
		<!--fonts-->

		<!-- <link rel="stylesheet" href="http://fonts.useso.com/css?family=Open+Sans:400,300" /> -->

    <?php load_js(array('js/jquery.min.js','js/bootstrap.min.js', 'js/ace-elements.min.js', 'js/ace.min.js'));?>
		<!--ace styles-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <!--basic scripts-->

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="<?php echo get_url();?>" class="brand" target="_blank">
						<small>
                            <i class="icon-globe"></i>
                            我的 CodeIgniter 博客
						</small>
					</a><!--/.brand-->
                    <?php $user = _auth_info();?>
					<ul class="nav ace-nav pull-right">
						<li>
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                                <?php $img = isset($user->photo) ? $user->photo : load_img('images/avatar.png');?>
								<img class="nav-user-photo" src="<?php echo $img;?>" alt="<?php echo $user->name;?>" />
								<span class="user-info">
									<small>Welcome,</small>
                                    <?php echo $user->name;?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="<?php echo site_url('setting/basic');?>">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="<?php echo site_url('users');?>">
										<i class="icon-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo site_url('users/logout');?>">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid admin-container">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar custom-sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list" id="left-nav-list">
					<li id="main">
						<a href="<?php echo site_url('main/mainPage');?>">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> 仪表盘 </span>
						</a>
					</li>

					<li id="article">
						<a href="<?php echo site_url('article');?>">
							<i class="icon-text-width"></i>
							<span class="menu-text"> 文章 </span>
						</a>
					</li>

					<li id="columns">
						<a href="<?php echo site_url('columns');?>">
							<i class="icon-folder-close"></i>
							<span class="menu-text"> 分类 </span>
						</a>
					</li>

					<li id="tag">
						<a href="<?php echo site_url('tag');?>">
							<i class="icon-tag"></i>
							<span class="menu-text"> 标签 </span>
						</a>
					</li>

					<li id="comment">
						<a href="<?php echo site_url('comment');?>">
							<i class="icon-comment"></i>
							<span class="menu-text"> 评论 </span>
						</a>
					</li>

					<li id="subscribe">
						<a href="<?php echo site_url('subscribe');?>">
							<i class="icon-bookmark"></i>
							<span class="menu-text"> 订阅 </span>
						</a>
					</li>

					<li id="template">
						<a href="<?php echo site_url('template');?>">
							<i class="icon-desktop"></i>
							<span class="menu-text"> 外观 </span>
						</a>
					</li>

					<li id="users">
						<a href="<?php echo site_url('users');?>">
							<i class="icon-user"></i>
							<span class="menu-text"> 用户 </span>
						</a>
					</li>

					<li id="link">
						<a href="<?php echo site_url('link');?>">
							<i class="icon-link"></i>
							<span class="menu-text"> 友链 </span>
						</a>
					</li>

					<li id="setting">
						<a href="javascript:;" class="dropdown-toggle">
							<i class="icon-list-ul"></i>
							<span class="menu-text"> 设置 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li id="basic">
								<a href="<?php echo site_url('setting/basic');?>">
									<i class="icon-double-angle-right"></i>
									常规设置
								</a>
							</li>

							<li id="seo">
								<a href="<?php echo site_url('setting/seo');?>">
									<i class="icon-double-angle-right"></i>
									SEO设置
								</a>
							</li>

<!--							<li id="read">-->
<!--								<a href="--><?php //echo site_url('setting/read');?><!--">-->
<!--									<i class="icon-double-angle-right"></i>-->
<!--									阅读设置-->
<!--								</a>-->
<!--							</li>-->
<!---->
<!--							<li id="comment">-->
<!--								<a href="--><?php //echo site_url('setting/comment');?><!--">-->
<!--									<i class="icon-double-angle-right"></i>-->
<!--									评论设置-->
<!--								</a>-->
<!--							</li>-->
						</ul>
					</li>
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>
