<h1>Cadastro de Regime de Trabalho do Professor</h1>	
<div>Professor</div>
<select id="idProfessor" class="width100">
	{foreach from=$professores item=professor}
		<option value="{$professor->id_professor}">{$professor->nome}</option>
	{/foreach}
</select>
<div>Regime de Trabalho</div>
<select id="idRegimeTrabalho" class="width100">
	{foreach from=$regimesTrabalho item=regimeTrabalho}
		<option value="{$regimeTrabalho->idRegimeTrabalho}">{$regimeTrabalho->descricao}</option>
	{/foreach}
</select>
<div>Processo</div>
<input type="text" id="processo" name="processo" value="" maxlength="45" class="ui-state-default ui-corner-all width100" />
<div>Delibera&ccedil;&atilde;o</div>
<input type="text" id="deliberacao" name="deliberacao" value="" maxlength="45" class="ui-state-default ui-corner-all width100" />
<div>Portaria</div>
<input type="text" id="portaria" name="portaria" value="" maxlength="45" class="ui-state-default ui-corner-all width100" />
<div>Data de in&iacute;cio</div>
<input type="text" id="dataInicio" class="ui-state-default ui-corner-all width100" />
<p></p>
<button id="cadastrarRegimeTrabalho">Cadastrar</button>