	/*********** Noticias ***************/
	function noticias(){
		$data = array();
		$this->load->model("Noticia");
		$id_noticia = $this->input->get("id");
		$data['banner_arriba'] = "galeria_y_noticias_arriba";
		$data['banner_derecha'] = "galeria_y_noticias_derecha";

		if($id_noticia){
		
			$data['noticia'] = $this->Noticia->getNoticia($id_noticia)->row();
			$this->myload->view("detalle_noticia",$data);
			
		}else
		{
			//For Paging
			$start = $this->input->get('per_page');
			$params ['limit'] = 8;//limit to get at DB
			$params ['start'] = ($start)?$start:0;//number id to get result
			$params ['sord'] ="desc";//For asc or desc
			$params ['sidx'] = "fecha_registro";//For orderby like "precio"...
			$params ['url_name'] = "noticias";//Url name for paging
			$lista = $this->_pagination($params,"Noticia");
			//End Paging
			
			$data['noticias'] = $lista;
			$this->myload->view("noticias",$data);
		}
	}
	/*********** End Noticias ***********/
