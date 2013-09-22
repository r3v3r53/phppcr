<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 17:06:01
         compiled from "./templates/student_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9682210855215c97098ed22-41569447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '432d82d8c44eee4e4d6a9eea6dc734b229ed06a4' => 
    array (
      0 => './templates/student_details.tpl',
      1 => 1377244365,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9682210855215c97098ed22-41569447',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5215c9709c57f0_17300805',
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
<?php if ($_valid && !is_callable('content_5215c9709c57f0_17300805')) {function content_5215c9709c57f0_17300805($_smarty_tpl) {?><span class="datas"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
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
<input id="validar" value="inscrever" onclick="inscrever(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" type="button">
<?php }else{ ?>
<input id="cancelar" value="cancelar inscri&ccedil;&atilde;o" onclick="cancelarInscricao(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" type="button">
<?php }?><?php }} ?>