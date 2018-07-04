
<?php

	require_once 'ligarbd.php';	
	
	class estudiofilme {
		
	public $estudio_filme_id;
	public $estudio_id;
	public $filme_id;
		
	
		public function __construct($estudio_filme_id= null, $estudio_id= null, $filme_id= null) {
		$this->estudio_filme_id = $estudio_filme_id;
		$this->estudio_id =  $estudio_id;
		$this->filme_id = $filme_id;
	
	}
		public function inserir($estudio_id = null, $filme_id= null) {
      $result = mysql_query("INSERT INTO estudio_filme_id(estudio_id, filme_id) VALUES ('$estudio_id ', ' $filme_id')");
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }
	   echo "<meta http-equiv='refresh' content='0'>";
      
      return true;
    }
		
		
		
		

	}
?>