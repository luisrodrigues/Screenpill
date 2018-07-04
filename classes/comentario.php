<?php

class comentario {
	
	public $comentario_id;
	public $utilizador_id;
	public $review_id;
	public $descricao;
	public $data;
	
	public function __construct($comentario_id =null, $utilizador_id=null, $review_id=null, $descricao = null, $data =null) {
		$this->comentario_id = $comentario_id;
		$this->utilizador_id = $utilizador_id;
		$this->review_id = $review_id;
		$this->descricao = $descricao;
		$this->data = $data;
	}

	public function getAllComentarios() {
        $sql = "SELECT * FROM comentario";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $comentarios = array();
        while ($row = mysql_fetch_assoc($result)) {
            $comentarios[] = new comentario($row["comentario_id"],$row["utilizador_id"],$row["review_id"],$row["descricao"],$row["data"]);
        }
        return $comentarios;

    }

	public function insert($utilizador_id = null, $review_id = null, $descricao = null) {
      $result = mysql_query("INSERT INTO comentario(utilizador_id, review_id, descricao) VALUES ('$utilizador_id', '$review_id', '$descricao')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }

    public function delete($comentario_id) {
        $sql = "DELETE FROM comentario WHERE comentario_id = $comentario_id";
        $result = mysql_query($sql) or die('delete: Invalid query: ' . mysql_error());
    }	
	
	public function getAutor() {
        $autor = new utilizador();
        $autor->loadById($this->utilizador_id);
        return $autor;
    }

    public function getReview() {
        $review = new review();
        $review->loadById($this->review_id);
        return $review;
    }

    public function getDateDiff() {
       $hourdiff = round((strtotime(date("Y-m-d h:i:sa")) - strtotime($this->data))/3600, 0);
       return $hourdiff;
    }
	
}
?>