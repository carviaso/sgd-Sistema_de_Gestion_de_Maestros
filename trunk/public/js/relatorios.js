var relatorios = {
	loadMenu: function() {
		$("#relCentros").click(function() {
			gb.processing();
			var params = { "action":"relCentros" };
			$('#content').load("app/frontController.php", params, function(){
				gb.processingClose();
			});
		});
		$("#relDepartamentos").click(function() {
			gb.processing();
			var params = { "action":"relDepartamentos" };
			$('#content').load("app/frontController.php", params, function(){
				gb.processingClose();
			} );
		});
		$("#relDiretoresCentros").click(function() {
			gb.processing();
			var params = { "action":"relDiretoresCentros" };
			$('#content').load("app/frontController.php", params, function() {
				$("#selectCentros").change(function() {
					var idCentro = $(this).val();
					var params = { "action":"relDiretorPorCentro", 'idCentro': idCentro };
					$('#departamentosPorCentro').load("app/frontController.php", params);
				});//.selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
				gb.processingClose();
			});
		});
		$("#relProfessoresDepartamento").click(function() {
			gb.processing();
			var params = { "action":"relProfessoresDepartamento" };
			$('#content').load("app/frontController.php", params, function() {
				$("#selectDepartamentos").change(function() {
					var idDepartamento = $(this).val();
					var params = { "action":"relProfessoresPorDepartamento", 'idDepartamento': idDepartamento };
					$('#professoresPorDepartamento').load("app/frontController.php", params);
				});//.selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
				gb.processingClose();
			});
		});
		$("#relDepartamentoCentro").click(function() {
			gb.processing();
			var params = { "action":"relDepartamentoCentro" };
			$('#content').load("app/frontController.php", params, function() {
				$("#selectCentros").change(function() {
					var idCentro = $(this).val();
					var params = { "action":"relDepartamentoPorCentro", 'idCentro': idCentro };
					$('#departamentosPorCentro').load("app/frontController.php", params);
				});//.selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
				gb.processingClose();
			});
		});
		$("#listarProfessores").click(function() {
			gb.processing();
			var params = { "action":"listarProfessores" };
			$('#content').load("app/frontController.php", params, function() {
				$("#listaProfessores").jqGrid({url:'app/frontController.php',
					postData: {'action':"getAllProfessoresJson"},
					mtype: 'POST',
					datatype: "json",
					colNames:['Acao', 'Id', 'Nome', 'Matricula', 'Siape' ],
					colModel:[	{name:'acao',index:'acao', width:80, search:false },
								{name:'id_professor',index:'id_professor', width:35 },
								{name:'nome',index:'nome', width:275 },
								{name:'matricula',index:'matricula', width:90 },
								{name:'siape',index:'siape', width:100 }
							],
					rowNum:50, rowList:[50,100,200],
					pager: '#pagerListaProfessores',
					sortname: 'id_professor',
					sortorder: "asc",
					viewrecords: true,
					shrinkToFit: false, // Exibir barra rolagem horizontal
					width:'600',
					height:'350',
					caption:"Relatorio de Professores",
					loadComplete: function() {
						$('.detalhesProfessor').click(function() {
							professores.progressaoFuncionalProfessor.mostraDetalhesProfessor( $(this).attr('id') );
						});
						$('.detalhesProgressaoFuncional').click(function() {
							professores.progressaoFuncionalProfessor.mostraProgressaoFuncional( $(this).attr('id') );
						});
						$('.imprimirFicha').click(function() {
							$.post("app/frontController.php", { 'action':'imprimirFicha', 'idProfessor':$(this).attr('id') }, function(data) {
								window.open("../sgd/tmp/cache/" + data.id + ".pdf", "_blank");
							}, 'json' );
						});
						gb.processingClose();
					}
				}).navGrid("#pagerListaProfessores", {
					refresh: true, 
					edit: false,
					add: false,
					del: false,
					search: true }, {},{},{},
					{	multipleSearch: true,
						odata : ['igual', 'diferente', 'menor', 'menor ou igual','maior','maior ou igual', 'come\u00E7a com','n\u00E3o come\u00E7a com','est\u00E1 contido','n\u00E3o est\u00E1 contido','termina com','n\u00E3o termina com','cont\u00E9m','n\u00E3o cont\u00E9m'],
						groupOps: [ { op: 'AND', text: 'todos' }, { op: 'OR',  text: 'ou' }] });
			});
		});
	}
};