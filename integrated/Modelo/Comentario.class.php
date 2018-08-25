
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentario
 *
 * @author André
 */
class Comentario {
    //put your code here
    private $id;
    private $texto;
    private $topico;
    private $usuario;
    
    public function getId() {
        return $this->id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getTopico() {
        return $this->topico;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setTopico($topico) {
        $this->topico = $topico;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


    
}
