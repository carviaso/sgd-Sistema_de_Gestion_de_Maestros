<?php

class ufController {

	/**
	 * Construtor
	 *
	 * @return void
	 */
	public function ufController() {}

	/**
	 * Realiza o cadastro de um novo uf
	 *
	 * @return json
	 */
	public function cadastrarUf( $idPais, $nome, $sigla ) {
		$ufDAO = new Uf();

		$erro = array();
		if ( empty( $idPais) ) $erro[] = 'Pais';
		if ( empty( $nome) ) $erro[] = 'Nome';
		if ( empty( $sigla) ) $erro[] = 'Sigla';

		if ( count( $erro ) == 0 ) {
			$return = $ufDAO->cadastrarUf( $idPais, $nome, $sigla );
		} else {
			$return->result = 0;
			$return->error = join( '<br />', $erro );
		}
		echo json_encode( $return );
	}

}
?>