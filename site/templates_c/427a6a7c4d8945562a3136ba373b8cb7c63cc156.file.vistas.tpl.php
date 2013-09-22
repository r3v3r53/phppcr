<?php /* Smarty version Smarty-3.1.13, created on 2013-07-15 15:21:09
         compiled from ".\templates\vistas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1930051e18500036265-34215368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '427a6a7c4d8945562a3136ba373b8cb7c63cc156' => 
    array (
      0 => '.\\templates\\vistas.tpl',
      1 => 1373898065,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1930051e18500036265-34215368',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e18500044408_77047414',
  'variables' => 
  array (
    'vistas' => 0,
    'vistas_selected' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e18500044408_77047414')) {function content_51e18500044408_77047414($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'smarty/libs/plugins\\function.html_radios.php';
?><form id="form_vista" method="post" action="?Calendario&setTipo" enctype="multipart/form-data">
	<fieldset id="vista" >
		<legend>vista do calend&aacute;rio:</legend>
		<?php echo smarty_function_html_radios(array('name'=>'vista','options'=>$_smarty_tpl->tpl_vars['vistas']->value,'selected'=>$_smarty_tpl->tpl_vars['vistas_selected']->value,'separator'=>'&nbsp;'),$_smarty_tpl);?>

    	<input type="submit" id="ver" name="ver" value="ver" />
	</fieldset>
</form><?php }} ?>