<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'master.php');

$objProcessoC = new ProcessoC();
$arrayProcesso = $objProcessoC->getProcessoPorId($_GET['id']);

$objAssunto = new AssuntoProcessoC();
$arrayAssunto = $objAssunto->getAssuntos();

$objStatus = new StatusProcessoC();
$arrayStatus = $objStatus->getStatus();

$retorno = 'listar_processos.php';
if($_GET['lista'] == '2') {
	$retorno = 'listar_processos_andamento.php';
} elseif($_GET['lista'] == '3') {
	$retorno = 'reuniao_listar_processos.php';
}
?>
<html>
<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'inc.head.php');
?>
<body>
<div id="edit-processo" data-role="page" class="type-interior" data-dom-cache="true">

	<div data-role="header" data-position="fixed" data-theme="a">
		<h1><?php echo SGD_TITULO_CABECALHO; ?></h1>
		<a href="index.php?logout=true" data-transition="fade" data-theme="e">Sair</a>
		<a href="menu.php" id="btn-menu-header" data-rel="dialog" data-transition="fade" data-theme="e">Menu</a>
	</div><!-- /header -->

	<div data-role="content">	
		
		<div class="content-menu">
			<div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">

					<ul data-role="listview" data-theme="c" data-dividertheme="d">

						<?php include_once("./inc/menu_lateral.php"); ?>

					</ul>
			</div>
		</div>


			<div class="ui-grid-a">
				<div class="titulo-corpo-topo"><div class="ui-bar ui-bar-c" data-role="header" style="padding: 1px">
					<h1 id="titulo-edit-processo"><?php echo $arrayProcesso['numero']; ?></h1>
					<a href="<?php echo $retorno; ?>" rel="external" data-icon="back" data-theme="e">Voltar</a>
				</div></div>
			</div>
		<div class="content-page">
		
		<div class="ui-body ui-body-c ui-corner-all">
	
			<div data-role="fieldcontain">
				<fieldset data-role="controlgroup">
					<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2'))) { ?>
				     	<label for="numero_processo">Número: <span class="asterisco">*<span></label>
			       		<input type="tel" name="name" id="numero_processo" value="<?php echo $arrayProcesso['numero']; ?>" data-mini="true" />
		       		<?php } else { ?>
		       			<label class="ui-input-text">Número: </label>
			       		<?php echo $arrayProcesso['numero']; ?>
		       		<?php } ?>
			    </fieldset>
			 </div>
			 <div data-role="fieldcontain">
			 	<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2'))) { ?>
					<label for="select-choice-custom-status" class="select">Status: <span class="asterisco">*<span></label>
					<select name="select-choice-2" id="select-choice-custom-status" data-native-menu="false" data-mini="true">
						<option value="0" data-placeholder="true">&lt;&lt; Selecione o status &gt;&gt;</option>
						<?php foreach ($arrayStatus as $key => $status) { ?>
							<option <?php if($status['id_status_processo'] == $arrayProcesso['id_status_processo']) echo 'selected'; ?> value="<?php echo $status['id_status_processo']; ?>"><?php echo $status['nome']; ?></option>
						<?php } ?>
					</select>
				<?php } else { ?>
	       			<label class="ui-input-text">Status: </label>
		       		<?php echo $arrayProcesso['nome_status']; ?>
	       		<?php } ?>
			</div>
			<div data-role="fieldcontain">
				<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2'))) { ?>
					<label for="select-choice-custom" class="select">Assunto: <span class="asterisco">*<span></label>
					<select name="select-choice-1" id="select-choice-custom" data-native-menu="false" data-mini="true">
						<option value="0" data-placeholder="true">&lt;&lt; Selecione o assunto &gt;&gt;</option>
						<?php foreach ($arrayAssunto as $key => $assunto) { ?>
							<option <?php if($assunto['id_assunto_processo'] == $arrayProcesso['id_assunto_processo']) echo 'selected'; ?> value="<?php echo $assunto['id_assunto_processo']; ?>"><?php echo $assunto['nome']; ?></option>
						<?php } ?>
					</select>
				<?php } else { ?>
	       			<label class="ui-input-text">Assunto: </label>
		       		<?php echo $arrayProcesso['assunto']; ?>
	       		<?php } ?>
			</div>
			<div data-role="fieldcontain">
				<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2'))) { ?>
				    <label class="select ui-select" for="requerente_processo">Requerente: <span class="asterisco">*<span></label>
				    <div class="ui-select">
				 		<a href="#" onclick="selecionarRequerente('?id=<?php echo $_GET['id'] ?>&lista=<?php echo $_GET['lista']; ?>')" data-role="button" id="requerente_processo" data-mini="true" data-iconpos="right" data-icon="arrow-r">
				 			<span id="nome_requerente_selecionado"><?php echo $arrayProcesso['nome_requerente']; ?></span>
				 		</a>
				 	</div>
				 	<input type="hidden" id="id_requerente_selecionado" value="<?php echo $arrayProcesso['id_professor_requerente']; ?>">
				 <?php } else { ?>
	       			<label class="ui-input-text">Requerente: </label>
		       		<?php echo $arrayProcesso['nome_requerente']; ?>
	       		<?php } ?>
			</div>
			<div data-role="fieldcontain">
				<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2'))) { ?>
				    <label class="select ui-select" for="relator_processo">Relator: <span class="asterisco">*<span></label>
				    <div class="ui-select">
				 		<a href="#" onclick="selecionarRelator('?id=<?php echo $_GET['id'] ?>&lista=<?php echo $_GET['lista']; ?>')" data-role="button" id="relator_processo" data-mini="true" data-iconpos="right" data-icon="arrow-r">
				 			<span id="nome_relator_selecionado"><?php echo $arrayProcesso['nome_relator']; ?></span>
				 		</a>
				 	</div>
				 	<input type="hidden" id="id_relator_selecionado" value="<?php echo $arrayProcesso['id_professor_relator']; ?>">
			 	<?php } else { ?>
	       			<label class="ui-input-text">Relator: </label>
		       		<?php echo $arrayProcesso['nome_relator']; ?>
	       		<?php } ?>
			</div>
			<div data-role="fieldcontain">
			    <?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2')) || ($arrayProcesso['meu_processo'] == '1' && $arrayProcesso['processo_ativo'])) { ?>
			    	<label class="select ui-select" for="parecer-processo">Parecer:</label>
			    	<textarea id="parecer-processo" name="parecer-processo" style="height: 100px"><?php echo $arrayProcesso['parecer']; ?></textarea>
			    <?php } else { ?>
			 	   <label class="ui-input-text">Parecer: </label>
			 	   <?php echo nl2br($arrayProcesso['parecer']); ?>
	       		<?php } ?>
			</div>
			<?php if( in_array($_SESSION['CPPD']['PERFIL'], array('1','2')) || ($arrayProcesso['meu_processo'] == '1' && $arrayProcesso['processo_ativo'])) { ?>
				<fieldset class="ui-grid-a">
					<span style='float: left;font-size: small'>[* Obrigatório]</span>
					<div align="center">
						<a data-role="button" href="edit_processo.php?id=<?php echo $arrayProcesso['id_processo']; ?>&lista=<?php echo $_GET['lista']; ?>" rel="external" data-transition="slide" data-icon="refresh" data-theme="e" data-inline="true">Resetar</a>
						<button onclick="editarProcesso('<?php echo $arrayProcesso['id_processo']; ?>')" type="submit" data-theme="a" data-icon="check" data-inline="true">Salvar alterações</button>
					</div>
			    </fieldset>
		    <?php } ?>

		    </div>

		</div>

	</div><!-- /content -->

	<?php require_once(dirname(__FILE__) . '/inc/inc.rodape.php'); ?>

</div>
<script type="text/javascript">
	
</script>
</body>
</html>