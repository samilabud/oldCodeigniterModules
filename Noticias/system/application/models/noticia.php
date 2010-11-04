<?php
class Noticia extends Model {
	
	var $imageDir = "images/noticias/";
	var $imageOriginal = "images/noticias/originals/";
	var $imageThumbnails = array('50x66','95x75');//for minithumbnail admin,for list of noticias
		
    ##########################################################
    # CLASS FUNCTIONS
    ##########################################################
    
	//To add some noticia
	function agregar($data)
	{
		$data['introduccion'] = utf8_encode($data['introduccion']);
		$data['contenido'] = utf8_encode($data['contenido']);
		$data['fecha_registro'] = date('Y-m-d H:i:s');

		$this->db->insert("noticia",$data);
		//for show image from model added of edited - ajax request take this id
		echo $this->db->insert_id();

	}
	//To edit one noticia
	function editar($data)
	{
		$data['introduccion'] = utf8_encode($data['introduccion']);
		$data['contenido'] = utf8_encode($data['contenido']);
		$this->db->where('noticia.id_noticia',$data['id_noticia']);
		$this->db->update("noticia",$data);
		
		//for show image from model added of edited - ajax request take this id
		echo $data['id_noticia'];
	}
	//To delete one noticia
	function borrar($rowId)
	{
		//Deleting images
		foreach($this->imageThumbnails as $d){
			$size = explode("x",$d);
			$modDirectory = $this->imageDir.$rowId;
			$modThumbDirectory = $modDirectory."/".$d;
			@$this->delTree($modThumbDirectory);
		}
		
		@$this->delTree($this->imageDir.$rowId);
		
		@$this->delTree($this->imageOriginal.$rowId);

		$this->db->delete('noticia', array('id_noticia' => $rowId)); 
	}


	function getNoticia($id_noticia)
	{
		$this->db->select("*", FALSE);
		
		$this->db->where('noticia.id_noticia = ', $id_noticia);
		
		$this->db->from('noticia');
		
		return $this->db->get();
	}


	function GetList($params = array())
	{
		$imgDir = base_url() . $this->imageDir;
		
		$this->db->select("*", FALSE);

		if(isset($params['search']))//para la busqueda
		{
			if(strlen($params['search']['searchString'])){
				if($params['search']['searchOper']!='like')
					$this->db->where('noticia.'.$params['search']['searchField'].' '.$search['searchOper'], $params['search']['searchString']); 
				else
					$this->db->like('noticia.'.$params['search']['searchField'], $params['search']['searchString']); 			
			}
		}
		
		$this->db->from('noticia');
		
		if(isset($params['limit']))
			$this->db->limit($params['limit'],$params['start']);
		
		if(isset($params['sord']) && isset($params['sidx']))	
			$this->db->order_by($params['sidx'], $params['sord']); 

		return $this->db->get();

	}
	private	function getNoticiaDirectory(){

		$directory = $this->imageDir;
				
		if(!is_dir($directory)) mkdir($directory);//mainDirectory
		if(!is_dir($this->imageOriginal)) mkdir($this->imageOriginal);//Directory for orignal images

		return $directory;
		
	}
	
	/**
		functions relateds with noticias
	**/
	
	//Working with images
	//Get all images of one accesory
	public function getImages($id_noticia)
	{
		return $this->db->select("images.id_noticia, images.id_noticia_images", FALSE)
		->from('noticia_images images')
		->where('images.id_noticia = ' . $id_noticia)
		->get();

	}
	//delete one image of one noticia
	public function deleteImag($id_image,$id_prod)
	{

		$this->db->delete('noticia_images', array('id_noticia_images' => $id_image));
		foreach($this->imageThumbnails as $d){
			$size = explode("x",$d);
			$modDirectory = $this->imageDir.$id_prod;
			$modThumbDirectory = $modDirectory."/".$d;
			@unlink($modThumbDirectory."/".$id_image);
		}

	}
	
	/*
	* Extra functions 
	*/
	
	//For add images to a noticia
	public function agregarImagen($rowId)
	{
		$this->load->helper('upload');
		$this->load->helper('thumbnails');
		
		//Thumbnails
		$imageThumbnails = $this->imageThumbnails;
		$imgDir = $this->getNoticiaDirectory();	//Ruta por defecto de los noticia

		//inserting DB
		$data = array(
		   'id_noticia' => $rowId,
		   'tipo_imagen' => '1'
		);
		
		if ($this->db->insert('noticia_images', $data) === FALSE)
			return FALSE;
		
		$rowImageId = $this->db->insert_id();
		
		//Saving original image
		if(!is_dir($this->imageOriginal."/".$rowId)) mkdir($this->imageOriginal."/".$rowId);		
		$upload = upload("userfile", "{$this->imageOriginal}{$rowId}/", $rowImageId, 'jpg');
		
		if ($upload === FALSE) return FALSE;
		

		
		foreach($imageThumbnails as $d){
			$size = explode("x",$d);

			$modDirectory = $imgDir.$rowId;
			if(!is_dir($modDirectory)) mkdir($modDirectory);
			
			$modThumbDirectory = $modDirectory."/".$d;
			if(!is_dir($modThumbDirectory)) mkdir($modThumbDirectory);//Creating directory for thumbnail of noticia

			//Saving a thumbnail to previous directory created
			create_thumb($upload['full_path'], "{$modThumbDirectory}/{$upload['file_name']}", $size[0], $size[1]);
		}
	
		return TRUE;
	}

	//to delete 
	private function delTree($dir) {
		$dir = $dir."/";
		$files = glob( $dir . '*', GLOB_MARK );
		foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
				delTree( $file );
        else
            unlink( $file );
		}
    	rmdir( $dir );
	} 

}
?>