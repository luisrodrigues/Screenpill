<?php

require_once "ligarbd.php";

class permissoes {

    //Atributos da classe
    public $permissao_id;
    public $utilizador_id;
    public $publicar_filme;
    public $eliminar_filme;
    public $apagar_review;
    public $editar_filme;

    //Construtor da classe
    public function __construct($permissao_id = NULL, $utilizador_id = NULL, $publicar_filme = NULL, $eliminar_filme = NULL, $apagar_review = NULL, $editar_filme = NULL) {
        $this->permissao_id = $permissao_id;
        $this->utilizador_id = $utilizador_id;
        $this->publicar_filme = $publicar_filme;
        $this->eliminar_filme = $eliminar_filme;
        $this->apagar_review = $apagar_review;
        $this->editar_filme = $editar_filme;
    }
    
}

?>
