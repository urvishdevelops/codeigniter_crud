<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function index()
	{
		$this->load->view('welcome_message');
		$this->load->model('AuthorModel');
	}

	public function insert()
	{
		$this->load->model('AuthorModel');
		// created config
		$config = [
			'upload_path' => './uploads/',
			'allowed_types' => 'jpg|jpeg|png'
		];

		// used library function 
		$this->load->library('upload', $config);



		if (!$this->upload->do_upload('image')) {

			isset($_FILES['image']);
		} else {
			$uploaddata = $this->upload->data();
			$filename = $uploaddata['file_name'];

			
			$data = array(
				'name' => $this->input->post('name'),
				'book' => $this->input->post('book'),
				'email' => $this->input->post('email'),
				'image' => $filename
			);

			$hidden_id = $this->input->post('hidden_id');


			if (!$hidden_id) {
				$this->AuthorModel->insert($data);
			} else {
				$this->AuthorModel->update($data, $hidden_id);
			}
		}




	}

	public function listing()
	{
		$this->load->model('AuthorModel');

		$modelData = $this->db->query('SELECT * FROM authors');
		$data = $modelData->result_array();

		$this->AuthorModel->listing($data);
	}

	public function edit()
	{
		$data = $this->input->post();

		$editId = $data['editId'];

		$modelData = $this->db->query("SELECT * FROM authors where id='$editId';");
		$data = $modelData->result_array();

		echo json_encode($data);
	}
	public function delete()
	{
		$this->load->model('AuthorModel');

		$data = $this->input->post();

		$deleteId = $data['deleteId'];

		$this->AuthorModel->delete($deleteId);

	}
}
