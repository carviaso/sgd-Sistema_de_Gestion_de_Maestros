<?php /* Smarty version 3.0rc1, created on 2010-09-11 20:24:45
         compiled from "views/professor/templates/formProgressaoFuncionalProfessor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89274c8be58d06c2b3-24295843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '355a0c2225f30f2084ee87147d3fbb81007371fc' => 
    array (
      0 => 'views/professor/templates/formProgressaoFuncionalProfessor.tpl',
      1 => 1283998393,
    ),
  ),
  'nocache_hash' => '89274c8be58d06c2b3-24295843',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Cadastro de Progressao Funcional de Professor</h1>
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
<div>Categoria Funcional<div>
<select id="idCategoriaFuncional" class="width100">
	<?php  $_smarty_tpl->tpl_vars['categoriaFuncional'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categoriasFuncionais')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['categoriaFuncional']->key => $_smarty_tpl->tpl_vars['categoriaFuncional']->value){
?>
		<option value="<?php echo $_smarty_tpl->getVariable('categoriaFuncional')->value->idCategoriaFuncional;?>
"><?php echo $_smarty_tpl->getVariable('categoriaFuncional')->value->descricao;?>
</option>
	<?php }} ?>
</select>
<div>Processo</div>
<input type="text" id="processo" value="" maxlength="45" class="ui-state-default ui-corner-all width100" />
<div>Data de Avalia&ccedil;&atilde;o</div>
<input type="text" id="dataAvaliacao" class="ui-state-default ui-corner-all width100" />
<div>Nota da Avalia&ccedil;&atilde;o</div>
<input type="text" id="notaAvaliacao" class="ui-state-default ui-corner-all width100" />
<div>Data de in&iacute;cio</div>
<input type="text" id="dataInicio" class="ui-state-default ui-corner-all width100" />
<div>Portaria</div>
<input type="text" id="portaria" name="portaria" value="" maxlength="45" class="ui-state-default ui-corner-all width100" />
<div>&nbsp;<div>
<div><button id="cadastrarProgressaoFuncionalProfessor" class="right">Cadastrar</button>