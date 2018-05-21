<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends ADMIN_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index($url='http://www.zhonghuawuxia.com/author/40',$main_url='http://www.zhonghuawuxia.com')
    {
        phpQuery::newDocumentFile($url);
        $data = array();
        $content = pq('.wrap .personal_wrap .personal_main .main_tab_wrap .mybook_list');
        if(!empty($content)){
            $list = pq($content)->find('dl.bestbook_list dd');
            if(!empty($list)){
                foreach($list as $key =>$value){
                    $book_title = pq($value)->find('.bestbook_info h4')->text();
                    $book_title = str_replace('《秦时明月之','',$book_title);
                    $data[$key]['cate_name'] = str_replace('》','',$book_title);
                    $book_url = pq($value)->find('.bestbook_info input.online_read')->attr('onclick');
                    $book_url = str_replace('window.open(\'','',$book_url);
                    $book_url = str_replace('\')','',$book_url);
                    $data[$key]['full_book_url'] = $main_url . $book_url;
                }
            }
        }
        foreach($data as $k => $v){
            $url = $v['full_book_url'];
            //$data[$k]['url_name'] = Pinyin($v['cate_name']);
            $data[$k]['meta_keyword'] = '秦时明月,温世仁,秦时明月之荆轲外传,秦时明月之' . $v['cate_name'] . '全文阅读,秦时明月之' . $v['cate_name'] . '在线阅读';
            $data[$k]['meta_desc'] = '秦时明月之荆轲外传是温世仁先生写作的一本非常经典的传统武侠武侠小说,本站提供全文在线阅读。';
            $data[$k]['pid'] = 9;
            $data[$k]['updated'] = time();
            unset($data[$k]['full_book_url']);
            $save_cate = $this->db->insert('columns',$data[$k]);
            if($save_cate){
                $cate_id = $this->db->insert_id();
                $this->_get_info_by_url($url,$cate_id);
            }
        }
        phpQuery::unloadDocuments();
    }

    public function _get_info_by_url($url,$cate_id){
        $url = str_replace('bookinfo','book',$url);
        $art_list = array();
        phpQuery::newDocumentFile($url);
        $main = pq('.wrap .indexbox .index_area ul.block_ul')->find('li');
        if(!empty($main)){
            foreach($main as $k => $v){
                $article = pq($v)->find('a.green');
                if(!empty($article)){
                    $art_list[$k]['url'] = pq($article)->attr('href');
                }
            }
        }
        foreach($art_list as $ak => $av){
            $this->_get_content_by_url($av['url'],$cate_id);
        }
        phpQuery::unloadDocuments();
    }

    public function _get_content_by_url($url,$cate){
        $data = array();
        phpQuery::newDocumentFile($url);
        $content = pq('.wrapbig #chaptercontainer .textbox');
        if(!empty($content)){
            if(!empty($cate)){
                $category = $this->columns_model->find_by_pk($cate);
            }
            $data['title'] = pq($content)->find('h1.story_title')->text();
            $data['c_id'] = $cate;
            $data['content'] = pq($content)->find('div.txtwrap .bookreadercontent')->html();
            $new_str = strpos($data['content'],'</div>');
            if(!empty($new_str)){
                $data['content'] = trim(substr($data['content'],$new_str+strlen('</div>')));
            }
            $data['view_count'] = 0;
            $data['comment_count'] = 0;
            $data['meta_keyword'] = '秦时明月,温世仁,秦时明月之' . $category->cate_name . ',' . $data['title'];
            $data['meta_desc'] = '《秦时明月之' . $category->cate_name . '》是温世仁先生写的一部传统武侠武侠小说，本页为您提供秦时明月之'  .  $category->cate_name.'章节---' .$data['title'];
            $data['post_time'] = time();
            $save_post = $this->db->insert('article',$data);
            if($save_post){
                echo $data['title'] . "保存完毕\n";
            }
        }
        phpQuery::unloadDocuments();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */