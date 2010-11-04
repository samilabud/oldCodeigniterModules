<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
/*For No Cache Image*/
header("HTTP/1.1 200 OK");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
/* End no cache image*/
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?=$admin_title_page ?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>css/admin/main.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>css/jqgrid/redmond/jquery-ui-1.7.2.custom.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>css/jqgrid/redmond/uitheme.css" />

<script type="text/javascript" src="<?=base_url() ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/locale.sp.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/jquery.jqgrid.min.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/ajaxupload.js"></script>
<? $CI = &get_instance(); 
	$currentURL = str_replace(".html","",$CI->uri->segment(2));
?>
<script type="text/javascript">
 	$(document).ready(function() {
							  jQuery("#<?=$currentURL?>").css({'background':'none','background-color' : '#f6f6f6', 'padding-left' : '8px'});
	 })
</script>
</head>
<body>
   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
		 <div id="header">
		 
		       <div> <a style="color:#2E6E9E" id="header_title" href="<?=base_url()?>admin/">Panel de Administracion</a></div>

<div id="header_b">
<?php if (isLoggedAdmin()) { ?>
	<a href="<?=base_url()?>admin/logout.html">
		<span>Cerrar Sesion</span>
		<img src="<?=base_url()?>images/admin/logout-icon.jpg" alt="Logout" />
	</a>
	<a href="<?=base_url()?>admin/cambiar_clave.html">
		<span>Cambiar Contrase&ntilde;a</span>
		<img src="<?=base_url()?>images/admin/red_edit.gif" alt="Logout" />
	</a>

<?php } ?>
</div>
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <?php if (isLoggedAdmin()) { ?>
		 <div id="leftcolumn">

		       <?php
		       foreach ($admin['nav'] as $nav_name => $nav_links)
		       {
					echo '<div class="menu-block">';
					
					echo '<h3>'. $nav_name .'</h3>';
					
					foreach ($nav_links as $nav_link_uri => $nav_link_name)
					{
						echo '<a id="'.$nav_link_uri.'" href="'. base_url() .'admin/'. $nav_link_uri .'.html">&bull; '. $nav_link_name .'</a>';
					}
					
					echo '</div>';
		       }
		       
		       ?>
		       
		 </div>
		 <?php } ?>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="rightcolumn" <?php if (!isLoggedAdmin()) { echo 'style="width:962px;"'; } ?>>
		       
