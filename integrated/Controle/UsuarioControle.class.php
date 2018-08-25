<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioControle
 *
 * @author André
 */
include_once '../Persistencia/UsuarioDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/UsuarioDAO.php';

class UsuarioControle {

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
            case 'autenticaLogin':
                self::autenticarLogin();
                break;
            case 'logout':
                self::logout();
                break;
            default:
                echo "Opção inválida!";
        }
    }

    //Função para inserir o usuário!
    private static function inserir() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        //>>>gilmar: a função empty() verifica se o campo está vazio (porque vazio é diferente de null)
        if (is_null($senha) || is_null($login) || is_null($email) || is_null($nome) || empty($senha) || empty($login) || empty($email) || empty($nome)) {
            //return;
            header('Location: ../Visao/CadastroDeUsuario.php?msg=Existem campos vazios.');
        }

        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setTipoDeUsuario(1);

        $usuarioDAO = new UsuarioDAO();
        if ($usuarioDAO->inserirUsuario($usuario)) {
            //echo "Cadastrado com sucesso!";
            header("Location: ../Visao/CadastroDeUsuario.php?msg=Usuário cadastrado com sucesso! Faça <a href='LoginDeUsuario.php' alt='fazer login'>Login</a> para entrar no sistema.");
        } else {
            echo ("Erro!");
        }
    }

    private static function autenticarLogin() {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
                
        $usuarioDAO = new UsuarioDAO();
        if ($usuarioDAO->autenticaLogin($usuario)) {
            //echo "<br/>Bem vindo ". $login;
            $idUsuario = $usuarioDAO->retornaIdUsuario($usuario);
            session_start();
            $_SESSION ['estado'] = 'logado:'.$idUsuario;
            header('Location: ../Visao/PerfilUsuario.php?login='. $usuario->getLogin());
        } else {
            header('location: ../Visao/LoginDeUsuario.php?msg=Usuário ou senha incorretos!');
            //echo "Usuário ou senha incorretos!";
        }
    }
    
    private static function logout(){
        session_start();
        session_destroy();
        //$_SESSION['estado'] = NULL;
        header("Location: ../Visao/LoginDeUsuario.php");
    }

}

UsuarioControle::iniciar();
