<?php /* Smarty version 3.0rc1, created on 2010-05-16 15:15:06
         compiled from "C:\wamp\www\SGD\app\library\Smarty-3.0rc1\libs\debug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75804bf0362a3c5da0-84769203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08285152443430a0bb4cd73eb72b8cdfbde61858' => 
    array (
      0 => 'C:\\wamp\\www\\SGD\\app\\library\\Smarty-3.0rc1\\libs\\debug.tpl',
      1 => 1272607038,
    ),
  ),
  'nocache_hash' => '75804bf0362a3c5da0-84769203',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_string_format')) include 'C:\wamp\www\SGD\app\library\Smarty-3.0rc1\libs\plugins\modifier.string_format.php';
if (!is_callable('smarty_modifier_escape')) include 'C:\wamp\www\SGD\app\library\Smarty-3.0rc1\libs\plugins\modifier.escape.php';
if (!is_callable('smarty_modifier_debug_print_var')) include 'C:\wamp\www\SGD\app\library\Smarty-3.0rc1\libs\plugins\modifier.debug_print_var.php';
?><?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Smarty Debug Console</title>
<style type="text/css">

body, h1, h2, td, th, p {
    font-family: sans-serif;
    font-weight: normal;
    font-size: 0.9em;
    margin: 1px;
    padding: 0;
}

h1 {
    margin: 0;
    text-align: left;
    padding: 2px;
    background-color: #f0c040;
    color:  black;
    font-weight: bold;
    font-size: 1.2em;
 }

h2 {
    background-color: #9B410E;
    color: white;
    text-align: left;
    font-weight: bold;
    padding: 2px;
    border-top: 1px solid black;
}

body {
    background: black; 
}

p, table, div {
    background: #f0ead8;
} 

p {
    margin: 0;
    font-style: italic;
    text-align: center;
}

table {
    width: 100%;
}

th, td {
    font-family: monospace;
    vertical-align: top;
    text-align: left;
    width: 50%;
}

td {
    color: green;
}

.odd {
    background-color: #eeeeee;
}

.even {
    background-color: #fafafa;
}

.exectime {
    font-size: 0.8em;
    font-style: italic;
}

#table_assigned_vars th {
    color: blue;
}

#table_config_vars th {
    color: maroon;
}

</style>
</head>
<body>

<h1>Smarty Debug Console  -  Total Time <?php echo smarty_modifier_string_format($_smarty_tpl->getVariable('execution_time')->value,"%.5f");?>
</h1>

<h2>included templates &amp; config files (load time in seconds)</h2>

<div>
<?php  $_smarty_tpl->tpl_vars['template'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('template_data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['template']->key => $_smarty_tpl->tpl_vars['template']->value){
?>
  <font color=brown><?php echo $_smarty_tpl->tpl_vars['template']->value['name'];?>
</font>
  <span class="exectime">
   (compile <?php echo smarty_modifier_string_format($_smarty_tpl->tpl_vars['template']->value['compile_time'],"%.5f");?>
) (render <?php echo smarty_modifier_string_format($_smarty_tpl->tpl_vars['template']->value['render_time'],"%.5f");?>
) (cache <?php echo smarty_modifier_string_format($_smarty_tpl->tpl_vars['template']->value['cache_time'],"%.5f");?>
)
  </span>
  <br>
<?php }} ?>
</div>

<h2>assigned template variables</h2>

<table id="table_assigned_vars">
    <?php  $_smarty_tpl->tpl_vars['vars'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('assigned_vars')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vars']->iteration=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['vars']->key => $_smarty_tpl->tpl_vars['vars']->value){
 $_smarty_tpl->tpl_vars['vars']->iteration++;
?>
       <tr class="<?php if ($_smarty_tpl->tpl_vars['vars']->iteration%2==0){?>odd<?php }else{ ?>even<?php }?>">   
       <th>$<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['vars']->key,'html');?>
</th>
       <td><?php echo smarty_modifier_debug_print_var($_smarty_tpl->tpl_vars['vars']->value);?>
</td></tr>
    <?php }} ?>
</table>

<h2>assigned config file variables (outer template scope)</h2>

<table id="table_config_vars">
    <?php  $_smarty_tpl->tpl_vars['vars'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('config_vars')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['vars']->iteration=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['vars']->key => $_smarty_tpl->tpl_vars['vars']->value){
 $_smarty_tpl->tpl_vars['vars']->iteration++;
?>
       <tr class="<?php if ($_smarty_tpl->tpl_vars['vars']->iteration%2==0){?>odd<?php }else{ ?>even<?php }?>">   
       <th><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['vars']->key,'html');?>
</th>
       <td><?php echo smarty_modifier_debug_print_var($_smarty_tpl->tpl_vars['vars']->value);?>
</td></tr>
    <?php }} ?>

</table>
</body>
</html>
<?php  $_smarty_tpl->assign('debug_output', ob_get_contents()); $_smarty_tpl->smarty->_smarty_vars['capture']['default']=ob_get_clean();?>
<script type="text/javascript">
    if ( self.name == '' ) {
       var title = 'Console';
      }
    else {
       var title = 'Console_' + self.name;
      }
    _smarty_console = window.open("",title.value,"width=680,height=600,resizable,scrollbars=yes");
    _smarty_console.document.write("<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('debug_output')->value,'javascript');?>
");
    _smarty_console.document.close();
</script>
