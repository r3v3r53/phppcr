<?php /* Smarty version Smarty-3.1.13, created on 2013-07-17 08:59:35
         compiled from "./templates/detalhes_avaliacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134855911551e47b967261a2-17890712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6be7927475931d2c80a004e09837f95f7ebff7ca' => 
    array (
      0 => './templates/detalhes_avaliacao.tpl',
      1 => 1374022851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134855911551e47b967261a2-17890712',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51e47b96727c20_02879814',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e47b96727c20_02879814')) {function content_51e47b96727c20_02879814($_smarty_tpl) {?>  	<div id="ajuda">ajuda</div>
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