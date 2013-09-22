<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 16:19:53
         compiled from "./templates/new_evaluation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2102238133521b5e506924c0-61132778%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b34adafa4cdbb55afdb2be1e99c4da61a2c68fa' => 
    array (
      0 => './templates/new_evaluation.tpl',
      1 => 1377530460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2102238133521b5e506924c0-61132778',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_521b5e50693b29_38787689',
  'variables' => 
  array (
    'data' => 0,
    'disciplinas' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521b5e50693b29_38787689')) {function content_521b5e50693b29_38787689($_smarty_tpl) {?><hr>
<form method="post" action="" name="nova_avaliacao" id="nova_avaliacao" enctype="multipart-form/data" >

<table id="forms">
	<thead>
		<tr>
			<th colspan="2"><h3>INSERIR NOVA AVALIA&Ccedil;&Atilde;O</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="titulos">Tipo de avalia&ccedil;&atilde;o:</td>
			<td class="valores"><input type="text" name="tipo"></td>
		</tr>
		<tr>
			<td class="titulos">Data:</td>
			<td class="valores">
				<?php echo $_smarty_tpl->tpl_vars['data']->value[0];?>

				<input type="hidden" name="data" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1];?>
">
			</td>
		</tr>
		<tr>
			<td class="titulos">Peso:</td>
			<td class="valores"><input type="text" name="peso"></td>
		</tr>
		<tr>
			<td class="titulos">Sala:</td>
			<td class="valores"><input type="text" name="sala"></td>
		</tr>
		<tr>
			<td class="titulos">Observa&ccedil;&otilde;es:</td>
			<td class="valores"><textarea name="observacoes"></textarea></td>
		</tr>
		<tr>
			<td class="titulos">Disciplina:</td>
			<td class="valores">
				<select name="disciplina">
					<option value="">Escolha uma disciplina</option>
					<?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['disciplinas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
	   					<option value="<?php echo $_smarty_tpl->tpl_vars['d']->value['num_disciplina'];?>
"><?php echo $_smarty_tpl->tpl_vars['d']->value['titulo'];?>
</option>
					<?php } ?>
				</select>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<input type="hidden" name="evaluation" value="nova">
				<input type="submit" value="inserir">
				<input type="reset" value="limpar">
			</th>
		</tr>
	</tfoot>
</table> 
</form>
<hr> <?php }} ?>