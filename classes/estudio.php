<?php
	
	require_once 'ligarbd.php';	
	
class estudio {

	public $id;
	public $nome;
	public $data;
	public $sede;
	public $descricao;

	public function __construct($id = null, $nome = null, $data= null, $sede = null, $descricao = null) {
		$this->id = $id;
		$this->nome = $nome;
		$this->data = $data;
		$this->sede = $sede;
		$this->descricao = $descricao;
	}

	public function loadById($id) {
		$result = mysql_query("SELECT * from estudio WHERE estudio_id = $id");
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$this->id = $row["estudio_id"];
		$this->nome = $row["nome"];
		$this->data = $row["data_criacao"];
		$this->sede = $row["sede"];
		$this->descricao = $row["descricao"];
	}

	public function loadByNome($nome) {
		$result = mysql_query("SELECT * from estudio WHERE nome = $nome");
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$this->id = $row["estudio_id"];
		$this->nome = $row["nome"];
		$this->data = $row["data_criacao"];
		$this->sede = $row["sede"];
		$this->descricao = $row["descricao"];
	}

	public function getfilmes() {
		$result = mysql_query("SELECT * from filmes WHERE estudio_id = $this->id");
		$results = array();
		while($row = mysql_fetch_assoc($result)) {
			$results[] = $row;
		}
		return $results;
	}
	
	public function inserir($nome = null, $data = null, $sede = null, $descricao = null) {
      $result = mysql_query("INSERT INTO estudio(nome, data_criacao, sede, descricao) VALUES ('$nome', '$data', '$sede', '$descricao')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
	   echo "<meta http-equiv='refresh' content='0'>";
      
      return true;
    }
	
	public static function getAll() {
        $sql = 'SELECT * FROM estudio ';    
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        $estudios = array();
        while ($row = mysql_fetch_assoc($result)) {
            $estudios[] = new estudio($row["estudio_id"],$row["nome"],$row["data_criacao"],$row["sede"],$row["descricao"]);
        }
        return $estudios;
    }
	  public function editar($id , $nome= null, $data= null, $sede=null, $descricao=null) {
      $result = mysql_query("UPDATE estudio SET nome = '$nome', data_criacao = '$data', sede = '$sede', descricao = '$descricao' WHERE estudio_id = '$id'");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
		 echo "<meta http-equiv='refresh' content='0'>";
      return true;
    }
	
	public function apagar($id){
		$result =mysql_query("DELETE from estudio WHERE estudio_id = '$id'");
	 if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
	
	}
	
}

?>