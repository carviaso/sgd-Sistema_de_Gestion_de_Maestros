<?php

class ProfessorM {

	/**
	 * Construtor
	 *
	 * @return void
	 */
	public function ProfessorM() {}

	/**
	 * Retorna todos os professores
	 *
	 * @return array
	 */
	function getAllProfessores( $filtro ) {

		$professores = array();
		$where = array();
		$conexao = Conexao::con();

		if ( !empty( $filtro ) ) {
			$filtro = json_decode( $filtro );
			switch ( $filtro->tipo ) {
				case 'byIdDepartamento':
					$where[] = 'WHERE p.id_departamento = '. $filtro->params->idDepartamento;
				break;
			}
		}

		$sql[] = "SELECT p.*, c.descricao_cargo FROM professor p";
		$sql[] = "left join cargo c";
		$sql[] = "on p.id_cargo = c.id_cargo";
		$sql[] = join( ' ', $where );
		$sql[] = "ORDER BY p.nome";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass();
			$professor->id_professor = $row['id_professor'];
			$professor->nome = utf8_encode( $row['nome'] );
			$professor->matricula = utf8_encode( $row['matricula'] );
			$professor->siape = utf8_encode( $row['siape'] );
			$professor->dataAdmissao = $row['data_admissao'];
			$professor->dataAdmissaoUfsc = $row['data_admissao_ufsc'];
			$professor->dataNascimento = $row['data_nascimento'];
			$professor->dataPrevistaAposentadoria = $row['data_previsao_aposentadoria'];
			$professor->dataEfetivaAposentadoria = $row['data_aposentadoria'];
			$professor->idDepartamento = $row['id_departamento'];
			$professor->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$professor->idCategoriaFuncionalAtual = $row['id_categoria_funcional_atual'];
			$professor->idTipoTitulacao = $row['id_tipo_titulacao'];
			$professor->idCategoriaFuncionalReferencia = $row['id_categoria_funcional_referencia'];
			$professor->idCargo = $row['id_cargo'];
			$professor->idSituacao = $row['id_situacao'];
			$professor->descricaoCargo = $row['descricao_cargo'];
			$professores[] = $professor;
		}
		return $professores;
	}

	/**
	 * Retorna o professor pelo id
	 *
	 * @return stdClass
	 */
	function getProfessorPorId( $idProfessores ) {

		$conexao = Conexao::con();
		$d = new DataHelper();

		$sql[] = "SELECT
					p.id_professor,
					p.nome,
					p.matricula,
					p.siape,
					p.data_admissao,
					p.data_admissao_ufsc,
					p.data_nascimento,
					/*p.aposentado,*/
					p.data_previsao_aposentadoria,
					p.data_aposentadoria,
					p.id_departamento,
					p.id_categoria_funcional_inicial,
					p.id_categoria_funcional_atual,
					p.id_tipo_titulacao,
					p.id_categoria_funcional_referencia,
					p.id_cargo,
					p.id_regime_trabalho,
					p.id_situacao,

					d.id_centro,
					d.nome as nomeDepartamento,
					d.sigla as siglaDepartamento,

					cen.nome as nomeCentro,
					cen.sigla as siglaCentro,

					i.id_instituicao,
					i.id_municipio,
					i.nome as nomeInstituicao,
					i.sigla as siglaInstituicao,

					cfi.id_categoria_funcional as idCategoriaFuncionalInicial,
					cfi.descricao as descCategoriaFuncionalInicial,

					cfa.id_categoria_funcional as idCategoriaFuncionalAtual,
					cfa.descricao as descCategoriaFuncionalAtual,

					cfr.id_categoria_funcional as idCategoriaFuncionalReferencia,
					cfr.descricao as descCategoriaFuncionalReferencia,

					tt.id_tipo_titulacao as idTipoTitulacao,
					tt.descricao as descTipoTitulacao,

					c.id_cargo as idCargo,
					c.descricao_cargo as descricaoCargo,

					rt.descricao as descricao_regime_trabalho,
					rt.quantidade_horas as quantidade_horasRegime_trabalho,
					rt.dedicacao_exclusiva as dedicacao_exclusiva,

					s.id_situacao as idSituacao,
					s.descricao_situacao as descricaoSituacao,

					sa.descricao as descricaoSituacaoAtual

		FROM professor p";
		$sql[] = "left join departamento d";
		$sql[] = "on p.id_departamento = d.id_departamento";
		$sql[] = "left join centro cen";
		$sql[] = "on d.id_centro = cen.id_centro";
		$sql[] = "left join instituicao i";
		$sql[] = "on cen.id_instituicao = i.id_instituicao";
		$sql[] = "left join categoria_funcional cfi";
		$sql[] = "on p.id_categoria_funcional_inicial = cfi.id_categoria_funcional";
		$sql[] = "left join categoria_funcional cfa";
		$sql[] = "on p.id_categoria_funcional_atual = cfa.id_categoria_funcional";
		$sql[] = "left join categoria_funcional cfr";
		$sql[] = "on p.id_categoria_funcional_referencia = cfr.id_categoria_funcional";
		$sql[] = "left join tipo_titulacao tt";
		$sql[] = "on p.id_tipo_titulacao = tt.id_tipo_titulacao";
		$sql[] = "left join cargo c";
		$sql[] = "on p.id_cargo = c.id_cargo";
		$sql[] = "left join regime_trabalho rt";
		$sql[] = "on p.id_regime_trabalho = rt.id_regime_trabalho";
		$sql[] = "left join situacao s";
		$sql[] = "on p.id_situacao = s.id_situacao";
		$sql[] = "left join status_atual_professor sa";
		$sql[] = "on p.id_status_atual_professor = sa.id_status";
		$sql[] = "WHERE id_professor = {$idProfessores} ORDER BY p.nome";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		$professor = new stdClass();
		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor->id_professor = $row['id_professor'];
			$professor->nome = utf8_encode( $row['nome'] );
			$professor->matricula = utf8_encode( $row['matricula'] );
			$professor->siape = utf8_encode( $row['siape'] );
			$professor->dataAdmissao = $d->validaData( $row['data_admissao'] );
			$professor->dataAdmissaoUfsc = $d->validaData( $row['data_admissao_ufsc'] );
			$professor->dataNascimento = $d->validaData( $row['data_nascimento'] );
			$professor->dataPrevistaAposentadoria = $d->validaData( $row['data_previsao_aposentadoria'] );
			$professor->dataEfetivaAposentadoria = $d->validaData( $row['data_aposentadoria'] );
			$professor->idDepartamento = $row['id_departamento'];
			$professor->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$professor->idCategoriaFuncionalAtual = $row['id_categoria_funcional_atual'];
			$professor->idTipoTitulacao = $row['id_tipo_titulacao'];
			$professor->idCategoriaFuncionalReferencia = $row['id_categoria_funcional_referencia'];
			$professor->idCargo = $row['id_cargo'];
			$professor->idRegimeTrabalho = $row['id_regime_trabalho'];
			$professor->idSituacao = $row['id_situacao'];
			$professor->idStatus = $row['id_status'];

			$professor->nomeDepartamento = utf8_encode( $row['nomeDepartamento'] );
			$professor->siglaDepartamento = utf8_encode( $row['siglaDepartamento'] );

			$professor->idCentro = $row['id_centro'];
			$professor->nomeCentro = utf8_encode( $row['nomeCentro'] );
			$professor->siglaCentro = utf8_encode( $row['siglaCentro'] );

			$professor->idInstituicao = $row['id_instituicao'];
			$professor->idMunicipio = $row['id_municipio'];
			$professor->nomeInstituicao = utf8_encode( $row['nomeInstituicao'] );
			$professor->siglaInstituicao = utf8_encode( $row['siglaInstituicao'] );

			$professor->idCategoriaFuncionalInicial = $row['idCategoriaFuncionalInicial'];
			$professor->descCategoriaFuncionalInicial = utf8_encode( $row['descCategoriaFuncionalInicial'] );

			$professor->idCategoriaFuncionalAtual = $row['idCategoriaFuncionalAtual'];
			$professor->descCategoriaFuncionalAtual = utf8_encode( $row['descCategoriaFuncionalAtual'] );

			$professor->idTipoTitulacao = $row['idTipoTitulacao'];
			$professor->descTipoTitulacao = utf8_encode( $row['descTipoTitulacao'] );

			$professor->idCategoriaFuncionalReferencia = $row['idCategoriaFuncionalReferencia'];
			$professor->descCategoriaFuncionalReferencia = utf8_encode( $row['descCategoriaFuncionalReferencia'] );

			$professor->idCargo = $row['idCargo'];
			$professor->descricaoCargo = utf8_encode( $row['descricaoCargo'] );

			$professor->descricaoRegimeTrabalho = utf8_encode( $row['descricao_regime_trabalho'] );
			$professor->quantidadeHorasRegimeTrabalho = $row['quantidade_horasRegime_trabalho'];
			$professor->dedicacaoExclusiva = $row['dedicacao_exclusiva'];

			$professor->descricaoSituacao = utf8_encode( $row['descricaoSituacao'] );

			$professor->descricaoSituacaoAtual = utf8_encode( $row['descricaoSituacaoAtual'] );
		}
		return $professor;
	}

	/**
	 * Total de professores
	 *
	 * @return array
	 */
	function countTotalProfessores( $wh ) {
		$conexao = Conexao::con();

		$sql[] = "SELECT COUNT(*) AS count FROM professor p";
		$sql[] = "inner join departamento d";
		$sql[] = "on p.id_departamento = d.id_departamento";
		$sql[] = "{$wh}";
		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		$count = mysqli_fetch_array( $query, MYSQL_ASSOC );
		return $count['count'];
	}

	/**
	 * Retorna um array com todos os professores no formato json para preenchimento de datatable
	 *
	 * @return json
	 */
	function getAllProfessoresJson( $start, $limit, $sidx, $sord, $count, $total_pages, $page, $wh ) {

		$professores = array();
		$conexao = Conexao::con();

		$sql[] = "SELECT ";
		$sql[] = "p.id_professor, p.nome, p.matricula, p.siape, d.sigla as siglaDepartamento";
		$sql[] = "FROM professor p";
		$sql[] = "inner join departamento d";
		$sql[] = "on p.id_departamento = d.id_departamento";
		$sql[] = "{$wh}";
		$sql[] = "ORDER BY $sidx $sord LIMIT $start, $limit";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );
		$return->page = $page;
		$return->total = $total_pages;
		$return->records = $count;
		$i = 0;
		while ( $row = mysqli_fetch_array( $query ) ) {
			$return->rows[$i]['id'] = $row['id_professor'];

			$idProfessor = $row['id_professor'];
			$nome = utf8_encode( $row['nome'] );

			$return->rows[$i]['cell'] = array(
					"<div class='detalhesProfessor' title='Detalhes' id='{$idProfessor}'>&nbsp;</div><div class='detalhesProgressaoFuncional' title='Progressao Funcional' id='{$idProfessor}'>&nbsp;</div><div class='imprimirFicha' title='Imprimir Ficha Detalhada do Professor' id='{$idProfessor}'>&nbsp;</div>",
					$idProfessor,
					$nome,
					$row['matricula'],
					$row['siape'],
					$row['siglaDepartamento']
				);
			$i++;
		}
		return $return;
	}

	/**
	 * Retorna todos os departamentos por centro
	 *
	 * @param int $idCentro
	 * @return array
	 */
	function findProfessorByName( $nameParam ) {
		$professores = array();
		$conexao = Conexao::con();

		$nameParam = utf8_decode( $nameParam );
		$sql[] = "SELECT * FROM professor p";
		$sql[] = "WHERE p.nome LIKE '%{$nameParam}%'";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );
		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass;
			$professor->idProfessor = utf8_encode( $row['id_professor'] );
			$professor->value = utf8_encode( $row['nome'] );
			$professores[] = $professor;
		}
		return $professores;
	}
	
	/**
	 * Retorna todos os departamentos por centro
	 *
	 * @param int $idCentro
	 * @return array
	 */
	function relAposentados() {
		$aposentados = array();
		$conexao = Conexao::con();

		$sql[] = "SELECT * FROM professor p";
		$sql[] = "WHERE p.id_situacao = 2";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );
		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass;
			$professor->idProfessor = utf8_encode( $row['id_professor'] );
			$professor->nome = utf8_encode( $row['nome'] );
			$professores[] = $professor;
		}
		return $professores;
	}

	/**
	 * Retorna todos os professores por departamento
	 *
	 * @param int $idDepartamento
	 * @return array
	 */
	function getProfessoresPorDepartamento( $idDepartamento ) {

		$professores = array();
		$conexao = Conexao::con();

		$sql[] = "SELECT p.nome FROM professor AS p ";
		$sql[] = "LEFT JOIN departamento AS d ON p.id_departamento = d.id_departamento ";
		$sql[] = "WHERE d.id_departamento ='{$idDepartamento}' ORDER by p.nome";
		$query = mysqli_query( $conexao, join( '', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass();
			$professor->setNome = utf8_encode( $row['nome'] );
			$professores[] = $professor;
		}
		return $professores;
	}

	/**
	 * Realiza o cadastro de um novo professor
	 *
	 * @return stdClass
	 */
	public function cadastrarProfessor( $nome, $dataNascimento, $matricula, $siape, $dataAdmissao, $dataAdmissaoUfsc, $dataPrevistaAposentadoria, $dataEfetivaAposentadoria, $idDepartamento, $idCategoriaFuncionalInicial, $idCategoriaFuncionalAtual, $idTipoTitulacao, $idCategoriaFuncionalReferencia, $idCargo, $idRegimeTrabalho, $idSituacao, $idStatusAtualProfessor ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$dataNascimento = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataNascimento ) ) );
		$dataAdmissao = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataAdmissao ) ) );
		$dataAdmissaoUfsc = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataAdmissaoUfsc ) ) );
		$dataPrevistaAposentadoria = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataPrevistaAposentadoria ) ) );
		$dataEfetivaAposentadoria = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataEfetivaAposentadoria ) ) );

		$nome = utf8_decode( $nome );
		$matricula = utf8_decode( $matricula );
		$siape = utf8_decode( $siape );

		$sql[] = "INSERT INTO professor( nome, matricula, siape,";
		$sql[] = "data_admissao, data_admissao_ufsc, data_nascimento,";
		$sql[] = "data_previsao_aposentadoria, data_aposentadoria, id_departamento,";
		$sql[] = "id_categoria_funcional_inicial, id_categoria_funcional_atual,";
		$sql[] = "id_tipo_titulacao, id_categoria_funcional_referencia, id_cargo,";
		$sql[] = "id_regime_trabalho, id_situacao, id_status_atual_professor )";
		$sql[] = "VALUES (";
		$sql[] = "'$nome', '$matricula', '$siape',";
		$sql[] = "'$dataAdmissao', '$dataAdmissaoUfsc', '$dataNascimento',";
		$sql[] = "'$dataPrevistaAposentadoria', '$dataEfetivaAposentadoria', '$idDepartamento',";
		$sql[] = "'$idCategoriaFuncionalInicial', '$idCategoriaFuncionalAtual',";
		$sql[] = "'$idTipoTitulacao', '$idCategoriaFuncionalReferencia', '$idCargo',";
		$sql[] = "'$idRegimeTrabalho', '$idSituacao', '$idStatusAtualProfessor' )";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	/**
	 * Realiza o cadastro de um regime de trabalho de professor
	 *
	 * @return stdClass
	 */
	public function cadastrarRegimeTrabalhoProfessor( $idProfessor, $idRegimeTrabalho, $processo, $deliberacao, $portaria, $dataInicio ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$dataInicio = !empty( $dataInicio ) ? date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataInicio ) ) ) : '';

		$processo = utf8_decode( $processo );
		$deliberacao = utf8_decode( $deliberacao );
		$portaria = utf8_decode( $portaria );

		$sql[] = "INSERT INTO regime_trabalho_professor (";
		$sql[] = "id_professor, id_regime_trabalho, processo, deliberacao, portaria, data_inicio )";
		$sql[] = "VALUES (";
		$sql[] = "'$idProfessor', '$idRegimeTrabalho', '$processo', '$deliberacao', '$portaria', '$dataInicio')";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	/**
	 * Realiza o cadastro de um afastamento de professor
	 *
	 * @return stdClass
	 */
	public function cadastrarAfastamentoProfessor( $idProfessor, $idInstituicao, $idTipoAfastamento, $idTipoTitulacao, $dataInicio, $dataPrevisaoTermino, $processo, $prorrogacao, $observacao ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$dataInicio = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataInicio ) ) );
		$dataPrevisaoTermino = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataPrevisaoTermino ) ) );

		$processo = utf8_decode( $processo );
		$prorrogacao = utf8_decode( $prorrogacao );
		$observacao = utf8_decode( $observacao );

		$sql[] = "INSERT INTO afastamento (";
		$sql[] = "id_professor, id_instituicao, id_tipo_afastamento,";
		$sql[] = "id_tipo_titulacao, data_inicio, data_previsao_termino,";
		$sql[] = "meses_duracao,";
		$sql[] = "processo, flag_prorrogacao, observacao )";
		$sql[] = "VALUES (";
		$sql[] = "'$idProfessor', '$idInstituicao', '$idTipoAfastamento',";
		$sql[] = "'$idTipoTitulacao', '$dataInicio', '$dataPrevisaoTermino',";
		$sql[] = "period_diff(date_format('$dataPrevisaoTermino', '%Y%m'), date_format('$dataInicio', '%Y%m')),";
		$sql[] = "'$processo', '$prorrogacao', '$observacao')";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	/**
	 * Realiza o cadastro de um afastamento de professor
	 *
	 * @return stdClass
	 */
	public function cadastrarProgressaoFuncionalProfessor( $idProfessor, $idCategoriaFuncional, $processo, $tituloAvaliacao, $dataAvaliacao, $notaAvaliacao, $aPartirDe, $portaria, $observacoes ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$dataAvaliacao = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataAvaliacao ) ) );
		$aPartirDe = date( 'Y-m-d', strtotime( str_replace( '/', '-', $aPartirDe ) ) );

		$processo = utf8_decode( $processo );
		$portaria = utf8_decode( $portaria );
		$tituloAvaliacao = utf8_decode( $tituloAvaliacao );
		$observacoes = utf8_decode( $observacoes );

		$sql[] = "INSERT INTO progressao_funcional (";
		$sql[] = "id_professor, id_categoria_funcional,";
		$sql[] = "processo, titulo_avaliacao, data_avaliacao, nota_avaliacao,";
		$sql[] = "apartir_de, portaria, observacao )";
		$sql[] = "VALUES (";
		$sql[] = "'$idProfessor', '$idCategoriaFuncional',";
		$sql[] = "'$processo', '$tituloAvaliacao', '$dataAvaliacao', '$notaAvaliacao',";
		$sql[] = "'$aPartirDe', '$portaria', '$observacoes')";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	/**
	 * Exibe todos os professores que estao aposentados ou afastados ate determinado periodo
	 *
	 * @return array
	 */
	public function pesquisarAfastamentoAposentadoria( $dataInicial, $dataFinal, $aposentado, $tipos ) {
		$conexao = Conexao::con();
		$professores = array();

		if ( !$aposentado ) {
			$dataInicial = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataInicial ) ) );
			$dataFinal = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataFinal ) ) );
			$sql[] = "SELECT";
			$sql[] = "p.id_professor, p.nome, f.data_inicio, f.data_previsao_termino, t.descricao";
			$sql[] = "FROM";
			$sql[] = "afastamento f";
			$sql[] = "INNER JOIN professor p";
			$sql[] = "ON f.id_professor = p.id_professor";
			$sql[] = "INNER JOIN tipo_afastamento t";
			$sql[] = "ON f.id_tipo_afastamento = t.id_tipo_afastamento";
			$sql[] = "WHERE";
			$sql[] = "f.id_tipo_afastamento IN ($tipos)";
			$sql[] = "AND f.data_inicio >= '$dataInicial'";
			$sql[] = "AND f.data_previsao_termino <= '$dataFinal'";
		} else {
			$today = date( 'Y-m-d' );
			$dataFinal = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataFinal ) ) );
			$sql[] = "SELECT";
			$sql[] = "p.id_professor, p.nome, p.data_previsao_aposentadoria";
			$sql[] = "FROM";
			$sql[] = "professor p";
			$sql[] = "WHERE";
			$sql[] = "p.data_previsao_aposentadoria BETWEEN '$today' AND '$dataFinal'";

			//$sql[] = "p.id_situacao = $aposentado";
			//$sql[] = "p.data_previsao_aposentadoria <= '$dataFinal'";
		}

		$query = mysqli_query( $conexao, join( ' ', $sql ) );
		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass();
			$professor->id_professor = $row['id_professor'];
			$professor->nome = utf8_encode( $row['nome'] );
			$dataInicio = date( 'd/m/Y', strtotime( $row['data_inicio'] ) );
			$professor->dataInicio = $dataInicio;
			$dataPrevisaoTermino = date( 'd/m/Y', strtotime( $row['data_previsao_termino'] ) );
			$professor->dataPrevisaoTermino = $dataPrevisaoTermino;
			$dataPrevisaoAposentadoria = date( 'd/m/Y', strtotime( $row['data_previsao_aposentadoria'] ) );
			$professor->dataPrevisaoAposentadoria = $dataPrevisaoAposentadoria;
			$professor->descricao = utf8_encode( $row['descricao'] );
			$professores[] = $professor;
		}
		return $professores;
	}

	/**
	 * Retorna todas as progressoes funcionais do professor
	 *
	 * @return stdClass
	 */
	public function getAllProgressaoFuncionalProfessor( $idProfessor ) {
		$conexao = Conexao::con();
		$progressaoFuncional = array();

		$sql[] = "SELECT";
		$sql[] = "p.id_categoria_funcional_inicial,";
		$sql[] = "'' as id_progressao_funcional,";
		$sql[] = "p.id_professor,";
		$sql[] = "p.nome as nome_professor,";
		$sql[] = "cf.id_categoria_funcional,";
		$sql[] = "cf.descricao as categoria_funcional,";
		$sql[] = "'' as processo,";
		$sql[] = "p.data_admissao_ufsc as data_avaliacao,";
		$sql[] = "'' as nota_avaliacao,";
		$sql[] = "p.data_admissao as apartir_de,";
		$sql[] = "'Admiss�o' as portaria,";
		$sql[] = "'' as titulo_avaliacao,";
		$sql[] = "'' as observacao";
		$sql[] = "FROM professor p";
		$sql[] = "inner join categoria_funcional cf";
		$sql[] = "on p.id_categoria_funcional_inicial = cf.id_categoria_funcional";
		$sql[] = "where id_professor = {$idProfessor}";
		$sql[] = "UNION";
		$sql[] = "SELECT";
		$sql[] = "p.id_categoria_funcional_inicial,";
		$sql[] = "pf.id_progressao_funcional,";
		$sql[] = "p.id_professor,";
		$sql[] = "p.nome,";
		$sql[] = "cf.id_categoria_funcional,";
		$sql[] = "cf.descricao,";
		$sql[] = "pf.processo,";
		$sql[] = "pf.data_avaliacao,";
		$sql[] = "pf.nota_avaliacao,";
		$sql[] = "pf.apartir_de,";
		$sql[] = "pf.portaria,";
		$sql[] = "pf.titulo_avaliacao as titulo_avaliacao,";
		$sql[] = "pf.observacao";
		$sql[] = "FROM professor p";
		$sql[] = "inner join progressao_funcional pf";
		$sql[] = "on p.id_professor = pf.id_professor";
		$sql[] = "inner join categoria_funcional cf";
		$sql[] = "on pf.id_categoria_funcional = cf.id_categoria_funcional";
		$sql[] = "where p.id_professor = {$idProfessor}";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$progressao = new stdClass();
			$progressao->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$progressao->idProgressaoFuncional = $row['id_progressao_funcional'];
			$progressao->idProfessor = $row['id_professor'];
			$progressao->nomeProfessor = $row['nome_professor'];
			$progressao->idCategoriaFuncional = $row['id_categoria_funcional'];
			$progressao->categoriaFuncional = utf8_encode( $row['categoria_funcional'] );
			$progressao->processo = $row['processo'];
			$dataAvaliacao = date( 'd/m/Y', strtotime( $row['data_avaliacao'] ) );
			$progressao->dataAvaliacao = $dataAvaliacao;
			$progressao->notaAvaliacao = $row['nota_avaliacao'];
			$aPartirDe = date( 'd/m/Y', strtotime( $row['apartir_de'] ) );
			$progressao->aPartirDe = $aPartirDe;
			$progressao->portaria = utf8_encode( $row['portaria'] );
			$progressao->tituloAvaliacao = utf8_encode( $row['titulo_avaliacao'] );
			$progressao->observacao = utf8_encode( $row['observacao'] );
			$progressaoFuncional[] = $progressao;
		}
		return $progressaoFuncional;
	}

	/**
	 * Realiza o cadastro de um afastamento de professor
	 *
	 * @return stdClass
	 */
	public function updateUser( $nome, $dataNascimento, $siape, $senhaAtual, $novaSenha, $novaSenha2, $atualizaSenha ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$nome = utf8_decode( $nome );
		$dataNascimento = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataNascimento ) ) );
		/* @TODO Melhorar a logica da funcao */
		if ( $atualizaSenha ) {
			$senha = MD5( $senhaAtual );
			$sql[] = "SELECT COUNT(*) AS count FROM professor WHERE (siape = {$siape} AND senha = '{$senha}')";
			$query = mysqli_query( $conexao, join( '', $sql ) );
			$count = mysqli_fetch_array( $query, MYSQL_ASSOC );
			if ( $count['count'] == 1 ) {
				unset( $sql );
				$sql[] = "UPDATE professor SET";
				$sql[] = "nome = '$nome',";
				$sql[] = "data_nascimento = '$dataNascimento',";
				$sql[] = "senha = MD5( '{$novaSenha}' )";
				$sql[] = "WHERE id_professor = {$_SESSION['idProfessor']} LIMIT 1";
				if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
					$return->result = 1;
				} else {
					$return->result = 0;
					$return->error = mysqli_error( $conexao );
				}
			} else {
				$return->result = 0;
				$return->error = "A senha atual nao confere.";
			}
		} else {
			unset( $sql );
			$sql[] = "UPDATE professor SET";
			$sql[] = "nome = '$nome',";
			$sql[] = "data_nascimento = '$dataNascimento'";
			$sql[] = "WHERE id_professor = {$_SESSION['idProfessor']} LIMIT 1";
			if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
				$return->result = 1;
			} else {
				$return->result = 0;
				$return->error = mysqli_error( $conexao );
			}
		}
		return $return;
	}
}

?>