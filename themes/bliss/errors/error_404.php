<?php load_page('pages/top');?>
<div id="main" class="container">
<div id="primary" class="row">
<div id="content" class="offset1 span10" role="main">
<style type="text/css">
.error{ 
	background: none repeat scroll 0 0 #fff;
	color: #333;
	font-family: "微软雅黑";
	font-size: 16px;
    min-height:470px;
    width: 970px;
    padding: 100px 48px;
    text-align: center;
 }
 .face {
    font-size: 90px;
    font-weight: normal;
    line-height: 120px;
    margin-bottom: 12px;
}
.redirect-content {
	color: #999;
}
#redirect-seconds{
    padding: 0 5px;
}
</style>
<div class="error">
<p class="face">~Duang!~</p>
<p class="redirect-content">看！灰机，灰过去了～，又灰过来了。。。<em id="redirect-seconds">5</em>秒跳转首页，So Easy~</p>
<div class="content">
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    jQuery(function () {
        var time = 6;
        setInterval(function() {
            time--;
            if (time == 0) {
                location.href = "<?php echo site_url()?>";
            }
            jQuery('#redirect-seconds').text(time);
        }, 1000);
    });
</script>
<?php load_page('pages/footer');?>
