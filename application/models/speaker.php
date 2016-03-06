<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speaker extends CI_Model {

	public function adduser($thedata)
	{
		$query = "INSERT INTO users (first_name, username, password, updated_on, created_on) VALUES (?, ?, ?, Now(), ?)";

		return $this->db->query($query, array($thedata['first_name'],$thedata['username'],$thedata['password'],$thedata['hiredate']));
	}

	public function verifyuser($post)
	{
		$query = "SELECT password FROM users WHERE username = ?";
		
		$infoverify = array($post['member_username']);

		$confirm = $this->db->query($query, $infoverify)->row_array();

		if($confirm['password'] == $post['member_password']){
			return true;
		} 
		else
		{
			return false;
		}
	}

	public function getid($username)
	{
		$query = "SELECT user_id FROM users WHERE username = ?";

		$idvalues = array($username);

		return $this->db->query($query, $idvalues)->row_array();
	}


	public function sayhello($id)
	{
		$query = "SELECT first_name, username FROM users WHERE user_id = ?";

		$sayinghi = array($id);

		return $this->db->query($query, $sayinghi)->row_array();
	}

	// ABOVE ----- LOGIN/REG //
	// BELOW ===== WISHLIST //

	public function additemwishlist($id){

		$userid = $this->session->userdata('id');
		$user = $userid['user_id'];
		
		$query = "INSERT INTO wishlists (user_id, item_id) VALUES ({$user}, {$id})";

		return $this->db->query($query);
	}

	public function removeitemwishlist($id){

		$userid = $this->session->userdata('id');
		$user = $userid['user_id'];

		$query = "DELETE FROM wishlists WHERE wishlists.user_id = {$user} AND wishlists.item_id = {$id}";

		return $this->db->query($query);
	}

	public function addnewitem($data){

		$userid = $this->session->userdata('id');
		$user = $userid['user_id'];
		$item = $data['item'];

		$query = "INSERT INTO items (name, added_by, added_on, updated_on) VALUES (?, {$user}, NOW(), NOW())";
		
		return $this->db->query($query,$item);

		// $query2 = "INSERT INTO wishlists (user_id, item_id) VALUES ({$user}, {$needid})";
		
		return $this->db->query($query2);
	}

	public function showitemdeets($id){
		$query2 = "SELECT items.name, users.username FROM items JOIN wishlists ON wishlists.item_id = items.id JOIN users ON users.user_id = wishlists.user_id WHERE items.id = {$id} GROUP BY username";

		return $this->db->query($query2)->result_array();
	}

	public function showuserwishes($id){
		
		$query = "SELECT items.name, users.username, items.added_on, items.id FROM items JOIN users ON users.user_id = items.added_by JOIN wishlists ON items.id = wishlists.item_id WHERE wishlists.user_id = ? GROUP BY items.id";

		$idnum = $id['user_id'];

		return $this->db->query($query, $idnum)->result_array();
	}

	public function showotherswishes($id){
		$query = "SELECT items.name, users.username, items.added_by, items.added_on, items.id FROM items JOIN users ON users.user_id = items.added_by JOIN wishlists ON wishlists.user_id = users.user_id WHERE users.user_id <> ? GROUP BY items.id";

		$idnum = $id['user_id'];

		return $this->db->query($query, $idnum)->result_array();
	}

	public function deleteitem($id){

		$userid = $this->session->userdata('id');
		$user = $userid['user_id'];

		$delete = "DELETE FROM wishlists WHERE item_id = {$id}";
		return $this->db->query($delete);

		$query = "DELETE FROM items WHERE id = {$id} AND added_by = {$user}";

		return $this->db->query($query);
	}
}