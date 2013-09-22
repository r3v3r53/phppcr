<?php /* Smarty version Smarty-3.1.13, created on 2013-07-17 09:42:21
         compiled from "./templates/semanal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150206397551e47ba55394d5-48736646%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd44ad7017bc86ccc57b81a4ca0627bd90604f034' => 
    array (
      0 => './templates/semanal.tpl',
      1 => 1374022852,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150206397551e47ba55394d5-48736646',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e47ba55c48d1_74146508',
  'variables' => 
  array (
    'calendario' => 0,
    'dias' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e47ba55c48d1_74146508')) {function content_51e47ba55c48d1_74146508($_smarty_tpl) {?><table id="semana">
	<tbody>
		<tr class="titulo_semana">
		<?php  $_smarty_tpl->tpl_vars['dias'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dias']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calendario']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dias']->key => $_smarty_tpl->tpl_vars['dias']->value){
$_smarty_tpl->tpl_vars['dias']->_loop = true;
?>
			<td class="<?php echo $_smarty_tpl->tpl_vars['dias']->value['class'];?>
">
				<div>
					<?php echo $_smarty_tpl->tpl_vars['dias']->value['dia']['titulo'];?>
<br><?php echo $_smarty_tpl->tpl_vars['dias']->value['dia']['num'];?>
 <?php echo $_smarty_tpl->tpl_vars['dias']->value['mes']['min'];?>
 <?php echo $_smarty_tpl->tpl_vars['dias']->value['ano'];?>

				</div>
			</td>
		<?php } ?>
		</tr>
		<tr class="ano_um">
			<td>
				<div id="d14m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d15m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d16m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d17m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d18m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d19m6a2013_1">&nbsp;</div>
			</td>
			<td>
				<div id="d20m6a2013_1">&nbsp;</div>
			</td>
		</tr>
		<tr class="ano_dois">
			<td>
				<div id="d14m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d15m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d16m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d17m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d18m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d19m6a2013_2">&nbsp;</div>
			</td>
			<td>
				<div id="d20m6a2013_2">&nbsp;</div>
			</td>
		</tr>
		<tr class="ano_tres">
			<td>
				<div id="d14m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d15m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d16m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d17m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d18m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d19m6a2013_3">&nbsp;</div>
			</td>
			<td>
				<div id="d20m6a2013_3">&nbsp;</div>
			</td>
		</tr>
	</tbody>
	
</table><?php }} ?>