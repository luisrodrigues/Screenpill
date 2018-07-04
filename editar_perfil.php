<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Editar Perfil";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Editar Perfil</li></a>
		</ul>
		<img src="<?php echo $este_utilizador->avatar; ?>" class="main-profile-pic">
		<form class="editar-perfil" method="post" action="">
			<label>Avatar</label>
			<input class="comment-box" type="text" name="editar-avatar" value="<?php echo $este_utilizador->avatar; ?>">
			<label>Website</label>
			<input class="comment-box" type="text" name="editar-website" value="<?php echo $este_utilizador->website; ?>">
			<label>Biografia</label>
			<input class="comment-box" type="text" name="editar-bio" value="<?php echo $este_utilizador->biografia; ?>">
			<input class="comment-add" type="submit" name="editar-perfil" value="Editar">
		</form>
		<?php 
		
		if(isset($_POST["editar-perfil"])) {
			$novo_avatar = $_POST["editar-avatar"];
			$novo_website = $_POST["editar-website"];
			$nova_biografia = $_POST["editar-bio"];

			$este_utilizador->editar($novo_avatar, $novo_website, $nova_biografia);
	 	}
		
	?>
	</div>	
</div>
<?
 include "utils/footer.php";
?>