<?php
class Source_code extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('source_code_model');
	}

	public function listAllSources()
	{
		$data['title'] = 'Liste des sources codes disponibles';

		$data['sc_array'] = $this->source_code_model->get_source_code_list();

		$this->load->view('templates/header', $data);
		$this->load->view('source_code/list', $data);
		$this->load->view('templates/footer');	
	} 

	public function view($sc_id){
        $sc_id = (string) $sc_id;    
  		$data['source_code'] = $this->source_code_model->get_source_code($sc_id);
        if (empty($data['source_code']))
        {
                show_404();
        }
        $data['title']    = $data['source_code']['sc_name'];
        $data['sc_name']  = $data['source_code']['sc_name'];

		$data['the_source_naked'] = $this->source_code_model->get_source_code_naked($sc_id);

        // Chargement de la vue	
        $this->load->view('templates/header', $data);
        $this->load->view('source_code', $data);
        $this->load->view('templates/footer');			
	}

	public function create(){
		$post_test = $this->input->post();
		foreach ($post_test as $key => $value) {
			var_dump($key);
			var_dump($value);
		}

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name',
										  'name',
										  'required', 
										  array('required'=>'The Source_code name is required')
										  );

		$data['active_source_code'] = $this->source_code_model->get_activated_source_code_list();

		$data['title'] = "Création d'un nouveau source_code";
		if ($this->form_validation->run() === FALSE){

			$this->load->view('templates/header', $data);
			$this->load->view('source_code/create',$data);
			$this->load->view('templates/footer');
		}		

		//$this->form_validation->set_rules('value',
		//								  'Source code value',
		//								  'required');


	}
}
?>