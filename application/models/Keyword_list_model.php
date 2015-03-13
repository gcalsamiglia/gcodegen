<?php
class Keyword_list_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
        //var_dump($this);
	}

	/*
	* Renvoi les couples (Keyword, Valeur) d'un document
	* sous forme d'un tableau associatif
	*/
	public function getCoupleByKeywordListId($doc_id){
		
        $query  = $this->db->query( 'SELECT keyword.kw_syntaxic_code, keyword.kw_translated_value
                            		FROM keyword
                            		INNER JOIN keyword_list ON keyword_list.kwl_keyword_id = keyword.kw_id
                            		WHERE keyword_list.kwl_document_id = '.$doc_id);
		foreach ($query->result() as $row)
		{
        	$result[$row->kw_syntaxic_code]=$row->kw_translated_value;
		}	
		return $result;
	}
}
?>