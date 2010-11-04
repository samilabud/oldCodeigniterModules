//Poner esto en el header

<link href="<?=base_url()?>css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />

<script src="<?=base_url()?>js/jquery.lightbox-0.5.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){	
	        $('.image_list a').lightBox();

});
</script>
