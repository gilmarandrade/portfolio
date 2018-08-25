<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComentarioDAO
 *
 * @author André
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Comentario.class.php';

class ComentarioDAO {

    //put your code here
    private $comandoSql;
    private $execucaoDoComando;
    private $vetorComentarios = array();

    public function cadastrarComentario(Comentario $comentario) {
        $texto = $comentario->getTexto();
        $usuario = $comentario->getUsuario();
        $topico = $comentario->getTopico();

        $this->comandoSql = "INSERT INTO Comentario (Texto, Usuario) VALUES(':texto', :usuario)";
        $this->comandoSql = str_replace(":texto", $texto, $this->comandoSql);
        $this->comandoSql = str_replace(":usuario", $usuario, $this->comandoSql);

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            echo 'cadastrado!';
            $this->comandoSql = "SELECT MAX(Id) AS idComentario FROM Comentario";
            $this->execucaoDoComando = mysql_query($this->comandoSql);
            
            if ($this->execucaoDoComando){
                $vetorIdComentario = mysql_fetch_assoc($this->execucaoDoComando);
                return $this->relacionaComentarioTopico((int) $vetorIdComentario['idComentario'], $topico);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function relacionaComentarioTopico($idComentario, $idTopico) {
        $this->comandoSql = "INSERT INTO TopicoComentario (IdComentario, IdTopico) VALUES(:comentario, :topico)";
        $this->comandoSql = str_replace(":comentario", $idComentario, $this->comandoSql);
        $this->comandoSql = str_replace(":topico", $idTopico, $this->comandoSql);

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function buscarComentarios($idTopico) {
        $this->comandoSql = "SELECT IdComentario FROM TopicoComentario WHERE IdTopico=:id";
        $this->comandoSql = str_replace(":id", $idTopico, $this->comandoSql);
        
        //echo $this->comandoSql;
        
        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            $linhasDeControle = mysql_num_rows($this->execucaoDoComando);
            //echo $linhasDeControle."<br/>";
            $vetorComent = array();
            for ($i = 0; $i < $linhasDeControle; $i++) {
                $vetorContComent = mysql_fetch_assoc($this->execucaoDoComando);
                $vetorComent[$i] = (int)$vetorContComent['IdComentario'];
                //echo $vetorComent[$i];
            }
            
            for ($i = 0; $i < $linhasDeControle; $i++){
                $comentario = $this->retornarComentario($vetorComent[$i]);
                //echo "<br/> ". $vetorComent[$i];
                $this->vetorComentarios[$i] = $comentario;
            }
            
            return $this->vetorComentarios;
        } else {
            return FALSE;
        }
    }

    public function retornarComentario($idComentario) {
        $this->comandoSql = "SELECT id, usuario, texto FROM Comentario WHERE id = :id;";
        $this->comandoSql = str_replace(":id", $idComentario, $this->comandoSql);

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            if (mysql_num_rows($this->execucaoDoComando) > 0) {
                $vetor = mysql_fetch_assoc($this->execucaoDoComando);
                $comentario = new Comentario();
                $comentario->setId($vetor['id']);
                $comentario->setTexto($vetor['texto']);
                //$comentario->setTopico($vetor['topico']);
                $comentario->setUsuario($vetor['usuario']);

                return $comentario;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
