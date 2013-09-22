<?php /* Smarty version Smarty-3.1.13, created on 2013-07-18 09:27:39
         compiled from "./templates/detalhes_aluno.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77473681051e67509db2024-81430376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2108f66e8b8980c94bb9f4b6569b29004a0780ba' => 
    array (
      0 => './templates/detalhes_aluno.tpl',
      1 => 1374136059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77473681051e67509db2024-81430376',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e67509db39f6_14010931',
  'variables' => 
  array (
    'data' => 0,
    'disciplina' => 0,
    'tipo_avaliacao' => 0,
    'peso' => 0,
    'sala' => 0,
    'inscrito' => 0,
    'botoes' => 0,
    'titulos' => 0,
    'num_avaliacao' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e67509db39f6_14010931')) {function content_51e67509db39f6_14010931($_smarty_tpl) {?>	<span class="datas&quot;">
		<?php echo $_smarty_tpl->tpl_vars['data']->value;?>

	</span>
	<br>
	<span class="disciplina">
		<?php echo $_smarty_tpl->tpl_vars['disciplina']->value;?>

	</span>
	<br>
	<span class="texto">
		<?php echo $_smarty_tpl->tpl_vars['tipo_avaliacao']->value;?>

	</span>
	<table class="detalhes">
		<tbody>
			<tr>
				<td>
					peso da avaliação
				</td>
				<td>
					alunos inscritos
				</td>
				<td>
					sala(s)
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['peso']->value;?>

				</td>
				<td>
					&nbsp;
				</td>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['sala']->value;?>

					<br>
				</td>
			</tr>
		</tbody>
	</table>
	<?php $_smarty_tpl->tpl_vars['botoes'] = new Smarty_variable(array('inscrever','cancelarInscricao'), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['titulos'] = new Smarty_variable(array('inscrever','cancelar inscri&ccedil;&atilde;o'), null, 0);?>
	 
	<input id="<?php echo $_smarty_tpl->tpl_vars['botoes']->value[$_smarty_tpl->tpl_vars['inscrito']->value];?>
" value="<?php echo $_smarty_tpl->tpl_vars['titulos']->value[$_smarty_tpl->tpl_vars['inscrito']->value];?>
" onclick="<?php echo $_smarty_tpl->tpl_vars['botoes']->value[$_smarty_tpl->tpl_vars['inscrito']->value];?>
(<?php echo $_smarty_tpl->tpl_vars['num_avaliacao']->value;?>
);" type="button">
	<input id="detalhes_aval" value="detalhes da avaliação" onclick="detalhes_avaliacao(<?php echo $_smarty_tpl->tpl_vars['num_avaliacao']->value;?>
);" type="button">
	<hr><?php }} ?>