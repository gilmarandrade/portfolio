<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticiaControle
 *
 * @author Gil
 */
include_once '../Persistencia/NoticiaDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/NoticiaDAO.php';
class NoticiaControle {
     public static function iniciar() {
        $acao = $_GET['acao'];

        if (!isset($acao) || is_null($acao)) {
            return;
        }

        switch ($acao) {
            //case 'editar':
                //break;
            case 'limpar':
                self::limpar();
                break;
            case 'atualizar':
                self::atualizar();
                break;
            case 'visualizar':
                self::visualizar();
                break;
            case 'selecionar':
                self::selecionar();
                break;
            case 'deselecionar':
                self::deselecionar();
                break;
            default:
                echo "Opção inválida!";
        }
    }
    
      //atualiza o banco de dados com todas as noticias encontradas em um xml
    public static function atualizar($idFeed = null, $urlFeed = null){
        $id = isset($_POST['id'])? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : $idFeed);
        $url = isset($_POST['url'])? $_POST['url'] : (isset($_GET['url']) ? $_GET['url'] : $urlFeed);
        //echo $id.'<br/>'.$url;
        
        $noticiaDAO = new NoticiaDAO();
        $noticiaDAO->XMLgetNoticias($url, $id);
        header('Location: ../Visao/CadastroDeFeed.php');
        
      
    }
    
    private static function visualizar(){
        //antes de visualizar é preciso atualizar
        $id = isset($_POST['id'])? $_POST['id'] : $_GET['id'];
        $url = isset($_POST['url'])? $_POST['url'] : $_GET['url'];
       // echo $id.' sera atualizado <br/>'.$url;
        $noticiaDAO = new NoticiaDAO();
        $noticiaDAO->XMLgetNoticias($url, $id);
        //echo 'atualizou, falta visualizar';
         
        //visualizar
        //$noticiaDAO = new NoticiaDAO();
        //$arrayNoticias = $noticiaDAO->listar($id);
        //echo 'preenchi o array de noticias';
        header('Location: ../Visao/ListaDeNoticias.php?id='.$id);
        //exiba o array
        
        
    }
    
    //deleta todas as noticias (que não estão selecionadas) guardadas a mais de tres dias no banco 
    private static function limpar(){
        $noticiaDAO = new NoticiaDAO();
        $noticiaDAO->limpar();
    }
    
    private static function selecionar(){
        
        $idNoticia = $_POST['idNoticia'];
        $idFeed = $_POST['idFeed'];
        
        $noticiaDAO = new NoticiaDAO();
        
        //antes de selecionar, verifica quantas noticias selecionadas existem
        $totalSelecionadas = $noticiaDAO->contarTodasSelecionadas();
        if($totalSelecionadas >= 20){
            //se tem mais de 20, deseleciona uma noticia antiga
            $idAntiga = $noticiaDAO->getSelecionadaMaisAntiga();
            $noticiaDAO->deselecionar($idAntiga); 
        }
        
        if($noticiaDAO->selecionar($idNoticia)==TRUE){
            //>>>>>reescreva o feed Integrated
            $noticiaDAO->escreverFeed();
            header('Location: ../Visao/ListaDeNoticias.php?id='.$idFeed);
        }
        
    }
    
    private static function deselecionar(){
        $idNoticia = $_POST['idNoticia'];
        $idFeed = $_POST['idFeed'];
        
        $noticiaDAO = new NoticiaDAO();
        if($noticiaDAO->deselecionar($idNoticia)==TRUE){
            //>>>reescreva o feed Inegrated
            $noticiaDAO->escreverFeed();
            header('Location: ../Visao/ListaDeNoticias.php?id='.$idFeed);
        }
    }
}

NoticiaControle::iniciar();
