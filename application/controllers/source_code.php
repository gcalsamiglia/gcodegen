<?php
class source_code extends CI_Controller {

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

}
?>