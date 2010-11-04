<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//For list of image of admin
if ( ! function_exists('imageListURL'))
{
	function imageListURL($id_modelo,$id_imagen,$thumbnail,$directory="modelos")
	{
		$base_url = base_url();
		$img = "";
		$noimage = "images/no_image_".$thumbnail.".jpg";
		
		$img = "images/".$directory."/".$id_modelo."/".$thumbnail."/".$id_imagen.".jpg";
		
		if(!is_file($img))
			return $base_url.$noimage;
			
		return $base_url.$img;
		
     }
}

/*To print image of model,article, etc, if not exist print no image file*/
if ( ! function_exists('getImagePath'))
{
	function getImagePath($id,$id_imagen,$thumbnail,$directory="modelos")
	{
		$base_url = base_url();
		$img = "";
		$noimage = "images/no_image_".$thumbnail.".jpg";
		
		$img = "images/".$directory."/".$id."/".$thumbnail."/".$id_imagen.".jpg";
		if(!is_file($img))
			return $base_url.$noimage;
			
		return $base_url.$img;
		
     }
}

//Description of product of main page
if ( ! function_exists('miniDescription'))
{
	function miniDescription($descripcion,$max_length = 20)
	{
		$CI = &get_instance();
		$CI->load->helper('text');
		return ucfirst(character_limiter($descripcion, $max_length));
		
     }
}

//To get all image id from a model
if ( ! function_exists('getImageIds')){
	function getImageIds($id,$modelo="Modelo"){
		$CI = &get_instance();
		$CI->load->model($modelo);
		if(@$imageIds = $CI->{$modelo}->getImages($id)->result_object())
			return $imageIds;
		else return array();
	}
}
//To get one image id from a model
if ( ! function_exists('getImageId')){
	function getImageId($id, $modelo="Modelo"){
		$CI = &get_instance();
		$CI->load->model($modelo);
		if(@$imageId = $CI->{$modelo}->getImages($id)->row())
			return $imageId;
		else return array();
	}
}
?>