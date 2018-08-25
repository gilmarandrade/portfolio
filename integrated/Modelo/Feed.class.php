<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Representa um feed recebido pela aplicação, disponivel apenas para o administrador,
 * o administrador vai selecionar as melhores noticias desses feeds para serem disponibilizadas no site integrated
 *
 *
 * @author Gil
 */
class Feed {
    private $id;
    private $nome; //ex: olhar digital
    private $descricao;
    private $url;//ex: http://olhardigital.uol.com.br/rss/ultimas_noticias.php
    private $imagem; //url do icone
    private $novas; //quantas noticias novas foram encontradas durante a ultima atualização

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getNovas() {
        return $this->novas;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setNovas($novas) {
        $this->novas = $novas;
    }




}
