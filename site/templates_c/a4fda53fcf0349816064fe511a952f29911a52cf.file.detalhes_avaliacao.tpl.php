<?php /* Smarty version Smarty-3.1.13, created on 2013-07-13 17:49:04
         compiled from ".\templates\detalhes_avaliacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2600351e18500169a20-93750372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4fda53fcf0349816064fe511a952f29911a52cf' => 
    array (
      0 => '.\\templates\\detalhes_avaliacao.tpl',
      1 => 1373492482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2600351e18500169a20-93750372',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e185001c2632_67158260',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e185001c2632_67158260')) {function content_51e185001c2632_67158260($_smarty_tpl) {?>  	<div id="ajuda">ajuda</div>
		<h1>DETALHES DA AVALIA&Ccedil;&Atilde;O</h1>
        <div id="detalhes_disciplina"></div>
        <div id="detalhes_tipo"></div>
        <div id="detalhes_data"></div>
        
        <table>
        	<tr>
            	<td>
                	<span class="bold">Descri&ccedil;&atilde;o</span><br />
        			<div id="detalhes_descricao"></div>
                </td>
                <td>
                	<span class="bold">Restri&ccedil;&otilde;es</span><br />
			        <div id="detalhes_restricoes"></div>
                </td>
            </tr>
        </table>
        <div id="detalhes_salas"></div>
        <div id="detalhes_pesos"></div>
  <input type="button" value="fechar" class="simplemodal-close" /><?php }} ?>