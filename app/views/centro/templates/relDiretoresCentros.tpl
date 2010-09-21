{if $option eq listCentros}
	<h1>Relat&oacute;rio de Diretores por Centro</h1>
	<label for="selectCentros">Escolha o centro</label>
	<select id="selectCentros">
		{foreach from=$centros item=centro}
		    <option value="{$centro->idCentro}">{$centro->nome}</option>
		{/foreach}
	</select>
	<br />
	<br />
	<div id="departamentosPorCentro" ></div>
{/if}
{if $option eq diretoresPorCentro}
	<table class="aatable">
		<tr>
			<th>Nome</th>
		</tr>
		{foreach from=$diretores item=diretor}
			<tr>
		    	<td>{$diretor->nome}</td>
		    </tr>	    
		{foreachelse}
			<tr>
		    	<td>Nenhum diretor cadastrado para o centro selecionado</td>
		    </tr>
		{/foreach}
	</table>	
{/if}