<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopicoControle
 *
 * @author André
 */
//include_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Topico.class.php';
include_once '../Persistencia/TopicoDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/TopicoDAO.php';

class TopicoControle {

    //put your code here
    public static function iniciar() {
        $acao = $_GET['acao'];

        if (!isset($acao) || is_null($acao)) {
            return;
        }

        switch ($acao) {
            case 'NovoTopico':
                session_start();
                self::cadastrarTopico();
                break;
            /*case 'CarregarTopico':
                $codigo = $_GET['codigo'];

                if (!isset($acao) || is_null($acao)) {
                    return;
                }else{
                    self::carregarTopico($codigo);
                }   
                
                break;*/
            default:
                return;
        }
    }

    private static function cadastrarTopico() {
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $usuario = (int) substr($_SESSION['estado'], 7);

        //echo $usuario;

        $topico = new Topico();
        $topico->setTitulo($titulo);
        $topico->setTexto($texto);
        $topico->setUsuarioDonoDoTopico($usuario);

        $topicoDAO = new TopicoDAO();
        if ($topicoDAO->cadastrarTopico($topico)) {
            header('Location: ../Visao/NovoTopico.php?msg=Tópico cadastrado com sucesso.');
            //echo "Cadastrado com sucesso";
        } else {
            //echo "Erro ao cadastrar!";
            header('Location: ../Visao/NovoTopico.php?msg=Erro ao cadastrar');
        }
    }

    /*private static function carregarTopico($idTopico) {
        $topicoDAO = new TopicoDAO();
        $topico = $topicoDAO->retornaTopico($idTopico);
        
        
    }*/

}

TopicoControle::iniciar();
?>
