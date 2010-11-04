<?php
/**
* 	Class to generate jqgrids
*	Created By Samil Abud
**/
class SimpleJqGrid{
	private	$CI; //Var to instance CodeIgniter
	
	function __construct(){
		$this->CI = &get_instance();//Getting instance of codeigniter
	}
	
	public function generate($data, $subGrid = false)
	{
			$this->CI->load->model($data['model']); //Loading respective model
			
			$params = array(); // array of params for sending to model
			$page = $_GET['page']; // get the requested page
			$limit = $_GET['rows']; // get how many rows we want to have into the grid
			$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
			$sord = $_GET['sord']; // get the direction

			$searchString = (isset($_GET['searchString']))?$_GET['searchString']:'';
			$searchField = (isset($_GET['searchField']))?$_GET['searchField']:'';
			$searchOper = (isset($_GET['searchOper']))?$this->getRealOper($_GET['searchOper']):'';

			$search = array('searchString'=>$searchString,'searchField'=>$searchField,'searchOper'=>$searchOper);
			
			if(!$sidx) $sidx = 1;
			
			if($subGrid)
				$params ['id_parent'] = $_GET['id_parent'];
			
			if(!isset($data['list_function']))//setting function list to get data from model
				$data['list_function'] =  "GetList";
			
			$params['where'] = (isset($data['where']))?$data['where']:array(); //querys to do in the model
			$lista = $this->CI->{$data['model']}->{$data['list_function']}($params);

			$count = $lista->num_rows;
			
			if( $count > 0 ) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0;
			}
			if ($page > $total_pages) $page = $total_pages;
			$start = $limit * $page - $limit; // do not put $limit*($page - 1)
			
			$params ['limit'] = ($limit<0)?0:$limit;//limit to get at DB
			$params ['start'] = ($start<0)?0:$start;//number id to get result
			$params ['sidx'] = $sidx;//order name to sort
			$params ['sord'] = $sord;//order type (asc, desc)
			$params ['search'] = $search;//to search in the model
			
			$lista = $this->CI->{$data['model']}->{$data['list_function']}($params);

			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			$i=0;
			
			$result = $lista->result_array();
			foreach($result as $row) {
				$cels = array(); //array cels to get from DB
				
				foreach($data['fields'] as $field) //Getting data from query
					$cels[] = $row[$field];
					
				$responce->rows[$i]['id']=$cels[0]; //get id (first cell)
	
				$responce->rows[$i]['cell']=$cels; //cells for send to view
				$i++;
			} 
			echo json_encode($responce);
	}
	function getRealOper($oper){

		$opers = array('eq'=>' = ', 'ne'=>'<>', 'lt'=>' < ', 'le'=>' <= ', 'gt'=>' > ', 'ge'=>' >= ','cn'=>'like');

		if(array_key_exists($oper,$opers))
			return $opers[$oper];
			
		return ' = ';
		
	}
	
}
?>