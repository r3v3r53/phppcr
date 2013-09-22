<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 17:05:28
         compiled from "./templates/teacher_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44397552652170e8f66ce35-15877961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '736fcc10802fa9bf5246eaf42ae135bfc87c9ef8' => 
    array (
      0 => './templates/teacher_details.tpl',
      1 => 1377242866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44397552652170e8f66ce35-15877961',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52170e8f66f2e4_95325439',
  'variables' => 
  array (
    'date' => 0,
    'discipline' => 0,
    'type' => 0,
    'weight' => 0,
    'classroom' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52170e8f66f2e4_95325439')) {function content_52170e8f66f2e4_95325439($_smarty_tpl) {?><span class="datas"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
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
<input id="cancelar" value="cancelar avalia&ccedil;&atilde;o" onclick="cancelarAvaliacao(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" type="button">
<input id="data" value="alterar data" type="button"><input id="sala" value="alterar sala" type="button"><?php }} ?>