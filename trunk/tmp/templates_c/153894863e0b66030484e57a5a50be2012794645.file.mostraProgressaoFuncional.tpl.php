<?php /* Smarty version 3.0rc1, created on 2010-09-18 00:40:56
         compiled from "views/professor/templates/mostraProgressaoFuncional.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258504c940a98726475-85199125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '153894863e0b66030484e57a5a50be2012794645' => 
    array (
      0 => 'views/professor/templates/mostraProgressaoFuncional.tpl',
      1 => 1284770446,
    ),
  ),
  'nocache_hash' => '258504c940a98726475-85199125',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="viewProgressaoFuncional">
	<?php  $_smarty_tpl->tpl_vars['progressao'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('progressaoFuncional')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['progressao']->key => $_smarty_tpl->tpl_vars['progressao']->value){
?>
		<div class="viewProgressaoFuncionalItem">
			<div>Categoria Funcional</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->categoriaFuncional;?>
</div>
			<div>Processo</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->processo;?>
</div>
			<div>Data Avalia&ccedil;&atilde;o</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->dataAvaliacao;?>
</div>
			<div>Nota Avalia&ccedil;&atilde;o</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->notaAvaliacao;?>
</div>
			<div>Data In&iacute;cio</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->dataInicio;?>
</div>
			<div>Portaria</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->portaria;?>
</div>
			<div>Observacao</div>
			<div><?php echo $_smarty_tpl->getVariable('progressao')->value->observacao;?>
</div>
		</div>
	<?php }} ?>
</div>