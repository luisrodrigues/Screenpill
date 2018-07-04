<?php 
	require_once "classes/utilizador.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>ScreenPill : Login</title>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
</head>
<body>
	<!-- write here -->
	<div class="mobile-bar">
		<a href="index.html"><img id="mobile-logo" class="mobile-bar-item" src="images/screenpill.png"></a>
		<a class="mobile-bar-item" href="#login_div">Sign In</a>
	</div>
	<a href="index.html"><img id="logo" src="images/screenpill.png"></a>
	<div id="signup_div" class="signup flex">
		<span>
			<i class="em em-spock-hand"></i>
			<i class="em em-pill"></i>
			<i class="em em-movie_camera"></i>
		</span>
		<h1 class="title dark">Sign up</h1>
		<p class="dark">Ainda não tens uma conta? Cria já!</p>
		<form id="signup" class="flex" method="post" action="">
			<input required type="text" name="signup_username" placeholder="Username">
			<input required type="password" name="signup_password" placeholder="Password">
			<input required type="password" name="signup_password2" placeholder="Confirmar Password">
			<input type="submit" name="signup" value="Sign up">
		</form>
	</div>
	<div id="login_div" class="login flex">
		<span>
			<i class="em em-film_frames"></i>
			<i class="em em-mega"></i>
			<i class="em em---1"></i>
		</span>
		<h1 class="title">Sign in</h1>
		<p>Já tens uma conta? entra!</p>
		<form id="login" class="flex" method="post" action="classes/validar_login.php">
			<input type="text" name="login_username" placeholder="Username">
			<input type="password" name="login_password" placeholder="Password">
			<input id="login-submit" type="submit" name="login" value="Sign in">
		</form>
<?php
    if (isset($_GET["erro"])) {
        $msg_erro = "";
        switch ($_GET["erro"]) {
            case 1: 
                $msg_erro = "Erro. username inexistente.";
                break;
            case 2: 
                $msg_erro = "Erro. Password errada.";
                break;
            case 3:
                $msg_erro = "Erro. Username ou password não definidos.";
                break;
            case 4:
                $msg_erro = "Não tem permissões para aceder à página.";
                break;
        }
        if ($msg_erro != "")
            echo "<p style='"."color: red;'".">$msg_erro</p>";
    }

    if(isset($_POST["signup_username"]) && isset($_POST["signup_password"]) && isset($_POST["signup_password2"])) {
    	$nome = $_POST["signup_username"];
    	$password = $_POST["signup_password"];
    	$password2 = $_POST["signup_password2"];

    	if($password == $password2) {
    		$adduser = new utilizador();
    		$adduser->loadByNome($nome);

    		if($adduser->nome == NULL) {
	    		$adduser->insert($nome, md5($password));
	    		$adduser->loadByNome($nome);
	    		$adduser->insertPermissoes();
	    		echo "<p style='color: white;'>Dados inseridos com sucesso!</p>";
	    	} else {
	    		echo "<p style='color: red;'>Utilizador já existe, introduza um novo username!</p>";
	    	}
    	} else {
    		echo "<p style='color: red;'>Passwords não são iguais!</p>";
    	}

    }

?>
	</div>
<script type="text/javascript" src="scripts/scripts.js"></script>
</body>
</html>