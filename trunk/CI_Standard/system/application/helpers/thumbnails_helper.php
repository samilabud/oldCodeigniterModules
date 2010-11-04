<?php

function create_thumb($imagePath, $newPath, $thumbW, $thumbH, $quality = 90, $crop = TRUE)
{
	
	@unlink($newPath);

	$CI =& get_instance();

	$CI->load->library('image_lib');
	

	$newPath = dirname(BASEPATH) . "/$newPath";

	$imageInfo = getimagesize($imagePath);
	$imageW = $imageInfo[0];
	$imageH = $imageInfo[1];

	$wCalc = ceil(($thumbH * $imageW) / $imageH);
	$hCalc = ceil(($thumbW * $imageH) / $imageW);
	
	if (($wCalc == $thumbW) && ($hCalc == $thumbH))
	{
		$config['master_dim'] = 'auto';
	}
	elseif (($wCalc < $thumbW) && ($hCalc >= $thumbH))
	{
		$config['master_dim'] = 'height';
	}
	elseif (($wCalc > $thumbW) && ($hCalc <= $thumbH))
	{
		$config['master_dim'] = 'width';
	}

	// Se redimensiona.
	$config['image_library'] = 'gd2';
	$config['source_image'] = $imagePath;
	$config['quality'] = "{$quality}%";
	$config['maintain_ratio'] = TRUE;
	$config['new_image'] = $newPath;
	$config['width'] = $wCalc;
	$config['height'] = $hCalc;

	$CI->image_lib->initialize($config);

	if ( ! $CI->image_lib->resize())
	{
		if (DEBUG)
		{
			debug('image_lib:' . $CI->image_lib->display_errors());
		}
		else
		{
			return FALSE;
		}
	}

	$CI->image_lib->clear();

	// Y se corta lo que sobre.
	if ($crop)
	{
		$img = imagecreatefromjpeg($newPath);

		$res = imagecreatetruecolor ($thumbW, $thumbH);

		imagecopy($res, $img, 0, 0, 0, 0, $thumbW, $thumbH);

		imagejpeg($res, $newPath, 100);
	}

}