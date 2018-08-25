<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Persistencia/DownloadsDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/DownloadsDAO.php';

class DownloadControle {

    public static function iniciar() {
        $acao = $_GET['acao'];

        if (!isset($acao) || is_null($acao)) {
            return;
        }

        switch ($acao) {
            case 'inserir':
                session_start();
                self::inserirDownload();
                break;
            case 'procurarDownload':
                self::procurarDownload();
                break;
            case 'contadorDownloads':
                $id = $_GET['id'];
                $url = $_GET['url'];
              self::contadorDownloads($id,$url);
              break;
            case 'editar':
                session_start();
                self::editarDownload();
                break;
            /* case 'excluir':
              self::visualizar();
              break;
              default:
              echo 'Opção inválida!'; */
        }
    }

    public static function inserirDownload() {
        $nome = $_POST['nomeInserido'];
        $descricao = $_POST['descricaoInserida'];
        $url = $_POST['urlInserida'];
        $data = $_POST['dataInserida'];
        if (is_null($nome) || is_null($url) || is_null($descricao) || is_null($data))
            return;

        $download = new Downloads();
        $download->setNome($nome);
        $download->setUrl($url);
        $download->setDescricao($descricao);
        $download->setData($data);

        $downloadsDAO = new DownloadsDAO();
        if ($downloadsDAO->inserir($download))
          //  echo "Cadastrado com sucesso";
        header('location:'.$_SERVER['HTTP_REFERER']);
        else
            echo "Erro ao cadastrar!";
    }

    public static function editarDownload() {
        $nome = $_POST['nome'];
        $url = $_POST['url'];
        $descricao = $_POST['descricao'];
        $data = $_POST['data'];
        if (is_null($nome) || is_null($url) || is_null($descricao) || is_null($data))
            return;

        $download = new Downloads();
        $download->setNome($nome);
        $download->setUrl($url);
        $download->setDescricao($descricao);
        $download->setData($data);

        $downloadsDAO = new DownloadsDAO();
        if ($downloadsDAO->inserir($download))
            header('location:'.$_SERVER['HTTP_REFERER']);
        else
            echo "Erro ao cadastrar!";
    }

    public static function procurarDownload() {

        $termoPesquisado = $_POST['termoPesquisado'];
        if (is_null($termoPesquisado))
            return;

        $downloadsDAO = new DownloadsDAO();
        $downloads[] = $downloadsDAO->procurarDownloads($termoPesquisado);
        print_r($downloads);
    }

    public static function contadorDownloads($id, $url) {
        $download = new Downloads();

        $download->setId($id);
        $downloadDAO = new DownloadsDAO();
        $downloadDAO->incrementarNumDownloads($download,$url);
    }

}

DownloadControle::iniciar();
?>


