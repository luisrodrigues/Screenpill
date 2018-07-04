<?php
  session_start();
  
  include 'classes/utilizador.php';
  if (!isset($_SESSION['utilizador_id'])) {
    header('Location: login.php?erro=4');
  } else {
  	$este_utilizador = new utilizador();
  	$este_utilizador->loadById($_SESSION['utilizador_id']);
  }
?>


<!DOCTYPE html>
<html lang="en-US">
<head>
	<title><?php echo $GLOBALS['title']; ?></title>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	