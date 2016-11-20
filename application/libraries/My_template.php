<?php if(!defined('BASEPATH')) exit('Tidak boleh ngakses langsung mas bro !');
/**
 * Description of My_template
 *
 * @author wahyu widodo
 */
class My_template {
	
	var $template_data = array();
	
	public function __construct(){
		$this->ci = & get_instance();			
	}	
	
	public function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }
	
	public function loadAdmin($view_name = '' , $view_data = array(), $return = FALSE){
		$this->set('contents', $this->ci->load->view($view_name, $view_data, TRUE));		
		$this->ci->load->view('layout_admin',$this->template_data, $return);
	}
	
	public function MenuAdmin(){
		$nav = '';
		$array_menu = array(""=>"Dashboard",
							"categories"=>"Categories",
							"products"=>"Products",
							"customers"=>"Customers",
							"employees"=>"Employees",
							"shippers"=>"Shippers",
							"suppliers"=>"Suppliers");
		$icons = array('dashboard','bar-chart-o','table','edit','desktop','wrench','file');					
		$i=0;
		foreach($array_menu as $row=>$key){
			$is_Act = $this->ci->uri->segment(1);	
			$css = ($is_Act==$row)? 'class="active"' : '';
			$nav.='<li '.$css.' >'.anchor(base_url().$row,'<i class="fa fa-fw fa-'.$icons[$i].'"></i> '.$key).'</li>';
			$i++;
		}
		return $nav;		
	}
	
}

?>