<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 15-4-23
 * Time: 下午4:55
 */
class Comment extends MY_Controller{

    public function post(){
        $comment = $this->input->post('Comment');
        if(!empty($comment)){
            if(!empty($comment['comment_post_id'])){
                $post = $this->article_home->getById(($comment['comment_post_id']));
                if($post == false){
                    set_message('comment_error','童鞋，哪儿找的破鞋+_+','error');
                    redirect('/');
                }else{
                    //如果评论不存在secure字段
                    if(empty($comment['comment_secure'])){
                        set_message('comment_error','童鞋，评论提交的姿势不对吧x_x','error');
                        redirect(article_url($comment['comment_post_id']));
                    }

                    if(preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/',$comment['email']) == false){
                        set_message('comment_error','童鞋，邮箱格式不对是不会通过滴x_x','error');
                        redirect(article_url($comment['comment_post_id']));
                    }

                    if(trim($comment['comment_secure']) != md5($post->a_id.$post->title.$post->post_time)){
                        set_message('comment_error','童鞋，据说逼格不够高的评论是不能提交的-_-','error');
                        redirect(article_url($comment['comment_post_id']));
                    }
					if(strpos($comment['comment'],'@') == true || strpos($comment['comment'],'http') == true || strpos($comment['comment'],'www') == true || strpos($comment['comment'],'com') == true || strlen($comment['comment']) < 10){
						set_message('comment_error','这位童鞋，也许您的逼格不太高啊！','error');
						redirect(article_url($comment['comment_post_id']));
					}

                    $data = array(
                        'article_id'=> (int)$comment['comment_post_id'],
                        'name' => addslashes(trim($comment['author'])),
                        'email' => addslashes(trim($comment['email'])),
                        'site_url' => addslashes(trim($comment['url'])),
                        'comment' => addslashes(trim($comment['comment'])),
                        'send_mail'=> isset($comment['comment_mail_notify']) ? 1 : 0,
                    );
                    if(isset($comment['comment_reply'])){
                        $data['reply_id'] = (int)$comment['comment_reply'];
                    }else{
                        $data['reply_id'] = 0;
                    }
                    $result = $this->comment_home->save($data);
                    if($result == true){
                        $this->article_home->update($post->a_id,array('comment_count'=>$post->comment_count+1));
                        $this->subscribe_home->save(addslashes(trim($comment['email'])),$data['reply_id']);
                        set_message('comment_success','童鞋，稍后您的评论才会显示，耐心ing *_*','success');
                        redirect(article_url($comment['comment_post_id']));
                    }
                }
            }

        }
    }
}
