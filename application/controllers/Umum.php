<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umum extends CI_Controller {

	public function sandbox(){
		echo base_url();
	}

	public function activate(){
		if($this->uri->segment(3)){
			$this->db->where('key',$this->uri->segment(3));
			$this->db->update('users', array('status'=>'activated'));
			// $query = $this->db->get('users');
			// $user = $query->row_array();
			toshout_success('Activation berjaya. Mohon login:');
			redirect('umum/login');
		}
	}

	public function register(){
		$inputs['username'] = array('type'=>'input', 'label'=>'Username', 'rules'=>'required');
		$inputs['password'] = array('type'=>'password', 'label'=>'Password', 'rules'=>'required');
		$inputs['email'] = array('type'=>'input', 'label'=>'Email', 'rules'=>'required');
		$inputs['hp'] = array('type'=>'input', 'label'=>'Mobile Phone', 'rules'=>'required');
		$inputs['height'] = array('type'=>'input', 'label'=>'Height (cm)', 'rules'=>'required');
		$inputs['gender'] = array('type'=>'input', 'label'=>'Gender', 'rules'=>'required', 'options'=>array('male'=>'Male', 'female'=>'Female'));

		$defaults = array();

		if(rbt_valid_post($inputs)){
			$_POST['password'] = hashim($this->input->post('password'));
			
			$_POST['created_at'] = date('Y-m-d H:i:s');
			$_POST['status'] = 'activated';

			$this->db->insert('users',$this->input->post());

			toshout_success('Your account has been created. <br/>Please <a href="'.site_url('login').'">login here &raquo;</a>');

			redirect('umum/register');
		}

		$data['inputs'] = $inputs;
		$data['defaults'] = $defaults;
		if(!$this->uri->segment(3)) $data['title'] = 'Register';
		else $data['title'] = 'Change Details';

		$this->load->view('umum_form', $data);
	}

	public function logout(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('group');

		redirect('login');
	}

	public function login()
	{	
		$inputs['username'] = array('type'=>'input', 'label'=>'Username', 'rules'=>'required');
		$inputs['password'] = array('type'=>'password', 'label'=>'Password', 'rules'=>'required');

		if(rbt_valid_post($inputs)){
			$this->load->model('users');
			$response = $this->users->login($this->input->post('username'), $this->input->post('password'));

			
			if($response['status']){
				toshout(array($response['message']=>'success'));
				redirect('dashboard/index');
			}else{
				toshout(array($response['message']=>'danger'));
			}

			// show_sess();
		}

		$data['inputs'] = $inputs;
		$this->load->view('umum_login', $data);
	}

}
