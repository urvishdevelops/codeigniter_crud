<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); // Load the database library
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function insert()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'book' => $this->input->post('book'),
			'email' => $this->input->post('email'),
		);

		$this->db->insert('authors', $data);

		if ($this->db->affected_rows() > 0) {
			echo "Inserted";
		} else {
			echo "Issue in db configration";
		}
	}
	public function listing()
	{

		$modelData = $this->db->query('SELECT * FROM authors');
		$data = $modelData->result_array();

		$tbody = [];


		foreach ($data as $value) {

			$tbody[] = [
				'id' => $value['id'],
				'name' => $value['name'],
				'book' => $value['book'],
				'email' => $value['email'],
				'action' => '<button id="' . $value['id'] . '" class="btn btn-warning edit">Edit</button> | <button id="' . $value['id'] . '" class="btn btn-danger delete">Delete</button>',
			];
		}

		$output = ['data' => $tbody];
		echo json_encode($output);

	}
	public function delete()
	{
		$deleteId = $this->post('deleteId');

		echo '<pre>';
		print_r($deleteId);
		die;

		// $this->db->where('id', $id);
		// $this->db->delete('user');

		// echo json_encode($output);

	}
}

