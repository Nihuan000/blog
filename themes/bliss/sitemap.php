<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>站点地图 - <?php echo $GLOBALS['title'];?></title>

    <meta name="description" content="<?php echo $GLOBALS['description'];?>">
    <meta name="keywords" content="<?php echo $GLOBALS['keywords'];?>">
    <style type="text/css">
        body {font-family: Verdana;FONT-SIZE: 12px;MARGIN: 0;color: #000000;background: #ffffff;}
        img {border:0;}
        li {margin-top: 8px;}
        .page {padding: 4px; border-top: 1px #EEEEEE solid}
        .author {background-color:#EEEEFF; padding: 6px; border-top: 1px #ddddee solid}
        #nav, #content, #footer {padding: 8px; border: 1px solid #EEEEEE; clear: both; width: 95%; margin: auto; margin-top: 10px;}
        .sitemap-tag {display: block;height: 100%;min-height: 200px;}
        .sitemap-tag ul{height: 100%;list-style: none;display: block;}
        .sitemap-tag ul li{float: left;padding: 10px;}
    </style>
</head>
<body vlink="#333333" link="#333333">
<h2 style="text-align: center; margin-top: 20px"><?php echo $GLOBALS['title'];?> SiteMap </h2>
<center></center>
<div id="nav">
    <strong>
        <?php echo _link(site_url(),$GLOBALS['title']);?>
    </strong>
    &raquo;
    <?php echo _link(site_url('sitemap.html'),'站点地图');?>
</div>
<div id="content">
    <h3>最新文章</h3>
    <ul>
        <?php
            if(isset($new_article) && !empty($new_article)){
                foreach($new_article as $a_k => $a_v){
                    echo "<li>" . _link($a_v->url,$a_v->title,'title="' . $a_v->title . '" target="_blank"') . "</li>";
                }
            }
        ?>
    </ul>
</div>

<div id="content">
    <li class="categories">分类目录<ul>
            <?php
                if(isset($root_cate) && !empty($root_cate)){
                    foreach($root_cate as $rk => $rv){
                        echo '<li class="cat-item cat-item-' . $rv->c_id . '">' . _link($rv->url,$rv->cate_name) . '</li>';
                        if(isset($rv->sub_cate) && !empty($rv->sub_cate)){
                            echo "<ul class='children'>";
                            foreach($rv->sub_cate as $sk => $sv){
                                echo '<li class="cat-item cat-item-' . $sv->c_id . '">' . _link($sv->url,$sv->cate_name) . '</li>';
                            }
                            echo "</ul>";
                        }
                    }
                };
            ?>
        </ul></li>
</div>

<div id="content" class="sitemap-tag">
    <h3>博客标签</h3>
    <ul>
        <?php
        if(isset($tags) && !empty($tags)){
            foreach($tags as $t_k => $t_v){
                echo "<li>" . _link($t_v->url,$t_v->tag,'title="' . $t_v->tag . '" target="_blank"') . "</li>";
            }
        }
        ?>
    </ul>
</div>

<div id="footer">查看博客首页: <strong><?php echo _link(site_url(),$GLOBALS['title']);?></strong></div><br />
<center>
    <div style="text-algin: center; font-size: 11px">
        Latest Update: <?php echo date('Y-m-d H:i:s');?>
        <br />
        <br />
    </div>
</center>
<center>
    <div style="text-algin: center; font-size: 11px"><span>Copyright © 2013 </span><a href="http://www.tcao.net/">唐朝码农</a> <span>All Rights Reserved.  Powered By <a href="http://codeigniter.org.cn/" target="_blank">Codeigniter</a>&nbsp;&nbsp;浙ICP备14043010号-1
</span></div>
</center>
</body>
</html>
