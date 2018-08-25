<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Downloads.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Downloads.class.php';

//include_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Downloads.php';

class DownloadsDAO {

    private $comandoSql;
    private $execucaoDoComando;
    private $vetorDownloads = array();
    private $vetorComentarios = array();

    public function inserir(Downloads $download) {
        $nome = $download->getNome();
        $descricao = $download->getDescricao();
        $url = $download->getUrl();
        $data = $download->getData();

        $this->comandoSql = "INSERT INTO Downloads (Nome, Descricao, Url, Data) VALUES('" . $nome . "', '" . $descricao . "', '" . $url . "', '" . $data . "')";

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function retornaDownload($idDownload) {
        $this->comandoSql = "SELECT Id, Nome , Descricao, Url, Data FROM Downloads WHERE id = :id;";
        $this->comandoSql = str_replace(":id", $idDownload, $this->comandoSql);

        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            if (mysql_num_rows($this->execucaoDoComando) > 0) {
                $this->vetorDownloads = mysql_fetch_assoc($this->execucaoDoComando);

                $id = $this->vetorDownloads['id'];
                $nome = $this->vetorDownloads['nome'];
                $descricao = $this->vetorDownloads['descricao'];
                $url = $this->vetorDownloads['url'];
                $data = $this->vetorDownloads['data'];

                $download = new Downloads();
                $download->setId($id);
                $download->setNome($nome);
                $download->setDescricao($desricao);
                $download->setUrl($url);
                $download->setData($data);
                return $download;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function listarDownloads() {
        $download = array();

        $this->comandoSql = "SELECT Id, Nome, Descricao, Url, Data FROM Downloads;";
        $this->execucaoDoComando = mysql_query($this->comandoSql);

        if ($this->execucaoDoComando) {
            for ($i = 0; $i < mysql_num_rows($this->execucaoDoComando); $i++) {
                $vetorDownloads = mysql_fetch_assoc($this->execucaoDoComando);
                $download = new Downloads();
                $download->setId($vetorDownloads['Id']);
                $download->setNome($vetorDownloads['Nome']);
                $download->setDescricao($vetorDownloads['Descricao']);
                $download->setUrl($vetorDownloads['Url']);
                $download->setData($vetorDownloads['Data']);

                $downloads[] = $download;
            }
            return $downloads;
        }
    }

    public function editarDownload(Downloads $download) {
        $comandoSQL = "UPDATE Downloads set nome=':nome', url=':url', descricao=':descricao', data=':data'  where id=:id";
        $comandoSQL = str_replace(":nome", $download->getNome(), $comandoSQL);
        $comandoSQL = str_replace(":url", $download->geturl(), $comandoSQL);
        $comandoSQL = str_replace(":descricao", $download->getDescricao(), $comandoSQL);
        $comandoSQL = str_replace(":data", $download->getData(), $comandoSQL);
        if (mysql_query($comandoSQL))
            return TRUE;
        else {
            echo mysql_error();
            return false;
        }
    }

    //  $this->comandoSql = "SELECT * FROM Downloads WHERE Nome LIKE ':pesquisa%' AND Descricao LIKE ':pesquisa%'";
    public function procurarDownloads($pesquisa) {
        //echo $pesquisa;
        $downloads = array();
        $this->comandoSql = 'SELECT * FROM downloads WHERE Nome LIKE \'%' . $pesquisa . '%\' OR Descricao LIKE \'%' . $pesquisa . '%\'';
        // $this->comandoSql = str_replace(":pesquisa",$pesquisa,$this->comandoSql);    
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        //echo $this->comandoSql;
        if ($this->execucaoDoComando) {
            //echo 'if';
            for ($i = 0; $i < mysql_num_rows($this->execucaoDoComando); $i++) {
                $vetorDownloads = mysql_fetch_assoc($this->execucaoDoComando);
                $download = new Downloads();
                $download->setId($vetorDownloads['Id']);
                $download->setNome($vetorDownloads['Nome']);
                $download->setDescricao($vetorDownloads['Descricao']);
                $download->setUrl($vetorDownloads['Url']);
                $download->setData($vetorDownloads['Data']);

                $downloads[] = $download;
                echo($download->getNome());
            }
            
            return $downloads;
        }
    }

    public function incrementarNumDownloads(Downloads $download, $url) {
        $download->getId();
        $this->comandoSql = "Update Downloads set Num_Downloads = Num_Downloads+1 where id =" . $download->getId() . ";";
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            echo "<br/>" . $this->comandoSql . "<br/>";
            echo mysql_error() . "<br/>";
            //header('Location: ../Visao/ListaDeNoticias.php?msg1=Erro ao executar o comando: '.mysql_error());
        } else {
            header('Location: '.$url);
        }
    }

}
?>
