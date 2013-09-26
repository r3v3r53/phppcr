<span class="datas">{$date}</span>
<br>
<span class="disciplina">{$discipline}</span>
<br>
<span class="texto">{$type}</span>
<table class="detalhes">
	<tbody>
		<tr>
			<td>peso da avalia&ccedil;&atilde;o</td>
			<td>sala(s)</td>
		</tr>
		<tr>
			<td>{$weight}</td>
			<td>{$classroom}</td>
		</tr>
	</tbody>
</table>
{if $validated == 0}
<input id="validar" value="validar avalia&ccedil;&atilde;o" onclick="validarAvaliacao({$id});" type="button">
{else}
<input id="cancelar" value="cancelar valida&ccedil;&atilde;o" onclick="cancelarValidacao({$id});" type="button">
{/if}
<input id="data" value="alterar data" type="button"><input id="sala" value="alterar sala" type="button">