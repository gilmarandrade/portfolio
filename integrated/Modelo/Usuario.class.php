<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author André
 */

include_once '../Modelo/Pessoa.class.php';//$_SERVER['DOCUMENT_ROOT'].'/ProjetoIntegrated/Modelo/Pessoa.class.php';

class Usuario extends Pessoa {
    //O usuário poderá ser:
    // 1 - Usuário Comum;
    // 2 - Moderador;
    // 3 - Administrador.
    private $tipoDeUsuario;
    
    public function getTipoDeUsuario() {
        return $this->tipoDeUsuario;
    }

    public function setTipoDeUsuario($tipoDeUsuario) {
        $this->tipoDeUsuario = $tipoDeUsuario;
    }


}
