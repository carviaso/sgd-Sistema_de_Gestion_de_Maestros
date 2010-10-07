<?php

class ProfessorV {

	function ProfessorV() {}

	function printFormCadProfessor( $departamentos, $categoriasFuncionais, $tipoTitulacoes, $cargos, $situacoes ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "departamentos", $departamentos );
		$smarty->assign( "categoriasFuncionais", $categoriasFuncionais );
		$smarty->assign( "tipoTitulacoes", $tipoTitulacoes );
		$smarty->assign( "cargos", $cargos );
		$smarty->assign( "situacoes", $situacoes );
		$smarty->display('professor.tpl');
	}

	function printFormCadRegTrabProfessor( $professores, $regimesTrabalho ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professores", $professores );
		$smarty->assign( "regimesTrabalho", $regimesTrabalho );
		$smarty->display('regTrabProfessor.tpl');
	}

	function printFormCadAfastamentoProfessor( $professores, $instituicoes, $tiposAfastamento, $tiposTitulacao ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professores", $professores );
		$smarty->assign( "instituicoes", $instituicoes );
		$smarty->assign( "tiposAfastamento", $tiposAfastamento );
		$smarty->assign( "tiposTitulacao", $tiposTitulacao );
		$smarty->display('formAfastamentoProfessor.tpl');
	}

	function printFormCadProgFuncProfessor( $professores, $categoriasFuncionais ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professores", $professores );
		$smarty->assign( "categoriasFuncionais", $categoriasFuncionais );
		$smarty->display('formProgressaoFuncionalProfessor.tpl');
	}

	function listarProfessores( $professores ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professores", $professores );
		$smarty->assign( "emissao", date('d/m/Y H:i:s P') );
		$smarty->display('listarProfessores.tpl');
	}

	function mostraDetalhesProfessor( $professor ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professor", $professor );
		$smarty->display('mostraDetalhesProfessor.tpl');
	}

	function mostraProgressaoFuncional( $progressaoFuncional ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "progressaoFuncional", $progressaoFuncional );
		$smarty->display('mostraProgressaoFuncional.tpl');
	}

	public function imprimirFicha( $professor, $progressoes ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professor", $professor );
		$smarty->assign( "progressoes", $progressoes );
		$smarty->assign( "data", date( 'd/m/Y' ) );
		$smarty->assign( "dia", date( 'd' ) );
		$smarty->assign( "mes", date( 'm' ) );
		$smarty->assign( "ano", date( 'Y' ) );
		$dataHelper = new DataHelper();
		$mesExtenso = $dataHelper->mesExtenso( date( 'm' ) );
		$smarty->assign( "mesExtenso", $mesExtenso );
		return $smarty->fetch('imprimirFicha.tpl');
	}

	function printFormUser( $professor ) {
		$smarty = new Smarty();
		$smarty->template_dir = 'views/professor/templates/';
		$smarty->compile_dir  = '../tmp/templates_c/';
		$smarty->cache_dir    = '../tmp/cache/';
		$smarty->config_dir   = 'views/configs/';
		$smarty->assign( "professor", $professor );
		$smarty->display('printFormUser.tpl');
	}
}

?>