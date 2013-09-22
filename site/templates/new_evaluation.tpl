<hr>
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
				{$data[0]}
				<input type="hidden" name="data" value="{$data[1]}">
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
					{foreach from=$disciplinas item=d}
	   					<option value="{$d.num_disciplina}">{$d.titulo}</option>
					{/foreach}
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
<hr> 