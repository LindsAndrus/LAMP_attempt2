<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Director extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('speaker');
		$this->load->library("form_validation");
	}

	public function index()
	{
		if(!$this->session->userdata("id"))
		{
			$this->load->view('view', array("errors" => $this->session->flashdata("errors")));
		} 
		else
		{
			$user = $this->speaker->sayhello($this->session->userdata("id"));
			
			$wishlist = $this->speaker->showuserwishes($this->session->userdata("id"));
			
			$otherswishes = $this->speaker->showotherswishes($this->session->userdata("id"));

			$this->load->view("welcome_user", array("user" => $user, "items" => $wishlist, "wishes" => $otherswishes));
		}
	}

	public function login(){
		$this->form_validation->set_rules("member_username","Username", "trim|required|min_length[3]");
		$this->form_validation->set_rules("member_password","Password", "trim|required");
		if($this->form_validation->run(s)===FALSE)
		{
			$this->session->set_flashdata("errors", validation_errors());
			redirect('/');
		} 
		else
		{
			$result = $this->speaker->verifyuser($this->input->post());
			
			if ($result) 
			{
				$id = $this->speaker->getid($this->input->post("member_username"));
				
				$this->session->set_userdata("id",$id);
				$this->session->set_userdata("member_username",$username);
				redirect('/');
			}
			else
				{
					$this->session->set_flashdata("errors", "<p>Password does not match. DO OVER!</p>");
					redirect('/');
				}
		}
	}

	public function registration(){
		$this->form_validation->set_rules("first_name","First Name", "trim|required|min_length[3]");
		$this->form_validation->set_rules("username","Username", "trim|required|min_length[3]");
		$this->form_validation->set_rules("password","Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm","Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("hiredate","Hire Date", "required");
		
		if($this->form_validation->run()===FALSE)
		{
			$this->session->set_flashdata("errors", validation_errors());

			redirect('/');
		}
		else
		{
			$this->speaker->adduser($this->input->post());

			$id = $this->speaker->getid($this->input->post("username"));
			$this->session->userdata("id", $id);
			$this->load->view("welcome_user");			
		}
	}

	public function destroy(){
		$this->session->sess_destroy();
		redirect('/');
	}
}