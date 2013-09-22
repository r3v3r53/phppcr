<?php /* Smarty version Smarty-3.1.13, created on 2013-07-15 16:48:19
         compiled from ".\templates\calendario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1684551e18500069895-48586050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0d04e3aade913b864e3f7f3dd00a09a0b37aead' => 
    array (
      0 => '.\\templates\\calendario.tpl',
      1 => 1373903298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1684551e18500069895-48586050',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e1850007a3e6_39753572',
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
<?php if ($_valid && !is_callable('content_51e1850007a3e6_39753572')) {function content_51e1850007a3e6_39753572($_smarty_tpl) {?><div id="prev">
	<a href="?Calendario&move=-1">
		<img src="imagens/prev.jpg" title="Retroceder" alt="seta à esquerda" />
	</a>
</div>
<div id="calendario">


<?php  $_smarty_tpl->tpl_vars['vars'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vars']->_loop = false;
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
<?php } ?>

</div>
<div id="next">
	<a href="?Calendario&move=1">
		<img src="imagens/next.jpg" title="Avançar" alt="seta à direita" />
	</a>
</div>
	<?php }} ?>