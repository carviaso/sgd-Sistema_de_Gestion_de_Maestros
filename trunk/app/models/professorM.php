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
	function getAllProfessores() {

		$professores = array();
		$conexao = Conexao::con();

		$sql[] = "SELECT * FROM professor p ORDER BY p.nome";
		$query = mysqli_query( $conexao, join( '', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor = new stdClass();
			$professor->id_professor = $row['id_professor'];
			$professor->nome = utf8_encode( $row['nome'] );
			$professor->matricula = utf8_encode( $row['matricula'] );
			$professor->siape = utf8_encode( $row['siape'] );
			$professor->dataAdmissao = $row['data_admissao'];
			$professor->dataAdmissaoUfsc = $row['data_admissao_ufsc'];
			$professor->dataNascimento = $row['data_nascimento'];
			$professor->aposentado = utf8_encode( $row['aposentado'] );
			$professor->dataPrevistaAposentadoria = $row['data_previsao_aposentadoria'];
			$professor->dataEfetivaAposentadoria = $row['data_aposentadoria'];
			$professor->idDepartamento = $row['id_departamento'];
			$professor->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$professor->idCategoriaFuncionalAtual = $row['id_categoria_funcional_atual'];
			$professor->idTipoTitulacao = $row['id_tipo_titulacao'];
			$professor->idCategoriaFuncionalReferencia = $row['id_categoria_funcional_referencia'];
			$professor->idCargo = $row['id_cargo'];
			$professor->idSituacao = $row['id_situacao'];
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

		$sql[] = "SELECT
					p.id_professor,
					p.nome,
					p.matricula,
					p.siape,
					p.data_admissao,
					p.data_admissao_ufsc,
					p.data_nascimento,
					p.aposentado,
					p.data_previsao_aposentadoria,
					p.data_aposentadoria,
					p.id_departamento,
					p.id_categoria_funcional_inicial,
					p.id_categoria_funcional_atual,
					p.id_tipo_titulacao,
					p.id_categoria_funcional_referencia,
					p.id_cargo,
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

					s.id_situacao as idSituacao,
					s.descricao_situacao as descricaoSituacao

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
		$sql[] = "left join situacao s";
		$sql[] = "on p.id_situacao = s.id_situacao";

		$sql[] = "WHERE id_professor = {$idProfessores} ORDER BY p.nome";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		$professor = new stdClass();
		while ( $row = mysqli_fetch_array( $query ) ) {
			$professor->id_professor = $row['id_professor'];
			$professor->nome = utf8_encode( $row['nome'] );
			$professor->matricula = utf8_encode( $row['matricula'] );
			$professor->siape = utf8_encode( $row['siape'] );
			$professor->dataAdmissao = $row['data_admissao'];
			$professor->dataAdmissaoUfsc = $row['data_admissao_ufsc'];
			$professor->dataNascimento = $row['data_nascimento'];
			$professor->aposentado = utf8_encode( $row['aposentado'] );
			$professor->dataPrevistaAposentadoria = $row['data_previsao_aposentadoria'];
			$professor->dataEfetivaAposentadoria = $row['data_aposentadoria'];
			$professor->idDepartamento = $row['id_departamento'];
			$professor->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$professor->idCategoriaFuncionalAtual = $row['id_categoria_funcional_atual'];
			$professor->idTipoTitulacao = $row['id_tipo_titulacao'];
			$professor->idCategoriaFuncionalReferencia = $row['id_categoria_funcional_referencia'];
			$professor->idCargo = $row['id_cargo'];
			$professor->idSituacao = $row['id_situacao'];

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

			$professor->idSituacao = $row['idSituacao'];
			$professor->descricaoSituacao = utf8_encode( $row['descricaoSituacao'] );
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

		$sql[] = "SELECT COUNT(*) AS count FROM professor {$wh}";
		$query = mysqli_query( $conexao, join( '', $sql ) );

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

		$sql[] = "SELECT * FROM professor {$wh} ORDER BY $sidx $sord LIMIT $start, $limit";
		$query = mysqli_query( $conexao, join( '', $sql ) );
		$return->page = $page;
		$return->total = $total_pages;
		$return->records = $count;
		$i = 0;
		while ( $row = mysqli_fetch_array( $query ) ) {
			$return->rows[$i]['id'] = $row['id_professor'];

			$idProfessor = $row['id_professor'];
			$nome = utf8_encode( $row['nome'] );

			$return->rows[$i]['cell'] = array(
												"<div class='detalhesProfessor' title='Detalhes' id='{$idProfessor}'>&nbsp;</div><div class='detalhesProgressaoFuncional' title='Progressao Funcional' id='{$idProfessor}'>&nbsp;</div>",
												$idProfessor,
												$nome,
												$row['matricula'],
												$row['siape']
											);
			$i++;
		}
		return $return;
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
	public function cadastrarProfessor( $nome, $dataNascimento, $matricula, $siape, $dataAdmissao, $dataAdmissaoUfsc, $aposentado, $dataPrevistaAposentadoria, $dataEfetivaAposentadoria, $idDepartamento, $idCategoriaFuncionalInicial, $idCategoriaFuncionalAtual, $idTipoTitulacao, $idCategoriaFuncionalReferencia, $idCargo, $idSituacao ) {
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
		$aposentado = utf8_decode( $aposentado );

		$sql[] = "INSERT INTO professor( nome, matricula, siape,";
		$sql[] = "data_admissao, data_admissao_ufsc, data_nascimento, aposentado,";
		$sql[] = "data_previsao_aposentadoria, data_aposentadoria, id_departamento,";
		$sql[] = "id_categoria_funcional_inicial, id_categoria_funcional_atual,";
		$sql[] = "id_tipo_titulacao, id_categoria_funcional_referencia, id_cargo, id_situacao )";
		$sql[] = "VALUES (";
		$sql[] = "'$nome', '$matricula', '$siape',";
		$sql[] = "'$dataAdmissao', '$dataAdmissaoUfsc', '$dataNascimento', '$aposentado',";
		$sql[] = "'$dataPrevistaAposentadoria', '$dataEfetivaAposentadoria', '$idDepartamento',";
		$sql[] = "'$idCategoriaFuncionalInicial', '$idCategoriaFuncionalAtual',";
		$sql[] = "'$idTipoTitulacao', '$idCategoriaFuncionalReferencia', '$idCargo', '$idSituacao' )";

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

		$dataInicio = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataInicio ) ) );

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
	public function cadastrarProgressaoFuncionalProfessor( $idProfessor, $idCategoriaFuncional, $processo, $dataAvaliacao, $notaAvaliacao, $dataInicio, $portaria ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$dataAvaliacao = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataAvaliacao ) ) );
		$dataInicio = date( 'Y-m-d', strtotime( str_replace( '/', '-', $dataInicio ) ) );

		$processo = utf8_decode( $processo );
		$portaria = utf8_decode( $portaria );

		$sql[] = "INSERT INTO progressao_funcional (";
		$sql[] = "id_professor, id_categoria_funcional,";
		$sql[] = "processo, data_avaliacao, nota_avaliacao,";
		$sql[] = "data_inicio, portaria )";
		$sql[] = "VALUES (";
		$sql[] = "'$idProfessor', '$idCategoriaFuncional',";
		$sql[] = "'$processo', '$dataAvaliacao', '$notaAvaliacao',";
		$sql[] = "'$dataInicio', '$portaria')";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	/**
	 * Retorna todas as progressoes funcionais do professor
	 *
	 * @return stdClass
	 */
	public function getAllProgressaoFuncionalProfessor( $idProfessor ) {
		$conexao = Conexao::con();
		$progressaoFuncional = array();

		//@todo identar o codigo
		$sql[] = "
		SELECT
p.id_categoria_funcional_inicial,
'' as id_progressao_funcional,
p.id_professor,
cf.id_categoria_funcional,
cf.descricao as categoriaFuncional,
'' as processo,
'' as data_avaliacao,
'' as nota_avaliacao,
p.data_admissao as data_inicio,
'' as portaria,
'' as observacao
FROM professor p
inner join categoria_funcional cf
on p.id_categoria_funcional_inicial = cf.id_categoria_funcional
where id_professor = {$idProfessor}
union
SELECT
p.id_categoria_funcional_inicial,
pf.id_progressao_funcional,
p.id_professor,
cf.id_categoria_funcional,
cf.descricao,
pf.processo,
pf.data_avaliacao,
pf.nota_avaliacao,
pf.data_inicio,
pf.portaria,
pf.observacao
FROM professor p
inner join progressao_funcional pf
on p.id_professor = pf.id_professor
inner join categoria_funcional cf
on pf.id_categoria_funcional = cf.id_categoria_funcional
where p.id_professor = {$idProfessor}";

	$query = mysqli_query( $conexao, join( '', $sql ) );

	while ( $row = mysqli_fetch_array( $query ) ) {
			$progressao = new stdClass();
			$progressao->idCategoriaFuncionalInicial = $row['id_categoria_funcional_inicial'];
			$progressao->idProgressaoFuncional = $row['id_progressao_funcional'];
			$progressao->idProfessor = $row['id_professor'];
			$progressao->idCategoriaFuncional = $row['id_categoria_funcional'];
			$progressao->categoriaFuncional = utf8_encode( $row['categoriaFuncional'] );
			$progressao->processo = $row['processo'];
			$progressao->dataAvaliacao = $row['data_avaliacao'];
			$progressao->notaAvaliacao = $row['nota_avaliacao'];
			$progressao->dataInicio = $row['data_inicio'];
			$progressao->portaria = utf8_encode( $row['portaria'] );
			$progressao->observacao = utf8_encode( $row['observacao'] );
			$progressaoFuncional[] = $progressao;
		}
		return $progressaoFuncional;
	}
}

?>