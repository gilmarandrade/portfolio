<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * classe que representa as noticias.
 *
 * @author Gil
 */
class Noticia {
    private $id;
    private $titulo;
    private $descricao;
    private $dataPub;
    private $link;
    private $dono; //id do feed (presente na classe Feed) ao qual foi retirada a noticia
    private $status; //1 para escolhido, 0 para não escolhido 
    
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDataPub() {
        return $this->dataPub;
    }

    public function getLink() {
        return $this->link;
    }

    public function getDono() {
        return $this->dono;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDataPub($dataPub) {
        $this->dataPub = $dataPub;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setDono($dono) {
        $this->dono = $dono;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


    
}
