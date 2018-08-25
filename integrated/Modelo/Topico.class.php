<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topico
 *
 * @author André
 */
include_once '../Modelo/Usuario.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Usuario.class.php';

class Topico {
    //put your code here
    private $usuarioDonoDoTopico;
    private $id;
    private $titulo;
    private $texto;
    private $comentarios = array();
    
    public function getUsuarioDonoDoTopico() {
        return $this->usuarioDonoDoTopico;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setUsuarioDonoDoTopico($usuarioDonoDoTopico) {
        $this->usuarioDonoDoTopico = $usuarioDonoDoTopico;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }


    
}
