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
        /*        
        public function create()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');

                $data['title'] = 'Create a news item';

                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('text', 'text', 'required');

                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('news/create');
                        $this->load->view('templates/footer');

                }
                else
                {
                        $this->news_model->set_news();
                        //$data['newItem'] = set_value('title');
                        $data['newItem'] = "greg";
                        $this->load->view('news/success', $data);
                }
        }*/
        
}


?>
