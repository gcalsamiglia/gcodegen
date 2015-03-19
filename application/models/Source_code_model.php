<?php
class Source_code_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
        //var_dump($this);
	}

    public function get_source_code_list()
    {
        $this->db->select('sc_id');   
        $this->db->select('sc_name');   
        $query = $this->db->get('ce_code');
        return $query->result_array();
    }

    public function get_activated_source_code_list()
    {
        $this->db->select('sc_id');   
        $this->db->select('sc_name');   
        $query = $this->db->get_where('source_code', array('sc_active' => 1));
        return $query->result_array();
    }

    public function get_source_code($sc_id = FALSE)
    {
        if ($sc_id === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }
        $query = $this->db->get_where('source_code', array('sc_id' => (string)$sc_id)); 
        return $query->row_array();
    }

    /*
    *    Renvoi le code source complet sans traduction des keywords
    *
    */
    public function get_source_code_naked($sc_id){
        $result = ' ';
        $query = $this->db->query('SELECT source_code.sc_value, source_code_list.scl_sc_id_ext
                                    FROM source_code_list
                                    INNER JOIN source_code ON source_code_list.scl_sc_id_ext = source_code.sc_id
                                    WHERE source_code_list.scl_sc_id = '.$sc_id);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                // appel récursif
                $result = $result.$this->get_source_code_naked($row->scl_sc_id_ext);
            }
        }
        else{
            $query = $this->db->query('SELECT source_code.sc_value
                                        FROM source_code
                                        WHERE source_code.sc_id = '.$sc_id);
            if ($query->num_rows() > 0){
                // bout de la récursivité
                $result = $result.$query->result()[0]->sc_value;               
            }else{
                //rien
            }
        }
        return $result;
    }
}
?>
