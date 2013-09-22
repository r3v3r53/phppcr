<?php /* Smarty version Smarty-3.1.13, created on 2013-07-15 20:35:24
         compiled from ".\templates\mensal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2120851e44e8f5f6834-83127704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4cfeacd79e036e3928de59180d88e8ae912088e' => 
    array (
      0 => '.\\templates\\mensal.tpl',
      1 => 1373916916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2120851e44e8f5f6834-83127704',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e44e8f7bd042_31214367',
  'variables' => 
  array (
    'calendario' => 0,
    'vars' => 0,
    'i' => 0,
    'key_dia' => 0,
    'dia' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e44e8f7bd042_31214367')) {function content_51e44e8f7bd042_31214367($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['vars'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vars']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calendario']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vars']->key => $_smarty_tpl->tpl_vars['vars']->value){
$_smarty_tpl->tpl_vars['vars']->_loop = true;
?>
<div id="mes">
<table class="mes">
<tr class="calendario_titulo_mes">
	<td colspan="7"><?php echo $_smarty_tpl->tpl_vars['vars']->value['mes']['titulo'];?>
, <?php echo $_smarty_tpl->tpl_vars['vars']->value['ano'];?>
</td>
</tr>
<tr class="calendario_titulo_dias">
	<td>d</td>
	<td>s</td>
	<td>t</td>
	<td>q</td>
	<td>q</td>
	<td>s</td>
	<td>s</td>
</tr>

<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>	
	<?php  $_smarty_tpl->tpl_vars['dia'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dia']->_loop = false;
 $_smarty_tpl->tpl_vars['key_dia'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['vars']->value['dias']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dia']->key => $_smarty_tpl->tpl_vars['dia']->value){
$_smarty_tpl->tpl_vars['dia']->_loop = true;
 $_smarty_tpl->tpl_vars['key_dia']->value = $_smarty_tpl->tpl_vars['dia']->key;
?>
    	<?php if ($_smarty_tpl->tpl_vars['i']->value==7){?>
    		</tr>
    		<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
    	<?php }?>
    	<?php if ($_smarty_tpl->tpl_vars['i']->value==0){?>
			<tr>
		<?php }?>
    	<td class="calendario_dias">
    			<div class="<?php echo $_smarty_tpl->tpl_vars['vars']->value['class'][$_smarty_tpl->tpl_vars['key_dia']->value];?>
">
    				<?php if ($_smarty_tpl->tpl_vars['dia']->value>0){?>
	    				<a 
	    					href="?Calendario&setDia=<?php echo $_smarty_tpl->tpl_vars['vars']->value['data'][$_smarty_tpl->tpl_vars['key_dia']->value];?>
" 
	    					title="<?php echo $_smarty_tpl->tpl_vars['vars']->value['nomes'][$_smarty_tpl->tpl_vars['key_dia']->value];?>
"
	    				>
	    					<?php echo $_smarty_tpl->tpl_vars['dia']->value;?>

	    				</a>
    				<?php }else{ ?>
    					&nbsp;
    				<?php }?>
    			</div>
    	</td>
    	
    	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
    <?php } ?>
</table>
</div>
<?php } ?><?php }} ?>