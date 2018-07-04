<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Utilizadores";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
if(isset($_GET["ver"]) && $_GET["ver"] == "todos") {
	$ver_utilizadores = $este_utilizador->getUsers();
} else if(isset($_GET["ver"]) && $_GET["ver"] == "seguindo") {
	$ver_utilizadores = $este_utilizador->getUsersSeguindo();
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
			<a href="ver_utilizadores.php?ver=todos"><li class="main-secondary-menu-item">Todos</li></a>
			<a href="ver_utilizadores.php?ver=seguindo"><li class="main-secondary-menu-item">Seguindo</li></a>
		</ul>
		<?
			
			foreach ($ver_utilizadores as $utilizador) {
				$nReviews = $utilizador->countReviews();
				$nComentarios = $utilizador->countComentarios();

				echo "<div class='ver-card'>
						<img src='$utilizador->avatar' class='ver-avatar'>
						<span class='ver-card-info'>
							<a href='ver_perfil.php?id=$utilizador->id'><h1 class='ver-card-title underline'>$utilizador->nome</h1></a>
							<a href='http://$utilizador->website'><p class='ver-card-p underline'>$utilizador->website</p></a>
						</span>
						<span class='ver-card-info'>
							<p class='ver-card-p'>$nReviews Reviews</p>
							<p class='ver-card-p'>$nComentarios Comentários</p>
						</span>
					</div>";
			}	
		?>
	</div>	
</div>
<?
 include "utils/footer.php";
?>