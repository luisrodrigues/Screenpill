<?php

require_once "ligarbd.php";
include "comentario.php";
require_once "filmes.php";

class review {

    //Atributos da classe
    public $review_id;
    public $utilizador_id;
    public $filme_id;
    public $data;
	public $titulo;
    public $texto;
    public $rating;
	public $like;

    //Construtor da classe
    public function __construct($review_id = NULL, $data = NULL, $titulo = NULL, $texto = NULL, $rating = NULL, $like = NULL, $utilizador_id = NULL, $filme_id = NULL) {
        $this->review_id = $review_id;
        $this->utilizador_id = $utilizador_id;
        $this->filme_id = $filme_id;
        $this->data = $data;
		$this->titulo = $titulo;
        $this->texto = $texto;
        $this->rating = $rating;
		$this->like = $like;
    }

    public function loadById($id) {
        $result = mysql_query("SELECT * from review WHERE id = '$id'");
        $row = mysql_fetch_assoc($result) or die(mysql_error());

        $this->review_id = $row["id"];
        $this->utilizador_id = $row["id_utilizador"];
        $this->filme_id = $row["filme_id"];
        $this->data = $row["data"];
        $this->titulo = $row["titulo"];
        $this->texto = $row["texto"];
        $this->rating = $row["rating"];
        $this->like = $row["like"];
    }

    public function getFilme() {
        $filme = new filme();
        $filme->loadById($this->filme_id);
        return $filme;
    }

    public function getAutor() {
        $autor = new utilizador();
        $autor->loadById($this->utilizador_id);
        return $autor->nome;
    }

    public function getAutorFull() {
        $autor = new utilizador();
        $autor->loadById($this->utilizador_id);
        return $autor;
    }

    public function getComentarios() {
        $sql = "SELECT * FROM comentario WHERE review_id = $this->review_id";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $comentarios = array();
        while ($row = mysql_fetch_assoc($result)) {
            $comentarios[] = new comentario($row["comentario_id"],$row["utilizador_id"],$row["review_id"],$row["descricao"],$row["data"]);
        }
        return $comentarios;

    }
	public function editar($id, $titulo =null, $texto=null, $rating=null) {
      $result = mysql_query("UPDATE review SET titulo = '$titulo', texto = '$texto', rating = '$rating' WHERE id = '$id'");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
	  
	 $this->id = $id;
     $this->titulo = $titulo;
     $this->rating = $rating; 
	 $this->texto = $texto;

      return true;
    }
	
	public function inserir($data = null, $titulo = null, $texto = null, $rating = null, $filme_id = null, $utilizador_id = null) {
      $result = mysql_query("INSERT INTO review(data, titulo, texto, rating, filme_id, id_utilizador) VALUES ('$data', '$titulo', '$texto', '$rating', '$filme_id', '$utilizador_id')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }
	
	public function apagar($id) {
		$sql = "DELETE FROM review WHERE id = $id";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		return true;
	}
	
	public static function getAll() {
        $sql = 'SELECT * FROM review ';    
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        $reviews = array();
        while ($row = mysql_fetch_assoc($result)) {
            $reviews[] = new review($row["id"],$row["data"],$row["titulo"],$row["texto"],$row["rating"],$row["like"],$row["id_utilizador"],$row["filme_id"]);
        }
        return $reviews;
    }

    public function getDateDiff() {
       $hourdiff = round((strtotime(date("Y-m-d h:i:sa")) - strtotime($this->data))/3600, 0);
       return $hourdiff;
    }
}

?>
