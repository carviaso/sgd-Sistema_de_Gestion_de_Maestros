<h1>Cadastro de Progressao Funcional de Professor</h1>
<div class="multiSelectProfessor"></div>
<div>Categoria Funcional<div>
<select id="idCategoriaFuncional" class="select ui-corner-all width100">
	{foreach from=$categoriasFuncionais item=categoriaFuncional}
		<option value="{$categoriaFuncional->idCategoriaFuncional}">{$categoriaFuncional->descricao}</option>
	{/foreach}
</select>
<div>Processo</div>
<input type="text" id="processo" value="" maxlength="45" class="input ui-corner-all width100" />
<div>Data de Avalia&ccedil;&atilde;o</div>
<input type="text" id="dataAvaliacao" class="input ui-corner-all width100" />
<div>Nota da Avalia&ccedil;&atilde;o</div>
<input type="text" id="notaAvaliacao" class="input ui-corner-all width100" />
<div>A partir de:</div>
<input type="text" id="aPartirDe" class="input ui-corner-all width100" />
<div>Portaria</div>
<input type="text" id="portaria" name="portaria" value="" maxlength="45" class="input ui-corner-all width100" />
<div>&nbsp;<div>
<div><button id="cadastrarProgressaoFuncionalProfessor" class="right button">Cadastrar</button>