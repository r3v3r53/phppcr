<?php /* Smarty version Smarty-3.1.13, created on 2013-07-15 20:35:24
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1642651e184ffd21ac6-92682400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1373916903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1642651e184ffd21ac6-92682400',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e184ffda4308_37793845',
  'variables' => 
  array (
    'login_action' => 0,
    'titulo_botao_login' => 0,
    'username' => 0,
    'tipo_calendario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e184ffda4308_37793845')) {function content_51e184ffda4308_37793845($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        	<a href="<?php echo $_smarty_tpl->tpl_vars['login_action']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['titulo_botao_login']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['titulo_botao_login']->value;?>
" >
				<?php echo $_smarty_tpl->tpl_vars['titulo_botao_login']->value;?>

			</a>
        </div>
        
    	<div id="titulo_site">
        	<img src="imagens/ipbeja_logotipo.png" 
            	alt="Logotipo IPBeja" 
                title="Logotipo IPBeja" />
        	<h1>
            GEST&Atilde;O DE AVALIA&Ccedil;&Otilde;ES</h1>
        </div>
        
    </div>
    <!-- fim do cabeçalho -->
    
    <div id="menu">
    	<?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    	<div id="identificacao">
    		<?php echo $_smarty_tpl->tpl_vars['username']->value;?>

    	</div>
    </div>
    
    <div id="alertas">
		ZONA DE ALERTAS
	</div>
	
    <div id="conteudo">
    
    	<div id="vistas">
        	<?php echo $_smarty_tpl->getSubTemplate ("vistas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
  		<div id="prev">
			<a href="?Calendario&move=-1">
				<img src="imagens/prev.jpg" title="Retroceder" alt="seta à esquerda" />
			</a>
		</div>
		<div id="calendario">
        	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['tipo_calendario']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		</div>
		<div id="next">
			<a href="?Calendario&move=1">
				<img src="imagens/next.jpg" title="Avançar" alt="seta à direita" />
			</a>
		</div>

        <div id="detalhes">
			<?php echo $_smarty_tpl->getSubTemplate ("detalhes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
  		<?php echo $_smarty_tpl->getSubTemplate ("detalhes_avaliacao.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
</body>
</html>
<?php }} ?>