<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopicoDAO
 *
 * @author André
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Topico.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Topico.class.php';

class TopicoDAO {

    //put your code here
    private $comandoSql;
    private $execucaoDoComando;
    private $vetorTopico = array();
    private $vetorComentarios = array();

    public function cadastrarTopico(Topico $topico) {
        $titulo = $topico->getTitulo();
        $texto = $topico->getTexto();
        $usuario = $topico->getUsuarioDonoDoTopico();

        $this->comandoSql = "INSERT INTO Topico (Texto, Titulo, Usuario) VALUES(':texto', ':titulo', :usuario)";
        $this->comandoSql = str_replace(":texto", $texto, $this->comandoSql);
        $this->comandoSql = str_replace(":titulo", $titulo, $this->comandoSql);
        $this->comandoSql = str_replace(":usuario", $usuario, $this->comandoSql);
        
        //echo $this->comandoSql;

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function retornaTopico($idTopico){ //Método que retorna o tópico junto com todos os comentários cadastrados.
        $this->comandoSql = "SELECT id, titulo, texto, usuario FROM Topico WHERE id = :id;";
        $this->comandoSql = str_replace(":id", $idTopico, $this->comandoSql);
        
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        
        if($this->execucaoDoComando){
            if(mysql_num_rows($this->execucaoDoComando) > 0){
                $this->vetorTopico = mysql_fetch_assoc($this->execucaoDoComando);
                
                $id = $this->vetorTopico['id'];
                $titulo = $this->vetorTopico['titulo'];
                $texto = $this->vetorTopico['texto'];
                $usuario = $this->vetorTopico['usuario'];
                
                $topico = new Topico();
                $topico->setId($id);
                $topico->setTexto($texto);
                $topico->setTitulo($titulo);
                $topico->setUsuarioDonoDoTopico($usuario);
                $topico->setComentarios($this->retornaComentarios($idTopico));
                return $topico;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
        
    }
    
    public function listarTopicos(){
        $topicos = array();
        
        $this->comandoSql = "SELECT Id, Usuario, Titulo FROM Topico;";
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        
        if($this->execucaoDoComando){
            for ($i = 0; $i < mysql_num_rows($this->execucaoDoComando) ; $i++){
                $vetorTopico = mysql_fetch_assoc($this->execucaoDoComando);
                $topico = new Topico();
                $topico->setId($vetorTopico['Id']);
                $topico->setUsuarioDonoDoTopico($vetorTopico['Usuario']);
                $topico->setTitulo($vetorTopico['Titulo']);
                
                $topicos[] = $topico;
            }
            return $topicos;
        }
        
    }

    private function retornaComentarios($idTopico){
        $comentarios = new ComentarioDAO();
        $this->vetorComentarios = $comentarios->buscarComentarios($idTopico);
        return $this->vetorComentarios;
    }
}
