<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComentarioControle
 *
 * @author André
 */
include_once '../Persistencia/ComentarioDao.php'; //$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/ComentarioDAO.php';

class ComentarioControle {
    //put your code here
    
    public static function iniciar(){
        $acao = $_GET['acao'];
        
        if (!isset($acao) || is_null($acao)) {
            return;
        }
        
        switch ($acao){
            case 'inserir':
                session_start();
                self::cadastrarComentario();
                break;
            default:
        }
    }
    
    private static function cadastrarComentario(){
        $texto = $_POST['texto'];
        $id = substr($_SESSION['estado'], 7);
        $topico = $_POST['topico'];
        
        $comentario = new Comentario();
        $comentario->setTopico($topico);
        $comentario->setUsuario($id);
        $comentario->setTexto($texto);
        
        $comentarioDAO = new ComentarioDAO();
        if ($comentarioDAO->cadastrarComentario($comentario)){
           //echo 'cadastrado com sucesso';
            header('location:'.$_SERVER['HTTP_REFERER']);
        }else {
            echo 'Erro inesperado.';
        }
    }
}

ComentarioControle::iniciar();

?>