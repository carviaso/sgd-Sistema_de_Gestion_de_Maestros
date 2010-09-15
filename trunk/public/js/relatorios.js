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
				}).selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
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
				}).selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
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
				}).selectmenu({width: '100%', menuWidth: 200, maxHeight: 150, style:'popup'});
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
									colModel:[	{name:'acao',index:'acao', width:50, search:false },
												{name:'id_professor',index:'id_professor', width:35, searchoptions: { sopt: ['eq', 'ne', 'cn']}},
									          	{name:'nome',index:'nome', width:275, searchoptions: { sopt: ['eq', 'ne', 'cn']}},
									          	{name:'matricula',index:'matricula', width:90, searchoptions: { sopt: ['eq', 'ne', 'cn']}},
									          	{name:'siape',index:'siape', width:100, searchoptions: { sopt: ['eq', 'ne', 'cn']}}
									          ],
									rowNum:50, rowList:[50,100,200],
									pager: '#pagerListaProfessores',
									sortname: 'id_professor',
									viewrecords: true,
									sortorder: "asc",
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
										gb.processingClose();
									}
				}).navGrid("#pagerListaProfessores", {	refresh: true, 
														edit: false,
														add: false,
														del: false,
														search: true }, {},{},{}, {url:"app/frontController.php"});
			} );
		});
	}
};