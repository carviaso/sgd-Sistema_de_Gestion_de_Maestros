<div>
	<div id="imprimirFichaLogo"></div>
	<div id="imprimirFichaCabecalho">
		<div>SERVI&Ccedil;O P&Uacute;BLICO FEDERAL</div>
		<div>UNIVERSIDADE FEDERAL DE SANTA CATARINA</div>
		<div>PR&Oacute;-REITORIA DE DESENVOLVIMENTO HUMANO E SOCIAL</div>
		<div>DEPARTAMENTO DE DESENVOLVIMENTO E ADMINISTRA&Ccedil;&atilde;O DE PESSOAL</div>
	</div>
	<div id="imprimirFichaSubtitulo">INFORMA&Ccedil;&Otilde;ES CADASTRAIS</div>
	<div id="imprimirFichaDados">	
		<table>
			<tr>
				<td>Nome:</td>
				<td>{$professor->nome}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Matr&iacute;cula UFSC:</td>
				<td>{$professor->matricula}</td>
				<td>Matr&iacute;cula SIAPE:</td>
				<td>{$professor->siape}</td>
			</tr>
			<tr>
				<td>Cargo/Regime:</td>
				<td>{$professor->descricaoCargo}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Classe:</td>
				<td>{$professor->descCategoriaFuncionalAtual}</td>
				<td>Nascimento:</td>
				<td>{$professor->dataNascimento}</td>
			</tr>
			<tr>
				<td>Admiss&atilde;o na UFSC:</td>
				<td>{$professor->dataAdmissaoUfsc}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Lota&ccedil;&atilde;o:</td>
				<td>{$professor->nomeDepartamento}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Localiza&ccedil;&atilde;o:</td>
				<td>{$professor->nomeCentro}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Jornada:</td>
				<td>{$professor->descricaoRegimeTrabalho}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Situa&ccedil;&atilde;o:</td>
				<td>{$professor->descricaoSituacao}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
	<div id="imprimirFichaData1">Florian&oacute;polis, {$dia} de {$mesExtenso} de {$ano}</div>
	<!-- Verifica se o professor possui somente uma progressao e se esta nao eh igual a progressao funcional inicial -->	
	{if ($progressoes|@count > '1') && ($professor->idCategoriaFuncionalInicial neq $progressoes[$progressoes|@count-1]->idCategoriaFuncional)}
		<div id="imprimirFichaSubtitulo2">Progress&otilde;es</div>
		<table class="tbProgressoes">
			<tr>
				<th>A Partir de</th>
				<th>Cargo</th>
				<th>Portaria</th>
				<th>T&iacute;tulo Avalia&ccedil;&atilde;o</th>
				<th>Observa&ccedil;&otilde;es</th>
			</tr>
		{foreach $progressoes as $progressao}
			<tr>
				<td>{$progressao->aPartirDe}</td>
				<td nowrap="nowrap">{$progressao->categoriaFuncional}</td>
				<td>{$progressao->portaria}</td>
				<td>{$progressao->tituloAvaliacao}</td>
				<td>{$progressao->observacao}</td>
			</tr>
		{/foreach}
		</table>
	{/if}
	<div style="clear: both"></div>
	<br />
	<br />
	<br />
	<br />
	<div id="imprimirFichaData2">Em {$data}</div>
	<div id="imprimirFichaFonte">Fonte: CPPD/SGD</div>
</div>