<?php
class keyword_list_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
        //var_dump($this);
	}

	/*
	* Renvoi les couples Keyword, Valeur d'un keyWordList
	*/
	public getCoupleByKeywordListId($kwl_id){
		$query = $this->db->get_where('keyword_list', array('kwl_id' => (string)$kwl_id));

		// A finir et tester
		return 
	}
?>