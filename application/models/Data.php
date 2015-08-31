<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data extends CI_Model {

	public function get_monthly(){
		$user = $this->session->userdata('user');
		$this->db->where('user_id', $user['id']);

		$this->db->order_by('datetime', 'DESC');
		$query = $this->db->get('data');

		return $query->result_array();
	}

}