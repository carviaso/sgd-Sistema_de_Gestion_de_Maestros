<?php /* Smarty version 3.0rc1, created on 2010-09-01 03:09:47
         compiled from "views/professor/templates/regTrabProfessor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151174c7dc3fb4dac32-97055694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ac6da322a83d6e159506eb669f0bd919d15942b' => 
    array (
      0 => 'views/professor/templates/regTrabProfessor.tpl',
      1 => 1283300600,
    ),
  ),
  'nocache_hash' => '151174c7dc3fb4dac32-97055694',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Cadastro de Regime de Trabalho do Professor</h1>	
<div>Professor</div>
<select id="idProfessor" class="width100">
	<?php  $_smarty_tpl->tpl_vars['professor'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('professores')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['professor']->key => $_smarty_tpl->tpl_vars['professor']->value){
?>
		<option value="<?php echo $_smarty_tpl->getVariable('professor')->value->id_professor;?>
"><?php echo $_smarty_tpl->getVariable('professor')->value->nome;?>
</option>
	<?php }} ?>
</select>
<div>Regime de Trabalho</div>
<select id="idRegimeTrabalho" class="width100">
	<?php  $_smarty_tpl->tpl_vars['regimeTrabalho'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('regimesTrabalho')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['regimeTrabalho']->key => $_smarty_tpl->tpl_vars['regimeTrabalho']->value){
?>
		<option value="<?php echo $_smarty_tpl->getVariable('regimeTrabalho')->value->idRegimeTrabalho;?>
"><?php echo $_smarty_tpl->getVariable('regimeTrabalho')->value->descricao;?>
</option>
	<?php }} ?>
</select>
<div>Processo</div>
<input type="text" id="processo" name="processo" value="" maxlength="45" class="form_tfield " />
<div>Delibera&ccedil;&atilde;o</div>
<input type="text" id="deliberacao" name="deliberacao" value="" maxlength="45" class="form_tfield " />
<div>Portaria</div>
<input type="text" id="portaria" name="portaria" value="" maxlength="45" class="form_tfield " />
<div>Data de in&iacute;cio</div>
<input type="text" id="dataInicio" class="form_tfield" />
<p></p>
<button id="cadastrarRegimeTrabalho">Cadastrar</button>