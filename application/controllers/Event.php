<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Event_model');
	}
	public function index()
	{
    $data['title']='Events';
    $data['event']= $this->Event_model->getAllEvent();
    $this->load->view('templates/admin_header',$data);
    $this->load->view('user/index',$data);
    $this->load->view('templates/admin_footer');
  }
}
