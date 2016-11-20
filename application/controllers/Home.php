<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    

    public function index()
	{   
		$data['title'] = 'Dashboard ';
        $this->my_template->loadAdmin('home/home',$data);		
	}
        
    
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */