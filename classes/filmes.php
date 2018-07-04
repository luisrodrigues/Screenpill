<?php

require_once "ligarbd.php";
require_once "realizador.php";
require_once "ator.php";
require_once "estudio.php";
require_once "genero.php";

class filme {

    //Atributos da classe
    public $filme_id;
    public $genero_id;
    public $titulo;
    public $duracao;
    public $descricao;
    public $poster;
    public $ano_de_estreia;
    public $aprovado;
    public $classificacao;

    //Construtor da class
    public function __construct($filme_id = NULL, $genero_id = NULL, $titulo = NULL, $duracao = NULL, $descricao = NULL, $poster = NULL, $ano_de_estreia = NULL, $aprovado = NULL, $classificacao = NULL) {
        $this->filme_id = $filme_id;
        $this->genero_id = $genero_id;
        $this->titulo = $titulo;
        $this->duracao= $duracao;
        $this->descricao = $descricao;
        $this->poster = $poster;
        $this->ano_de_estreia = $ano_de_estreia;
        $this->aprovado = $aprovado;
        $this->classificacao = $classificacao;
    }

    public function loadById($id) {
        $result = mysql_query("SELECT * from filme WHERE filme_id = $id");
        $row = mysql_fetch_assoc($result) or die(mysql_error());

        $this->filme_id = $row["filme_id"];
        $this->genero_id = $row["genero_id"];
        $this->titulo = $row["titulo"];
        $this->duracao = $row["duracao"];
        $this->descricao = $row["descricao"];
        $this->poster = $row["poster"];
        $this->ano_de_estreia = $row["ano_estreia"];
        $this->aprovado = $row["aprovado"];
        $this->classificacao = $row["classificacao"];
    }
	
    //Modifica os dados do filme
    public function editar($id, $genero_id = NULL, $titulo = NULL, $duracao = NULL, $descricao = NULL, $poster = NULL, $ano_de_estreia = NULL, $aprovado = NULL, $classificacao = NULL) {
        $sql = "UPDATE filme SET genero_id = '$genero_id', titulo = '$titulo', duracao = '$duracao', descricao = '$descricao', poster = '$poster', ano_estreia = '$ano_de_estreia' WHERE filme_id = '$id'";
        $result = mysql_query($sql);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        return true;
    }

    //Adiciona um filme à BD
    public function inserir($novo_genero, $novo_titulo, $nova_duracao, $nova_descricao, $novo_poster, $novo_ano) {
        $sql = "INSERT INTO filme(genero_id, titulo, duracao, descricao, poster, ano_estreia) VALUES ($novo_genero,'$novo_titulo', '$nova_duracao', '$nova_descricao', '$novo_poster', '$novo_ano')";
        $result = mysql_query($sql);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        echo "<meta http-equiv='refresh' content='0'>";
        return true;
    }

    //Apaga o filme da BD
    public function apagar($id) {
        $sql = "DELETE FROM filme WHERE filme_id = $id";
        $result = mysql_query($sql);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        return true;
    }
	
	//Verifica se o filme e ator já estão associados
	public function verificaAssoAtor($ator_id) {
		$sql = "SELECT * FROM ator_filme";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());

		while ($row = mysql_fetch_assoc($result)) {
			if($row["filme_id"] == $this->filme_id AND $row["ator_id"] == $ator_id){
				return TRUE;
			}   
		} 
           return FALSE;
	}
	
	//Associa um ator ao filme
	public function associarAtor($id_ator, $id_filme) {
		$sql = "INSERT INTO ator_filme (ator_id, filme_id) VALUES ($id_ator, $id_filme)";
		$result = mysql_query($sql) or die('associar: Invalid query: ' . mysql_error());
		if (!$result) {
            die('associarAtor: Invalid query: ' . mysql_error());
        } 
	}

    //Desassocia um ator de um filme
    public function retirarAtor($id_ator, $id_filme) {
        $sql = "DELETE FROM ator_filme WHERE ator_id = $id_ator AND filme_id = $id_filme";
        $result = mysql_query($sql) or die('retirar: Invalid query: ' . mysql_error());
        if (!$result) {
            die('associarAtor: Invalid query: ' . mysql_error());
        } 
    }

    //Verifica se o filme e realizador já estão associados
    public function verificaAssoRealizador($realizador_id) {
        $sql = "SELECT * FROM realizador_filme";
        $result = mysql_query($sql) or die('verificaRealizador: Invalid query: ' . mysql_error());

        while ($row = mysql_fetch_assoc($result)) {
            if($row["filme_id"] == $this->filme_id AND $row["realizador_id"] == $realizador_id){
                return TRUE;
            }   
        } 
           return FALSE;
    }

    //Associa um realizador ao filme
    public function associarRealizador($id_realizador, $id_filme) {
        $sql = "INSERT INTO realizador_filme (realizador_id, filme_id) VALUES ($id_realizador, $id_filme)";
        $result = mysql_query($sql) or die('associarRealizador1: Invalid query: ' . mysql_error());
        if (!$result) {
            die('associarRealizador2: Invalid query: ' . mysql_error());
        } 
    }

    //Desassocia um realizador de um filme
    public function retirarRealizador($id_realizador, $id_filme) {
        $sql = "DELETE FROM realizador_filme WHERE realizador_id = $id_realizador AND filme_id = $id_filme";
        $result = mysql_query($sql) or die('retirarRealizador: Invalid query: ' . mysql_error());
        if (!$result) {
            die('retirarRealizador: Invalid query: ' . mysql_error());
        } 
    }

	//Retorna todos os filmes
	public static function getAll() {
		$sql = "SELECT * FROM filme";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
		
		$filmes = array();
		while ($row = mysql_fetch_assoc($result)) {
			$filmes[] = new filme($row["filme_id"],$row["genero_id"],$row["titulo"],$row["duracao"],$row["descricao"],$row["poster"],$row["ano_estreia"],$row["aprovado"],$row["classificacao"]);
		}
		return $filmes;
	}

    public function getRealizadores() {
        $sql = "SELECT * FROM realizador inner join realizador_filme ON realizador_filme.realizador_id = realizador.realizador_id WHERE realizador_filme.filme_id=$this->filme_id";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $realizadores = array();
        while ($row = mysql_fetch_assoc($result)) {
            $realizadores[] = new realizador($row["realizador_id"],$row["nome"],$row["data_nascimento"],$row["fotografia"],$row["biografia"]);
        }
        return $realizadores;
    }

    public function getAtores() {
        $sql = "SELECT * FROM ator inner join ator_filme ON ator_filme.ator_id = ator.ator_id WHERE ator_filme.filme_id=$this->filme_id";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $atores = array();
        while ($row = mysql_fetch_assoc($result)) {
            $atores[] = new ator($row["ator_id"],$row["nome"],$row["data_nascimento"],$row["fotografia"],$row["biografia"]);
        }
        return $atores;
    }

    public function getEstudios() {
        $sql = "SELECT * FROM estudio inner join estudio_filme_id ON estudio_filme_id.estudio_id = estudio.estudio_id WHERE estudio_filme_id.filme_id=$this->filme_id";
        $result = mysql_query($sql) or die('getEstudios: Invalid query: ' . mysql_error());
        
        $estudios = array();
        while ($row = mysql_fetch_assoc($result)) {
            $estudios[] = new estudio($row["estudio_id"],$row["nome"],$row["data_criacao"],$row["sede"],$row["descricao"]);
        }
        return $estudios;
    }

    public function getGenero() {
        $genero = new genero();
        $genero->loadById($this->genero_id);
        return $genero->nome;
    }
}

?>
