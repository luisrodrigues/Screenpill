<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Realizador";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 

 if(isset($_GET["id"])) {
	$realizador_id = $_GET["id"];
	$ver_realizador = new realizador();
	$ver_realizador->loadById($realizador_id);
 }

?>	
<div class="main">
	<div class="main-left">
		<img src="<? echo $ver_realizador->foto; ?>" class="main-film-pic">
		<h1 class="main-title"><? echo $ver_realizador->nome; ?></h1>
		<p class="main-text"><? echo $ver_realizador->data; ?></p>		
		<h1 class="main-title">Bio</h1>
		<p class="main-text-long"><? echo $ver_realizador->bio; ?></p>		
	</div>
	<div class="main-right">	
		<h1 class="main-title">Filmes Realizados</h1>
			<? 
				
				$realizador_filmes = $ver_realizador->getFilmes(); 

				foreach	($realizador_filmes as $filme) {
					echo "<a href='ver_filme.php?id=$filme->filme_id'><li class='main-list-item underline'>$filme->titulo</li></a>";
				}
				
			?>
		</div>
</div>
<?
 include "utils/footer.php";
?>