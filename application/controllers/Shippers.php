<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shippers extends CI_Controller {
    
	public $crud;
	public $module;	
	
    public function __construct() {
        parent::__construct();					
		$this->crud = new grocery_CRUD();
		$this->crud->set_theme('datatables');
		$this->module = 'shippers';	
    }

    public function index()
	{						
		$this->crud->set_table($this->module);						
		$output = $this->crud->render();		
		$this->my_template->loadAdmin($this->module.'/'.$this->module,$output);
	}
         
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */