<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 上午11:00
 */
class Template extends ADMIN_Controller{

    public function index(){

        $this->load->view('template');
    }
}