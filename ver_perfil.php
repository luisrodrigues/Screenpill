<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Perfil";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
 if(isset($_GET["id"])) {
	$perfil_id = $_GET["id"];
	$ver_utilizador = new utilizador();
	$ver_utilizador->loadById($perfil_id);
 }
?>
	
<div class="main">
	<div class="main-left">
					<img src="<?php echo $ver_utilizador->avatar; ?>" class="main-profile-pic">
					<span>
						<h1 class="main-title"><?php echo $ver_utilizador->nome; ?></h1>
						<a href="http://<?php echo $ver_utilizador->website; ?>"><p class="main-text underline"><?php echo $ver_utilizador->website; ?></p></a>
					</span>
					<span>
						<h1 class="main-title">Bio</h1>
						<p class="main-text-long"><?php echo $ver_utilizador->biografia; ?></p>
					</span>
					<form method="post" action="<? echo "ver_perfil.php?id=$ver_utilizador->id";?>">
						<input class="main-button" type="submit" name="seguir" value="Seguir">
					</form>
<?php 
	
	if(isset($_POST["seguir"])) {
	 $este_utilizador->verificar_seguidor($_GET["id"]);
 	}

?>
	</div>
	<div class="main-right">
					<span>
						<h1 class="main-title">Filmes Favoritos</h1>
						<ul>
							<? 
							
								$filmes_favoritos = $ver_utilizador->getFilmesFavoritos();
								foreach	($filmes_favoritos as $filme) {
									echo "<a href='ver_filme.php?id=$filme->filme_id'><li class='main-list-item underline'>$filme->titulo</li></a>";
								}
							?>
						</ul>
					</span>
					<span>
						<h1 class="main-title">Reviews</h1>
						<ul>
							<? 
							
							$ver_reviews = $ver_utilizador->getReviews();
							foreach	($ver_reviews as $review) {
								echo "<a href='ver_review.php?id=$review->review_id'><li class='main-list-item underline'>$review->titulo</li></a>";
							}
							
							?>
						</ul>
					</span>
	</div>
</div>
<?
 include "utils/footer.php";
?>