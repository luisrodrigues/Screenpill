<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Filme";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 

 if(isset($_GET["id"])) {
	$filme_id = $_GET["id"];
	$ver_filme = new filme();
	$ver_filme->loadById($filme_id);
 }

?>	
<div class="main">
	<div class="main-left">
		<h1 class="main-title"><? echo $ver_filme->titulo; ?> (<? echo $ver_filme->classificacao; ?>/10)</h1>
		<p class="main-text"><? echo $ver_filme->ano_de_estreia; ?></p>
		<p class="main-text"><? echo $ver_filme->getGenero(); ?></p>
		<img src="<? echo $ver_filme->poster;?>" class="main-film-pic">
					<span>
						<p class="main-text"><b>Realizadores:</b></p>
							<ul>
								<?

								$filme_realizadores = $ver_filme->getRealizadores();
								foreach	($filme_realizadores as $realizador) {
									echo "<a href='ver_realizador.php?id=$realizador->id'><li class='main-list-item underline'>$realizador->nome</li></a>";
								}

								?>
							</ul>
						<p class="main-text"><b>Duração:</b> <? echo $ver_filme->duracao; ?> min</p>
					</span>
					<span>
						<h1 class="main-title">Sinopse</h1>
						<p class="main-text-long"><? echo $ver_filme->descricao; ?></p>
					</span>
					<form method="post" action="<? echo "ver_filme.php?id=$ver_filme->filme_id"; ?>">
						<input class="main-button" type="submit" name="favoritar" value="Adicionar aos Favoritos">
					</form>
<?php 
	
	if(isset($_POST["favoritar"])) {
		$este_utilizador->verificar_filme($_GET["id"]);
 	}

?>								
	</div>
	<div class="main-right">
		<span>
			<h1 class="main-title">Elenco</h1>
				<ul>
					<?

					$filme_atores = $ver_filme->getAtores();
						foreach	($filme_atores as $ator) {
							echo "<a href='ver_ator.php?id=$ator->id'><li class='main-list-item underline'>$ator->nome</li></a>";
						}
					?>
				</ul>
		</span>		
		<span>
			<h1 class="main-title">Estúdios</h1>
			<? 
			
			$filme_estudios = $ver_filme->getEstudios(); 
				foreach	($filme_estudios as $estudio) {
					echo "<p class='main-text'><b>$estudio->nome</b> ($estudio->data), $estudio->sede</p>
						  <p class='main-text-long'>$estudio->descricao</p>";
				}
			?>
		</span>
	</div>
</div>
<?
 include "utils/footer.php";
?>