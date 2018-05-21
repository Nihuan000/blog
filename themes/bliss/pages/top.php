<?php load_page('pages/header');?>
<body class="home blog">
<div class="bl_search_overlay"></div>
<!--<div class="bl_background">-->
<!--    <div id="stripe"></div>-->
<!--    <img src="--><?php //load_img('images/bg.jpg');?><!--">-->
<!--</div>-->
<ul class="scroll">
    <li class="sct">
        <a href="#">&nbsp;&nbsp;&nbsp;</a>
        <div style="display: block; right: 0px; opacity: 0;"><a title="返回顶部" class="scroll_t">返回顶部</a></div>
    </li>
    <li class="scc">
        <a href="javascript:;">&nbsp;&nbsp;&nbsp;</a>
        <div><a title="查看评论" class="scroll_c">查看评论</a></div>
    </li>
    <li class="scb">
        <a href="javascript:;">&nbsp;&nbsp;&nbsp;</a>
        <div style="display: block; right: 0px; opacity: 0;"><a title="转至底部" class="scroll_b">转至底部</a></div>
    </li>
</ul>

<div id="page" class="site">
    <header id="masthead" role="banner">
        <div class="row-fluid top-banner">
            <div class="container">
                <div class="banner-overlay"></div>
                <?php echo site_logo();?>
                <div class="top-banner-social pull-right"></div>
            </div>
        </div>
        <div class="row-fluid bluth-navigation">
            <div class="container">
                <div class="mini-logo">
                    <a class="mini mini-image" href="<?php echo setting('site_url');?>" title="<?php echo setting('second_name');?>" rel="home"><img src="<?php load_img('images/tang.png');?>" alt="<?php echo setting('second_name');?>"></a>
                </div>
                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                        <div class="visible-tablet visible-phone bl_search">
                            <?php echo form_open(site_url('article/search'),array('method'=>'get','class'=>'searchform','role'=>'search'));?>
                            <fieldset>
                                <a href="javascript:;"><i class="icon-search-1"></i></a>
                                <?php echo form_input(array('name'=>'word','placeholder'=>'搜索文章'));?>
                            </fieldset>
                            <?php echo form_close();?>
                        </div>
                        <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                        <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><i class="icon-menu-1"></i></button>
                        <div class="nav-collapse collapse">
                            <?php echo load_column();?>
                        </div>
                    </div><!-- /.navbar-inner -->
                    <div style="left: 0px; width: 60px;" class="nav-line"></div>
                </div>
                <div class="bl_search visible-desktop nav-collapse collapse">
                    <form action="http://www.tcao.net/" method="get" class="searchform" role="search">
                        <fieldset>
                            <a href="#"><i class="icon-search-1"></i></a>
                            <input name="s" placeholder="搜索ing..." type="text">
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </header><!-- #masthead .site-header -->
