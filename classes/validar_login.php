<?php

require_once "utilizador.php";

if (isset($_POST["login_username"], $_POST["login_password"]) && !empty($_POST["login_username"]) && !empty($_POST["login_password"])) {
    
    $user = $_POST["login_username"];
    $pass = md5($_POST["login_password"]);

    
    $utilizador = new utilizador();
    $utilizador->loadByNome($user);
    
	if ($utilizador->nome == NULL) {
        header("Location: ../login.php?erro=1");
    } else if ($pass != $utilizador->password) {
        header("Location: ../login.php?erro=2");
    } else {
        session_start();
        $_SESSION['utilizador_id'] = $utilizador->id;
        header("Location: ../feed.php?ver=comentarios");
    } 
    
}
else {
    header("Location: ../login.php?erro=3");
}
?>