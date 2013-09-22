<?php /* Smarty version Smarty-3.1.14, created on 2013-08-26 12:59:15
         compiled from "./templates/monthly.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6335717751f689c44da349-79467166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36ecedab5360a6e636cd038d958163d02b7f3687' => 
    array (
      0 => './templates/monthly.tpl',
      1 => 1375606051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6335717751f689c44da349-79467166',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_51f689c4606109_10877756',
  'variables' => 
  array (
    'calendario' => 0,
    'vars' => 0,
    'i' => 0,
    'dia' => 0,
    'key_dia' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f689c4606109_10877756')) {function content_51f689c4606109_10877756($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['vars'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vars']->_loop = false;
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
    			<div class="<?php if (array_key_exists($_smarty_tpl->tpl_vars['dia']->value,$_smarty_tpl->tpl_vars['vars']->value['class'])){?><?php echo $_smarty_tpl->tpl_vars['vars']->value['class'][$_smarty_tpl->tpl_vars['dia']->value];?>
<?php }?>">
    				<?php if ($_smarty_tpl->tpl_vars['dia']->value>0){?>
	    				<a 
	    					href="?Calendar&setDay=<?php echo $_smarty_tpl->tpl_vars['vars']->value['data'][$_smarty_tpl->tpl_vars['key_dia']->value];?>
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