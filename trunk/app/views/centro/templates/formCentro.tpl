<h1>Cadastro de Centros</h1>
<div>Nome</div>
<input type="text" id="nome" name="nome" value="" maxlength="100" class="input ui-corner-all width100" />
<div>Sigla</div>
<input type="text" id="sigla" name="sigla" value="" maxlength="3" class="input ui-corner-all width100" />
<div>Institui&ccedil;&atilde;o</div>
<select id="idInstituicao" class="select ui-corner-all width100">
{foreach from=$instituicoes item=instituicao}
	<option value="{$instituicao->idInstituicao}">{$instituicao->nome}</option>
{/foreach}
</select>
<p></p>
<p><button id="cadastrarCentro" class="right button">Cadastrar</button></p>