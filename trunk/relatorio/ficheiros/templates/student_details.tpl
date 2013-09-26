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
<input id="validar" value="inscrever" onclick="inscrever({$id});" type="button">
{else}
<input id="cancelar" value="cancelar inscri&ccedil;&atilde;o" onclick="cancelarInscricao({$id});" type="button">
{/if}