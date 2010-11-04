<form name="frmLogin" id="frmLogin" action="" method="post">

	<div align="center">

	<br />
	<strong>Inicie Sesi&oacute;n</strong>
	<br /><br />
		

	<div style="padding:10px; border:1px solid #ddd;background-color:#f6f6f6; width:280px;">
    <?=isset($msg_box)?$msg_box:""?>
	<table cellpadding="0" cellspacing="8" border="0" width="100%">
		<tr>
			<td width="100">Usuario</td>
			<td align="right"><input name="username" type="text" size="20" /></td>
		</tr>
		<tr>
			<td width="100">Contrase&ntilde;a</td>
			<td align="right"><input name="password" type="password" size="20" /></td>
		</tr>
	</table>
	<br />

	<input type="submit" value="Login" />
	</div>
	</div>


</form>

<br /><br />
	