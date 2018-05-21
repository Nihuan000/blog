<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @parmar css加载类
 * format : load_css(array(css1,css2,css3));
 */

function get_config_val(){
	$Config =& get_config();
	$path = str_replace('./','',APPPATH);
	if(@realpath(THEMEPATH)){
		$theme_path = isset($Config['theme']) ? THEMEPATH . $Config['theme'] . '/' : '';
	}else{
		$theme_path = $path . 'views/';
	}
	return $theme_path;
}


function load_css($file,$type = ''){
	$theme = get_config_val();
	$css = '';
	if(is_array($file)){
		foreach($file as $key => $value){
			if(file_exists($theme . $value)){
				$url =site_url($theme . $value);
				$css .= '<link rel="stylesheet" media="'. $type .'" type="text/css" href="' . $url . '" />';
				$css .= "\n";
			}
		}
	}else{
		$css .= '<link rel="stylesheet" type="text/css" href="' . $file . '" />';
	}
	echo $css;
}

/**
 * @parmar js加载类
 * js1 : /path/of/js
 * format : load_js(array(js1,js2,js3));
 */
function load_js($file = array()){
	$theme = get_config_val();
	$js = '';
	if(is_array($file)){
		foreach($file as $key => $value){
			if(file_exists($theme . $value)){
				$url =site_url($theme . $value);
				$js .= '<script type="text/javascript" src="' . $url . '"></script>';
				$js .= "\n";
			}
		}
	}
	echo $js;
}

/**
 * @parmar image加载类
 * format : load_css(array(css1,css2,css3));
 */
function load_img($filename){
	$theme = get_config_val();
	echo site_url($theme . $filename);
}

/**
 * $parma 页面加载类
 */
function load_page($page){
	$_ci_ext = pathinfo($page, PATHINFO_EXTENSION);
	$page = ($_ci_ext == '') ? $page.'.php' : $page;
	$theme = get_config_val();
	require($theme . $page);
}

/**
 * $parmar 验证码加载类
 */
function load_captcha($type){
	$controller = 'site';
	switch($type){
	case 1:
		$controller = 'site';
		break;
	case 2:
		$controller = 'main';
		break;
	}
	$url  = site_url($controller . '/captcha');
	return "<img src=\"" . $url . "\" id=\"vaptcha\" alt=\"captcha\" onclick=\"this.src='" . $url . "?'+Math.random()\">";
}

//$name : 信息标题，$content：内容,$style：样式(根据信息级别不同分为：error,success,info)
function set_message($name,$content,$style='info'){
	$CI =& get_instance();
	$data = array();
	if(!empty($name) && !empty($content)){
		$data['content'] = $content;
		if(!empty($style)){
			$data['style'] = $style;
		}
		$CI->session->set_flashdata($name,$data);
	}
}

//获取信息,$name :设置的信息标题
function get_message($name){
	$CI =& get_instance();
	$messages = ''; 
	if(!empty($name)){
		$info = $CI->session->flashdata($name);
		if(!empty($info)){
			$messages = '<p class="' . $info['style'] . '">' . $info['content'] . '</p>';
		}
	}
	echo $messages;
}

function get_home_message($name){
    $CI =& get_instance();
    if(!empty($name)){
        $info = $CI->session->flashdata($name);
        return $info['content'];
    }
}
//获取分类列表 $columns = array();
function get_columns($show_sec = false){
	$columns = array();
	$CI =& get_instance();
	if($show_sec == false){
		$columns = array(0 => '请选择分类');
	}
	$columns_arr = $CI->db->from('columns')->where('pid',0)->get()->result();
	if(!empty($columns_arr)){
		foreach($columns_arr as $key => $value){
			if($show_sec == true){
				$columns[$value->c_id]['cate_name'] = $value->cate_name;
				$columns[$value->c_id]['url'] = $value->url_name;
				$columns[$value->c_id]['is_cate'] = true;
				$sec_columns = $CI->db->from('columns')->where('pid',$value->c_id)->get()->result();
				if(!empty($sec_columns)){
					foreach($sec_columns as $skey => $sval){
						$columns[$value->c_id]['sec_column'][$sval->c_id]['cate_name'] = $sval->cate_name;
						$columns[$value->c_id]['sec_column'][$sval->c_id]['url'] = $sval->url_name;
						$columns[$value->c_id]['sec_column'][$sval->c_id]['is_cate'] = true;
					}
				}
			}else{
				$columns[$value->c_id] = $value->cate_name;
			}
		}
	}
	return $columns;
}

//获取文章的tag标签 article_id:文章id
function get_articte_tag($article_id){
	$CI =& get_instance();
	$tags = array();
	if(!empty($article_id)){
		$tags = $CI->db->select('tag')
			->from('tag')
			->join('article_tag','article_tag.tag_id = tag.t_id','left')
			->where('article_tag.article_id',(int)$article_id)
			->get()
			->result();
	}
	return $tags;
}

//数组转字符串
function array_to_string($data = array()){
	$string = '';
	if(is_array($data) && !empty($data)){
		foreach($data as $key => $value){
			$string .= $value->tag . ',';
		}
		$string = substr($string,0,strlen($string) - 1);
	}
	return $string;
}

//获取博客地址
function get_url(){
	$CI =& get_instance();
	$setting = $CI->db->get_where('setting',array('key'=>'site_url'))->row();
	if(!empty($setting)){
		$setting->value = rtrim($setting->value,'/') . '/';
		return $setting->value;
	}
}

/**
 * @param int $id
 * @param string $type
 * @param string $tag //当type 为tag时，tag不为空
 *  先根据文章或分类的id获取title/keyword/description
 * 如果id为空，则根据type获取该类型默认值
 * 如果id=null && type=null 则获取默认首页的title/keyword/description
 * return array(title,keyword,description)
 */
function set_metaSeo($id = 0,$type = '',$tag=NULL){
	$setting_arr = array();
	$metaSeo = array();
	$CI =& get_instance();
	$setting = $CI->db->get_where('setting',array('isshow'=>1))->result_array();
	if(!empty($setting)){
		foreach($setting as $key => $value){
			$setting_arr[$value['key']] = $value['value'];
		}
	}
	if($type == 'article' && $id != 0){
		$article = $CI->db->get_where('article',array('a_id'=>$id))->row();
		if(!empty($article)){
			$metaSeo['title'] = $article->title . ' - ' . $setting_arr['site_name'];
			$metaSeo['keywords'] = $article->meta_keyword;
			$metaSeo['description'] = $article->meta_desc;
		}
	}

	if($type == 'category' && $id != 0){
		$category = $CI->db->get_where('columns',array('c_id'=>$id))->row();
		if(!empty($category)){
			$metaSeo['title'] = $category->cate_name . ' - ' . $setting_arr['site_name'];
			$metaSeo['keywords'] = $category->meta_keyword;
			$metaSeo['description'] = $category->meta_desc;
		}
	}
	if($type == 'tag' && !empty($tag)){
		$tag = $CI->db->get_where('tag',array('en_tag'=>$tag))->row();
		if(!empty($tag)){
			$metaSeo['title'] = $tag->tag . ' - ' . $setting_arr['site_name'];
			$metaSeo['keywords'] = str_replace(array('{site_name}','{second_name}'),array($setting_arr['site_name'],$setting_arr['second_name']),$setting_arr['index_meta_keyword']);
			$metaSeo['description'] = str_replace(array('{site_name}','{second_name}'),array($setting_arr['site_name'],$setting_arr['second_name']),$setting_arr['index_meta_desc']);
		}
	}
	if($type)
	//获取首页的tkd
	if($id == 0 && (empty($type) || $type == 'index')){
		$metaSeo['title'] = str_replace(array('{site_name}','{second_name}'),array($setting_arr['site_name'],$setting_arr['second_name']),$setting_arr['index_meta_title']);
		$metaSeo['keywords'] = str_replace(array('{site_name}','{second_name}'),array($setting_arr['site_name'],$setting_arr['second_name']),$setting_arr['index_meta_keyword']);
		$metaSeo['description'] = str_replace(array('{site_name}','{second_name}'),array($setting_arr['site_name'],$setting_arr['second_name']),$setting_arr['index_meta_desc']);
	}
	if(!empty($metaSeo)){
		$GLOBALS['title'] = $metaSeo['title'];
		$GLOBALS['keywords'] = $metaSeo['keywords'];
		$GLOBALS['description'] = $metaSeo['description'];
	}
	return $GLOBALS;
}

/**
 * return $setting[$key]
 * $key 要获取的设置信息
 */
function setting($key){
	//根据名称获取设置信息
	$CI =& get_instance();
	$setting = $CI->db->select('value')
		->from('setting')
		->where('key',$key)
		->get()
		->row();
	if(!empty($setting)){
		return $setting->value;
	}
}

/**
*
*生成访问数
*/
function _view_count($post_id){
	$CI =& get_instance();
	$post = $CI->article_home->getById($post_id);
	if(get_cookie('viewCount' . $post_id) === false){
		$count = $view_count = $post->view_count+1;
		$CI->article_home->update($post_id,array('view_count'=>$count));
		set_cookie('viewCount' . $post_id,$view_count,3600);
	}else{
		$count = get_cookie('viewCount' . $post_id);
	}
	return $count;
}

/**
 * return $string
 * 生成html中的a链接元素
 */
function _link($href,$name,$style=''){
	return '<a href="' . $href . '" ' . $style . '>' . $name . '</a>';
}
/**
 * return site-logo加载信息
 * site_logo logo加载
 * site_url 网址加载
 */
function site_logo(){
	echo '<a class="brand brand-image" href="' . setting('site_url') . '" title="' . setting('site_name') . '" rel="home"><img src="' . setting('site_logo') . '" alt="' . setting('site_name') . '"><h1><small>' . setting('second_name') . '</small></h1></a>';
}
/**
 *      * 获取前台导航列表
 *           */
function load_column(){
	$top_menu = '<ul id="menu-top" class="nav">';
	$top_menu .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home" id="menu-item-0">' . _link(setting('site_url'),'首页') . '</li>';
	$columns = get_columns(true);
	if(!empty($columns)){
		sort($columns);
		foreach($columns as $key => $value){
			$url_link = rtrim(site_url('catalog/' . $value['url']),'/') . '/';
			$link_url = _link($url_link,$value['cate_name']);
			if($value['is_cate'] == true){
				$style_class = 'menu-item menu-item-type-taxonomy menu-item-object-category';
				if(!empty($value['sec_column'])){
					$style_class .= ' menu-item-has-children dropdown';
					$link_url = _link($url_link,$value['cate_name'] . '<i class="icon-angle-down"></i>','class="dropdown-toggle" data-toggle="dropdown"');
				}
			}else{
				$style_class = 'menu-item menu-item-type-custom menu-item-object-custom';
				if($key == 0){
					$style_class .= ' menu-item-home';
				}
			}

			$top_menu .= '<li id="menu-item-' . $key . '" class="' . $style_class . '">'  .  $link_url;
			if(!empty($value['sec_column'])){
				$top_menu .= '';
				$top_menu .= '<ul class="dropdown-menu">';
				foreach($value['sec_column'] as $skey => $sval){
					$sub_link_url = rtrim(site_url($url_link . $sval['url']),'/') . '/';
					$top_menu .= '<li id="menu-item-' . $skey . '" class="menu-item menu-item-type-taxonomy menu-item-object-category">' . _link($sub_link_url,$sval['cate_name']) . '</li>';
				}
				$top_menu .= '</ul>';
			}
			$top_menu .= '</li>';
		}
	}
	$top_menu .= '</ul>';
	return $top_menu;
}

/**
 * 字符截取
 * $string:要截取的内容
 * $length:截取的字数
 */
function _wordCut($string,$length,$url = ''){
	$content = '';
	$more_text = '继续阅读…';
	$more_link = _link($url,$more_text,'class="more-link"');
	if(strpos($string,'<hr>')){
		//+4是加上匹配的标签长度
		$text_string = substr($string,0,strpos($string,'<hr>')+4);
		$content .= str_replace('<hr>', $more_link, $text_string);
	}else{
		$string = trim(strip_tags($string,'<p><img><blockquote>'));
		$tmp_string = substr($string, 0,$length);
		$more_length = strpos($string,'/>');
		//$more_length+2是加上匹配的两个字符
		if($more_length){
            $content = substr($string, 0,$more_length+2);
        }else{
         $content = join("",array_slice(preg_split("//u", strip_tags($string,'<p><img><blockquote>'), -1, PREG_SPLIT_NO_EMPTY), 0, $length));
        }
		$content .= $more_link;
	}
	return $content;
}

/**
 * 获取用户信息
 */
function _user($key){
	$CI =& get_instance();
	$user = $CI->db->select($key)
		->from('users')
		->get()
		->row();
	if(!empty($user)){
		return $user->$key;
	}
}

/**
 *获取热门文章
 *return array()
 */
function _hot(){
	$CI =& get_instance();
	$article = $CI->article_home->get_all(10,0,false,'','','view_count DESC');
	return $article;
}

/**
 * 获取右侧标签列表
 */
function _right_Tag(){
	$CI =& get_instance();
	$tags = $CI->tag_home->get_by_match();
	return $tags;
}

/**
 * 获取最新文章
 */
function _new(){
	$CI =& get_instance();
	$article = $CI->article_home->get_all(5,0,false,'','','post_time DESC');
	return $article;
}

/**
 *获取文章分类
 */
function _article_cat($cate_id){
	$CI =& get_instance();
	$cateDiv = '';
	$category = $CI->category_home->findByPk($cate_id);
	if(!empty($category)){
		if($category->pid == 0 || $category->pid == -1){
			$cateDiv = _link(site_url('catalog/' . $category->url_name . '/'),$category->cate_name,'title="查看所有文章在 ' . $category->cate_name . '"');
		}else{
			$root_cate = $CI->category_home->findByPk($category->pid);
			$cateDiv = _link(site_url('catalog/' . $root_cate->url_name . '/'),$root_cate->cate_name,'title="查看所有文章在 ' . $root_cate->cate_name . '"');
			$cateDiv .= '&nbsp;&nbsp;' ._link(site_url('catalog/' . $root_cate->url_name . '/' . $category->url_name . '/'),$category->cate_name,'title="查看所有文章在 "' . $category->cate_name . '"');

		}
	}
	return $cateDiv;
}

/**
 * 其他文章的链接
 * $style :标题前的符号
 */
function _other_link($data,$is_other = ''){
	$style = '';
	$string = '';
	$img = '';
	$more = 'class="more-link"';
	if(!empty($data->content)){
		$tmp_img = '';
		$preview_content = strstr(stripslashes($data->content),$more,true);
		if($preview_content == true){
			$tmp_img = preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $preview_content,$picture);
		}else{
			$tmp_img = preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', stripslashes($data->content),$picture);
		}
		if(isset($picture) && count($picture) > 1){
			$img = "background-image: url('" .  $picture[1] . "');";
		}

	}
	$style = 'class="nav-previous"';
	if(isset($is_other)){
		if($is_other == 'left'){
            $string = '<h5><i class="icon-angle-double-left"></i>' . $data->title . '</h5>';
            $biaoshi = '';
		}else if($is_other == 'right'){
            $string = '<h5 id="blog-right-h5"><i class="icon-angle-double-right blog-right"></i>' . $data->title . '</h5>';
            $biaoshi = 'blog-right';
		}
	}
	$title = '<div class="bgfallback ' . $biaoshi . '">&nbsp;</div>
						<span class="' . $biaoshi . '">&nbsp;</span>
						<div class="tab_icon tab_standard ' . $biaoshi . '"><i class="icon-calendar-3"></i></div>
						<div class="bgimage '. $biaoshi .'" style="' . $img . '"></div>' . $string;
	return _link($data->url, $title,$style);
}

/**
 * 获取推荐站点
 */
function _feature_link(){
	$CI =& get_instance();
	$link = $CI->link_home->get_all();
	return $link;
}

/**
 *  * 不要使用CI自带的show_404(),否则不能加载公益广告
 *   */
function blog_show_404() {
	redirect('site/_show_404');
}

