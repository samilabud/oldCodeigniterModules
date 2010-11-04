<?php
function upload($fieldName, $uploadDir, $fileName, $allowed_types = NULL)
{
	$CI =& get_instance();

	$CI->load->library('image_lib');

	if ($allowed_types !== NULL) $config['allowed_types'] = $allowed_types;
	$config['encrypt_name'] = TRUE;
	$config['mimes'] = getMimes();
	
	$CI->load->library('upload', $config);
	
	$CI->upload->set_upload_path($uploadDir);
	if (!$CI->upload->do_upload($fieldName)) return FALSE;

	$result = $CI->upload->data();
	// El nombre con el que se guardo en la carpeta.
	$uploadName = $result['full_path'];


	$result['raw_name'] = $fileName;
	
	$result['file_ext'] = strtolower($result['file_ext']);

	$result['file_name'] = $result['raw_name'] . $result['file_ext'];

	$result['full_path'] = $result['file_path'] . $result['file_name'];
	@unlink($result['full_path']);//Parche created by samil abud
	rename($uploadName, $result['full_path']);


	// -------------------------------------------------------
	return $result;

}
function getMimes(){
	$mimes = array(    'hqx'    =>    'application/mac-binhex40',
                'xht'    =>    'application/xhtml+xml',
                'zip'    => array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
                'mid'    =>    'audio/midi',
                'midi'    =>    'audio/midi',
                'mpga'    =>    'audio/mpeg',
                'mp2'    =>    'audio/mpeg',
                'mp3'    =>    'audio/mpeg',
                'aif'    =>    'audio/x-aiff',
                'aiff'    =>    'audio/x-aiff',
                'aifc'    =>    'audio/x-aiff',
                'ram'    =>    'audio/x-pn-realaudio',
                'rm'    =>    'audio/x-pn-realaudio',
                'rpm'    =>    'audio/x-pn-realaudio-plugin',
                'ra'    =>    'audio/x-realaudio',
                'rv'    =>    'video/vnd.rn-realvideo',
                'wav'    =>    'audio/x-wav',
                'bmp'    =>    'image/bmp',
                'gif'    =>    'image/gif',
                'jpeg'    =>    array('image/jpeg', 'image/pjpeg'),
                'jpg'    =>    array('image/jpeg', 'image/pjpeg'),
                'jpe'    =>    array('image/jpeg', 'image/pjpeg'),
                'png'    =>    array('image/png',  'image/x-png'),
				'swf'    =>    array('application/x-shockwave-flash'),
                'tiff'    =>    'image/tiff',
                'tif'    =>    'image/tiff',
                'css'    =>    'text/css',
                'html'    =>    'text/html',
                'htm'    =>    'text/html',
                'shtml'    =>    'text/html',
                'txt'    =>    'text/plain',
                'text'    =>    'text/plain',
                'log'    =>    array('text/plain', 'text/x-log'),
                'rtx'    =>    'text/richtext',
                'rtf'    =>    'text/rtf',
                'xml'    =>    'text/xml',
                'xsl'    =>    'text/xml',
                'mpeg'    =>    'video/mpeg',
                'mpg'    =>    'video/mpeg',
                'mpe'    =>    'video/mpeg',
                'qt'    =>    'video/quicktime',
                'mov'    =>    array('video/mov','video/quicktime'),
                'avi'    =>    array('video/avi', 'video/x-msvideo'),
                'movie'    =>    'video/x-sgi-movie',
                'doc'    =>    'application/msword',
                'word'    =>    array('application/msword', 'application/octet-stream'),
                'xl'    =>    'application/excel',
                'flv'   =>  'video/flv',
                'wmv'   =>  array('video/wmv', 'video/x-ms-wmv'),
                'eml'    =>    'message/rfc822',
				'pdf'	=> 'application/pdf'
            );
	return $mimes;
}