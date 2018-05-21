<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-20
 * Time: 下午3:57
 */
class Subscribe_home extends MY_Model{

    private $_table = 'subscribe';
    public function __construct(){
        parent::__construct();
    }

    public function save($email,$incoming = 1){
	$check_email = $this->get_subscribe($email);
        if(empty($check_email)){
            $data = array(
                'email'=>$email,
                'incoming'=>$incoming
            );
            return $this->db->insert($this->_table,$data);
        }
    }

    public function get_subscribe($email){
        return $this->db->get_where($this->_table,array('email'=>$email))->row();
    }
}
