<?php
class document extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('document_model');
		$this->load->model('source_code_model');
                
	}     
	public function view($doc_id)
	{
            $doc_id = (string) $doc_id;    
      		$data['document'] = $this->document_model->get_document($doc_id);
                if (empty($data['document']))
                {
                        show_404();
                }
                
                $data['title']    = $data['document']['doc_name'];
                $data['doc_name'] = $data['document']['doc_name'];

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


		if ($this->form_validation->run() === FALSE)
		{
			$data['source_code_list'] = $this->source_code_model->get_source_code_list();	

			$this->load->view('templates/header', $data);
			$this->load->view('document/create',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			if (!$this->document_model->set_document()){
				$this->load->view('templates/header', $data);
				$this->load->view('document/create');
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
}


?>
