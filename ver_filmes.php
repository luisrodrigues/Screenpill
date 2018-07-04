<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Filmes";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
if(isset($_GET["ver"]) && $_GET["ver"] == "todos") {
	$ver_filmes=$este_utilizador->getAllFilmes();
} else if(isset($_GET["ver"]) && $_GET["ver"] == "favoritos") {
	$ver_filmes=$este_utilizador->getFilmesFavoritos();
}

?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="ver_filmes.php?ver=todos"><li class="main-primary-menu-item">Filmes</li></a>
			<a href="ver_reviews.php?ver=todos"><li class="main-primary-menu-item">Reviews</li></a>
			<a href="ver_utilizadores.php?ver=todos"><li class="main-primary-menu-item">Users</li></a>
		</ul>
		<ul class="main-secondary-menu">
			<a href="ver_filmes.php?ver=todos"><li class="main-secondary-menu-item">Todos</li></a>
			<a href="ver_filmes.php?ver=favoritos"><li class="main-secondary-menu-item">Favoritos</li></a>
		</ul>
		<?
			
			foreach ($ver_filmes as $filme) {
				$genero = $filme->getGenero();
				
				echo "<div class='ver-card'>
						<img src='$filme->poster' class='ver-poster'>
						<span class='ver-card-info'>
							<a href='ver_filme.php?id=$filme->filme_id'><h1 class='ver-card-title underline'>$filme->titulo ($filme->classificacao/10)</h1></a>
							<p class='ver-card-p'>$filme->ano_de_estreia</p>
							<p class='ver-card-p'>$genero</p>
							<p class='ver-card-p'>Duração: $filme->duracao min</p>
						</span>
					</div>";
			}
			
		?>
	</div>	
</div>
<?
 include "utils/footer.php";
?>