<?php
	
	require_once 'ligarbd.php';
	
class realizador {

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
		$result = mysql_query("SELECT * from realizador WHERE realizador_id = $id");
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$this->id = $row["realizador_id"];
		$this->nome = $row["nome"];
		$this->data = $row["data_nascimento"];
		$this->foto = $row["fotografia"];
		$this->bio = $row["biografia"];
	}
	
	public static function loadAll() {
		$sql = "SELECT * FROM realizador";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
		$realizadores = array();
		while ($row = mysql_fetch_assoc($result)) {
            $realizadores[] = new realizador($row["realizador_id"],$row["nome"],$row["data_nascimento"],$row["fotografia"],$row["biografia"]);
        }
        return $realizadores;
	}
	
	public function inserir($nome = null, $data = null, $foto = null, $bio = null) {
      $result = mysql_query("INSERT INTO realizador(nome, data_nascimento, fotografia, biografia) VALUES ('$nome', '$data', '$foto', '$bio')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }
	
	  public function editar($id ,$nome=null, $data=null , $foto=null, $bio=null) {
	      $result = mysql_query("UPDATE realizador SET nome = '$nome', data_nascimento = '$data', fotografia = '$foto', biografia = '$bio' WHERE realizador_id = '$id'");
	      if (!$result) {
	        die('Invalid query: ' . mysql_error());
	      }
	      $this->id = $id;
	      $this->nome = $nome;
	      $this->data = $data;
	      $this->foto = $foto;
		  $this->bio = $bio;
	      
	      return true;
	    }

	    public function getFilmes() {
        $sql = "SELECT * FROM filme inner join realizador_filme ON realizador_filme.filme_id = filme.filme_id WHERE realizador_filme.realizador_id=$this->id";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $filmes = array();
        while ($row = mysql_fetch_assoc($result)) {
            $filmes[] = new filme($row["filme_id"],$row["genero_id"],$row["titulo"],$row["duracao"],$row["descricao"],$row["poster"],$row["ano_estreia"],$row["aprovado"],$row["classificacao"]);
        }
        return $filmes;
    }
	public function apagar($id) {
		$sql = "DELETE FROM realizador WHERE realizador_id = $id";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		return true;
	}
}

?>