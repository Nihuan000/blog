<?php load_page('pages/top'); ?>
<div id="main" class="container">
<div id="primary" class="row">
<div id="content" class="margin span8" role="main">
<?php
    if(isset($article) && !empty($article)){
        foreach($article as $key => $value){
?>
<article id="post-<?php echo $value->a_id;?>"
         class="post-<?php echo $value->a_id;?> post type-post status-publish format-standard hentry category-front-end-development tag-61">
    <div class="post-title box">
        <h1 class="entry-title">
            <?php echo _link($value->url,$value->title);?>
        </h1>

        <div class="post-meta">﻿
            <ul>
                <li>
                    <time class="entry-date" datetime="<?php echo date('Y-m-d H:i:s');?>"><?php echo date(setting('date_format'),$value->post_time);?></time>
                </li>
                <li class="divider">/</li>
                <li>
                    <?php echo _link($value->cate_url,$value->cate_name,'title="查看所有文章在 ' . $value->cate_name . '"');?>
                </li>
                <li class="divider">/</li>
                <li>
                    <?php echo _link($value->url . '#comments',$value->comment_count . '条评论')?>
                </li>
                <li class="divider">/</li>
                <li>浏览:<?php echo $value->view_count;?></li>
            </ul>
        </div>

        <div class="post-format-badge post-format-standard">
            <i class="icon-calendar-3"></i>
        </div>
    </div>


    <div class="entry-container noimg">
        <div class="entry-content">
           <?php echo _wordCut(stripslashes($value->content),200,$value->url);?>
            <footer class="entry-meta clearfix">
              <ul></ul>
            </footer>
            <!-- .entry-meta -->
        </div>
        <!-- .entry-content -->
    </div>
    <!-- .entry-container -->
</article>
<?php
        }
   }
?>
<!-- #post-1170 -->
    <?php
    if(isset($site_pagination)){
        echo $site_pagination;
    }
    ?>
</div>
<!-- #content -->


<?php load_page('pages/sidebar');?>
</div>
<!-- #primary -->
</div><!-- #main .site-main -->
<?php load_page('pages/footer'); ?>
