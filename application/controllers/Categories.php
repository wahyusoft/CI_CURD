<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Categories_model','CM');        
    }

    public function index()
	{   	    
		$data['title'] = 'Data Categories';			
        $this->my_template->loadAdmin('categories/categories',$data);		
	}
        
    public function ajax_list()
	{
		$list = $this->CM->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $category) {
			$no++;
			$row = array();
			$row[] = $category->CategoryID;
			$row[] = $category->CategoryName;
			$row[] = $category->Description;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_categories('."'".$category->CategoryID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_categories('."'".$category->CategoryID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->CM->count_all(),
						"recordsFiltered" => $this->CM->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


    public function ajax_edit($id)
	{
		$data = $this->CM->get_by_id($id);		
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'CategoryName' => $this->input->post('CategoryName'),
				'Description' => $this->input->post('Description')
			);
		$insert = $this->CM->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'CategoryName' => $this->input->post('CategoryName'),
				'Description' => $this->input->post('Description')
			);
		$this->CM->update(array('CategoryID' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->CM->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('CategoryName') == '')
		{
			$data['inputerror'][] = 'CategoryName';
			$data['error_string'][] = 'Category Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('Description') == '')
		{
			$data['inputerror'][] = 'Description';
			$data['error_string'][] = 'Description is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */