<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author André
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'].'/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Usuario.class.php';

class UsuarioDAO {

    private $comandoSql;
    private $execucaoDoComando;
    private $vetorUsuario = array();

    //Função necessária para fazer o cadastro do usuário.
    public function inserirUsuario(Usuario $usuario) {
        $nomeDoUsuario = $usuario->getNome();
        $emailDoUsuario = $usuario->getEmail();
        $tipoDeUsuario = $usuario->getTipoDeUsuario(); //1 - Usuário comum; 2 - Moderador; 3 - Administrador.
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha();

        $this->comandoSql = "INSERT INTO usuario (Nome, Email,  Login, Senha) VALUES('" . $nomeDoUsuario .
                "', '" . $emailDoUsuario . "', '" . $login . "', '" . $senha . "');";

        //O Login deve ser único. Assim, deve pesquisar no BD se há algum login existente do mesmo nome.
        if ($this->validaLogin($login)) {
            $this->execucaoDoComando = mysql_query($this->comandoSql);

            if (!$this->execucaoDoComando) {
                echo "<br/>" .$this->comandoSql . "<br/>";
                echo mysql_error() . "<br/>";
                echo "Erro ao executar o comando!" . "<br/>";
            } else {
                return true;
                //echo "Usuário cadastrado com sucesso!";
            }
        } else {
            echo "Login inválido";
        }
    }

    //Fazer a validação do Login quando o usuário for se cadastrar, verificando se é um login único!
    private function validaLogin($login) {
        $this->execucaoDoComando = mysql_query("SELECT Login FROM Usuario");
        if ($this->execucaoDoComando) {
            $linhasDeControle = mysql_num_rows($this->execucaoDoComando);
            
            for ($i = 0; $i < $linhasDeControle; $i++) {
                $this->vetorUsuario = mysql_fetch_assoc($this->execucaoDoComando);
                if($login == $this->vetorUsuario['Login']){ 
                    return false;
                }
            }
        }
        return true;
    }

    //Função necessária na hora de fazer o login no site.
    /*private function buscarSenhaDoUsuario($login) {
        $this->comnadoSql = "SELECT Senha FROM Usuario WHERE Login = " . $login . ";";
        $this->execucaoDoComando = mysql_query($this->comnadoSql);
        if ($this->execucaoDoComando) {
            return mysql_result($this->execucaoDoComando, 0, "Senha"); //Verificar se essa linha busca realmente a senha no BD
        } else {
            return;
        }
    }*/

    //Realizar login no site
    public function autenticaLogin(Usuario $usuario) {
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha();

        $this->comandoSql = "SELECT Login, Senha FROM Usuario WHERE Login=':login' AND Senha=':senha'";
        $this->comandoSql = str_replace(":login", $login, $this->comandoSql);
        $this->comandoSql = str_replace(":senha", $senha, $this->comandoSql);
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        
        if($this->execucaoDoComando){
//        echo 'eu entro aqui';
//            if(mysql_num_rows($this->execucaoDoComando) > 0){
//                echo 'eu entro aqui 2';
//                return TRUE;
//            }
            
            for ($i = 0; $i < mysql_num_rows($this->execucaoDoComando); $i++){
                $this->vetorUsuario = mysql_fetch_assoc($this->execucaoDoComando);
                echo $this->vetorUsuario['Login'].$this->vetorUsuario['Senha'];
                if ($login == $this->vetorUsuario['Login'] && $senha == $this->vetorUsuario['Senha']){
                    return true;
                }else {
                    return false;
                }
            }
        }
        return FALSE;
    }
    
    //Retorna a ID do Usuario
    public function retornaIdUsuario(Usuario $usuario){
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha();

        $this->comandoSql = "SELECT Id, Login, Senha FROM Usuario WHERE Login=':login' AND Senha=':senha'";
        $this->comandoSql = str_replace(":login", $login, $this->comandoSql);
        $this->comandoSql = str_replace(":senha", $senha, $this->comandoSql);
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        
        if($this->execucaoDoComando){
            for ($i = 0; $i < mysql_num_rows($this->execucaoDoComando); $i++){
                $this->vetorUsuario = mysql_fetch_assoc($this->execucaoDoComando);
                //if (mysql_num_rows($this->execucaoDoComando)){
                if ($login == $this->vetorUsuario['Login'] && $senha == $this->vetorUsuario['Senha']){
                    return $this->vetorUsuario['Id'];
                }else {
                    return false;
                }
            }
        }
        return;
    }
    
    //Retorna o usuário
    public function retornaUsuario($idUsuario){
        $this->comandoSql = 'SELECT login FROM Usuario WHERE id=:id';
        $this->comandoSql = str_replace(":id", $idUsuario, $this->comandoSql);
        
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        
        if($this->execucaoDoComando){
            $login = mysql_fetch_assoc($this->execucaoDoComando);
            
            return $login['login'];
        }else{
            return FALSE;
        }
    }

}
