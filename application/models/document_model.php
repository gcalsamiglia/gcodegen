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
        return $query->row_array();
    }

    // --------------------------------------------------------------------------------------------------
    /**
     * Returns a list containing available documents
     *
     * @return  array   documents
     */    
    public function get_document_list()
    {
        $query = $this->db->get('document');
        return $query->result_array();
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


    /**
    *
    *   renvoi le document $doc_id traduit vaec ses keywords
    *
    *
    *
    */
    public function translate($texteBrut, $keywords, $doc_id){
        // recup du source code brut
        //$texteBrut = $this->source_code_model->get_source_code_naked($data['document']['doc_sc_id']); 

        //
        //$keywords = $this->keyword_list_model->getCoupleByKeywordListId($data['document']['doc_id']);
        foreach ($keywords as $syntaxicCode => $translatedValue) {
            str_replace("@@".$syntaxicCode."@@", $translatedValue, $texteBrut);
        }        
        return $texteBrut;
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


            //$keywords = $this->input->post('keyword[]');
            $form_datas = $this->input->post(NULL,TRUE);
            foreach ($form_datas as $key => $value) {
                if (substr($key,0,strlen($this->config->item('keyword_input_prefix'))) === $this->config->item('keyword_input_prefix')){
                    $key_new = substr($key, strlen($this->config->item('keyword_input_prefix')));
                    $keywords_input[$key_new] = $value;
                }   
            }    

            if ($this->document_exists_by_name($data['doc_name']))
            {
                return FALSE;
            }
            else
            {
                $insert_result = $this->db->insert('document', $data);
                if ($insert_result){
                    $inserted_doc = $this->db->insert_id();
                    // insertion de chaque keyword saisi
                    foreach ($keywords_input as $key => $value) {
                        $data = array(
                                        'kw_syntaxic_code'    => $key,
                                        'kw_translated_value' => $value,
                                       );
                        $insert_keyword_result = $this->db->insert('keyword', $data);
                        if ($insert_keyword_result){
                            $inserted_keyword = $this->db->insert_id();
                            $data = array(
                                            'kwl_document_id' => $inserted_doc,
                                            'kwl_keyword_id'  => $inserted_keyword,
                                          );
                            $insert_keyword_list_result = $this->db->insert('keyword_list', $data);
                            if (!$insert_keyword_list_result){
                                return $insert_keyword_list_result;
                            }     
                        }
                        else{
                            return $insert_keyword_result;
                        }
                    } 
                    return $insert_result;
                }
            }
    }
}
?>
