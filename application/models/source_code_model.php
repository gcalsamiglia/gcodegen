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

    /*
    *    Renvoi le code source complet sans traduction des keywords
    *
    */

    public function get_source_code_naked($sc_id){
        $result = ' ';
        $query = $this->db->query('SELECT source_code.sc_value
                                    FROM source_code_list
                                    INNER JOIN source_code ON source_code_list.scl_sc_id_ext = source_code.sc_id
                                    WHERE source_code_list.scl_sc_id = '.$sc_id);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {

                $result = $result.$row->sc_value;
            }
        }
        return $result;
    }
}
?>
