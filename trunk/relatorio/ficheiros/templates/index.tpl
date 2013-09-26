<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/simple.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='scripts/jquery.js'></script>
<script type="text/javascript" src="scripts/jquery-1.3.1.min.js"></script>
<script type='text/javascript' src='scripts/jquery.simplemodal.js'></script>
<script type="text/javascript" src="scripts/codes.js"></script>
</head>
<body>
	<div id="cabecalho">
    	<div id="ajuda_site">
    		<a href="#">Ajuda</a>
    	</div>
        <div id="b_login">
        	{include file="b_login.tpl"}
        </div>
        
    	<div id="titulo_site">
        	<img src="/pcr/imagens/logotipo.png" 
            	alt="Logotipo " 
                title="Logotipo" />
        	<h1>
            GEST&Atilde;O DE AVALIA&Ccedil;&Otilde;ES</h1>
        </div>
        
    </div>
    <!-- fim do cabecalho -->
    
    <div id="menu">
    	<div id="menu_itens">
    		{eval $menu}
    	</div>
    	<div id="identificacao">
    		{include file="identificacao.tpl"}
    	</div>
    </div>

    <div id="conteudo">
    <div id="forms">
		{eval $form}
	</div>
    	<div id="vistas">
        	{include file="vistas.tpl"}
        </div>
  		<div id="prev">
			<a href="?Calendar&move=-1">
				<img src="imagens/prev.jpg" title="Retroceder" alt="seta a esquerda" />
			</a>
		</div>
		<div id="calendario">
        	{include file=$tipo_calendario}
		</div>
		<div id="next">
			<a href="?Calendar&move=1">
				<img src="imagens/next.jpg" title="Avancar" alt="seta a direita" />
			</a>
		</div>

        <div id="detalhes">
			{eval $details}
		</div>
    </div>
    
	<div id="avisos"></div>
	
	<div id="painel_login">
		<div id="ajuda_login">ajuda</div>
		<h1>AUTENTICA&Ccedil;&Atilde;O</h1>
        <form action="?User&login" method="post"
        	enctype="multipart/form-data" id="autenticacao" name="autenticacao">
        <label for="form_utilizador">UTILIZADOR:</label>
        <input type="text" id="form_utilizador" name="form_utilizador" />
        <br />
        <label for="form_password">PASSWORD:</label>
        <input type="password" id="form_password" name="form_password" />
        <br />
        <div id="lgn"><input type="submit" id="ok" name="ok" value="ok"/></div>
        <input type="reset" value="cancel" class="simplemodal-close" />
       
		<br />recuperar password
        </form>
	</div>
	   
	<div id="detalhes_avaliacao">
  		{* include file="detalhes_avaliacao.tpl" *}
    </div>
</body>
</html>
