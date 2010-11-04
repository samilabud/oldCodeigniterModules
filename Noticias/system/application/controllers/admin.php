	/********************************************* Noticias *********************************************/
	//Agregar noticia
		function noticias(){
			$data = array();
			$model = "Noticia";
			$params = array(); //For sending params to simplegrid function
			$params['model'] = $model;
			$params['fields'] = array('id_noticia','titulo','introduccion'); //Fields to get from simple grid
			
			//Gettingbrands
			$this->load->model($model);
			
			if($_GET){//If the grid is called
					switch($_GET['q']){
						case "grid":
							$this->simplejqgrid->generate($params);
						break;
						case "edit":		
							$arrayEdit = array();//Fields to save in DB
														
							if($this->input->post('id')!="0") //if id was sent, is because the user is editing
								$arrayEdit['id_noticia'] = $this->input->post('id');
							elseif($this->input->post('id_noticia'))
								$arrayEdit['id_noticia'] = $this->input->post('id_noticia');
							/*Fields to edit*/
							$arrayEdit['titulo'] = $this->input->post('titulo');
							$arrayEdit['introduccion'] = $this->input->post('introduccion');
							$arrayEdit['contenido'] =$this->input->post('contenido');

							if($this->input->post('oper')=='add'){//adding data
									$this->{$model}->agregar($arrayEdit);		
							}elseif($this->input->post('oper')=='del')//deleting data
								$this->{$model}->borrar($arrayEdit['id_noticia']);
							elseif($this->input->post('oper')=='edit')//editing data
								$this->{$model}->editar($arrayEdit);
							elseif($this->input->post('oper')=='addImage')
								$this->{$model}->agregarImagen($arrayEdit['id_noticia']);
						break;
						default:
						break;
					}

		}else//To load the main view of controler
			$this->myload->backend('noticia',$data);	
	}
	//imagenes de noticias
			function imagenes_noticias(){
				$this->load->model('Noticia');
				$id_noticia = $this->input->post('id_noticia');
				$listaImagenes = $this->Noticia->getImages($id_noticia);
				
				$data['listaImagenes'] = $listaImagenes->result_object();
				$data['numRows'] = $listaImagenes->num_rows;
				
				$this->load->view('ajax/imagenes_noticias',$data);	
			}
			function delete_img_noticia(){
				$this->load->model('Noticia');
				$id_image = $this->input->post('id_imagen');
				$id_prod = $this->input->post('id_noticia');
				$this->Noticia->deleteImag($id_image,$id_prod);
			}
	
	

		//Form accesories - ajax request
	function form_noticia(){
		$id_noticia = $this->input->post('id_noticia');
		$data = array();
		if($id_noticia){
			$this->load->model('Noticia');
			$listaNoticias = $this->Noticia->getNoticia($id_noticia);
			$data['listaNoticias'] = $listaNoticias->result_array();
		}
		$this->load->view('ajax/form_noticia',$data);
	}

	function get_noticia_titulo(){
		$id_noticia = $this->input->post('id_noticia');
		if($id_noticia){
			$this->load->model('Noticia');
			$noticia = $this->Noticia->getNoticia($id_noticia)->row();
			$nombreNoticia = $noticia->titulo;
			echo $nombreNoticia;
		}	

	}

	/********************************************* END Noticias *********************************************/