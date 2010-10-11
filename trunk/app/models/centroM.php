<?php

class CentroM {

	/**
	 * Retorna um array com todos os objetos Centro
	 *
	 * @return array
	 */
	function getCentros() {
		$conexao = Conexao::con();
		$centros = array();
		$f = new FormataHelper();

		$sql = "SELECT * FROM centro ORDER BY nome";
		$query = mysqli_query( $conexao, $sql );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$centro = new stdClass;
			$centro->idCentro = utf8_encode( $row['id_centro'] );
			$centro->idInstituicao = utf8_encode( $row['id_instituicao'] );
			$centro->nome = utf8_encode( $row['nome'] );
			$centro->sigla = utf8_encode( $row['sigla'] );
			$centro->fone = $f->foneFormato( $row['fone'] );
			$centros[] = $centro;
		}
		return $centros;
	}

	/**
	 * Realiza o cadastro de um novo centro
	 *
	 * @return stdClass
	 */
	public function cadastrar( $nome, $sigla, $idInstituicao, $fone ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$nome = utf8_decode( $nome );

		$sql[] = "INSERT INTO centro ( id_instituicao, nome, sigla, fone )";
		$sql[] = "VALUES (";
		$sql[] = "'{$idInstituicao}', '{$nome}', '{$sigla}', '{$fone}'";
		$sql[] = ")";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

	function relDiretorPorCentro( $idCentro ) {
		$conexao = Conexao::con();
		$diretores = array();

		$sql[] = "select p.id_professor, p.nome from centro c";
		$sql[] = "inner join centrocargocomissionado cc";
		$sql[] = "on c.id_centro = cc.id_centro";
		$sql[] = "inner join professor p";
		$sql[] = "on cc.id_professor = p.id_professor";
		$sql[] = "where c.id_centro = {$idCentro}";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$diretor = new stdClass;
			$diretor->idDiretor = $row['id_professor'];
			$diretor->nome = utf8_encode( $row['nome'] );
			$diretores[] = $diretor;
		}
		return $diretores;
	}

	function relDepartamentoPorCentro( $idCentro ) {
		$conexao = Conexao::con();
		$departamentos = array();

		$sql[] = "select * from departamento where id_centro = {$idCentro}";

		$query = mysqli_query( $conexao, join( ' ', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$departamento = new stdClass;
			$departamento->idDepartamento = $row['id_departamento'];
			$departamento->idCentro = $row['id_centro'];
			$departamento->nome = utf8_encode( $row['nome'] );
			$departamento->sigla = utf8_encode( $row['sigla'] );
			$departamentos[] = $departamento;
		}
		return $departamentos;
	}
}

?>