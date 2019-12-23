<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
    parent::__construct();
    $this->load->model('Event_model');
		$this->load->library('form_validation');
  }

	public function index()
	{
		$event=$this->Event_model->showUser();
		$data = array('title'=>'ARCTICS',
									'event' => $event,
								);
		$this->load->view('templates/user_header',$data);
		$this->load->view('user/show',$data);
		$this->load->view('templates/user_footer');
  }

	public function tambah()
  {
    $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
    $this->form_validation->set_rules('waktu', 'Waktu', 'required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
		$this->form_validation->set_rules('contact_person', 'Contact Person', 'required|trim|numeric|max_length[13]');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

    if ($this->form_validation->run()==false)
    {
			$data['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
      $data['title']='Tambah Event';
      $this->load->view('templates/user_header',$data);
      $this->load->view('user/tambah');
      $this->load->view('templates/user_footer');
    }
    else
    {
      $data = [
        'nama_event'      	=> htmlspecialchars($this->input->post('nama_event',true)),
        'waktu'    			 		=> htmlspecialchars($this->input->post('waktu',true)),
				'tempat'    			 	=> htmlspecialchars($this->input->post('tempat',true)),
				'deskripsi'    			=> htmlspecialchars($this->input->post('deskripsi',true)),
				'contact_person'		=> htmlspecialchars($this->input->post('contact_person',true)),
				'status'    			 	=> htmlspecialchars($this->input->post('status',true))
      ];
      $this->db->insert('tb_event',$data);
      $this->session->set_flashdata('suksestambah', '<div class="alert alert-success" role="alert">Event anda sedang dalam pengecekan oleh admin kami, silahkan menunggu beberapa saat</div>');
      redirect('user');
    }

  }

	public function member()
	{
		$data['title']='Member';
		$this->load->view('templates/user_header',$data);
		$this->load->view('admin/member');
		$this->load->view('templates/user_footer');
	}
}
