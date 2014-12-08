<?php
class document_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
        
    public function get_document($doc_id = FALSE)
    {
        if ($doc_id === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }
        $query = $this->db->get_where('document', array('doc_id' => (string)$doc_id)); 
        
        //show_error($query);
        return $query->row_array();
    }

    public function get_source_code_keywords_xml($sc_id){
        
    }

    // --------------------------------------------------------------------------------------------------
    /**
     * Returns document existance by document name
     *
     * @param   string  $name           document name Configuration file name
     * @return  bool    TRUE if the document exists or FALSE otherwise
     */
    public function document_exists_by_name($name)
    {
        $query = $this->db->get_where('document', array('doc_name' => (string)$name)); 
        return ($query->num_rows() > 0); 
    }

    public function get_keywords($doc_id){

    }
    // --------------------------------------------------------------------------------------------------
    /**
     * Add a document row according to the post datas ($this->input->post)
     *
     * @return  bool|insert result     FALSE if document already exists
     */
    public function set_document()
    {       
            $data = array(
                    'doc_name'  => $this->input->post('name'),
                    'doc_sc_id' => $this->input->post('sc_id'),
            );
            if ($this->document_exists_by_name($data['doc_name']))
            {
                return FALSE;
            }
            else
            {
                return $this->db->insert('document', $data);
            }
    }
}
?>
