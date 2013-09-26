{*
<form id="form_vista" method="post" action="?Calendario&setTipo" enctype="multipart/form-data">
	<fieldset id="vista" >
		<legend>vista do calend&aacute;rio:</legend>
		{html_radios name='vista' options=$vistas
			selected=$vistas_selected separator='&nbsp;'}
    	<input type="submit" id="ver" name="ver" value="ver" />
	</fieldset>
</form>
*}