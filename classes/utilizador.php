<?php

include "ligarbd.php";
include "filmes.php";
include "reviews.php";

class utilizador {
	
	public $id;
	public $nome;
	public $password;
	public $avatar;
	public $biografia;
	public $website;
	
	public function __construct( $id=null, $nome = null, $password=null, $avatar = null, $biografia = null, $website = null) {
			$this-> id = $id;
			$this-> nome = $nome;
			$this-> password =$password;
			$this-> avatar = $avatar;
			$this-> biografia = $biografia;
			$this-> website = $website;
			
	}
	
	public function loadById($id) {
		$result = mysql_query("SELECT * from utilizador WHERE id = $id");
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$this->id = $row["id"];
		$this->nome = $row["nome"];
		$this->password = $row["password"];
		$this->avatar = $row["avatar"];
		$this->biografia = $row["biografia"];
		$this->website = $row["website"];
	}

  public function getUsers() {
    $sql = "SELECT * FROM `utilizador`";
    $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
    
    $utilizadores = array();
    while ($row = mysql_fetch_assoc($result)) {
      $utilizadores[] = new utilizador($row["id"],$row["nome"],$row["password"],$row["avatar"],$row["biografia"],$row["website"]);
    }
    return $utilizadores;
  }

  public function getUsersSeguindo() {
    $sql = "SELECT * FROM utilizador inner join seguidor ON seguidor.id_seguido = utilizador.id WHERE seguidor.id_seguidor=$this->id";
    $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
    
    $utilizadores = array();
    while ($row = mysql_fetch_assoc($result)) {
      $utilizadores[] = new utilizador($row["id"],$row["nome"],$row["password"],$row["avatar"],$row["biografia"],$row["website"]);
    }
    return $utilizadores;
  }

	public function loadByNome($nome) {
		$result = mysql_query("SELECT * from utilizador WHERE nome = '".$nome."'");
		if(mysql_num_rows($result) == 0) {
			return NULL;
		} else {
		
			$row = mysql_fetch_assoc($result) or die(mysql_error());
			      	
			$this->id = $row["id"];
			$this->nome = $row["nome"];
			$this->password = $row["password"];
			$this->avatar = $row["avatar"];
			$this->biografia = $row["biografia"];
			$this->website = $row["website"];
		}
	}

	public function insert($nome = null, $password = null) {
      $avatar = "https://d3iw72m71ie81c.cloudfront.net/male-71.jpg";
      $biografia = "Lorem ipsum dolor sit amet, putent eruditi duo in, ea mei tale decore periculis. Brute civibus consetetur at mei, etiam libris iriure et vix, qui iusto elitr option cu.";
      $website = "www.".$nome.".com";

      $result = mysql_query("INSERT INTO utilizador(nome, password, avatar, biografia, website) VALUES ('$nome', '$password', '$avatar', '$biografia', '$website')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }

    public function insertPermissoes() {
      $result = mysql_query("INSERT INTO permissoes(id_utilizador) VALUES ('$this->id')");
      
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }

  public function getAllReviews() {
    $sql = "SELECT * FROM `review`";
    $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
    
   $reviews = array();
    while ($row = mysql_fetch_assoc($result)) {
      $reviews[] = new review($row["id"],$row["data"],$row["titulo"],$row["texto"],$row["rating"],$row["like"],$row["id_utilizador"],$row["filme_id"]);
    }
    return $reviews;
  }

  public function getAllReviewsSeguidores() {
    $sql = "SELECT * FROM review inner join seguidor ON seguidor.id_seguido = review.id_utilizador WHERE seguidor.id_seguidor=$this->id";
    $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
    
   $reviews = array();
    while ($row = mysql_fetch_assoc($result)) {
      $reviews[] = new review($row["id"],$row["data"],$row["titulo"],$row["texto"],$row["rating"],$row["like"],$row["id_utilizador"],$row["filme_id"]);
    }
    return $reviews;
  }

	public function getReviews() {
		$sql = "SELECT * FROM `review` WHERE id_utilizador = $this->id";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
		
		$reviews = array();
		while ($row = mysql_fetch_assoc($result)) {
			$reviews[] = new review($row["id"],$row["data"],$row["titulo"],$row["texto"],$row["rating"],$row["like"],$row["id_utilizador"],$row["filme_id"]);
		}
		return $reviews;
	}

	public function verificar_seguidor($id_seguido = null) {
      $result = mysql_query("SELECT * FROM seguidor where id_seguido = $id_seguido AND id_seguidor = $this->id");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      } elseif (mysql_num_rows($result) == 1) {
      	echo "<p class='main-text' style='color:red'>Já segues este utilizador!</p>";
      } elseif ($id_seguido == $this->id) {
      	echo "<p class='main-text' style='color:red'>Não te podes seguir a ti próprio!</p>";
      }
      else {
      	$this->seguir($id_seguido);
      	echo "<p class='main-text' style='color:white'>Utilizador seguido com sucesso!</p>";
      }
      
      
    }
	
	public function seguir($id_seguido = null) {
      $result = mysql_query("INSERT INTO seguidor(id_seguido, id_seguidor) VALUES ($id_seguido, $this->id)");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }

    public function getAllFilmes() {
        if(!$this->verificar_permissao("ver_filmes")) {
          $sql = "SELECT * FROM filme WHERE aprovado = 1";
        } else {
          $sql = "SELECT * FROM filme";
        }
        
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $filmes = array();
        while ($row = mysql_fetch_assoc($result)) {
          $filmes[] = new filme($row["filme_id"],$row["genero_id"],$row["titulo"],$row["duracao"],$row["descricao"],$row["poster"],$row["ano_estreia"],$row["aprovado"],$row["classificacao"]);
        }
        return $filmes;
  }

    public function getFilmesFavoritos() {
		$sql = "SELECT * FROM filme inner join favorito ON favorito.filme_id = filme.filme_id WHERE favorito.utilizador_id=$this->id";
		$result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
		
		$filmes = array();
		while ($row = mysql_fetch_assoc($result)) {
			$filmes[] = new filme($row["filme_id"],$row["genero_id"],$row["titulo"],$row["duracao"],$row["descricao"],$row["poster"],$row["ano_estreia"],$row["aprovado"],$row["classificacao"]);
		}
		return $filmes;
	}

   public function verificar_permissao($permissao) {
        $result = mysql_query("SELECT * from permissoes WHERE id_utilizador = $this->id");
        $row = mysql_fetch_assoc($result) or die(mysql_error());

        if($row[$permissao] == 1) {
            return True;
        } else {
            return False;
        }
    }
	
	public function verificar_filme($filme_id = null) {
      $result = mysql_query("SELECT * FROM favorito where filme_id = $filme_id AND utilizador_id = $this->id");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      } elseif (mysql_num_rows($result) == 1) {
      	echo "<p class='main-text' style='color:red'>Já tens este filme nos favoritos!</p>";
      } else {
      	$this->favoritar($filme_id);
      	echo "<p class='main-text' style='color:white'>Adicionado aos favoritos!</p>";
      }
      
      
    }
	
	public function favoritar($filme_id = null) {
      $result = mysql_query("INSERT INTO favorito(utilizador_id, filme_id) VALUES ($this->id, $filme_id)");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
      
      return true;
    }

    public function editar($avatar = null, $website = null, $biografia = null) {
    	//ir ao http://uifaces.com/ para ir buscar fotos de perfil fixes
      $result = mysql_query("UPDATE utilizador SET avatar='$avatar', website='$website', biografia='$biografia' WHERE id = $this->id");
      if (!$result) {
          die('Invalid query: ' . mysql_error());
        }
      //esta linha serve para dar refresh na página e se ver a foto a mudar
      echo "<meta http-equiv='refresh' content='0'>";
      
      return true;
    }

    public function countReviews() {
      $result = mysql_query("SELECT COUNT(id) as total FROM review WHERE id_utilizador = $this->id") or die('getall: Invalid query: ' . mysql_error());;
      $data = mysql_fetch_assoc($result);
        
      return $data["total"];
    }

    public function countComentarios() {
        $result = mysql_query("SELECT COUNT(comentario_id) as total FROM comentario WHERE utilizador_id = $this->id") or die('getall: Invalid query: ' . mysql_error());;
        $data = mysql_fetch_assoc($result);
        
        return $data["total"];
    }

    public function getAllFavoritos() {
        $sql = "SELECT * FROM favorito";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $favoritos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $favoritos[] = $row;
        }
        return $favoritos;
    }

     public function getAllSeguidores() {
        $sql = "SELECT * FROM seguidor";
        $result = mysql_query($sql) or die('getall: Invalid query: ' . mysql_error());
        
        $seguidores = array();
        while ($row = mysql_fetch_assoc($result)) {
            $seguidores[] = $row;
        }
        return $seguidores;
    }
	
    public function getDateDiff($date) {
       $hourdiff = round((strtotime(date("Y-m-d h:i:sa")) - strtotime($date))/3600, 0);
       return $hourdiff;
    }

    public function total($table) {
        $id = "id";

        if($table == "comentario") {
          $id = "comentario_id";
        } else if ($table == "filme") {
          $id = "filme_id";
        }

        $result = mysql_query("SELECT COUNT($id) as total FROM $table") or die('getall: Invalid query: ' . mysql_error());;
        $data = mysql_fetch_assoc($result);
        
        return $data["total"];
    }

}

?>