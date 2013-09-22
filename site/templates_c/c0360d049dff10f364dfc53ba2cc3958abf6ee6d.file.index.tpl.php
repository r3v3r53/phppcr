<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 14:55:28
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126508492651e47b965e1b70-02448491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1377525378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126508492651e47b965e1b70-02448491',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_51e47b9666cd20_80893764',
  'variables' => 
  array (
    'menu' => 0,
    'form' => 0,
    'tipo_calendario' => 0,
    'details' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e47b9666cd20_80893764')) {function content_51e47b9666cd20_80893764($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        	<?php echo $_smarty_tpl->getSubTemplate ("b_login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        
    	<div id="titulo_site">
        	<img src="/pcr/imagens/logotipo.png" 
            	alt="Logotipo " 
                title="Logotipo" />
        	<h1>
            GEST&Atilde;O DE AVALIA&Ccedil;&Otilde;ES</h1>
        </div>
        
    </div>
    <!-- fim do cabeçalho -->
    
    <div id="menu">
    	<div id="menu_itens">
    		<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['menu']->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
    	</div>
    	<div id="identificacao">
    		<?php echo $_smarty_tpl->getSubTemplate ("identificacao.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    	</div>
    </div>
    
    <div id="alertas">
		<?php echo $_smarty_tpl->getSubTemplate ("alertas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	
    <div id="conteudo">
    <div id="forms">
		<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['form']->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
	</div>
    	<div id="vistas">
        	<?php echo $_smarty_tpl->getSubTemplate ("vistas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
  		<div id="prev">
			<a href="?Calendar&move=-1">
				<img src="imagens/prev.jpg" title="Retroceder" alt="seta à esquerda" />
			</a>
		</div>
		<div id="calendario">
        	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['tipo_calendario']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		</div>
		<div id="next">
			<a href="?Calendar&move=1">
				<img src="imagens/next.jpg" title="Avançar" alt="seta à direita" />
			</a>
		</div>

        <div id="detalhes">
			<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['details']->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
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
  		
    </div>
</body>
</html>
<?php }} ?>