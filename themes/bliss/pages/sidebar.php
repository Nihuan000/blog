<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-20
 * Time: 上午11:13
 */
?>
<aside id="side-bar" class="span4">

    <div id="bl_author-2" class="box bl_author"><h3 class="widget-head">此民工</h3>

        <img src="<?php load_img('images/user.jpg');?>">

        <div class="widget-body">
            <div class="bl_author_img"><img src="<?php echo _user('photo');?>"></div>
            <div class="bl_author_bio"><h3><?php echo _user('name');?></h3>

                <p class="muted"><?php echo _user('maxim');?></p>

                <div style="height:40px; width:175px;margin:0 auto;">
                    <ul id="social-list">
                        <li>
                            <?php echo _link(_user('sina'),'<span class="sprite-round-icon-sina">新浪微博</span>','target="_blank"');?>
                        </li>
                        <li>
                            <?php echo _link(_user('txweibo'),'<span class="sprite-round-icon-qq">腾讯微博</span>','target="_blank"');?>
                        </li>
                        <li>
                            <?php echo _link('javascript:;','<span class="sprite-round-icon-weixin">微信</span>','target="_blank"');?>
                        </li>
                    </ul>
                </div>
                <p></p></div>
        </div>
    </div>

    <div id="bl_html-4" class="box box bl_html"><h3 class="widget-head">推荐网站</h3>

          <div class="widget-body">
              <a href="https://bandwagonhost.com/aff.php?aff=14708" target="_blank">搬瓦工-BandwagonHost</a>
              <br />
              <a href="http://s.click.taobao.com/t?e=m%3D2%26s%3DPnul%2Be6Kxx8cQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClAv6BRGSKl24qFZXPm4I7DbGDNWmBIOl%2BCEL8owkDFYQ6onWfH3UbtVq9xO70tJJ1Mqb6h%2BauVgdyCEDNGBpwx5jlSg55GVX5wbSqdkxH6LRFnaYpFBIfC%2F2orLd93QuCUMYOae24fhW0" target="_blank">
                  聚划算，巨划算！
              </a>
          </div>

      </div>

    <div id="bl_newsletter-2" class="box bl_newsletter">
        <h3 class="widget-head">订阅到邮箱</h3>

        <div class="widget-body">

            <p>输入邮箱订阅唐朝码农的精彩内容</p>
            <div class="input-append">
                <input class="bl_newsletter_email" placeholder="邮件地址" type="text">
                <button class="btn bluth green btn-primary" type="button">订阅</button>
            </div>

        </div>

        <script type="text/javascript">

            window.locale = {
                "no_email_provided": '未提供Email',
                "thank_you_for_subscribing": '感谢您的订阅，一封确认订阅邮件已发送到您的邮箱'
            };

        </script>

    </div>
    <div id="views-2" class="box widget_views"><h3 class="widget-head">热门文章</h3>
        <ul>
	    <?php foreach(_hot() as $hot_art){?>
	    <li>
		<?php echo _link($hot_art->url,$hot_art->title,'title="{$hot_art->title}"');?>
	    </li>
	    <?php }?>
                    </ul>
    </div>
    <div id="tag_cloud-2" class="box widget_tag_cloud"><h3 class="widget-head">标签</h3>

        <div class="tagcloud">
            <?php $tags = _right_Tag();
                if(!empty($tags)){
                    foreach($tags as $key => $value){
                        echo _link(tag_url($value->tag,$value->en_tag),$value->tag,'class="tag-link-' . $value->t_id . '" title="' .  $value->tag. '"');
                    }
                }
            ?>
            </div>
    </div>
    <div id="recent-posts-4" class="box widget_recent_entries"><h3 class="widget-head">最新文章</h3>
        <ul>
            <?php foreach(_new() as $k => $v){?>
            <li>
                <?php echo _link($v->url,$v->title);?>
            </li>
            <?php }?>
        </ul>
    </div>
</aside>
