<?php
class source_code_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
        //var_dump($this);
	}

    public function get_source_code_list()
    {
        $this->db->select('sc_id');   
        $this->db->select('sc_name');   
        $query = $this->db->get('source_code');
        return $query->result_array();
    }
}
?>
