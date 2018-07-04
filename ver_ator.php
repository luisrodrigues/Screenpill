<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ator";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 

 if(isset($_GET["id"])) {
	$ator_id = $_GET["id"];
	$ver_ator = new ator();
	$ver_ator->loadById($ator_id);
 }

?>	
<div class="main">
	<div class="main-left">
		<img src="<? echo $ver_ator->foto; ?>" class="main-film-pic">
		<h1 class="main-title"><? echo $ver_ator->nome; ?></h1>
		<p class="main-text"><? echo $ver_ator->data; ?></p>		
		<h1 class="main-title">Bio</h1>
		<p class="main-text-long"><? echo $ver_ator->bio; ?></p>		
	</div>
	<div class="main-right">	
		<h1 class="main-title">Participações</h1>
			<? 
			
				$ator_filmes = $ver_ator->getFilmes(); 

				foreach	($ator_filmes as $filme) {
					echo "<a href='ver_filme.php?id=$filme->filme_id'><li class='main-list-item underline'>$filme->titulo</li></a>";
				}
			
			?>
		</div>
</div>
<?
 include "utils/footer.php";
?>