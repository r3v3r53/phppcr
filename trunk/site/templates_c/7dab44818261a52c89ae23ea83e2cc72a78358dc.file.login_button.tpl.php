<?php /* Smarty version Smarty-3.1.13, created on 2013-07-13 18:40:12
         compiled from ".\templates\login_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1119251e184ffeaaa17-86004357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dab44818261a52c89ae23ea83e2cc72a78358dc' => 
    array (
      0 => '.\\templates\\login_button.tpl',
      1 => 1373737206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1119251e184ffeaaa17-86004357',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e184ffebf3b1_52742607',
  'variables' => 
  array (
    'titulo_login' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e184ffebf3b1_52742607')) {function content_51e184ffebf3b1_52742607($_smarty_tpl) {?><script>
$(document).ready(function() {
	$('#logout').click(function() { 
		alert("logout");
	});
}
</script>
<a href="#" title="<?php echo $_smarty_tpl->tpl_vars['titulo_login']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['titulo_login']->value;?>
" >
	<?php echo $_smarty_tpl->tpl_vars['titulo_login']->value;?>

</a>
<?php }} ?>