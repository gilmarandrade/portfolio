<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticiaDAO
 *
 * @author Gil
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Noticia.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Noticia.class.php';

//gambiarra
include_once '../Persistencia/FeedDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FeedDAO.php';

class NoticiaDAO {

    private $comandoSql;
    private $execucaoDoComando;

    public function XMLgetNoticias($url, $id) {
        $noticiasNovas = 0;
        //echo '<br />chegei em XMLgetNoticias<br/> '.$url.'<br />'.$id;
        $feed = @file_get_contents($url);
        if($feed == false){header('Location:../Visao/CadastroDeFeed.php?msg=Tempo Limite Atingido. Verifique conexão com a internet.'); }
        $rss = new SimpleXmlElement($feed);

        $key = 0;

        //percorre os itens do xml de baixo para cima (ordem descendente)
        for ($key = count($rss->channel->item) - 1; $key >= 0; $key--) {
            $link = isset($rss->channel->item[$key]->link) ? ($rss->channel->item[$key]->link == '' ? '' : $rss->channel->item[$key]->link ) : '';

            $sql = "select count(Id) as contagem from noticia where Link='" . $link . "' AND Dono=" . $id;
            $recurso = mysql_query($sql) or die(mysql_error());
            $contagem = mysql_fetch_assoc($recurso);
            //echo $key.'-dentro do for Contagem = '.$contagem['contagem'].'..<br/>';
            if ($contagem['contagem'] == 0) {
                //echo 'pode inserir, cria objeto noticia<br/>';
                //$link;
                $titulo = isset($rss->channel->item[$key]->title) ? ($rss->channel->item[$key]->title == '' ? '[titulo não disponível]' : $rss->channel->item[$key]->title ) : '[titulo não disponível]';
                $titulo = str_replace("'", "\'", $titulo);
                $titulo =$titulo.' -'.$this->getNome($id);
                $descricao = isset($rss->channel->item[$key]->description) ? ($rss->channel->item[$key]->description == '' ? '[descrição não disponível]' : $rss->channel->item[$key]->description ) : '[descrição não disponível]';
                $descricao = str_replace("'", "\'", $descricao);
                $dataPub = isset($rss->channel->item[$key]->pubDate) ? ($rss->channel->item[$key]->pubDate == '' ? '' : $rss->channel->item[$key]->pubDate ) : '';
                //define o fuso horario local
                date_default_timezone_set('America/Recife');


                $noticia = new Noticia();
                $noticia->setDono($id);
                $noticia->setLink($link);
                $noticia->setTitulo($titulo);
                $noticia->setDescricao($descricao);
                $noticia->setDataPub(date('Y-m-d H:m:s', strtotime($dataPub)));
                $noticia->setStatus(0);

                $this->inserir($noticia);
                $noticiasNovas = $noticiasNovas + 1;
            } else {
                //echo 'não pode inserir<br/>não cria objeto noticia<br /><br/>';
            }
        }

        $feedDAO = new FeedDAO();
        $feedDAO->atualizarNovas($noticiasNovas, $id);
        //echo $noticiasNovas . ' noticias novas';
    }

    public function inserir($noticia) {
        $this->comandoSql = "INSERT INTO noticia (Titulo, Descricao, DataPub, Link, Status, Dono) "
                . "VALUES('" . $noticia->getTitulo() . "', '" . $noticia->getDescricao() . "', '" . $noticia->getDataPub() . "', '" . $noticia->getLink() . "', " . $noticia->getStatus() . ", " . $noticia->getDono() . " );";

        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            echo "<br/>" . $this->comandoSql . "<br/>";
            echo mysql_error() . "<br/>";
            echo "Erro ao executar o comando!" . "<br/>";
        } else {
            //return TRUE;
            //echo "noticia cadastrada com sucesso!<br/>";
        }
    }

    public function listar($idFeed) {
        $noticias = array();
        $sql = 'select Id, Titulo, Descricao, DataPub, Link, Status from noticia WHERE Dono = ' . $idFeed . ' ORDER BY DataPub desc';
        $recurso = mysql_query($sql);

        if ($recurso) {
            for ($i = 0; $i < mysql_num_rows($recurso); $i++) {
                $vetorNoticia = mysql_fetch_assoc($recurso);
                $noticia = new Noticia();
                $noticia->setId($vetorNoticia['Id']);
                $noticia->setTitulo($vetorNoticia['Titulo']);
                $noticia->setDescricao($vetorNoticia['Descricao']);
                $noticia->setDataPub($vetorNoticia['DataPub']);
                $noticia->setLink($vetorNoticia['Link']);
                $noticia->setStatus($vetorNoticia['Status']);
                $noticias[] = $noticia;
            }
        }
        return $noticias;
    }

    //exclui todas as noticias com data anterior a tres dias atras
    public function limpar() {
        //deleta noticias mais antigas que tres dias E que tenham status 0
        $this->comandoSql = 'DELETE from noticia where ( unix_timestamp(DataPub) < unix_timestamp(date_sub(CURDATE(), interval 3 day)) ) AND Status = 0  ';
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            //echo "<br/>" . $this->comandoSql . "<br/>";
            //echo mysql_error() . "<br/>";
            header('Location: ../Visao/CadastroDeFeed.php?msg=Erro ao executar o comando: ' . mysql_error());
        } else {
            //return TRUE;
            header('Location: ../Visao/CadastroDeFeed.php?msg=limpeza de noticias efetuada!');
        }
    }

    public function selecionar($idNoticia) {

        $this->comandoSql = 'UPDATE noticia SET Status = 1 WHERE Id = ' . $idNoticia;
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            echo "<br/>" . $this->comandoSql . "<br/>";
            echo mysql_error() . "<br/>";
            //header('Location: ../Visao/ListaDeNoticias.php?msg1=Erro ao executar o comando: '.mysql_error());
        } else {
            return TRUE;
            //header('Location: ../Visao/ListaDeNoticias.php');
        }
    }

    public function deselecionar($idNoticia) {
        $this->comandoSql = 'UPDATE noticia SET Status = 0 WHERE Id = ' . $idNoticia;
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            echo "<br/>" . $this->comandoSql . "<br/>";
            echo mysql_error() . "<br/>";
            //header('Location: ../Visao/ListaDeNoticias.php?msg1=Erro ao executar o comando: '.mysql_error());
        } else {
            return TRUE;
            //header('Location: ../Visao/ListaDeNoticias.php');
        }
    }

    public function getNome($idFeed) {
        $sql = 'select Nome from feed WHERE Id = ' . $idFeed;
        $recurso = mysql_query($sql);

        $nome = '';
        if ($recurso) {
            $vetorFeed = mysql_fetch_assoc($recurso);
            $nome = $vetorFeed['Nome'];
        }
        return $nome;
    }

    public function contarSelecionadas($idFeed) {

        $sql = 'SELECT count(Id) as contagem from noticia WHERE Dono = ' . $idFeed . ' AND Status = 1';
        $recurso = mysql_query($sql);
        if ($recurso) {
            $vetorFeed = mysql_fetch_assoc($recurso);
            $contagem = $vetorFeed['contagem'];
            return $contagem;

            //header('Location: ../Visao/ListaDeNoticias.php?msg1=Erro ao executar o comando: '.mysql_error());
        } else {
            //echo "<br/>" . $this->comandoSql . "<br/>";
            // echo mysql_error() . "<br/>";
            return -1;
            //header('Location: ../Visao/ListaDeNoticias.php');
        }
    }

      public function contarTodasSelecionadas() {

        $sql = 'SELECT count(Id) as contagem from noticia WHERE Status = 1';
        $recurso = mysql_query($sql);
        if ($recurso) {
            $vetorFeed = mysql_fetch_assoc($recurso);
            $contagem = $vetorFeed['contagem'];
            return $contagem;

            //header('Location: ../Visao/ListaDeNoticias.php?msg1=Erro ao executar o comando: '.mysql_error());
        } else {
            //echo "<br/>" . $this->comandoSql . "<br/>";
            // echo mysql_error() . "<br/>";
            return -1;
            //header('Location: ../Visao/ListaDeNoticias.php');
        }
    }
    
    
    public function excluirTodas($idFeed) {
        //deleta todas as noticias para um feed
        $this->comandoSql = 'DELETE from noticia where Dono = ' . $idFeed;
        $this->execucaoDoComando = mysql_query($this->comandoSql);
        if (!$this->execucaoDoComando) {
            //echo "<br/>" . $this->comandoSql . "<br/>";
            //echo mysql_error() . "<br/>";
            //header('Location: ../Visao/CadastroDeFeed.php?msg1=Erro ao executar o comando: '.mysql_error());
            return FALSE;
        } else {
            return TRUE;
            // header('Location: ../Visao/CadastroDeFeed.php?msg1=limpeza de noticias efetuada!');
        }
    }

    public function listarNoticiasSelecionadas() {
        $noticias = array();
        $sql = 'select Titulo, Descricao, DataPub, Link from noticia WHERE Status = 1 ORDER BY DataPub desc';
        $recurso = mysql_query($sql);

        if ($recurso) {
            for ($i = 0; $i < mysql_num_rows($recurso); $i++) {
                $vetorNoticia = mysql_fetch_assoc($recurso);
                $noticia = new Noticia();
                $noticia->setTitulo($vetorNoticia['Titulo']);
                $noticia->setDescricao($vetorNoticia['Descricao']);
                $noticia->setDataPub($vetorNoticia['DataPub']);
                $noticia->setLink($vetorNoticia['Link']);
                $noticias[] = $noticia;
            }
        }
        return $noticias;
    }
    
    //retorna o id  da noticia selecionada com a data mais antiga
    public function getSelecionadaMaisAntiga() {
    
        $sql = 'select Id from noticia WHERE Status = 1 ORDER BY DataPub';
        $recurso = mysql_query($sql);

        if ($recurso) {
         
                $vetorNoticia = mysql_fetch_assoc($recurso);
                return $vetorNoticia['Id'];
              
            
        }
        else{
                return -1;
        }
    }
    
    

    //escreve o feed INTEGRATED
    public function escreverFeed() {
        // Criando um elemento raiz vazio
        $doc = '<rss version="2.0">' .
                '</rss>';

        $feed = new SimpleXMLElement($doc);
        $feed->addChild('channel');

        $feed->channel->addChild('title');
        $feed->channel->title = 'RSS Integrated';

        $feed->channel->addChild('link');
        $feed->channel->link = 'http://site.com/xml';

        $feed->channel->addChild('description');
        $feed->channel->description = 'A reunião das melhores notícias dos melhores sites em um feed!';

        $feed->channel->addChild('image');
        $feed->channel->image->addChild('url');
        $feed->channel->image->url = 'http://img1.olhardigital.uol.com.br/img/logo_olhar_digital.gif';
        $feed->channel->image->addChild('title');
        $feed->channel->image->title = 'Integrated';
        $feed->channel->image->addChild('link');
        $feed->channel->image->link = 'http://olhardigital.uol.com.br';

        $feed->channel->addChild('language');
        $feed->channel->language = 'pt-br';

        $feed->channel->addChild('lastBuildDate');
        date_default_timezone_set('America/Recife');
        $feed->channel->lastBuildDate = date('Y-m-d H:i:s');

        //acessa banco e pega noticias com status 1
        $i = 0;
        foreach ($this->listarNoticiasSelecionadas() as $noticia) {

            $feed->addChild('item');
            $feed->item[$i]->addChild('title', $noticia->getTitulo());
            $feed->item[$i]->addChild('link', $noticia->getLink());
            $feed->item[$i]->addChild('description', $noticia->getDescricao());//$feed->item[$i]->addChild('description', $noticia->getDescricao());
            $feed->item[$i]->addChild('pubDate', $noticia->getDataPub());

            $i=$i+ 1;
        }
        
        //echo $feed->asXML();
        if ($feed->saveXML($_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/noticias.xml')) {
        echo 'gravou arquivo XML';
}
    }

}
