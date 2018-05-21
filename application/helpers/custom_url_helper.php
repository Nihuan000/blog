<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-19
 * Time: 下午2:07
 */

    //生成分类url地址
    function category_url($cataid){
        $url = '';
        $CI =& get_instance();
        $category = $CI->category_home->findByPk($cataid);
        if(!empty($category)){
            if($category->pid == 0 || $category->pid == -1){
                $url .= site_url('catalog/' . $category->url_name . '/');
            }else{
                $root_cate = $CI->category_home->findByPk($category->pid);
                $url .= rtrim(site_url('catalog/' . $root_cate->url_name . '/' . $category->url_name),'/') . '/';
            }
        }

        return $url;
    }

    //生成文章的url地址
    function article_url($art_id){
        $url = '';
        $url .= site_url('article/' . $art_id . '.html');
        return $url;
    }

    //生成tag页面的url地址
    function tag_url($tag,$tag_en){
        $url = '';
        if(!empty($tag_en)){
            $url = 'tag/'.$tag_en . '/';
        }
        if(empty($tag_en) && !empty($tag)){
            $url = 'tag/' . $tag . '/';
        }
        $tag_url = rtrim(site_url($url),'/');
        return $tag_url;
    }

    //生成评论的url地址
    function comment_url(){

    }

    //其他页面的地址
    function page_url(){

    }
