$(document).ready(function() {

	$('#semestre').click(function(){
		window.location.href='?Calendario&tipo=mensal';
	});
	
	$('#semana').click(function(){
		window.location.href='?Calendario&tipo=semanal';
	});
	
	$('#login').click(function() { 
		$("#painel_login").modal({overlayClose:true});
	});
	
});

function validarAvaliacao(num_avaliacao){
	window.location.href='?User&validate='+num_avaliacao;
}

function cancelarValidacao(num_avaliacao){
	window.location.href='?User&unvalidate='+num_avaliacao;
}

function cancelarAvaliacao(num_avaliacao){
	window.location.href='?User&cancelEvaluation='+num_avaliacao;
}

function inscrever(num_avaliacao){
	window.location.href='?User&inscribe='+num_avaliacao;
}

function cancelarInscricao(num_avaliacao){
	window.location.href='?User&uninscribe='+num_avaliacao;
}