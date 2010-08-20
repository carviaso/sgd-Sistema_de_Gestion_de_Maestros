//$(function() {

	principal = {
		loadNavHome: function() {
			$(".navHome").click(function() {
				// Carregado um arquivo vazio para a tela nao 'piscar' utilizando a funcao $('#sidebar').html('')
				$('#sidebar').load('app/content/null.php');
				$('#content').load('app/content/home.php');
			});
		},
		loadNavCadastro: function() {
			$(".navCadastro").click(function() {
				$('#sidebar').load('app/views/menuCadastro.php');
				$('#content').load('app/content/cadastro.php');
			});
		},
		loadNavProfessor: function() {
			$(".navProfessor").click(function() {
				$('#sidebar').load('app/views/menuProfessor.php');
				$('#content').load('app/content/professor.php');
			});
		},
		loadNavRelatorio: function() {
			$(".navRelatorio").click(function() {
				$('#sidebar').load('app/views/menuRelatorio.php');
				$('#content').load('app/content/relatorio.php');
			});
		}
	};

//}); 