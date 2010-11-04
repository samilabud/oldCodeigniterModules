<link rel="stylesheet" type="text/css" href="<?=base_url() ?>css/wufoo/structure.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url() ?>css/wufoo/form.css" />
<table id="list_noticias" width="100%">
</table>
<div id="pager_noticias"></div>
<!-- Load TinyMCE -->
<script type="text/javascript" src="<?=base_url()?>js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	function setTinyMCE(){
		$.doAfter(500,function() {
			jQuery('textarea.tinymce').tinymce({
				// Location of TinyMCE script
				script_url : '<?=base_url()?>js/tiny_mce/tiny_mce.js',
				// General options
				language : "es",
				theme : "advanced",
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
	
				// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,anchor,cleanup,code,|,insertdate,inserttime",
				theme_advanced_buttons3 : "tablecontrols,|,hr,|,sub,sup,|fullscreen",
				theme_advanced_buttons4 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
	
				// Example content CSS (should be your site CSS)
				content_css : "css/content.css",
	
				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",
	
			});
		});
	}
</script>
<!-- /TinyMCE -->

<script type="text/javascript">

$(document).ready(function(){
			
			
			//*************************Noticias*************************************

			jQuery("#list_noticias").jqGrid({ 
						//basic params
						 url:'<?=base_url()?>admin/noticias.html?q=grid', //Url for show grid
						 editurl: "<?=base_url()?>admin/noticias.html?q=edit", //Url for editing
						 datatype: "json", 
						 colNames:['ID','Titulo','Introducci&oacute;n'], 
						 colModel:[ 
								   {name:'id_noticia',index:'id_noticia', hidden:true},																																
								   {name:'titulo',index:'titulo', sortable:true},
								   {name:'introduccion',index:'introduccion', sortable:true}
								   ],
						 rowNum:10, 
						 height: '100%',
						 rowList:[10,20,30], 
						 pager:'#pager_noticias', 
						 sortname: 'id_noticia',
						 autowidth:true,
						 multiselect: false,
						viewrecords: true,
						sortorder: "desc",
						caption:"LISTADO DE NOTICIAS",
						onSelectRow: function(ids) {
						if(ids == null) {
							ids=1;
							loadNoticiaForm(ids);
						} else {
							loadNoticiaForm(ids);
						}}
			//setting method for add and edditing
			 }).navGrid('#pager_noticias',{edit:false,add:false,del:true}, 
				{}, //  end default settings for edit
				{}, // end default settings for add
				{},  // delete instead that del:false we need this
				{sopt:['cn','bw','eq','ne','lt','gt']}, // search options
				{}
			);
 });

/***************************functions for form****************************************/
	//cargar el formulario para edicion
	var id_noticia_selected = 0;
	function loadNoticiaForm(id_noticia){
		$("#loading").show();
		id_noticia_selected = id_noticia;
		$.post("<?=base_url()?>admin/form_noticia.html", {id_noticia:id_noticia},function(data){
				$("#loading").hide();
				$('#container').html(data);
				loadWufooScript();
				loadName(id_noticia_selected);
				setTinyMCE();
			});
		
	}
	//Cargar el script de wufoo
	function loadWufooScript(){
		$.getScript("<?=base_url() ?>js/wufoo.js", function(){
									   initForm();
									   $('#container').show();
									   validations();
									 });
	}
	$(document).ready(function(){
		//Mostrar el formulario para agregar un accesorio
		$("#addNoticia").click(function(){
								id_noticia_selected = 0;
								$("#loading").show();
								$.post("<?=base_url()?>admin/form_noticia.html", {},function(data){
										$("#loading").hide()
										$('#container').html(data);
										loadWufooScript();
										hideUploadTools();
										setTinyMCE();
								});
					}
		);

	});
	function validations(){
			/*Validations*/
			$('.numeric').keyup(function(){
				var value=$(this).val();
				var orignalValue=value;
				val=value.replace(/[0-9]*/g, "");
				
				
				value=value.replace(/\./, "");
				msg="Solo se permiten valores numericos";
				
				
				if (val!=''){
					orignalValue=orignalValue.replace(/([^0-9].*)/g, "")
					$(this).val(orignalValue);
					alert(msg);
				}
				
			});

		}

	//Save the data of form on DB
	function saveForm(){
		titulo = $("#titulo").val();
		contenido = $("#contenido").val();
		introduccion = $("#introduccion").val();

		if(id_noticia_selected == 0)
			oper = "add";
		else
			oper = "edit";
		$("#loading").show();
		
		
		$.post("<?=base_url()?>admin/noticias.html?q=edit", {titulo:titulo,contenido:contenido,introduccion:introduccion,id_noticia:id_noticia_selected,oper:oper},function(data){
				$("#loading").hide();
				jQuery("#list_noticias").jqGrid().trigger('reloadGrid');
				loadName(data);		
				id_noticia_selected = data;	 
		});
		
	}
	(function($) {
	  $.doAfter = function(time, f) {
		setTimeout(f, time);
	  };
	})(jQuery);
	
</script>
<br />
<style type="text/css">
.inline{
	display:inline;
	width:15px;
	cursor:pointer;
}
#loading{
	display:inline;
	position:absolute;
	margin:2px 0 0 4px;
}
#addNoticia{
	background-image:url(<?=base_url()?>images/admin/backgroundbutton.png);
	color:#FFF;
	text-transform:uppercase;
	font-weight:bold;
	font-size:10px;
	font-family:Lucida Grande,Lucida Sans,Arial,sans-serif;
	margin-bottom:2px;
}
</style>

<input type="button" value="Agregar una noticia nueva" id="addNoticia" />
<div id="loading" style="display:none"><img width="18" src="<?=base_url()?>images/admin/ajax-loader.gif"/></div>

<!--container-->
<div id="container" style="display:none">
  
</div>

<!-- ******************Images********************* -->
<script type="text/javascript">
//load name of product.
function hideUploadTools(){
	$("#loading2").hide();
	$("#fileupload").hide();
	$("#imgContainer").hide();
	$("#showProdName").hide();
}
function loadName(ids)
{
		$("#loading2").show();
		$("#fileupload").show();
		$("#imgContainer").show();
		$("#showProdName").show();
		$("#textUpload").hide();
		$('#input_idmod').attr('value',ids);

		$.post("<?=base_url()?>admin/get_noticia_titulo.html", {id_noticia:ids},function(data){
			$("#loading2").hide();
			$("#textUpload").show();
			$('#showProdName').html("Subir imagenes para la noticia <strong>" + data + "</strong>");
		});
		$.post("<?=base_url()?>admin/imagenes_noticias.html", {id_noticia:ids},function(data){
			$('#showImgList').html(data);
			addEventToDelete();
		});
}
//To add click event to delete button
function addEventToDelete(){
	$(".imageDelete").click(function(){
		$("#loading2").show();									 
		id_imagen = this.id;
		id_noticia = $('#input_idmod').attr('value');
		$.post("<?=base_url()?>admin/delete_img_noticia.html", {id_imagen:id_imagen,id_noticia:id_noticia},function(data){
			$("#loading2").hide();
			loadName(id_noticia);					  
		});						  
	});
}
//For uploading image jpg
$(document).ready(function(){
    var button = $('#fileupload'), interval;
   	new AjaxUpload('#fileupload', {
        action: '<?=base_url()?>admin/noticias.html?q=edit',
        onSubmit : function(file , ext){
			var send = {};
			send.id = $('#input_idmod').attr('value');
			send.oper = 'addImage';
			this.setData(send);
			if (! (ext && /^(jpg|jpeg)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten imagenes JPG');
				// cancela upload
				return false;
			} else {
				button.text('Subiendo...');
				this.disable();
			}
        },
        onComplete: function(file, response){
			loadName(id_noticia_selected);
			this.enable();
            button.html('Subir Otra Imagen <img height="10" src="<?=base_url()?>images/admin/up.png" />');
        }  
    });

});
</script>
<br />
<style type="text/css">
#fileupload {
    width:120px;
    height:35px;
    text-align:center;
    color:#000;
    font-weight:bold;
    padding-top:15px;
	margin:auto;
	display:block;
	background-color:#FFF;
	border:1px #A6C9E2 outset;

}
.listaImagenes{
	border:1px groove #4270D7;
	float:left;
	margin-right:3px;
	margin-bottom:2px;
	margin-top:1px;
	height:66px;
}
.buttonDelete{
	position:absolute;
	margin-top:2px;
	margin-left:35px;
	/margin-left:-19px;/*for ie*/
	cursor:pointer;
}
#imgContainer{
	border:2px #A6C9E2 solid;
	width:98%;
	height:100%;
	clear:both;
	float:left;
	padding:3px;
	margin-bottom:5px;
}
#showProdName{
	background:url(<?=base_url()?>css/jqgrid/redmond/images/ui-bg_gloss-wave_55_85A8FF_500x100.png);
	float:left;
	color:#FFF;
	border:1px #A6C9E2 solid;
	width:98%;
	padding:4px;
}
</style>
<input id="input_idmod" type="hidden" />
<div id="loading" style="display:none"><img width="18" src="<?=base_url()?>images/admin/ajax-loader.gif"/></div>
<div id="showProdName" class="ui-corner-tl ui-corner-tr" style="display:none"></div>

<div id="imgContainer" style="display:none">
	<div id="showImgList"></div>
</div>

<div id="fileupload" style="clear:both; display:none;">
	<span id="textUpload"> Subir Imagen <img height="10" src="<?=base_url()?>images/admin/up.png" /></span>
    <img id="loading" style="display:none; float:left; margin-top:-8px; margin-left:7px;" src="<?=base_url()?>images/ajax-loader.gif" />
</div>