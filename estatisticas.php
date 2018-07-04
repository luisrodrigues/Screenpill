<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Feed";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
 $ver_estatisticas = $este_utilizador->verificar_permissao("ver_estatisticas");

 if(!$ver_estatisticas) {
 	session_destroy();
 	header("Location: login.php?erro=4");
 }

?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Estatísticas</li></a>
		</ul>
		<span class="stats-row">
			<div class="stats-card">
				<h1 class="stats-title">Total Utilizadores</h1>
				<h1 class="stats-nr"><? echo $este_utilizador->total("utilizador");?></h1>
			</div>
			<div class="stats-card">
				<h1 class="stats-title">Total Comentários</h1>
				<h1 class="stats-nr"><? echo $este_utilizador->total("comentario");?></h1>
			</div>
		</span>
		<span class="stats-row">
			<div class="stats-card">
				<h1 class="stats-title">Total Reviews</h1>
				<h1 class="stats-nr"><? echo $este_utilizador->total("review");?></h1>
			</div>
			<div class="stats-card">
				<h1 class="stats-title">Total Filmes</h1>
				<h1 class="stats-nr"><? echo $este_utilizador->total("filme");?></h1>
			</div>
		</span>
	</div>
</div>
<?
 include "utils/footer.php";
?>