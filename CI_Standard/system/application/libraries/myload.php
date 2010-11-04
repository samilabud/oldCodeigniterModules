<?php
/**
	Samil Abud
	
	Class to load views with headers and footers
**/
class MyLoad
{
	public $siteName = "Firts part Title of WebSite";
	public $siteNameAdmin = "Administrator title page";
	public $spliterTitle = " .::. ";
	public $compress = true;//compress all code.
	public $debug = false;//activate profiler and decompress all code.
	
	function view($view, $data = array()){
	
		$CI = &get_instance();
		
		//For send data to views inner ours views
		$data['data'] = $data;	
		//Title page
		$data['titlepage'] = (isset($data['titlepage']))?$this->siteName.$this->spliterTitle.$data['titlepage']:$this->siteName;
		//Name to load the view - (Must be unique)
		$data['viewToLoad'] = $view;
		

		echo $this->compress($CI->load->view("template/header",$data,true));
		
		if(!isset($data['notcontent'])){
			echo $this->compress($CI->load->view("template/content",$data,true));
		}else//used to main page
			echo $this->compress($CI->load->view($view,$data,true));
		
		echo $this->compress($CI->load->view("template/footer",$data,true));
	}
	
	function backend($view, $data = array()){
		$CI = &get_instance();
		
		$data["admin"] = $this->backendMenu();
		$data['admin_title_page'] = (isset($data['titlepage']))?$this->siteName.$this->spliterTitle.$data['titlepage']:$this->siteNameAdmin;
		
		$CI->load->view("template/header_admin",$data);
		$CI->load->view("admin/".$view,$data);
		$CI->load->view("template/footer_admin",$data);

	}
	
	//Compressing output
	private function compress($html)
	{
		if($this->compress)
		{
			$search = array(
				'/\>[^\S ]+/s',    //strip whitespaces after tags, except space
				'/[^\S ]+\</s',    //strip whitespaces before tags, except space
				'/(\s)+/s'    // shorten multiple whitespace sequences
				);
			$replace = array(
				'>',
				'<',
				'\\1'
				);
			$html = preg_replace($search, $replace, $html);
			
			$html = str_replace("\n",'',$html);
			$html = str_replace("\t",'',$html);
			$html = str_replace("\r",'',$html);
			$html = str_replace("> <",'><',$html);
		}
		return $html;
	}

	private function backendMenu(){
			/**
			 * Nav
			 *
			 * Configuracion para el menu.
			 */
			$admin['nav'] = array();
			

			$admin['nav']['Titulo Menu'] = array(
				'url' => 'SubTitulo menu'
			);

			return $admin;
	}
}
?>