<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-6
 * Time: 下午3:47
 */
class Users_model extends ADMIN_Model{

    protected $_table = 'users';

    public function __construct(){
        parent::__construct();
    }

    public function update($uid,$data = array()){
        return $this->db->update($this->_table,$data,array('u_id' => (int)$uid));
    }

    public function get_by_pk($uid){
        return $this->db->get_where($this->_table,array('u_id'=>(int)$uid))->row();
    }
}