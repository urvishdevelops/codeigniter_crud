<?php
class AuthorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        $this->db->insert('authors', $data);

        if ($this->db->affected_rows() > 0) {
            echo "Inserted";
        } else {
            echo "Issue in db configration";
        }
    }

    public function update($data, $hidden_id)
    {
        $this->db->where('id', $hidden_id);
        $this->db->update('authors', $data);

        if ($this->db->affected_rows() > 0) {
            echo "Updated";
        } else {
            echo "Issue in db configration";
        }

    }

    public function listing($data)
    {
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

    public function delete($deleteId)
    {
        $this->db->where('id', $deleteId);

        $deleted = $this->db->delete('authors');


        if ($deleted) {
            echo "Deleted";
        } else {
            echo "Issue in query";
        }
    }
}
?>