<?php

class ProfessorC {

	private $model;
	private $view;

	/**
	 * Contrutor
	 *
	 * @return void
	 */
	public function ProfessorC() {
		$this->model = new ProfessorM();
		$this->view = new ProfessorV();
	}

	/**
	 * Retorna um array com todos os objetos Professores
	 *
	 * @return array
	 */
	public function getAllProfessores( $returnType, $filtro ) {
		$return = $this->model->getAllProfessores( $filtro );
		if ( $returnType == 'json' ) {
			echo json_encode( $return );
		} else {
			return $return;
		}
	}

	/**
	 * Pesquisa o professor e retorna informacoes gerais
	 *
	 * @return void
	 */
	public function relGeralProfessor() {
		$this->view->relGeralProfessor();
	}

	/**
	 * Retorna diversos detalhes do professor
	 *
	 * @return void
	 */
	public function detalheGeralProfessor( $idProfessor ) {
		$filtro = new stdClass();
		$params = new stdClass();
		$params->idProfessor = $idProfessor;
		$filtro->tipo = 'byIdProfessor';
		$filtro->params = $params;
		$filtro = json_encode( $filtro );
		$departamentoC = new DepartamentoC();
		$departamento = $departamentoC->getDepartamentos( '', $filtro );
		$regimeC = new RegimeTrabalhoC();
		$regimesTrabalho = $regimeC->getAllRegimesTrabalho( $filtro );
		$processoC = new ProcessoC();
		$processosProfessor = $processoC->getAllProcessos( $filtro );
		$portariaC = new PortariaC();
		$portariasProfessor = $portariaC->getAllPortarias( $filtro );
		$this->view->detalheGeralProfessor( $departamento, $regimesTrabalho, $processosProfessor, $portariasProfessor );
	}

	/**
	 * Mostra os detalhes do professor desejado
	 *
	 * @return void
	 */
	public function relAfastamentoAposentadoria() {
		$tipoAfastastamentoC = new TipoAfastamentoController();
		$tiposAfastamentos = $tipoAfastastamentoC->getAll();
		$this->view->relAfastamentoAposentadoria( $tiposAfastamentos );
	}

	/**
	 * Exibe todos os professores que estao aposentados ou afastados ate determinado periodo
	 *
	 * @return void
	 */
	public function pesquisarAfastamentoAposentadoria( $dataInicial, $dataFinal, $aposentado, $tipos ) {
		/**@todo validar campos*/
		$professores = $this->model->pesquisarAfastamentoAposentadoria( $dataInicial, $dataFinal, $aposentado, $tipos );
		$this->view->pesquisarAfastamentoAposentadoria( $professores, $aposentado );
	}

	/**
	 * Retorna um array com todos os professores no formato json para preenchimento de datatable
	 *
	 * @return json
	 */
	public function getAllProfessoresJson( $page, $limit, $sidx, $sord, $wh ) {
		$count = $this->model->countTotalProfessores( $wh );

		if( $count > 0 ) {
			$total_pages = ceil( $count / $limit );
		} else {
			$total_pages = 0;
		}
		if ( $page > $total_pages ) {
			$page = $total_pages;
		}
		$start = $limit * $page - $limit;
		if( $start < 0 ) $start = 0;
		if( !$sidx ) $sidx = 1;

		echo json_encode( $this->model->getAllProfessoresJson( $start, $limit, $sidx, $sord, $count, $total_pages, $page, $wh ) );
	}

	/**
	 * Retorna o professor com nome like param
	 *
	 * @param int $nameParam
	 * @return json
	 */
	public function findProfessorByName( $nameParam ) {
		echo json_encode( $this->model->findProfessorByName( $nameParam ) );
	}

	/**
	 * Retorna um array com todos os objetos Professores por centro
	 *
	 * @return array
	 */
	public function getProfessoresPorDepartamento( $idDepartamento ) {
		return $this->model->getProfessoresPorDepartamento( $idDepartamento );
	}

	/**
	 * Realiza o cadastro de um novo professor
	 *
	 * @return json
	 */
	public function cadastrarProfessor( $nome, $dataNascimento, $matricula, $siape, $dataAdmissao, $dataAdmissaoUfsc, $dataPrevistaAposentadoria, $dataEfetivaAposentadoria, $idDepartamento, $idCategoriaFuncionalInicial,	$idCategoriaFuncionalAtual, $idTipoTitulacao, $idCategoriaFuncionalReferencia, $idCargo, $idRegimeTrabalho, $idSituacao, $idStatusAtualProfessor ) {
		$erro = array();
		if ( empty( $nome) ) $erro[] = 'Nome';
		if ( empty( $dataNascimento) ) $erro[] = 'Data nascimento';
		if ( empty( $matricula) ) $erro[] = 'Matricula';
		if ( empty( $siape) ) $erro[] = 'Siape';
		if ( empty( $dataAdmissao) ) $erro[] = 'Data admissao';
		if ( empty( $dataAdmissaoUfsc) ) $erro[] = 'Data admissao UFSC';
		//if ( empty( $dataPrevistaAposentadoria) ) $erro[] = 'Data prevista aposentadoria';
		//if ( empty( $dataEfetivaAposentadoria) ) $erro[] = 'Data efetiva aposentadoria';
		if ( $idRegimeTrabalho == '' ) $erro[] = 'Regime de trabalho';
		if ( $idStatusAtualProfessor == '' ) $erro[] = 'Status Atual do professor';

		if ( count( $erro ) == 0 ) {
			$return = $this->model->cadastrarProfessor( $nome, $dataNascimento, $matricula, $siape, $dataAdmissao, $dataAdmissaoUfsc, $dataPrevistaAposentadoria, $dataEfetivaAposentadoria, $idDepartamento, $idCategoriaFuncionalInicial, $idCategoriaFuncionalAtual, $idTipoTitulacao, $idCategoriaFuncionalReferencia, $idCargo, $idRegimeTrabalho, $idSituacao, $idStatusAtualProfessor );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}

	/**
	 * Realiza o cadastro do regime de trabalho de um professor
	 *
	 * @return json
	 */
	public function cadastrarRegimeTrabalhoProfessor( $idProfessor, $idRegimeTrabalho, $processo, $deliberacao, $portaria, $dataInicio ) {
		$erro = array();
		if ( $idProfessor <= 0 ) $erro[] = 'Professor';
		if ( empty( $processo) ) $erro[] = 'Processo';
		if ( empty( $deliberacao) ) $erro[] = 'Deliberacao';
		//if ( empty( $portaria) ) $erro[] = 'Portaria';
		//if ( empty( $dataInicio) ) $erro[] = 'Data de Inicio';

		if ( count( $erro ) == 0 ) {
			$return = $this->model->cadastrarRegimeTrabalhoProfessor( $idProfessor, $idRegimeTrabalho, $processo, $deliberacao, $portaria, $dataInicio );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}

	/**
	 * Realiza o cadastro de afastamento de um professor
	 *
	 * @return json
	 */
	public function cadastrarAfastamentoProfessor( $idProfessor, $idInstituicao, $idTipoAfastamento, $idTipoTitulacao, $dataInicio, $dataPrevisaoTermino, $processo, $prorrogacao, $observacao ) {
		$erro = array();
		if ( empty( $idProfessor ) ) $erro[] = 'Professor';
		if ( empty( $idInstituicao ) ) $erro[] = 'Instituicao';
		if ( empty( $idTipoAfastamento ) ) $erro[] = 'Tipo de Afastamento';
		if ( empty( $idTipoTitulacao ) ) $erro[] = 'Titulacao';
		if ( empty( $dataInicio ) ) $erro[] = 'Data de Inicio';
		if ( empty( $dataPrevisaoTermino ) ) $erro[] = 'Data de Previsao de Termino';
		if ( empty( $processo ) ) $erro[] = 'Processo';
		if ( $prorrogacao == '' ) $erro[] = 'Prorrogacao';

		if ( count( $erro ) == 0 ) {
			$return = $this->model->cadastrarAfastamentoProfessor( $idProfessor, $idInstituicao, $idTipoAfastamento, $idTipoTitulacao, $dataInicio, $dataPrevisaoTermino, $processo, $prorrogacao, $observacao );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}

	/**
	 * Realiza o cadastro de afastamento de um professor
	 *
	 * @return json
	 */
	public function cadastrarProgressaoFuncionalProfessor( $idProfessor, $idCategoriaFuncional, $processo, $tituloAvaliacao, $dataAvaliacao, $notaAvaliacao, $aPartirDe, $portaria, $observacoes ) {
		$erro = array();
		if ( empty( $idProfessor ) ) $erro[] = 'Professor';
		if ( empty( $idCategoriaFuncional ) ) $erro[] = 'Categoria Funcional';
		//if ( empty( $processo ) ) $erro[] = 'Processo';
		if ( empty( $tituloAvaliacao ) ) $erro[] = 'Titulo Avaliacao';
		//if ( empty( $dataAvaliacao ) ) $erro[] = 'Data Avaliacao';
		//if ( empty( $notaAvaliacao ) ) $erro[] = 'Nota Avaliacao';
		if ( empty( $aPartirDe ) ) $erro[] = 'A partir de';
		if ( empty( $portaria ) ) $erro[] = 'Portaria';

		if ( count( $erro ) == 0 ) {
			$return = $this->model->cadastrarProgressaoFuncionalProfessor( $idProfessor, $idCategoriaFuncional, $processo, $tituloAvaliacao, $dataAvaliacao, $notaAvaliacao, $aPartirDe, $portaria, $observacoes );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}

	/**
	 * Lista todos os professores
	 *
	 * @return json
	 */
	public function listarProfessores() {
		$professores = $this->getAllProfessores( '', '' );
		return $this->view->listarProfessores( $professores );
	}

	/**
	 * Mostra os detalhes do professor desejado
	 *
	 * @return void
	 */
	public function mostraDetalhesProfessor( $idProfessor ) {
		$professor = $this->model->getProfessorPorId( $idProfessor );
		$this->view->mostraDetalhesProfessor( $professor );
	}

	/**
	 * Mostra os detalhes da progressao funcional do professor
	 *
	 * @return void
	 */
	public function mostraProgressaoFuncional( $idProfessor ) {
		$progressaoFuncional = $this->model->getAllProgressaoFuncionalProfessor( $idProfessor );
		$this->view->mostraProgressaoFuncional( $progressaoFuncional );
	}

	/**
	 * Imprime a ficha em formato PDF do professor
	 *
	 * @return pdf
	 */
	public function imprimirFicha( $idProfessor ) {
		$professor = $this->model->getProfessorPorId( $idProfessor );
		$progressoes = $this->model->getAllProgressaoFuncionalProfessor( $idProfessor );
		$content = $this->view->imprimirFicha( $professor, $progressoes );

		$mpdf = new mPDF();
		$stylesheet = file_get_contents('../public/css/imprimirFicha.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML( $content );
		$mpdf->Output( "../tmp/cache/{$idProfessor}.pdf", 'F' );
		$return['id'] = $idProfessor;
		echo json_encode($return);
	}

	/**
	 * Imprime um formulario para edicao dos dados do usuario logado
	 *
	 * @return void
	 */
	public function printFormUser( $idProfessor ) {
		$professor = $this->model->getProfessorPorId( $idProfessor );
		$this->view->printFormUser( $professor );
	}

	/**
	 * Esta fun��o serve para retornar Todos os prof. Aposentados
	 *
	 * @return void
	 */
	public function relAposentados () {
		$aposentados = $this->model->relAposentados();
		$this->view->relAposentados( $aposentados );
	}

	/**
	 * Imprime o formulario para cadastro de um novo professor
	 *
	 * @return void
	 */
	public function printFormCadProfessor() {
		$departamentoC = new DepartamentoC();
		$departamentos = $departamentoC->getDepartamentos( '', '' );
		$categoriaFuncionalC = new CategoriaFuncionalController();
		$categoriasFuncionais = $categoriaFuncionalC->getCategoriaFuncional();
		$tipoTitulacaoC = new TipoTitulacaoController();
		$tipoTitulacoes = $tipoTitulacaoC->getAll();
		$cargoC = new CargoController();
		$cargos = $cargoC->getCargos();
		$regimeC = new RegimeTrabalhoC();
		$regimesTrabalho = $regimeC->getAllRegimesTrabalho( '' );
		$situacaoC = new SituacaoC();
		$situacoes = $situacaoC->getSituacoes();
		$professorV = new ProfessorV();
		$professorV->printFormCadProfessor( $departamentos, $categoriasFuncionais, $tipoTitulacoes, $cargos, $regimesTrabalho, $situacoes );
	}

	/**
	 * Atualiza os dados do usuario logado
	 *
	 * @return void
	 */
	public function updateUser( $nome, $dataNascimento, $siape, $senhaAtual, $novaSenha, $novaSenha2 ) {
		$erro = array();
		$atualizaSenha = false;
		if ( empty( $nome ) ) $erro[] = 'Nome';
		if ( empty( $dataNascimento ) ) $erro[] = 'Data de nascimento';
		if ( empty( $siape ) ) $erro[] = 'Siape';
		if ( !empty( $senhaAtual ) ) {
			if ( !empty( $novaSenha ) && !empty( $novaSenha2 ) ) {
				if ( $novaSenha != $novaSenha2 ) {
					$erro[] = 'Os campos da nova senha n�o conferem';
				} else {
					$atualizaSenha = true;
				}
			} else {
				$erro[] = 'Preencha todos os campos de senha';
			}
		}

		if ( count( $erro ) == 0 ) {
			$return = $this->model->updateUser( $nome, $dataNascimento, $siape, $senhaAtual, $novaSenha, $novaSenha2, $atualizaSenha );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}
}
?>