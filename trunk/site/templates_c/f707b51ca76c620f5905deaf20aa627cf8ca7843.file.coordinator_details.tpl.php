<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 12:06:02
         compiled from "./templates/coordinator_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5705358665214af4887eb35-46255992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f707b51ca76c620f5905deaf20aa627cf8ca7843' => 
    array (
      0 => './templates/coordinator_details.tpl',
      1 => 1377155040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5705358665214af4887eb35-46255992',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5214af488804b1_52529473',
  'variables' => 
  array (
    'date' => 0,
    'discipline' => 0,
    'type' => 0,
    'weight' => 0,
    'classroom' => 0,
    'validated' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5214af488804b1_52529473')) {function content_5214af488804b1_52529473($_smarty_tpl) {?><span class="datas"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</span>
<br>
<span class="disciplina"><?php echo $_smarty_tpl->tpl_vars['discipline']->value;?>
</span>
<br>
<span class="texto"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</span>
<table class="detalhes">
	<tbody>
		<tr>
			<td>peso da avaliação</td>
			<td>sala(s)</td>
		</tr>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['weight']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['classroom']->value;?>
</td>
		</tr>
	</tbody>
</table>
<?php if ($_smarty_tpl->tpl_vars['validated']->value==0){?>
<input id="validar" value="validar avalia&ccedil;&atilde;o" onclick="validarAvaliacao(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" type="button">
<?php }else{ ?>
<input id="cancelar" value="cancelar valida&ccedil;&atilde;o" onclick="cancelarValidacao(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" type="button">
<?php }?>
<input id="data" value="alterar data" type="button"><input id="sala" value="alterar sala" type="button">




<?php }} ?>