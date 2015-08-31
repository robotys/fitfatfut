<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		verify_access();
	}

	public function index(){
		$this->load->view('dashboard_index');
	}

	public function sandbox(){
		
	}

	public function report(){
		$data['rows'] = array();
		$data['title'] = 'Report: COMING SOON';

		$this->load->view('dashboard_list', $data);
	}

	public function setting(){

		$user = $this->session->userdata('user');

		$inputs['username'] = array('type'=>'input', 'label'=>'Username', 'rules'=>'required');
		$inputs['password'] = array('type'=>'password', 'label'=>'Password', 'rules'=>'required');
		$inputs['email'] = array('type'=>'input', 'label'=>'Email', 'rules'=>'required');
		$inputs['hp'] = array('type'=>'input', 'label'=>'Mobile Phone', 'rules'=>'required');
		$inputs['height'] = array('type'=>'input', 'label'=>'Height (cm)', 'rules'=>'required');
		$inputs['gender'] = array('type'=>'dropdown', 'label'=>'Gender', 'rules'=>'required', 'options'=>array('male'=>'Male', 'female'=>'Female'));

		$defaults = array();

		if(rbt_valid_post($inputs)){
			$_POST['password'] = hashim($this->input->post('password'));
			
			// $_POST['created_at'] = date('Y-m-d H:i:s');
			// $_POST['status'] = 'activated';

			$this->db->where('id', $user['id']);
			$this->db->update('users', $this->input->post());

			// $this->db->insert('users',$this->input->post());

			toshout_success('Your settings has been changed.');
		}

		$this->db->where('id', $user['id']);
		$query = $this->db->get('users');

		$defaults = $query->row_array();
		$defaults['password'] = robot($defaults['password']);
		$data['inputs'] = $inputs;
		$data['defaults'] = $defaults;
		$data['title'] = 'Change Details';

		$this->load->view('dashboard_form', $data);
	}

	public function data(){
		$this->load->model('Data');

		$datas = $this->Data->get_monthly();

		foreach($datas as $i=>$dat){
			$arr['#'] = $i+1;
			$arr['date'] = date('d/m', strtotime($dat['datetime']));
			$arr['weight'] = $dat['weight'];
			$arr['fat'] = $dat['fat'];
			// $arr['water'] = $dat['water'];
			$arr['muscle'] = $dat['muscle'];
			// $arr['bone'] = $dat['bone'];
			$arr['waist'] = $dat['waist'];
			$arr['kcal'] = $dat['kcal'];

			$rows[] = $arr;
		}

		$data['rows'] = $rows;
		$data['title'] = 'All Data <a href="'.site_url('dashboard/new_data').'" class="btn btn-sm btn-primary pull-right">create new</a>';

		$this->load->view('dashboard_list', $data);
	}

	public function new_data(){
		$inputs['datetime'] = array('type'=>'input', 'label'=>'Date & Time (Y-m-d H:m:s)', 'rules'=>'required');
		$inputs['weight'] = array('type'=>'input', 'label'=>'Weight (kg)', 'rules'=>'required|decimal');
		$inputs['fat'] = array('type'=>'input', 'label'=>'Fat (%)', 'rules'=>'required|decimal');
		$inputs['water'] = array('type'=>'input', 'label'=>'Water (%)', 'rules'=>'required|decimal');
		$inputs['muscle'] = array('type'=>'input', 'label'=>'Muscle (%)', 'rules'=>'required|decimal');
		$inputs['bone'] = array('type'=>'input', 'label'=>'Bone (%)', 'rules'=>'required|decimal');
		$inputs['kcal'] = array('type'=>'input', 'label'=>'KCal (kcal)', 'rules'=>'required|integer');
		$inputs['waist'] = array('type'=>'input', 'label'=>'Waist (cm)', 'rules'=>'required|integer');

		$defaults = array('datetime'=>date('Y-m-d H:i:s'));

		if(rbt_valid_post($inputs)){
			$user = $this->session->userdata('user');
			$_POST['user_id'] = $user['id'];
			// dumper($this->input->post());
			$this->db->insert('data', $this->input->post());
			toshout(array('Your data has been saved'=>'success'));

			redirect('dashboard/data');
		}

		$data['inputs'] = $inputs;
		$data['title'] = 'New Data';
		$data['defaults'] = $defaults;
		$this->load->view('dashboard_form', $data);
	}

}