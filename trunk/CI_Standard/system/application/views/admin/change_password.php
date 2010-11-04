<style media="all" type="text/css">
@import url("<?=(base_url() . 'css/datagrid.css') ?>");  
</style>

<script type="text/javascript">
function submitForm(){
	cNew = $("#c_nueva").get(0).value;
	ccNew = $("#cc_nueva").get(0).value;
	if(cNew == ""){
		alert("Debe de especificar una contraseña nueva");
		return false;
	}	
	if(cNew != ccNew){
		alert("La confirmación de la contraseña no coincide.");
		return false;
	}
	$("#change_pass_form").get(0).submit();
} 
</script>

<h1>Cambiar Contrase&ntilde;a</h1>
<div><?=isset($msg_box)?$msg_box:""?></div>
<form method="post" action="" id="change_pass_form">
    <div class="bottoms_panel">
    <a href="javascript:;" onclick="submitForm()"><img src="<?= base_url() ?>images/admin/disk.png"> Guardar</a>
    
    </div>
    <div style="width:250px">
    <strong>Contraseña Actual:</strong> 
    <input type="password" size="10" style="float:right" name="c_actual"/><br /><br />
    
    <strong>Contraseña Nueva:</strong> 
    <input type="password" size="10"  align="right" style="float:right" name="c_nueva" id="c_nueva"/><br /><br />
    
    <strong>Confirmar Contraseña:</strong> 
    <input type="password" size="10"  align="right" style="float:right" id="cc_nueva"/>

    </div>
</form>

