<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

  public function add($data){
    $this->db->insert('tb_event',$data);
  }

  public function edit($data){
    $this->db->where('id_event',$data['id_event']);
    $this->db->update('tb_event',$data);
  }

  public function delete($data){
    $this->db->where('id_event',$data['id_event']);
    $this->db->delete('tb_event',$data);
  }

  public function detail($id_event){
    $query=$this->db->get_where('tb_event',array('id_event' => $id_event));
    return $query->row();
  }

  public function show(){
    $query=$this->db->get('tb_event');
    return $query->result();
  }

  public function showUser(){
    $this->db->select('*');
    $this->db->from('tb_event');
    $this->db->where('status', "upcoming");
    $this->db->or_where('status', "end");

    $query = $this->db->get();
    return $query->result();
  }


}
