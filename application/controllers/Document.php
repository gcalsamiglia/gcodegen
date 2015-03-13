<?php
class Document extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('document_model');
		$this->load->model('source_code_model');
		$this->load->model('keyword_list_model'); 
	}  
	public function index(){
		echo "test";
	}  
	/*
	*  Find the keywords in the naked source code  	
	*/
	public function get_source_code_keywords_json($sc_id){

		// recup du source code brut
        $data['result'] = $this->source_code_model->get_source_code_naked($sc_id);
        // split en fonction du séparateur
        $splitted_source = preg_split("/@sc@/", $data['result'] );	
        $keywords = array();
        // On en saute 1 sur 2
		for ($i = 1; $i < count($splitted_source) ; $i=$i+2) {
		    $keywords[] = $splitted_source[$i];
		}
		$data['json_encoded_keywords'] = json_encode($keywords);
        $this->load->view('document/getsourcecodekw', $data);
    }

	public function view($doc_id)
	{
			// recup du document (row)
            $doc_id = (string) $doc_id;    
      		$data['document'] = $this->document_model->get_document($doc_id);
            if (empty($data['document']))
            {
                    show_404();
            }
            $data['title']    = $data['document']['doc_name'];
            $data['doc_name'] = $data['document']['doc_name'];

			$data['the_graal'] = $this->document_model->translate($doc_id);

            // Chargement de la vue	
            $this->load->view('templates/header', $data);
            $this->load->view('document', $data);
            $this->load->view('templates/footer');                
    }

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Création d\'un nouveau document';

		$this->form_validation->set_rules('name',
										  'name',
										  'required', 
										  array('required'=>'The document name is required')
										  );

		$this->form_validation->set_rules('sc_id',
										  'Source code selection',
										  'required');

		/*$this->form_validation->set_rules('keyword[]', 
										  'Keyword', 
										  'required');*/
		$posts = $this->input->post(NULL,TRUE);
		foreach ($posts as $key => $value) {
			if (substr($key,0,strlen($this->config->item('keyword_input_prefix'))) === $this->config->item('keyword_input_prefix')){
				$data['keywords_input'][$key] = $value;
				$this->form_validation->set_rules($key, 
										  $key, 
										  'required');
			}	
		}

		if ($this->form_validation->run() === FALSE)
		{
			$data['source_code_list'] = $this->source_code_model->get_source_code_list();

			
			$data['selected_sc_value']= $this->input->post('sc_id');

			$this->load->view('templates/header', $data);
			$this->load->view('document/create',$data);
			$this->load->view('templates/footer');
		}else{
			$data['source_code_list'] = $this->source_code_model->get_source_code_list();		

			if (!$this->document_model->set_document()){
				$this->load->view('templates/header', $data);
				$this->load->view('document/create', $data);
				$this->load->view('templates/footer');			
			}else{
				$data['doc_name'] 	= $this->document_model->input->post('name') ;
				$data['title'] 		= 'Document created';

				$this->load->view('templates/header', $data);
				$this->load->view('document/success', $data);
				$this->load->view('templates/footer');	
			}
		}
	}   

	public function listAllDocuments()
	{
		$data['title'] = 'Liste des documents disponibles';
		$data['doc_array'] = $this->document_model->get_document_list();
		$this->load->view('templates/header', $data);
		$this->load->view('document/list', $data);
		$this->load->view('templates/footer');	
	} 
}
?>