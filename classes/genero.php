<?php

Class genero {
	
	public $genero_id;
	public $nome;
	
	
	public function __construct( $genero_id = null, $nome = null){ 

		$this->genero_id = $genero_id;
		$this->nome = $nome;		
	}

	public function loadById($id) {
        $result = mysql_query("SELECT * from genero WHERE genero_id = $id");
        $row = mysql_fetch_assoc($result) or die(mysql_error());

        $this->genero_id = $row["genero_id"];
        $this->nome = $row["nome"];
    }
	
	public static function loadAll() {
		$result = mysql_query("SELECT * FROM genero") or die('loadAll: Invalid query: ' . mysql_error());
		$generos = array();
		while ($row = mysql_fetch_assoc($result)) {
            $generos[] = new genero($row["genero_id"], $row["nome"]);
        }
        return $generos;
	}

}
?>