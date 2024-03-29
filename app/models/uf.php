<?php

class Uf {

	/**
	 * Retorna todos os ufs
	 *
	 * @return array
	 */
	function getAll() {

		$ufs = array();
		$conexao = Conexao::con();

		$sql[] = "SELECT * FROM uf u ORDER by u.nome";
		$query = mysqli_query( $conexao, join( '', $sql ) );

		while ( $row = mysqli_fetch_array( $query ) ) {
			$uf = new stdClass();
			$uf->idUf = $row['id_uf'];
			$uf->idPais = $row['id_pais'];
			$uf->nome = utf8_encode( $row['nome'] );
			$uf->sigla = utf8_encode( $row['sigla'] );
			$ufs[] = $uf;
		}
		return $ufs;
	}

	/**
	 * Realiza o cadastro de uma nova Uf
	 *
	 * @return stdClass
	 */
	public function cadastrarUf( $idPais, $nome, $sigla ) {
		$conexao = Conexao::con();
		$return = new stdClass();

		$nome = utf8_decode( $nome );
		$sigla = utf8_decode( $sigla );

		$sql[] = "INSERT INTO uf ( id_pais, nome, sigla )";
		$sql[] = "VALUES (";
		$sql[] = "'{$idPais}', '{$nome}', '{$sigla}'";
		$sql[] = ")";

		if ( mysqli_query( $conexao, join( ' ', $sql ) ) ) {
			$return->result = 1;
		} else {
			$return->result = 0;
			$return->error = mysqli_error( $conexao );
		}
		return $return;
	}

}

?>