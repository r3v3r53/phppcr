var http_request = false;
var xmlDoc, tipo, curso, nome, avaliacoes, first_day;
var disciplina, timer_um, timer_dois, current_view, role;
var b_validar = new Array(
		new Array("validar", "validar"), 
		new Array("cancelar", "cancelar valida&ccedil;&atilde;o")
	);
	
var b_inscrever = new Array(
		new Array("validar", "inscrever"), 
		new Array("cancelar", "cancelar inscri&ccedil;&atilde;o")
	);	
var no_leap = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var leap = new Array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

var cores = new Array("cor-neutro", "cor-info", "cor-ok", "cor-erro", "cor-alerta");
var months = new Array(
	new Array("JAN", "Janeiro"), 
	new Array("FEV", "Fevereiro"), 
	new Array("MAR", "Mar&ccedil;o"), 
	new Array("ABR", "Abril"), 
	new Array("MAI", "Maio"),
	new Array("JUN", "Junho"),
	new Array("JUL", "Julho"), 
	new Array("AGO", "Agosto"), 
	new Array("SET", "Setembro"),
	new Array("OUT", "Outubro"), 
	new Array("NOV", "Novembro"), 
	new Array("DEZ", "Dezembro")
);				
var week_days = new Array(
	new Array("d", "domingo", "domingo"), 
	new Array("s", "segunda", "segunda-feira"), 
	new Array("t", "ter&ccedil;a", "ter&ccedil;a-feira"), 
	new Array("q", "quarta", "quarta-feira"),
	new Array("q", "quinta", "quinta-feira"),
	new Array("s", "sexta", "sexta-feira"),
	new Array("s", "s&aacute;bado", "s&aacute;bado")
);
var tamanho = 6;
today = new Date();
var start_month = today.getMonth();
var start_year = today.getFullYear();
var start_day = today.getDate();
var selected_day = today;
var start_week;

$(document).ready(function() {
	text = '<a href="#"><div id="menu_item">';
	text += 'item1</div></a><a href="#"><div id="menu_item">';
	text += 'item2</div></a>';
	text += '<div id="identificacao"></div>';
	msg = 'DEVE EFECTUAR LOGIN';
	document.getElementById('menu').innerHTML = text;
	alerta(msg, 1, true);
	makeMonthsCalendar();

	$('#semestre').click(function(){
		makeMonthsCalendar(); 
		clearTimers();
	});
	
	$('#semana').click(function(){
		makeWeekCalendar();
		clearTimers();
	});
	
	$('#lgn').click(function() { lgn(); });
	$('#b_login').click(function() { login(); });
	
});

function lgn(){
	avaliacoes = null;
	$.ajax({
		type: 'get',
		url: 'xml/utilizadores.xml',
		success: function(response) {
			$msg = "ERRO NO USERNAME / PASSWORD";
			$cor = 3;
			$(response).find('utilizador').each(function() {
				elm = $(this);
				usrn = elm.find('username').text();
				pass = elm.find('password').text();
				if(usrn == $("#form_utilizador").val() 
					&& pass == $("#form_password").val()){
						texto = elm.find('nome').text()+"<br />";
						role = elm.find('tipo').text();
						texto += role+"<br />";
						texto += elm.find('curso').text()+"<br />";
						$("#identificacao").html(texto);
						$msg = "LOGIN EFECTUADO COM SUCESSO";
						$cor = 2;
						closeModal();
						$.ajax({
							type: 'get',
							url: 'xml/'+usrn+'.xml?r='+Math.random(),
							success: function(response) {
								$("#detalhes").html("escolha um dia");
								avaliacoes = response;
								arrangeAvals();
								makeMonthsCalendar();
								avisos();
							}
						});
						
						return 0;
				}
			});
			alerta($msg, $cor, true);
     	}
	});
}

function closeModal(){
	$.modal.close();
}

function avisos(){
	closeModal();
	txt = "";
	if(role == 'coordenador'){
		txt += "<h2>AVALIA&Ccedil;&Otilde;ES POR VALIDAR</h2><ul>";
		$(avaliacoes).find("avaliacao").each(
			function(){
				if($(this).find("validada").text() == '0'){
					a = $(this).find("ano").text();
					m = $(this).find("mes").text();
					d = $(this).find("dia").text();
					txt += "<li><a href=\"#\" onclick=\"goToValidate("+a+","+m+","+d+")";
					txt += ";\" >";
					txt += $(this).find("ano_curso").text()+"&ordm; ano - ";
					txt += $(this).find("disciplina").text();
					txt += "</a></li>";
				}
			}
		);
	} else if(role == 'aluno'){
		txt += "<h2>AVALIA&Ccedil;&Otilde;ES POR INSCREVER</h2><ul>";
		$(avaliacoes).find("avaliacao").each(
			function(){
				if($(this).find("inscrito").text() == '0'){
					a = $(this).find("ano").text();
					m = $(this).find("mes").text();
					d = $(this).find("dia").text();
					txt += "<li><a href=\"#\" onclick=\"goToValidate("+a+","+m+","+d+")";
					txt += ";\" >";
					txt += $(this).find("ano_curso").text()+"&ordm; ano - ";
					txt += $(this).find("disciplina").text();
					txt += "</a></li>";
				}
			}
		);
	}
	else if(role == 'docente'){
		txt += "<h2>AVALIA&Ccedil;&Otilde;ES COM CARGA EXCESSIVA</h2><ul>";
		$(avaliacoes).find("avaliacao").each(
			function(){
				if($(this).find("carga").text() > 0){
					a = $(this).find("ano").text();
					m = $(this).find("mes").text();
					d = $(this).find("dia").text();
					txt += "<li><a href=\"#\" onclick=\"goToValidate("+a+","+m+","+d+")";
					txt += ";\" >";
					txt += $(this).find("ano_curso").text()+"&ordm; ano - ";
					txt += $(this).find("disciplina").text();
					txt += "</a></li>";
				}
			}
		);
	}
	txt += "</ul>";
	txt += "<br><input type=\"button\" id=\"fechar\" value=\"fechar\" name=\"fechar\"";
	txt += " onclick=\"closeModal();\" />";
	
	$("#avisos").html(txt);
	$("#avisos").modal({overlayClose:true});
}

function goToValidate(a, m, d){
	setDay(a, m, d);
	makeWeekCalendar(); 
	closeModal();
}
// organizar informação das avaliações para melhor pesquisa
function arrangeAvals(){
	avals = new Array();
	$(avaliacoes).find("avaliacao").each(
		function(){
			x = $(this);
			id = x.attr("id");
			ano = x.find("ano").text();
			mes = x.find("mes").text();
			dia = x.find("dia").text();
			mes = mes < 10 ? '0' + mes : mes;
			dia = dia < 10 ? '0' + dia : dia;
			if(!avals[ano+''+mes+''+dia]) avals[ano+''+mes+''+dia] = new Array();
			avals[ano+''+mes+''+dia][id] = $(this);
		} 
	);
}

// barra de avisos / alertas
function alerta(txt, cor, repeat){
	if(repeat) clearTimers();
	$('#alertas').html(txt);
	$('#alertas').removeClass(cores[0]);
	$('#alertas').removeClass(cores[1]);
	$('#alertas').removeClass(cores[2]);
	$('#alertas').removeClass(cores[3]);
	$('#alertas').removeClass(cores[4]);
	$('#alertas').addClass(cores[cor]);
	if(repeat) {
		timer_um = setInterval(resetAlerta,5000);
	}	
}

function resetAlerta(){
	x = 0;
	clearInterval(timer_um);
	timer_um = setInterval(
		function(){
			alerta("ESCOLHA UMA OP&Ccedil;&Atilde;O", (x++)%2, false);
		}, 300
	);
	timer_dois = setInterval(
		function(){
			clearTimers();
			alerta("ESCOLHA UMA OP&Ccedil;&Atilde;O", 1, false);
		}, 2000
	);	
}

function clearTimers(){
	clearInterval(timer_um);
	clearInterval(timer_dois);
}

function login(){
	clearTimers();
	$("#form_utilizador").val("");
	$("#form_password").val("");
	$('#painel_login').modal({overlayClose:true});
}

function nextMonth(){
	data = new Date(start_year, start_month + 1, 1);
	start_month = data.getMonth();
	start_year = data.getFullYear();
	makeMonthsCalendar();
	clearTimers();
}

function prevMonth(){
	data = new Date(start_year, start_month - 1, 1);
	start_month = data.getMonth();
	start_year = data.getFullYear();
	makeMonthsCalendar();
	clearTimers();
}

function nextWeek(){
	data = new Date(
		selected_day.getFullYear(), 
		selected_day.getMonth(), 
		selected_day.getDate() + 7
	);
	selected_day = data;
	makeWeekCalendar();
	clearTimers();
}
function setWeekDay(ano, mes, dia){
	data = new Date(ano, mes, dia);
	selected_day = data;
	makeWeekCalendar();
	clearTimers();
	mes = mes < 10 ? '0' + mes : mes;
	dia = dia < 10 ? '0' + dia : dia;
	id = ano+""+mes+""+dia;
	form_mes = "";
	if(!avals[id]){ 
		form_mes += "no info";
	} else {
		for (i in avals[id]){
			if(role == "coordenador") form_mes += getDayFormCoordenador(id, i)+"<hr>";
			else if(role == 'docente') form_mes += getDayFormDocente(id, i)+"<hr>";
			else form_mes += getDayFormAluno(id, i)+"<hr>";
		}
	}
	$("#detalhes").html(form_mes);
}
function prevWeek(){
	data = new Date(
		selected_day.getFullYear(), 
		selected_day.getMonth(), 
		selected_day.getDate() - 7
	);
	selected_day = data;
	makeWeekCalendar();
	clearTimers();
}

// CALENDÁRIO SEMANAL
function makeWeekCalendar(){
	current_view = "semanal";
	dia_escolhido = selected_day.getDay();
	mes = selected_day.getMonth();
	ano = selected_day.getFullYear();
	target = "calendario";
	msg = new Array(
			new Array(), 
			new Array(), 
			new Array(), 
			new Array()
	);
	first_day = new Date(ano,mes,selected_day.getDate() - dia_escolhido);
	classes = new Array("titulo_semana", "ano_um", "ano_dois", "ano_tres");
	for(i = 0; i < 7; i++){
		current_day = new Date(
			first_day.getFullYear(), 
			first_day.getMonth(),
			first_day.getDate() + i
		);
		a = current_day.getMonth();
		ident = "d"+current_day.getDate();
		ident += "m"+a;
		ident += "a"+current_day.getFullYear()+"_";
		msg[0][i] = "<td";
		if(current_day.getDay() == selected_day.getDay()){
			msg[0][i] += " class=\""+cores[1]+"\" ";
		}
		msg[0][i] += "><div onclick=\"setWeekDay("+current_day.getFullYear();
		msg[0][i] += ","+current_day.getMonth();
		msg[0][i] += ","+current_day.getDate()+");\" >";
		msg[0][i] += week_days[current_day.getDay()][1]+"<br />";
		msg[0][i] += current_day.getDate()+" ";
		msg[0][i] += months[current_day.getMonth()][0] + " ";
		msg[0][i] += current_day.getFullYear();
		msg[0][i] += "</div></td>";
		msg[1][i] = "<td><div id='"+ident+"1'>&nbsp;</div></td>";
		msg[2][i] = "<td><div id='"+ident+"2'>&nbsp;</div></td>";
		msg[3][i] = "<td><div id='"+ident+"3'>&nbsp;</div></td>";
	}
	document.getElementById("semana").checked = true;
	msg_final = "<table id=\"semana\">";
	for(i = 0; i < 4; i++){
		msg_final += "<tr class=\""+classes[i]+"\">"
		for(j = 0; j < 7; j++){
			msg_final += msg[i][j];
		}
		msg_final += "</tr>";
	}
	
	msg_final += "</table>";
	$('#prev').html("<img src=\"imagens/prev.jpg\" onmouseup=\"prevWeek()\" title=\"Retroceder uma semana\" alt=\"seta à esquerda\" />");
	//$('#prev').html("<img src=\"imagens/prev.jpg\" onmouseup=\"prevMonth()\" />");
	$('#next').html("<img src=\"imagens/next.jpg\" onmouseup=\"nextWeek()\" title=\"Avançar uma semana\" alt=\"seta à direita\" />");
	//$('#next').html("<img src=\"imagens/next.jpg\" onmouseup=\"nextMonth()\" />");
	$('#calendario').html(msg_final);
	//$('#'+target).html(msg);
	
	recolor();
}

// CALENDÁRIO MENSAL
function makeMonthsCalendar(){
	current_view = "mensal";
	mes = start_month;
	ano = start_year;
	lenght = tamanho;
	msg = "";
	tamanho = lenght;
	document.getElementById("semestre").checked = true;
	
	for(i = 0; i < lenght; i++){
		date = new Date(ano, mes + i, 1);
		month = date.getMonth();
		year = date.getFullYear();
		msg += "<div id=\"mes\">";
		msg += "<table class=\"mes\"><tr class=\"calendario_titulo_mes\">";
		msg += "<td colspan=\"7\">";
		msg += months[month][1] + ", " + year;
		msg += "</td></tr><tr class=\"calendario_titulo_dias\">";
		for(k = 0; k < 7; k++){
			msg += "<td>" + week_days[k][0] + "</td>";
		}
		
		msg += "</tr>" + buildMonth(month, year);
		msg +="</table>";
		msg += "</div>";
	}
	$('#prev').html("<img src=\"imagens/prev.jpg\" onmouseup=\"prevMonth()\" title=\"Retroceder um mês\" alt=\"seta à esquerda\" />");
	$('#next').html("<img src=\"imagens/next.jpg\" onmouseup=\"nextMonth()\" title=\"Avançar um mês\" alt=\"seta à direita\" />");
	$('#calendario').html(msg);
	recolor();
}

// RECOLORIR OS DIAS
function recolor(){
	if(current_view == "mensal"){
		msg = new Array();
		$(avaliacoes).find('avaliacao').each(function(){
			elm = $(this);
			cur_div = "#d"+elm.find('data').find('dia').text();
			cur_div += "m"+elm.find('data').find('mes').text();
			cur_div += "a"+elm.find('data').find('ano').text();
			
			//campo para colorir
			if(role == 'coordenador'){
				valor = 3 - parseInt(elm.find("validada").text());
			} else if(role == 'docente'){
				valor = parseInt(elm.find("carga").text())+2;
			} else {
				valor = 3 - parseInt(elm.find("inscrito").text());
			}
			if(msg[cur_div]){
				msg[cur_div] = Math.max(valor, msg[cur_div]);
			} else {
				msg[cur_div] = valor;
			}
		});
		dia = selected_day.getDate();
		mes = selected_day.getMonth();
		ano = selected_day.getFullYear();
		novo_dia = "#d"+dia+"m"+mes+"a"+ano;
		if($(novo_dia)) $(novo_dia).addClass(cores[1]);
		
		for(var i in msg){
			if($(i)){
				$(i).removeClass();
				$(i).addClass("dia_mes");
				$(i).addClass(cores[msg[i]]);
			}
		}
		
	} else if(current_view == "semanal"){
		msg = new Array();
			$(avaliacoes).find('avaliacao').each(function(){
				elm = $(this);
				cur_div = "#d"+elm.find('data').find('dia').text();
				cur_div += "m"+elm.find('data').find('mes').text();
				cur_div += "a"+elm.find('data').find('ano').text();
				cur_div += "_"+elm.find('ano_curso').text();
				if(role == 'coordenador'){
					valor = 3 - parseInt(elm.find("validada").text());
				} else if(role == 'docente'){
					valor = parseInt(elm.find("carga").text())+2;
				} else {
					valor = 3 - parseInt(elm.find("inscrito").text());
				}
				if(msg[cur_div]){
					msg[cur_div] += "<table><tr><td class=\"d"+valor+"\">&nbsp;</td>";
					msg[cur_div] += "<td>" + elm.find('min').text();
					
				} else {
					msg[cur_div] = "<table><tr><td class=\"d"+valor+"\">&nbsp;</td>";
					msg[cur_div] += "<td>" + elm.find('min').text();
					msg[cur_div] += "</td></tr></table>";
				}
				
				
				if($(cur_div).length > 0)
					$(cur_div).html(msg[cur_div]);
		});
		
	}
}

// NOVO DIA SELECCIONADO
function setDay(ano, mes, dia){
	mes = mes < 10 ? '0' + mes : mes;
	dia = dia < 10 ? '0' + dia : dia;
	id = ano+''+mes+''+dia;
	alvo = "#d"+selected_day.getDate() + 
		"m"+selected_day.getMonth() + 
		"a"+selected_day.getFullYear();
	form_mes = "";
	if($(alvo)){
		$(alvo).addClass(cores[0]);
		$(alvo).removeClass(cores[1]);
	}
	start_day = dia;
	selected_day = new Date(ano, mes, dia);
	recolor();
	if(!avals[id]){ 
		form_mes += "no info";
	} else {
		for (i in avals[id]){
			if(role == "coordenador") form_mes += getDayFormCoordenador(id, i)+"<hr>";
			else if(role == 'docente') form_mes += getDayFormDocente(id, i)+"<hr>";
			else form_mes += getDayFormAluno(id, i)+"<hr>";
		}
	}
	$("#detalhes").html(form_mes);
}

function getDayFormDocente(id, i){
	ano = $(avals[id][i]).find("ano").text();
	mes = $(avals[id][i]).find("mes").text();
	dia = $(avals[id][i]).find("dia").text();
	horas = $(avals[id][i]).find("hora").text();
	minutos = $(avals[id][i]).find("minutos").text();
	disciplina = $(avals[id][i]).find("disciplina").text();
	tipo = $(avals[id][i]).find("tipo").text();
	peso_disciplina = $(avals[id][i]).find("disc").text();
	peso_curso = $(avals[id][i]).find("curso").text();
	alunos = $(avals[id][i]).find("alunos").text();
	salas = new Array();
	$(avals[id][i]).find("salas").each(
		function(){
			salas.push($(this).find("sala").text());
		}
	);
	carga = $(avals[id][i]).find("carga").text();

	texto = "<span class=\datas\">";
	texto += dia+months[mes][0]+ano+" &mdash; "+horas+"h"+minutos;
	texto += "</span><br /><span class=\"disciplina\">";
	texto += disciplina;
	texto +="</span><br /><span class=\"texto\">"+tipo+"</span>";
	texto +="<table class=\"detalhes\"><tr><td colspan=\"2\">";
	texto += "peso da avalia&ccedil;&atilde;o</td>";
	texto += "<td rowspan=\"2\">alunos inscritos</td>";
	texto += "<td rowspan=\"2\">sala(s)</td></tr>";
	texto += "<tr><td>disciplina</td><td>curso</td></tr>";
	texto += "<tr><td>"+peso_disciplina+"</td>";
	texto += "<td>"+peso_curso+"</td><td>"+alunos+"</td>";
	texto += "<td>";
	for(s in salas){
		texto += salas[s]+"<br />";
	}
	texto += "</td></tr></table>";
	texto += "<input type=\"button\" id=\"eliminar_avaliacao\" value=\"";
	texto += "cancelar avaliação\"";
	texto += " onclick=\"eliminar_avaliacao("+id+","+i+");\" />";
	texto += "<input type=\"button\" id=\"data\" value=\"alterar data\" />";
	texto += "<input type=\"button\" id=\"sala\" value=\"alterar sala\" />";
	return texto;
}

function getDayFormCoordenador(id, i){
	ano = $(avals[id][i]).find("ano").text();
	mes = $(avals[id][i]).find("mes").text();
	dia = $(avals[id][i]).find("dia").text();
	horas = $(avals[id][i]).find("hora").text();
	minutos = $(avals[id][i]).find("minutos").text();
	disciplina = $(avals[id][i]).find("disciplina").text();
	tipo = $(avals[id][i]).find("tipo").text();
	peso_disciplina = $(avals[id][i]).find("disc").text();
	peso_curso = $(avals[id][i]).find("curso").text();
	alunos = $(avals[id][i]).find("alunos").text();
	salas = new Array();
	$(avals[id][i]).find("salas").each(
		function(){
			salas.push($(this).find("sala").text());
		}
	);
	validar = $(avals[id][i]).find("validada").text();

	texto = "<span class=\datas\">";
	texto += dia+months[mes][0]+ano+" &mdash; "+horas+"h"+minutos;
	texto += "</span><br /><span class=\"disciplina\">";
	texto += disciplina;
	texto +="</span><br /><span class=\"texto\">"+tipo+"</span>";
	texto +="<table class=\"detalhes\"><tr><td colspan=\"2\">";
	texto += "peso da avalia&ccedil;&atilde;o</td>";
	texto += "<td rowspan=\"2\">alunos inscritos</td>";
	texto += "<td rowspan=\"2\">sala(s)</td></tr>";
	texto += "<tr><td>disciplina</td><td>curso</td></tr>";
	texto += "<tr><td>"+peso_disciplina+"</td>";
	texto += "<td>"+peso_curso+"</td><td>"+alunos+"</td>";
	texto += "<td>";
	for(s in salas){
		texto += salas[s]+"<br />";
	}
	texto += "</td></tr></table>";
	texto += "<input type=\"button\" id=\""+b_validar[validar][0]+"\" value=\"";
	texto += b_validar[validar][1]+"\"";
	texto += " onclick=\""+b_validar[validar][0]+"_avaliacao("+id+","+i+");\" />";
	texto += "<input type=\"button\" id=\"data\" value=\"alterar data\" />";
	texto += "<input type=\"button\" id=\"sala\" value=\"alterar sala\" />";
	return texto;
}

function getDayFormAluno(id, i){
	ano = $(avals[id][i]).find("ano").text();
	mes = $(avals[id][i]).find("mes").text();
	dia = $(avals[id][i]).find("dia").text();
	horas = $(avals[id][i]).find("hora").text();
	minutos = $(avals[id][i]).find("minutos").text();
	disciplina = $(avals[id][i]).find("disciplina").text();
	tipo = $(avals[id][i]).find("tipo").text();
	peso_disciplina = $(avals[id][i]).find("disc").text();
	peso_curso = $(avals[id][i]).find("curso").text();
	alunos = $(avals[id][i]).find("alunos").text();
	salas = new Array();
	$(avals[id][i]).find("salas").each(
		function(){
			salas.push($(this).find("sala").text());
		}
	);
	inscrito = $(avals[id][i]).find("inscrito").text();

	texto = "<span class=\datas\">";
	texto += dia+months[mes][0]+ano+" &mdash; "+horas+"h"+minutos;
	texto += "</span><br /><span class=\"disciplina\">";
	texto += disciplina;
	texto +="</span><br /><span class=\"texto\">"+tipo+"</span>";
	texto +="<table class=\"detalhes\"><tr><td colspan=\"2\">";
	texto += "peso da avalia&ccedil;&atilde;o</td>";
	texto += "<td rowspan=\"2\">alunos inscritos</td>";
	texto += "<td rowspan=\"2\">sala(s)</td></tr>";
	texto += "<tr><td>disciplina</td><td>curso</td></tr>";
	texto += "<tr><td>"+peso_disciplina+"</td>";
	texto += "<td>"+peso_curso+"</td><td>"+alunos+"</td>";
	texto += "<td>";
	for(s in salas){
		texto += salas[s]+"<br />";
	}
	texto += "</td></tr></table>";
	texto += "<input type=\"button\" id=\""+b_inscrever[inscrito][0]+"\" value=\"";
	texto += b_inscrever[inscrito][1]+"\"";
	texto += " onclick=\""+b_inscrever[inscrito][0]+"_inscricao("+id+","+i+");\" />";
	texto += "<input type=\"button\" id=\"detalhes_aval\"";
	texto += " value=\"detalhes da avalia&ccedil;&atilde;o\"";
	texto += " onclick=\"detalhes_avaliacao("+id+","+i+");\" />";
	return texto;
}

function detalhes_avaliacao(id, i){
	ano = $(avals[id][i]).find("ano").text();
	mes = $(avals[id][i]).find("mes").text();
	dia = $(avals[id][i]).find("dia").text();
	horas = $(avals[id][i]).find("hora").text();
	minutos = $(avals[id][i]).find("minutos").text();
	
	data = "<b>Data: </b>" + dia + months[mes][0] + ano;
	data += " &mdash; " + horas + "h" + minutos;
	
	salas = "<b>Sala(s):</b> ";
	$(avals[id][i]).find("salas").each(
		function(){
			salas += $(this).find("sala").text() + "<br />";
		}
	);
	peso = "<b>Peso na Disciplina:</b> ";
	peso += $(avals[id][i]).find("disc").text();
	peso += "% <b>Peso no Curso:</b> ";
	peso += $(avals[id][i]).find("curso").text() + "%";
	
	$('#detalhes_disciplina').html($(avals[id][i]).find("disciplina").text());
	$('#detalhes_data').html(data);
	$('#detalhes_descricao').html($(avals[id][i]).find("detalhes").text());
	$('#detalhes_restricoes').html($(avals[id][i]).find("restricoes").text());
	$('#detalhes_salas').html(salas);
	$('#detalhes_pesos').html(peso);
	$('#detalhes_avaliacao').modal({overlayClose:true});
}

function eliminar_avaliacao(a, b){ 
    $(avals[a][b]).empty();
	arrangeAvals();
	if(current_view == 'mensal'){
		makeMonthsCalendar();
	} else {
		makeWeekCalendar();
	}
	setDay(ano, mes, dia);
	alerta("AVALIA&Ccedil;&Atilde;O ELIMINADA", 2, true);
}

function validar_inscricao(a, b){
	$(avals[a][b]).find("inscrito").empty();
	$(avals[a][b]).find("inscrito").text(1);
	setDay(ano, mes, dia);
	alerta("INSCRI&Ccedil;&Atilde;O EFECTUADA", 2, true);
}
function cancelar_inscricao(a, b){
	$(avals[a][b]).find("inscrito").empty();
	$(avals[a][b]).find("inscrito").text(0);
	setDay(ano, mes, dia);
	alerta("INSCRI&Ccedil;&Atilde;O CANCELADA", 2, true);
}
function validar_avaliacao(a, b){
	$(avals[a][b]).find("validada").empty();
	$(avals[a][b]).find("validada").text(1);
	setDay(ano, mes, dia);
	alerta("AVALIA&Ccedil;&Atilde;O VALIDADA", 2, true);
}
function cancelar_avaliacao(a, b){
	$(avals[a][b]).find("validada").empty();
	$(avals[a][b]).find("validada").text(0);
	setDay(ano, mes, dia);
	alerta("AVALIA&Ccedil;&Atilde;O CANCELADA", 2, true);
}
// CONSTRUIR MESES
function buildMonth(mes, ano){
	first = new Date(ano, mes, 1);
	first = first.getDay();
	days = leapYear(ano) ? leap[mes] : no_leap[mes];
	msg = "<tr>";
	for( j = 0; j < 42; j++){
		if( j > 0 && j % 7 == 0 ){
			msg +="</tr><tr>";
		}
		msg += "<td ";
		if(j >= first && (j-first) < days){
			msg += "class=\"calendario_dias\">";
			dia = j - first + 1;
			data = new Date(ano, mes, dia);
			
			msg += "<div id=\"d"+dia+"m"+mes+"a"+ano+"\" ";
			msg += "class=\"dia_mes\" onclick=\"setDay("+ano+","+mes+","+dia+")\"";
			msg += " title=\"";
			msg += week_days[data.getDay()][2];
			msg += ", "+dia+" de " + months[mes][1] + " de " + ano;
			msg += "\" >";
			msg += j - first + 1;
			msg += "</div>";
		} else {
			msg += ">";
			msg += "&nbsp;";
		}
		msg += "</td>"; 
	}
	msg += "</tr>";
	return msg;
}

// VERIFICAR SE É ANO BISSEXTO
function leapYear(year){
  if(year > 0)
	  if (0 == (year % 400)) return true;
	  else {
		if ((year % 4) == 0 && (year % 100) != 0) return true;
		else return false;
	  }
  else return null;
}