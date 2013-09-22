<span class="datas">{$date}</span>
<br>
<span class="disciplina">{$discipline}</span>
<br>
<span class="texto">{$type}</span>
<table class="detalhes">
	<tbody>
		<tr>
			<td>peso da avaliação</td>
			<td>sala(s)</td>
		</tr>
		<tr>
			<td>{$weight}</td>
			<td>{$classroom}</td>
		</tr>
	</tbody>
</table>
<input id="cancelar" value="cancelar avalia&ccedil;&atilde;o" onclick="cancelarAvaliacao({$id});" type="button">
<input id="data" value="alterar data" type="button"><input id="sala" value="alterar sala" type="button">