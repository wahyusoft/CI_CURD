<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
		$load_model = array('Products_model'=>'PM',
							'Categories_model'=>'CM',
							'Suppliers_model'=>'SM');
        $this->load->model($load_model);        
    }

    public function index()
	{   	    
		$data['title'] = 'Data Products';			
        $this->my_template->loadAdmin('products/product',$data);		
	}
        
    public function ajax_list()
	{
		$list = $this->PM->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $products) {
			$no++;
			$row = array();
			$row[] = $products->ProductID;
			$row[] = $products->ProductName;
			$row[] = $products->SupplierID;
			$row[] = $products->CategoryID;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_products('."'".$products->ProductID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_products('."'".$products->ProductID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->PM->count_all(),
						"recordsFiltered" => $this->PM->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


    public function ajax_edit($id)
	{
		$data = $this->PM->get_by_id($id);		
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'ProductName' => $this->input->post('ProductName'),
				'SupplierID' => $this->input->post('SupplierID'),
				'CategoryID' => $this->input->post('CategoryID')
			);
		$insert = $this->PM->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'ProductName' => $this->input->post('ProductName'),
				'SupplierID' => $this->input->post('SupplierID'),
				'CategoryID' => $this->input->post('CategoryID')
			);
		$this->PM->update(array('ProductID' => $this->input->post('id')), $data);
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

		if($this->input->post('ProductName') == '')
		{
			$data['inputerror'][] = 'ProductName';
			$data['error_string'][] = 'Product Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('SupplierID') == '')
		{
			$data['inputerror'][] = 'SupplierID';
			$data['error_string'][] = 'Supplier is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('CategoryID') == '')
		{
			$data['inputerror'][] = 'CategoryID';
			$data['error_string'][] = 'Category is required';
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