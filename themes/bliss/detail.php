<?php
        load_page('pages/top');
        $message = '';
        $statu = '';
        if(get_home_message('comment_error')){
            $message = get_home_message('comment_error');
            $statu = 'not';
        }else if(get_home_message('comment_success')){
            $message = get_home_message('comment_success');
            $statu = 'ok';
        }
?>
	<div id="main" class="container">
	<div id="primary" class="row">
		<div id="content" class="span10 offset1" role="main">
		<article id="post-<?php echo $article->a_id;?>" class="post-<?php echo $article->a_id;?> post type-post status-publish format-standard hentry category-front-end-development category-color-knowledge">

	<div class="post-title box">

	<h1 class="entry-title"><?php echo _link(article_url($article->a_id),$article->title);?></h1>
		<div class="post-meta">
			﻿
<ul>
<li><time class="entry-date" datetime="<?php echo date('Y-m-d H:i:s',$article->post_time);?>"><?php echo date('Y年m月d日',$article->post_time);?></time></li>

	<li class="divider">/</li>

	<li><?php echo _article_cat($article->c_id);?> </li>
	<li class="divider">/</li>

	<li><?php echo _link(article_url($article->a_id) . '#comments',$article->comment_count . '条评论');?></li>

	<li class="divider">/</li>

	<li>浏览:<?php echo _view_count($article->a_id);?></li>

</ul>
</div>
<div class="post-format-badge post-format-standard">
<i class=""></i>
</div>
</div>
<div class="entry-container noimg">

		<div class="entry-content">
			<?php echo stripslashes($article->content);?>
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->

</article><!-- #post-1086 -->
	<div class="single-pagination clearfix">

		<div class="box clearfix">
			<?php
                $empty_link = _link('javascript:;','','class="nav-previous"');
				echo (isset($prev_post) && !empty($prev_post)) ? _other_link($prev_post,'left') : $empty_link;
				echo (isset($next_post) && !empty($next_post)) ? _other_link($next_post,'right') : $empty_link;
			?>
		</div>

	</div>


	<div id="related-posts" class="row-fluid box">

		<h3>你可能也喜欢</h3>
		<?php 
			if(isset($other_post) && !empty($other_post)){
				foreach($other_post as $k => $v){
					echo _other_link($v);
				}	
			}
		?>
	</div>﻿
		<div id="comments" class="comments-area">
			<h3 class="comments-title">
				<?php echo $post_comment_count;?>  评论
			</h3>
            <?php if(!empty($post_comment)){?>
			<ol class="commentlist">
                <?php foreach($post_comment as $ck=>$cv){?>
					<li class="comment even thread-even depth-1" id="li-comment-2449">
                    <article id="<?php echo 'comment-' . $cv['id'];?>" class="comment">
                        <div>
                            <div class="comment-author">
                                <?php
                                    $author = (isset($cv['site_url']) && !empty($cv['site_url'])) ? _link($cv['site_url'],$cv['name'],'rel="external nofollow" class="url"') : $cv['name'];
                                    $string = '上午';
                                    if(date('H',$cv['time']) > 12){
                                        $hour = '下午' . date('H',$cv['time']) - 12;
                                        $date = date('Y年m月d日 ' . $hour . ':i',$cv['time']);
                                    }else{
                                        $date = date('Y年m月d日 ' . $string . 'H:i',$cv['time']);
                                    }
                                    $date = date('Y年m月d日 ' . $string . 'H:i',$cv['time']);
                                ?>
                                <cite class="commenter"><?php echo $author;?></cite>
                                <small class="muted">&nbsp;&nbsp;•&nbsp;&nbsp;<time title="<?php echo $date;?>" class="timeago"><?php echo $date;?></time></small>
                            </div><!-- .comment-author .vcard -->
                                                </div>

                        <div class="comment-content">
                            <p><?php echo $cv['comment'];?></p>
                        </div>

                        <div class="reply">
                        	<?php
							echo _link(article_url($article->a_id) . '#respond','回复','class="comment-reply-link" onclick=\'return addComment("'. $cv['article_id'] .'", "respond", "' . $cv['id'] . '")\'');
						?>	                		          
                        </div><!-- .reply -->
                    </article><!-- #comment-## -->
            <?php if(isset($cv['reply'])){?>
			<ul class="children">
                <?php foreach($cv['reply'] as $rk => $rv){?>
			<li class="comment byuser comment-author-cgtianyi bypostauthor odd alt depth-2" id="<?php echo 'li-comment-' . $rv['id'];?>">
				<article id="<?php echo 'comment' . $rv['id'];?>" class="comment">
					<div>
						<div class="comment-author">
                            <?php
                            $author = (isset($rv['site_url']) && !empty($rv['site_url'])) ? _link($rv['site_url'],$rv['name'],'rel="external nofollow" class="url"') : $rv['name'];
                            $string = '上午';
                            if(date('H',$rv['time']) > 12){
                                $hour = '下午' . date('H',$rv['time']) - 12;
                                $date = date('Y年m月d日 ' . $hour . ':i',$rv['time']);
                            }else{
                                $date = date('Y年m月d日 ' . $string . 'H:i',$rv['time']);
                            }
                            $date = date('Y年m月d日 ' . $string . 'H:i',$rv['time']);
                            ?>
							<cite class="commenter"><?php echo $author;?></cite>
                            <small class="muted">&nbsp;&nbsp;•&nbsp;&nbsp;
                                <time title="<?php echo $date;?>" class="timeago">
                                    <?php echo $date;?>
                                </time>
                            </small>
<!--							&nbsp;&nbsp;<span class="label label-success">作者</span>-->
						</div><!-- .comment-author .vcard -->
					</div>

					<div class="comment-content"><p><?php echo $rv['comment'];?></p>
</div>

					<div class="reply">
						<?php
							echo _link(article_url($article->a_id) . '#respond','回复','class="comment-reply-link" onclick=\'return addComment("'. $rv['article_id'] .'", "respond", "' . $rv['reply_id'] . '")\'');
						?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->
			</li><!-- #comment-## -->
                <?php }?>
            </ul><!-- .children -->
          <?php }?>
                </li>
                <?php }?>
                <!-- #comment-## -->

			</ol><!-- .commentlist -->
            <?php }?>
        <div id="respond" class="comment-respond">
            <h3 id="reply-title" class="comment-reply-title">
                发表评论
                <small>
                    <?php echo _link(article_url($article->a_id) . '#respond','取消回复','rel="nofollow" id="cancel-comment-reply-link" style="display:none;"');?>
                </small>
            </h3>
            <?php
                $secure = md5($article->a_id.$article->title.$article->post_time);
                echo form_open('comment/post',array('class'=>'comment-form','id'=>'commentform'));
                echo form_hidden('Comment[comment_secure]',$secure);
                echo form_hidden('Comment[comment_post_id]',$article->a_id);
            ?>
            <p class="comment-notes">电子邮件地址不会被公开。 必填项已用<span class="required">*</span>标注</p>
            <p class="comment-form-author">
                <?php echo form_label('姓名 <span class="required">*</span>','author');?>
                <?php echo form_input(array('name'=>'Comment[author]','id'=>'author','size'=>'30','aria-required'=>'true'));?>
            </p>
            <p class="comment-form-email">
                <?php echo form_label('电子邮件 <span class="required">*</span>','email');?>
                <?php echo form_input(array('name'=>'Comment[email]','id'=>'email','size'=>'30','aria-required'=>'true'));?>
            </p>
            <p class="comment-form-url">
                <?php echo form_label('站点','url');?>
                <?php echo form_input(array('name'=>'Comment[url]','id'=>'url','size'=>'30'));?>
            </p>
            <p class="comment-form-comment">
                <?php echo form_label('评论','comment');?>
                <?php echo form_textarea(array('name'=>'Comment[comment]','id'=>'comment','cols'=>'45','rows'=>'8','aria-required'=>'true'));?>
            </p>
    <!--        <p class="form-allowed-tags">您可以使用这些<abbr title="HyperText Markup Language">HTML</abbr>标签和属性： <code>&lt;a-->
    <!--href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt;-->
    <!--&lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt;-->
    <!--                <br />-->
    <!--                &lt;code&gt; &lt;del-->
    <!--datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; -->
    <!--&lt;strong&gt; </code>-->
    <!--        </p>-->
            <p class="form-submit">
                <?php echo form_submit(array('name'=>'Comment[submit]','id'=>'submit','value'=>'发表评论'));?>
            </p>
            <p>
                <?php echo form_checkbox(array('name'=>'Comment[comment_mail_notify]','id'=>'comment_mail_notify','value' => "1",'checked'=>'checked','style'=>'width: auto;'));?>
                <?php echo form_label('有人回复时邮件通知我','comment_mail_notify');?>
            </p>
    <?php echo form_close();?>

        </div><!-- #respond -->
    </div><!-- #comments .comments-area -->
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	</div><!-- #main .site-main -->
<script type="text/javascript">
    function addComment(id,type,reply){
        if(type == 'respond'){
            jQuery('.comment-respond h3 small').find('a').show();
            jQuery('#commentform').find('.form-submit').append('<input type="hidden" id="comment_post_id" value="'+id+'" name="Comment[comment_post_id]"><input name="Comment[comment_reply]" id="comment_reply" value="'+reply+'" type="hidden">');
            jQuery('#cancel-comment-reply-link').click(function(){
                jQuery(this).hide();
                jQuery('#commentform').find('.form-submit').html('<input name="Comment[submit]" id="submit" value="发表评论" type="submit">');
            });
        }
    }

    jQuery(function(){
        var obj = "<?php echo $statu;?>";
        var message = "<?php echo $message;?>";
        if(message != '' && obj != ''){
            if('ok' != obj){
                jQuery('body').prepend('<div class="bl_alert"><h4 style="text-align:center"><i class="icon-cancel-circle"></i>&nbsp;'+message+'</h4></div>');
                jQuery('.bl_alert').slideDown().delay(3000).slideUp();
            }else if(obj == 'ok'){
                jQuery('body').prepend('<div class="bl_alert"><h4 style="text-align:center"><i class="icon-ok-circle"></i>&nbsp;'+message+'</h4></div>');
                jQuery('.bl_alert').slideDown().delay(3000).slideUp();
            }
        }
    });
</script>
<?php load_page('pages/footer');?>
