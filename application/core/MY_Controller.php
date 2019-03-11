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
    protected function  POST($name)
{
    return $this->input->post($name);
}
    protected function GET($name, $clean = false)
{
    return $this->input->get($name, $clean);
}
    protected function METHOD()
{
    return $this->input->method();
}
    protected function flashmsg($msg, $type = 'success', $name='msg')
{
    return $this->session->set_flashdata($name, '<div class="alert font-weight-normal alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
}
    protected function upload($id, $directory, $tag_name = 'userfile', $max_size = 0)
{
    if(isset($_FILES[$tag_name]) && !empty($_FILES[$tag_name]['name']))
    {
        $upload_path = realpath(APPPATH . '../assets/img/' . $directory . '/');
        @unlink($upload_path . '/' . $id . '.jpg');
        $config = array(
            'file_name' 		=> $id . '.jpg',
            'allowed_types'		=> 'jpg|png|bmp|jpeg|',
            'upload_path'		=> $upload_path,
            'max_size'          => $max_size
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        return $this->upload->do_upload($tag_name);
    }
}
protected function uploadFile($name, $directory, $tag_name = 'userfile')
{
    if($_FILES[$tag_name])
    {
        $upload_path = realpath(APPPATH . '../assets/file/' . $directory . '/');
        @unlink($upload_path . '/' . $name);
        $config = array(
            'file_name' 		=> $name ,
            'allowed_types'		=> '*',
            'upload_path'		=> $upload_path,
            'max_size'          => $max_size
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        return $this->upload->do_upload($tag_name);
        $eks = explodes(".",$_FILES[$tag_name]['name']);
        return $name."".$eks[1];
    }
    return "false";
}
public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
?>
