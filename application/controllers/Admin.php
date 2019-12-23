<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
    parent::__construct();
    $this->load->model('Event_model');
		$this->load->library('form_validation');
  }

	public function index()
	{
		$admin = $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
		$event=$this->Event_model->show();
		$data = array('title'=>'Dahboard',
									'event' => $event,
									'admin' => $admin
								);

    $this->load->view('templates/admin_header',$data);
    $this->load->view('admin/show',$data);
    $this->load->view('templates/admin_footer');
  }

	public function gantistatus(){
		$admin = $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
		$event=$this->Event_model->show();
		$data = array('title'=>'Ganti status event',
									'event' => $event,
									'admin' => $admin
								);

    $this->load->view('templates/admin_header',$data);
    $this->load->view('admin/gantistatus',$data);
    $this->load->view('templates/admin_footer');
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
      $this->load->view('templates/admin_header',$data);
      $this->load->view('admin/tambah');
      $this->load->view('templates/admin_footer');
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
      $this->session->set_flashdata('suksestambah', '<div class="alert alert-success" role="alert">Berhasil menambah data!</div>');
      redirect('admin');
    }

  }


  public function delete($id_event){
    $event= $this->Event_model->detail($id_event);
    // hapus Gambar
    // if ($event->poster !=""){
    //   unlink('./assets/upload/'.$event->poster);
    //   unlink('./assets/upload/thumbs/'.$event->poster);
    // }
    // end hapus
    $data = array('id_event'=>$id_event);
    $this->Event_model->delete($data);
    $this->session->set_flashdata('sukseshapus', '<div class="alert alert-danger" role="alert">Event telah dihapus!</div>');
    redirect (base_url('admin'));
  }


  public function edit($id_event){
		$dataa['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
		$event	= $this->Event_model->detail($id_event);
		$data 	= array('title'=>'Edit event',
									'event' => $event,
									// 'admin' => $admin
								);

    $valid = $this->form_validation;
		$this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
		$this->form_validation->set_rules('waktu', 'Waktu', 'required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
		$this->form_validation->set_rules('contact_person', 'Contact Person', 'required|trim|numeric|max_length[13]');
		$this->form_validation->set_rules('status', 'Status', 'required|trim');

    if($valid->run()===FALSE){
      $data = array('title'     =>'Edit event',
                    'event'    	=> $event
										);
			$this->load->view('templates/admin_header',$dataa);
			$this->load->view('admin/edit',$data);
			$this->load->view('templates/admin_footer');

      // Masuk database
      		}else{
						$dataa['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
						$data = array (
							'id_event' 					=> $id_event,
							'nama_event'      	=> htmlspecialchars($this->input->post('nama_event',true)),
							'waktu'    			 		=> htmlspecialchars($this->input->post('waktu',true)),
							'tempat'    			 	=> htmlspecialchars($this->input->post('tempat',true)),
							'deskripsi'    			=> htmlspecialchars($this->input->post('deskripsi',true)),
							'contact_person'		=> htmlspecialchars($this->input->post('contact_person',true)),
							'status'    			 	=> htmlspecialchars($this->input->post('status',true))
			      );
						$this->load->view('templates/admin_header',$dataa);
						$this->load->view('admin/editstatus',$data);
						$this->load->view('templates/admin_footer');

      			$this->Event_model->edit($data);
      			$this->session->set_flashdata('suksesedit', '<div class="alert alert-warning" role="alert">Event berhasil diubah!</div>');
      			redirect(base_url('admin'));
      		}
        }


				public function editstatus($id_event){
					$dataa['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
					$event	= $this->Event_model->detail($id_event);
					$data 	= array('title'=>'Edit event',
												'event' => $event,
												// 'admin' => $admin
											);

					$valid = $this->form_validation;

					$this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
					$this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
					$this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
					$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
					$this->form_validation->set_rules('contact_person', 'Contact Person', 'required|trim|numeric|max_length[13]');
					$this->form_validation->set_rules('status', 'Status', 'required|trim');

					if($valid->run()===FALSE){
						$data = array('title'     =>'Edit event',
													// 'admin' 		=> $admin,
													'event'    	=> $event
													);
						$this->load->view('templates/admin_header',$dataa);
						$this->load->view('admin/editstatus',$data);
						$this->load->view('templates/admin_footer');

						// Masuk database
								}else{
									$dataa['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
									$data = array (
										'id_event' 					=> $id_event,
										'nama_event'      	=> $this->input->post('nama_event'),
										'waktu'    			 		=> $this->input->post('waktu'),
										'tempat'    			 	=> $this->input->post('tempat'),
										'deskripsi'    			=> $this->input->post('deskripsi'),
										'contact_person'		=> $this->input->post('contact_person'),
										'status'    			 	=> $this->input->post('status')
									);
									$this->load->view('templates/admin_header',$dataa);
									$this->load->view('admin/editstatus',$data);
									$this->load->view('templates/admin_footer');

									$this->Event_model->edit($data);
									$this->session->set_flashdata('suksesstatus', '<div class="alert alert-warning" role="alert">Status event berhasil diganti!</div>');
									redirect(base_url('admin/gantistatus'));
								}
			}

			public function member()
			{
				$data['admin']= $this->db->get_where('tb_admin',['email' => $this->session->userdata('email')])->row_array();
				$data['title']='Member';
				$this->load->view('templates/admin_header',$data);
				$this->load->view('admin/member');
				$this->load->view('templates/admin_footer');
			}
}
