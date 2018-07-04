-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 04-Jul-2018 às 23:37
-- Versão do servidor: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si06`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ator`
--

CREATE TABLE `ator` (
  `ator_id` int(11) NOT NULL,
  `nome` varchar(200) CHARACTER SET latin1 NOT NULL,
  `data_nascimento` date NOT NULL,
  `fotografia` varchar(150) CHARACTER SET latin1 NOT NULL,
  `biografia` varchar(400) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `ator`
--

INSERT INTO `ator` (`ator_id`, `nome`, `data_nascimento`, `fotografia`, `biografia`) VALUES
(1, 'Leonardo DiCaprio', '1974-11-11', 'https://s1.r29static.com//bin/entry/8bc/1554,0,1667,2000/545x654,80/1902098/image.jpg', 'Leonardo Wilhelm DiCaprio Ã© um premiado ator, produtor e filantropo norte-americano vencedor do Oscar de melhor ator com o filmeThe Revenant.'),
(2, 'Tom Hanks', '1956-07-09', 'https://pmcvariety.files.wordpress.com/2017/10/tom-hanks-2.jpg?w=1000&h=563&crop=1', 'Thomas Jeffrey Hanks, mais conhecido como Tom Hanks Ã© um premiado ator, produtor, roteirista e diretor americano'),
(9, 'Alden Ehrenreich', '1989-11-22', '', ''),
(10, 'Ben Affleck', '1974-02-14', '', ''),
(11, 'Henry Cavill', '0000-00-00', '', ''),
(12, 'Kristen Stewart', '1990-02-28', '', ''),
(13, 'Gerard Butler', '1972-04-08', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ator_filme`
--

CREATE TABLE `ator_filme` (
  `ator_filme_id` int(11) NOT NULL,
  `ator_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ator_filme`
--

INSERT INTO `ator_filme` (`ator_filme_id`, `ator_id`, `filme_id`) VALUES
(20, 1, 1),
(21, 9, 20),
(22, 10, 2),
(23, 11, 2),
(24, 12, 16),
(25, 13, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `comentario_id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`comentario_id`, `utilizador_id`, `review_id`, `descricao`, `data`) VALUES
(24, 20, 9, 'TambÃ©m acho mesmo bom, e tens toda a razÃ£o, ela foi egoÃ­sta... Cabiam lÃ¡ os dois, atÃ© faziam conchinha para ficarem mais quentinhos...', '2018-05-23 23:16:03'),
(25, 21, 10, 'Olha, Ã³ Joana, nÃ£o gosto nada que andes para aÃ­ a dizer coisas dessas... Eu... hmm... Eu deixei que ele ganhasse porque sou generoso!', '2018-05-23 23:17:45'),
(26, 21, 11, 'Eu tambÃ©m gosto de vampiros, mas os lobisomens sÃ£o mais radicais!', '2018-05-23 23:21:22'),
(27, 22, 7, 'JÃ¡ viste Deadpool 2? Ai Ã© que vais chorar!', '2018-05-24 07:12:01'),
(28, 22, 10, 'LOOOOOOOOOOL! Esta review estÃ¡ mais negra que o Universo da DC!', '2018-05-24 07:13:02'),
(29, 22, 12, 'Ã‰S...SÃ“...TRISTE! #FAKESUPERHERO', '2018-05-24 07:13:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudio`
--

CREATE TABLE `estudio` (
  `estudio_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data_criacao` date NOT NULL,
  `sede` varchar(150) NOT NULL,
  `descricao` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estudio`
--

INSERT INTO `estudio` (`estudio_id`, `nome`, `data_criacao`, `sede`, `descricao`) VALUES
(1, 'Paramount Pictures Corporation', '1912-05-08', 'Los Angeles', 'A Paramount foi um dos maiores e mais lucrativos estï¿½dios de Hollywood nos anos 1920, 1940 e 1970. Modernamente, o estï¿½dio procura reinventar a forma de fazer cinema, a fim de enfrentar os desafios do sï¿½culo XXI, atravï¿½s do uso de novas tecnologias.'),
(2, '20th Century Foxs', '1934-12-26', 'Los Angeles', ' 20th Century Fox (Twentieth Century Fox Film Corporation, ou Twentieth Century-Fox Film Corporation, com hï¿½fen, de 1935 a 1985), tambï¿½m conhecida simplesmente como Fox, ï¿½ um dos seis maiores estï¿½dios de cinema dos Estados Unidos. '),
(3, 'Disneys', '1987-03-21', 'Paris', 'jm'),
(8, 'Columbia Pictures Industries, Inc.', '1918-06-19', 'CalifÃ³rnia', 'Columbia Pictures Industries, Inc. Ã© uma produtora e distribuidora de filmes norte-americana e Ã© um dos seis maiores estÃºdios de cinema. Ã‰ uma divisÃ£o da Sony Pictures Entertainment, uma subsidiÃ¡ria do conglomerado japonÃªs Sony.[1] A sua sede estÃ¡ localizada em Culver City, na CalifÃ³rnia nos Estados Unidos.  O estÃºdio foi fundado originalmente em 1918 como \"Cohn-Brandt-Cohn Film Sales\" p');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudio_filme_id`
--

CREATE TABLE `estudio_filme_id` (
  `estudio_filme_id` int(11) NOT NULL,
  `estudio_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estudio_filme_id`
--

INSERT INTO `estudio_filme_id` (`estudio_filme_id`, `estudio_id`, `filme_id`) VALUES
(13, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito`
--

CREATE TABLE `favorito` (
  `utilizador_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favorito`
--

INSERT INTO `favorito` (`utilizador_id`, `filme_id`, `data`) VALUES
(1, 1, '2018-05-05 08:51:06'),
(1, 2, '2018-05-11 19:40:49'),
(1, 20, '2018-06-29 15:50:47'),
(2, 2, '2018-05-05 08:59:16'),
(18, 1, '2018-05-14 20:45:11'),
(21, 2, '2018-05-23 23:17:57'),
(23, 21, '2018-05-24 07:58:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

CREATE TABLE `filme` (
  `filme_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `duracao` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `poster` varchar(200) NOT NULL,
  `ano_estreia` int(11) NOT NULL,
  `aprovado` tinyint(1) NOT NULL,
  `classificacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`filme_id`, `genero_id`, `titulo`, `duracao`, `descricao`, `poster`, `ano_estreia`, `aprovado`, `classificacao`) VALUES
(1, 1, 'Titanic', 195, 'Titanic Ã© um filme Ã©pico de romance e drama norte-americano de 1997, escrito, dirigido, co-produzido e co-editado por James Cameron. Ã‰ uma histÃ³ria de ficÃ§Ã£o do naufrÃ¡gio real do RMS Titanic, estrelando Leonardo DiCaprio como Jack Dawson, e Kate Winslet como Rose DeWitt Bukater, membros de diferentes classes sociais que se apaixonam durante a fatÃ­dica viagem inaugural no navio. ', 'https://http2.mlstatic.com/poster-cartaz-titanic-2-D_NQ_NP_13792-MLB2703949927_052012-F.jpg', 1997, 1, 8),
(2, 2, 'Batman vs Superman', 151, 'Fearing that the actions of Superman are left unchecked, Batman takes on the Man of Steel, while the world wrestles with what kind of a hero it really needs. ', 'http://br.web.img2.acsta.net/pictures/18/01/04/18/43/2155615.jpg', 2016, 0, 7),
(16, 1, 'Twilight', 123, 'Vampiros', 'https://ia.media-imdb.com/images/M/MV5BMTQ2NzUxMTAxN15BMl5BanBnXkFtZTcwMzEyMTIwMg@@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 2009, 0, 2),
(20, 2, 'Solo', 135, 'During an adventure into a dark criminal underworld, Han Solo meets his future copilot Chewbacca and encounters Lando Calrissian years before joining the Rebellion. ', 'https://i0.wp.com/teaser-trailer.com/wp-content/uploads/Star-Wars-Solo-New-Film-Poster-2.jpg?ssl=1', 2018, 0, 9),
(21, 2, '300', 117, 'King Leonidas of Sparta and a force of 300 men fight the Persians at Thermopylae in 480 B.C. ', 'http://img06.deviantart.net/bc60/i/2013/013/3/7/300_spartans_by_lukarley-d5rcq7r.jpg', 2006, 0, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `genero_id` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`genero_id`, `nome`) VALUES
(1, 'Romance'),
(2, 'Action');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id_utilizador` int(11) NOT NULL,
  `publicar` tinyint(1) NOT NULL DEFAULT '1',
  `apagar_review` tinyint(1) NOT NULL DEFAULT '1',
  `editar` tinyint(1) NOT NULL DEFAULT '1',
  `ver_filmes` int(11) NOT NULL DEFAULT '1',
  `apagar` int(11) NOT NULL DEFAULT '1',
  `ver_estatisticas` int(11) NOT NULL DEFAULT '0',
  `associar` int(11) NOT NULL DEFAULT '1',
  `desassociar` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id_utilizador`, `publicar`, `apagar_review`, `editar`, `ver_filmes`, `apagar`, `ver_estatisticas`, `associar`, `desassociar`) VALUES
(1, 1, 1, 1, 1, 0, 1, 0, 0),
(2, 1, 1, 1, 1, 1, 0, 1, 1),
(12, 1, 1, 1, 1, 1, 0, 1, 1),
(17, 1, 1, 1, 1, 1, 0, 1, 1),
(18, 1, 1, 1, 1, 1, 0, 1, 1),
(19, 1, 1, 1, 1, 1, 0, 1, 1),
(20, 1, 1, 1, 1, 1, 0, 1, 1),
(21, 1, 1, 1, 1, 1, 0, 1, 1),
(22, 1, 1, 1, 1, 1, 0, 1, 1),
(23, 1, 1, 1, 1, 1, 1, 1, 1),
(24, 1, 1, 1, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `realizador`
--

CREATE TABLE `realizador` (
  `realizador_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `fotografia` varchar(150) NOT NULL,
  `biografia` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `realizador`
--

INSERT INTO `realizador` (`realizador_id`, `nome`, `data_nascimento`, `fotografia`, `biografia`) VALUES
(1, 'James Cameron', '1954-08-16', 'https://upload.wikimedia.org/wikipedia/commons/c/cd/JamesCameronHWOFOct2012.jpg', 'James Francis Cameron (Kapuskasing, 16 de agosto de 1954) ï¿½ um cineasta, produtor, roteirista e editor canadense. ï¿½ bacharel em Fï¿½sica pela Universidade da Califï¿½rnia e tambï¿½m explorador dos fundos oceï¿½nicos, tendo sido, em 26 de marï¿½o de 2012, o primeiro homem a descer sozinho num batiscafo ao fundo da Fossa das Marianas.'),
(7, 'Ron Howard', '1959-05-24', 'https://www.biography.com/.image/t_share/MTE5NTU2MzE2NDI5OTExNTYz/ron-howard-9542185-1-402.jpg', 'Academy Award-winning filmmaker Ron Howard is one of this generations most popular directors.'),
(8, 'Catherine Hardwicke ', '1979-06-21', 'https://www.aceshowbiz.com/images/wennpic/catherine-hardwicke-premiere-the-mortal-instruments-city-of-bones-05.jpg', 'Realizadora do filme Twilight.'),
(9, 'Zack Snyder', '1991-10-27', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/Zack_Snyder_by_Gage_Skidmore_2.jpg/1200px-Zack_Snyder_by_Gage_Skidmore_2.jpg', 'Famoso realizador de muitos filmes, quais? Pois...');

-- --------------------------------------------------------

--
-- Estrutura da tabela `realizador_filme`
--

CREATE TABLE `realizador_filme` (
  `realizador_filme_id` int(11) NOT NULL,
  `realizador_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `realizador_filme`
--

INSERT INTO `realizador_filme` (`realizador_filme_id`, `realizador_id`, `filme_id`) VALUES
(3, 1, 1),
(5, 7, 20),
(6, 8, 16),
(7, 9, 2),
(8, 9, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` text NOT NULL,
  `texto` varchar(250) NOT NULL,
  `rating` int(11) NOT NULL,
  `like` tinyint(4) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `review`
--

INSERT INTO `review` (`id`, `data`, `titulo`, `texto`, `rating`, `like`, `id_utilizador`, `filme_id`) VALUES
(7, '2018-05-23 13:20:11', 'Fatelas!', 'Chorei... Mas como toda a gente diz que o filme nÃ£o presta, quem sou eu para dizer o contrÃ¡rio?', 2, 0, 1, 16),
(9, '2018-05-23 17:39:37', 'Muito bom', 'Gostei muito, mas eles cabiam os dois na porta.', 8, 0, 1, 1),
(10, '2018-05-23 23:12:32', 'Poderosos', 'Curto largo que o batman dÃª porrada ao super-homem, porque o CK tem a mania que Ã© buÃ© de forte...', 7, 0, 1, 2),
(11, '2018-05-23 23:14:42', 'Curto vampiros!', 'Ai meu deus, o Edward Ã© tÃ£o bonito e pÃ¡lido!', 10, 0, 20, 16),
(12, '2018-05-23 23:20:02', 'Coitados!', 'Eu tenhomuita pena deles... NÃ£o ouvi com a minha super-audiÃ§Ã£o, porque nessa semana estava com otite, caso contrÃ¡rio tinha ido lÃ¡ salvÃ¡-los a todos... SInceramente... Sinceramente...', 9, 0, 21, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidor`
--

CREATE TABLE `seguidor` (
  `id_seguido` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `seguidor`
--

INSERT INTO `seguidor` (`id_seguido`, `id_seguidor`, `data`) VALUES
(2, 1, '2018-05-05 09:57:26'),
(1, 2, '2018-05-05 09:58:49'),
(12, 1, '2018-05-09 17:01:18'),
(1, 23, '2018-05-24 07:58:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `password` varchar(32) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `biografia` varchar(400) NOT NULL,
  `website` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `nome`, `password`, `avatar`, `biografia`, `website`) VALUES
(1, 'joanam', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/female-43.jpg', 'Adoro filmes romÃ¢nticos e de comÃ©dia. Gosto imenso de ir ao cinema!', 'www.fe.up.joanam.pt'),
(2, 'ruir', '81dc9bdb52d04dc20036dbd8313ed055', 'https://s3.amazonaws.com/uifaces/faces/twitter/jadlimcaco/128.jpg', 'Adoro filmes com o Tom Cruise ;)', 'www.ruir.com'),
(12, 'luir', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/male-71.jpg', 'Lorem ipsum dolor sit amet, putent eruditi duo in, ea mei tale decore periculis. Brute civibus consetetur at mei, etiam libris iriure et vix, qui iusto elitr option cu.', 'www.luir.com'),
(17, 'jonny', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/male-71.jpg', 'Lorem ipsum dolor sit amet, putent eruditi duo in, ea mei tale decore periculis. Brute civibus consetetur at mei, etiam libris iriure et vix, qui iusto elitr option cu.', 'www.jonny.com'),
(18, 'afcruz', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/female-83.jpg', 'Brasileira a estudar no Porto! Adoro filmes de comÃ©dia!', 'www.afcruz.com'),
(19, 'pbarros', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/male-71.jpg', 'JÃ¡ fui atleta de remo. Gosto de filmes de motocross!', 'www.rebentanelas.com'),
(20, 'luisaguiar', '81dc9bdb52d04dc20036dbd8313ed055', 'https://d3iw72m71ie81c.cloudfront.net/male-71.jpg', 'Lorem ipsum dolor sit amet, putent eruditi duo in, ea mei tale decore periculis. Brute civibus consetetur at mei, etiam libris iriure et vix, qui iusto elitr option cu.', 'www.luisaguiar.com'),
(21, 'superhomem', '81dc9bdb52d04dc20036dbd8313ed055', 'https://http2.mlstatic.com/fantasia-superman-super-homem-ccapa-infantil-original-D_NQ_NP_720725-MLB25468928449_032017-F.jpg', 'Tenho um nome original do meu Planeta mto estranho. Fui adotado em pequeno e na altura sÃ³ me deixavam ver filmes de romance. Tenho um fraquinho pelo Stalone e claro: Kryptonite!', 'www.superman.com'),
(22, 'wadewilson', '81dc9bdb52d04dc20036dbd8313ed055', 'http://digitalspyuk.cdnds.net/17/02/320x320/square-1484222978-deadpool.jpg', '\"Eu sou o NTS, quem curte, curte, quem nÃ£o curte esquece!\" Lol era bom nÃƒÂ£ era? O meu nome ÃƒÂ© deadpool: maior apreciador de comida mexicana e filmes de romance ÃƒÂ  face da terra! Tmb gosto de filmes de Bollywood!', 'www.deadpool.com'),
(23, 'batman', '81dc9bdb52d04dc20036dbd8313ed055', 'https://media.licdn.com/dms/image/C4E03AQGygkSucyniiQ/profile-displayphoto-shrink_800_800/0?e=1532563200&v=beta&t=LQJGPL8A2BIZSEgdqRVFvbp_ypp6xFtfYTJ0O73gqHU', 'Sou o batman! Bruce Wayne? Quem Ã© esse? Ah... Aquele ricalhaÃ§o... Ele sÃ³ gosta de borga, eu sou o herÃ³i que ninguÃ©m quer mas que todos precisam', 'www.batman.com'),
(24, 'armindo', '3c91dd8c14dd1623ad208ca4f881fe9c', 'https://d3iw72m71ie81c.cloudfront.net/male-71.jpg', 'Lorem ipsum dolor sit amet, putent eruditi duo in, ea mei tale decore periculis. Brute civibus consetetur at mei, etiam libris iriure et vix, qui iusto elitr option cu.', 'www.armindo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ator`
--
ALTER TABLE `ator`
  ADD PRIMARY KEY (`ator_id`);

--
-- Indexes for table `ator_filme`
--
ALTER TABLE `ator_filme`
  ADD PRIMARY KEY (`ator_filme_id`),
  ADD KEY `ator_id` (`ator_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `utilizador_id` (`utilizador_id`),
  ADD KEY `descricao` (`descricao`),
  ADD KEY `descricao_2` (`descricao`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`estudio_id`);

--
-- Indexes for table `estudio_filme_id`
--
ALTER TABLE `estudio_filme_id`
  ADD PRIMARY KEY (`estudio_filme_id`),
  ADD KEY `estudio_id` (`estudio_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Indexes for table `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`utilizador_id`,`filme_id`),
  ADD KEY `utilizador_id` (`utilizador_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Indexes for table `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`filme_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`genero_id`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id_utilizador`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_utilizador_2` (`id_utilizador`);

--
-- Indexes for table `realizador`
--
ALTER TABLE `realizador`
  ADD PRIMARY KEY (`realizador_id`);

--
-- Indexes for table `realizador_filme`
--
ALTER TABLE `realizador_filme`
  ADD PRIMARY KEY (`realizador_filme_id`),
  ADD KEY `realizador_id` (`realizador_id`,`filme_id`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_utilizador_2` (`id_utilizador`),
  ADD KEY `filme_id` (`filme_id`);

--
-- Indexes for table `seguidor`
--
ALTER TABLE `seguidor`
  ADD KEY `id_seguido` (`id_seguido`),
  ADD KEY `id_seguido_2` (`id_seguido`),
  ADD KEY `id_seguidor` (`id_seguidor`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ator`
--
ALTER TABLE `ator`
  MODIFY `ator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ator_filme`
--
ALTER TABLE `ator_filme`
  MODIFY `ator_filme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `estudio`
--
ALTER TABLE `estudio`
  MODIFY `estudio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `estudio_filme_id`
--
ALTER TABLE `estudio_filme_id`
  MODIFY `estudio_filme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `filme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `genero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `realizador`
--
ALTER TABLE `realizador`
  MODIFY `realizador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `realizador_filme`
--
ALTER TABLE `realizador_filme`
  MODIFY `realizador_filme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ator_filme`
--
ALTER TABLE `ator_filme`
  ADD CONSTRAINT `ator_filme_ibfk_1` FOREIGN KEY (`ator_id`) REFERENCES `ator` (`ator_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ator_filme_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`filme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `estudio_filme_id`
--
ALTER TABLE `estudio_filme_id`
  ADD CONSTRAINT `estudio_filme_id_ibfk_1` FOREIGN KEY (`estudio_id`) REFERENCES `estudio` (`estudio_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudio_filme_id_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`filme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`filme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `filme_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`genero_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD CONSTRAINT `permissoes_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `realizador_filme`
--
ALTER TABLE `realizador_filme`
  ADD CONSTRAINT `realizador_filme_ibfk_1` FOREIGN KEY (`realizador_id`) REFERENCES `realizador` (`realizador_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `realizador_filme_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`filme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`filme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `seguidor`
--
ALTER TABLE `seguidor`
  ADD CONSTRAINT `seguidor_ibfk_1` FOREIGN KEY (`id_seguido`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguidor_ibfk_2` FOREIGN KEY (`id_seguidor`) REFERENCES `utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
