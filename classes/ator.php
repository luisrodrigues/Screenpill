<?php


include "ligarbd.php";

class Ator {
	
	public $id;
	public $nome;
	public $data;
	public $foto;
	public $bio;

	public function __construct($id = null, $nome = null, $data= null, $foto = null, $bio = null) {
		$this->id = $id;
		$this->nome = $nome;
		$this->data = $data;
		$this->foto = $foto;
		$this->bio = $bio;
	}

	public function loadById($id) {
		$result = mysql_query("SELECT * from ator WHERE ator_id = $id");
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$this->id = $row["ator_id"];
		$this->nome = $row["nome"];
		$this->data = $row["data_nascimento"];
		$this->foto = $row["fotografia"];
		$this->bio = $row["biografia"];
	}

	public static function loadAll() {
		$sql = "SELECT * FROM ator";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
		$atores = array();
		while ($row = mysql_fetch_assoc($result)) {
            $atores[] = new ator($row["ator_id"],$row["nome"],$row["data_nascimento"],$row["fotografia"],$row["biografia"]);
        }
        return $atores;
	}

	public function inserir($nome = null, $data = null, $foto = null, $bio = null) {
      $result = mysql_query("INSERT INTO ator(nome, data_nascimento, fotografia, biografia) VALUES ('$nome', '$data', '$foto', '$bio')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      echo "<meta http-equiv='refresh' content='0'>";
      return true;
    }
	
	  public function editar($id, $nome = NULL, $data = NULL, $foto = NULL, $bio = NULL) {
	  $sql = "UPDATE ator SET nome = '$nome', data_nascimento = '$data', fotografia = '$foto', biografia = '$bio' WHERE ator_id = '$id'";
      $result = mysql_query($sql);
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      return true;
	  echo "<meta http-equiv='refresh' content='0'>";
    }
	
	public function apagar($id) {
		$sql = "DELETE FROM ator WHERE ator_id = $id";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		return true;
	}
	
	//ver esta função
    public function getFilmes() {
        $sql = "SELECT * FROM filme inner join ator_filme ON ator_filme.filme_id = filme.filme_id WHERE ator_filme.ator_id=$this->id";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $filmes = array();
        while ($row = mysql_fetch_assoc($result)) {
            $filmes[] = new filme($row["filme_id"],$row["genero_id"],$row["titulo"],$row["duracao"],$row["descricao"],$row["poster"],$row["ano_estreia"],$row["aprovado"],$row["classificacao"]);
        }
        return $filmes;
    }
}

?>