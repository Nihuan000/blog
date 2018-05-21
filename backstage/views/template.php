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
                <li class="active">主题</li>
            </ul>
            <!--.breadcrumb-->
        </div>
    <div class="page-content">
        <div class="page-header position-relative">
            <h1>主题</h1>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <ul class="ace-thumbnails">
                    <li>
                        <a href="#" title="TYStudio　主题" data-rel="colorbox">
                            <img width="350" src="<?php echo '../themes/TYStudio/screenshot.png'?>" />
                        </a>

                        <div class="tools">
                            <a href="#">
                                <i class="icon-link"></i>
                            </a>

                            <a href="#">
                                <i class="icon-paper-clip"></i>
                            </a>

                            <a href="#">
                                <i class="icon-pencil"></i>
                            </a>

                            <a href="#">
                                <i class="icon-remove red"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
<?php load_page('pages/footer');?>