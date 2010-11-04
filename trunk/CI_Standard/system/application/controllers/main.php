<?php
class main extends Controller
{	
	function __construct(){
		parent::Controller();
	}
	
	private function _pagination($params, $model, $query = ""){
			$this->load->library('pagination');
			$this->load->model($model);
			
			$lista= $this->{$model}->GetList($params);
			$limit = $params ['limit'];
			
			unset($params ['limit']);
			$total = $this->{$model}->GetList($params)->num_rows;//Total of all products
			$paginationURL = site_url($params ['url_name'])."?".$query;
			
			$config['base_url'] = $paginationURL;

			$config['total_rows'] = $total;
			
			$config['per_page'] = $limit;
			
			$config['full_tag_open'] = '<ul class="paginator">';
			$config['full_tag_close'] = '</ul>';
			
			$config['cur_tag_open'] = '<li class="num_act"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li class="num"><a>';
			$config['num_tag_close'] = '</a></li>';
			
			$config['prev_link'] = 'anterior';
			$config['prev_tag_open'] = '<li class="prev"><a>';
			$config['prev_tag_close'] = '</a></li>';
			
			$config['next_tag_open'] = '<li class="next"><a>';
			$config['next_tag_close'] = '</a></li>';
			$config['next_link'] = 'siguiente';
			
			$config['last_link'] = ' >>';
			$config['last_tag_open'] = '<li class="next"><a>';
			$config['last_tag_close'] = '</a></li>';
			
			$config['first_link'] = '<< ';
			$config['first_tag_open'] = '<li class="next"><a>';
			$config['first_tag_close'] = '</a></li>';
	
			$this->pagination->initialize($config); 
			return array("lista"=>$lista->result_object(),"total"=>$total);
	}

	function index()
	{
		$data = array();
		$data['titlepage'] = "Inicio"; 
		$data['notcontent'] = true;//At the most of cases the index page is diferent to another pages for this in this case not load the generic content
		
		$this->myload->view("inicio",$data);
	}
	
	function exPagination(){
		$data = array();

		//For Paging
		$start = $this->input->get('per_page');
		$params ['limit'] = 4;//limit to get at DB
		$params ['start'] = ($start)?$start:0;//number id to get result
		$params ['sord'] ="desc";//For asc or desc
		$params ['sidx'] = "fecha_registro";//For orderby like "precio"...
		$params ['url_name'] = "this function name";//Url name for paging example "exPagination"
		$lista = $this->_pagination($params,"ModelName");
		//End Paging

		$data['listName'] = $lista;
		
		$this->myload->view("viewname",$data);	
	}
	
}
?>