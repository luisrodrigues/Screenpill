</head>
<body>
	<!-- write here -->

	<div class="navbar">
		<div class="menu">
			<img id="mobile-menu" src="images/menu.png">
			<a href="index.html"><img src="images/screenpill.png" id="logo"></a>
			<ul>
				<a href="classes/logout.php"><li class="menu-item opacity border">Logout</li></a>
			</ul>
		</div>
	</div>
	
	<div id="left-section" class="left-section">
			<img src="<?php echo $este_utilizador->avatar ?>" class="profile_pic">
			<h1 class="profile_name"><?php echo $este_utilizador->nome ?></h1>
			<ul class="left-section-menu">
				<a href="feed.php?ver=comentarios"><li class="left-section-menu-item">Feed</li></a>
				<a href="ver_filmes.php?ver=todos"><li class="left-section-menu-item">Descobrir</li></a>
				<li class="left-section-menu-item">Gerir</li>
					<a href="gerir_estudio.php"><li class="left-section-menu-item small">Estúdio</li></a>
					<a href="gerir_review.php"><li class="left-section-menu-item small">Review</li></a>
					<a href="gerir_filme.php"><li class="left-section-menu-item small">Filme</li></a>
					<a href="gerir_ator.php"><li class="left-section-menu-item small">Ator</li></a>
					<a href="gerir_realizador.php"><li class="left-section-menu-item small">Realizador</li></a>
				<li class="left-section-menu-item"><a href="editar_perfil.php">Editar Perfil</a></li>
			<?
				$ver_estatisticas = $este_utilizador->verificar_permissao("ver_estatisticas");
				if($ver_estatisticas) {
					echo "<li class='left-section-menu-item'><a href='estatisticas.php'>Estatísticas</a></li>";
				}
			
			?>
			</ul>
	</div>
		