<?php
defined('BASEPATH') || exit('No direct script allowed');

class MY_Controller extends CI_controller
{
    public $title = '';
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    protected function template($data , $module = '')
    {
        $data['global_title'] =$this->title;
        $data['module'] = $module;
        if(strlen($module)>0) return $this->load->view($module.'/includes/layout'.$data);
        return $this->load->view('includes/layout',$data);
    }

}
?>
