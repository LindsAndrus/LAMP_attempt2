<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
	}

	public function add_item(){

		$this->load->view('createitem', array("errors" => $this->session->flashdata("errors")));
	}
	
	public function new_item(){

		$this->form_validation->set_rules("item","Item", "trim|required|min_length[3]");
		if($this->form_validation->run()===FALSE)
		{
			$this->session->set_flashdata("errors", validation_errors());

			redirect('add_item');
		}
		else {
			$this->load->model('speaker');
			$this->speaker->addnewitem($this->input->post());

			redirect ('/');
		}
	}

	public function remove_item($id){
		$this->load->model('speaker');
		$this->speaker->deleteitem($id);

		redirect('/');
	}

	public function deletefromwishlist($id){

		$this->load->model('speaker');
		$this->speaker->removeitemwishlist($id);

		redirect('/');
	}

	public function item_view($id){
		$this->load->model('speaker');
		$item_info = $this->speaker->showitemdeets($id);

		$this->load->view('itemview',array('data' => $item_info));
	}

	public function addtowishlist($id){

		$this->load->model('speaker');
		$this->speaker->additemwishlist($id);

		redirect('/');
	}
}