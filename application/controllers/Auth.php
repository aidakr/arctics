<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

	public function index()
	{
    $this->form_validation->set_rules('password', 'Password1', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

    if ($this->form_validation->run()==false)
    {
      $data['title']='LOGIN';
      $this->load->view('templates/auth_header',$data);
  		$this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else
    {
      $this->_login();
    }
  }


  private function _login()
  {
      $email    = $this->input->post('email');
      $password = $this->input->post('password');
      $admin     = $this->db->get_where('tb_admin',['email' => $email])->row_array();

      if ($admin){
        if(password_verify($password, $admin['password']))
        {
          $data = [
            'email' => $admin['email'],
            'name'  => $admin['name']
          ];
          $this->session->set_userdata($data);
          redirect('admin');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
          redirect('auth');
        }
      }else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email isnt registered!</div>');
        redirect('auth');
      }
  }

  public function registration()
  {
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('password1', 'Password1', 'required|trim|max_length[12]');
    $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_admin.email]',
                                      ['is_unique'=> 'this email has been taken']);
    if ($this->form_validation->run()==false)
    {
      $data['title']='REGISTRATION';
      $this->load->view('templates/auth_header',$data);
      $this->load->view('auth/registration');
      $this->load->view('templates/auth_footer');
    }
    else
    {
      $data = [
        'name'      => htmlspecialchars($this->input->post('name',true)),
        'email'     => htmlspecialchars($this->input->post('email',true)),
        'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
      ];

      $this->db->insert('tb_admin',$data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully create an account!</div>');
      redirect('auth');
    }

  }

  public function logout(){
    $this->session->unset_userdata('email');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successfully logged out!</div>');
    redirect('auth');
  }

}
