<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * classe responsavel pelo controle dos feeds recebidos pelo administrador, 
 * permite adicionar novo endereço de feed, editar ou excluir um endereço de feed cadastrado no banco.
 *
 * @author Gil
 */

include_once '../Persistencia/FeedDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FeedDAO.php';

//gambiarra
//include_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Controle/NoticiaControle.class.php';
include_once '../Persistencia/NoticiaDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/NoticiaDAO.php';
class FeedControle {
    //put your code here
    public static function iniciar() {
        $acao = $_GET['acao'];

        if (!isset($acao) || is_null($acao)) {
            return;
        }

        switch ($acao) {
            case 'inserir':
                self::inserir();
                break;
           // case 'editar':
               // break;
            case 'excluir':
                self::excluir();
                break;
            default:
                echo "Opção inválida! ";
               
        }
    }
    
    //método para inserir endereço de feed
    private static function inserir() {
        $nome = $_POST['nome'];
        $url = $_POST['url'];

        
        if (is_null($nome) || is_null($url) || empty($nome) || empty($url) ) {
            //return;
            header('Location: ../Visao/CadastroDeFeed.php?msg=Existem campos vazios');
              
        }
        else{
        $feed = new Feed();
        
        $feed->setNome(trim($nome,' '));
        $feed->setUrl(trim($url,' '));
        //echo 'chegei antes de inserir';
        $feedDAO = new FeedDAO();
        if ($feedDAO->inserirFeed($feed)) {
            //echo "Url do feed cadastrada com sucesso!";
            
            //$feedDAO = new FeedDAO();
            $id = $feedDAO->getIdFeed($url);//encontar id do feed que acabou de ser cadastrado
            
            //atualiza banco de dados de noticias
               //NoticiaControle::atualizar($id, $url);
                $noticiaDAO = new NoticiaDAO();
                $noticiaDAO->XMLgetNoticias($url, $id);
                //header('Location: ../Visao/CadastroDeFeed.php');
        
            
            header('Location: ../Visao/CadastroDeFeed.php?msg=Cadastro efetuado com sucesso');
            
            
            //header("Location: NoticiaControle.class.php?acao=atualizar&id=".$id."&url=".$url);
        } else {
            header('Location: ../Visao/CadastroDeFeed.php?msg=A URL não é valida ou já foi cadastrada!');
        }
    }
    }
    
    //método para excluir um feed do banco
    private static function excluir(){
        $idFeed = $_POST['id'];
        //verificar se pode excluir
        //echo 'verificando se pode excluir...';
        $noticiaDAO= new NoticiaDAO();
        $selecionadas = $noticiaDAO->contarSelecionadas($idFeed);
        //echo 'vou entrar no if: '. $selecionadas;
        if($selecionadas == -1){
            echo 'erro';
        }
       else if($selecionadas == 0){
           //pode excluir o feed
           
           //excluir noticias
           if($noticiaDAO->excluirTodas($idFeed)==TRUE){
               //excluir feed
               $feedDAO = new FeedDAO();
               $resultado = $feedDAO->excluirFeed($idFeed);
               if( $resultado == TRUE){
                   //feed excluido com sucesso
                   header('Location: ../Visao/CadastroDeFeed.php?msg=Feed excluido com sucesso!');
               }
           }
        
        
       }
       else{
           //não pode excluir
           //echo 'existem noticias sendo utilizadas, não épossível excluir o feed';
           header('Location: ../Visao/CadastroDeFeed.php?msg3=Existem noticias sendo utilizadas, não é possível excluir o feed');
       }
        
        
    } 
    
    
    
}

FeedControle::iniciar();
