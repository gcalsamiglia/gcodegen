<?php
class document extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('document_model');
                
	}

/*	public function index()
	{
                //show_error("index()");

                log_message('debug', 'public function index()');
                //show_error('coucou');
		$data['news'] = $this->news_model->get_news();
                $data['title'] = 'News archive';
                //show_error('coucou');
                //show_error($data['news']);
                $this->load->view('templates/header', $data);
                $this->load->view('news/index', $data);
                $this->load->view('templates/footer');                
	}
  */      
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

			$data['title'] = 'Création d\'un nouveau docuement';

			$this->form_validation->set_rules('name',
											  'name',
											  'required', 
											  array('required'=>'The document name is required')
											  );

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('document/create');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->document_model->set_document();
				$this->load->view('document/success');
			}
		}
        
}


?>
