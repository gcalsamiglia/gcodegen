<?php
class document_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
        //var_dump($this);
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
        /*
        public function set_news()
        {
                $this->load->helper('url');
                $slug = url_title($this->input->post('title'), 'dash', TRUE);
                $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text')
                );

                return $this->db->insert('news', $data);
        }*/
}
?>
