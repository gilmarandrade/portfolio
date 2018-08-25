<?php

#vai acessar o banco de dados e inserir, editar ou excluir endereços de feeds de outros sites como Olhar digital
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * classe de contrlo para acessar banco de feeds cadastrados
 *
 * @author Gil
 */
include_once '../Persistencia/FabricaDeConexao.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FabricaDeConexao.php';
include_once '../Modelo/Feed.class.php';

class FeedDAO {

    private $comandoSql;
    private $execucaoDoComando;

    //Função necessária para fazer o cadastro da url de um novo feed.
    public function inserirFeed(Feed $feed) {
        $nomeDoFeed = $feed->getNome();//>>>>>>ESSE CAMPO NÃO PODE ESTAR VAZIO
        $descricaoDoFeed;// = $feed->getDescricao();
        $urlDoFeed = $feed->getUrl(); //>>>>ESTE CAMPO NÃO PODE ESTAR VAZIO
        $imagemDoFeed;// = $feed->getImagem();
        $novas;//$feed->getNovas();
        
        //verifica se uma url identica ja está cadastrada
        $validacao1 = $this->validar($urlDoFeed);
        if ($validacao1 == TRUE) {
            //echo 'Tempo Limite atingido, tente novamente usando uma internet de vergonha...';
           
            $validacao2 = $this->validarUrl($urlDoFeed);
            //echo 'passei pela validação 2';
            if ($validacao2 == TRUE) {
                //a url é de um xml
                //echo ' pegar dados que faltam do xml.';
                $descricaoDoFeed = $this->XMLgetDescricao($urlDoFeed);
                $imagemDoFeed = $this->XMLgetImagem($urlDoFeed);
                $novas = 0;
                //echo ' dados encontrados';
                
                $this->comandoSql = "INSERT INTO feed (Nome, Descricao, Url, Imagem, Novas) "
                        . "VALUES('" . $nomeDoFeed ."', '".$descricaoDoFeed."', '" . $urlDoFeed . "', '".$imagemDoFeed."', ".$novas." );";
                
                $this->execucaoDoComando = mysql_query($this->comandoSql);
                if (!$this->execucaoDoComando) {
                    echo "<br/>" . $this->comandoSql . "<br/>";
                    echo mysql_error() . "<br/>";
                    echo "Erro ao executar o comando!" . "<br/>";
                } else {
                   // echo " Url do feed cadastrado com sucesso!";
                    return TRUE;
                    
                }
            } else {
                header('Location: ../Visao/CadastroDeFeed.php?msg=Cadastro não efetuado. Tem certeza que a URL é de um XML?');
                //return FALSE;
            }
        }
        else{
            header('Location: ../Visao/CadastroDeFeed.php?msg=A URL informada já foi cadastrada.');
        }
    }

    public function listar() {
        $feeds = array();
        $sql = 'select Id, Imagem, Nome, Descricao, Url, Novas from feed';
        $recurso = mysql_query($sql);

        if ($recurso) {
            for ($i = 0; $i < mysql_num_rows($recurso); $i++) {
                $vetorFeed = mysql_fetch_assoc($recurso);
                $feed = new Feed();
                $feed->setId($vetorFeed['Id']);
                $feed->setNome($vetorFeed['Nome']);
                $feed->setUrl($vetorFeed['Url']);
                $feed->setNovas($vetorFeed['Novas']);
                $feed->setImagem($vetorFeed['Imagem']);
                $feed->setDescricao($vetorFeed['Descricao']);
                $feeds[] = $feed;
            }
        }
        return $feeds;
    }

    //verifica se uma url já está cadastrada
    public function validar($url) {
        $sql = "select Id from feed where Url=':url'";
        $sql = str_replace(":url", $url, $sql);
        $recurso = mysql_query($sql) or die(mysql_error());
        $num_rows = mysql_num_rows($recurso);

        if ($num_rows == 0) {
            return TRUE;
            //else{return FALSE;}
            //ja existe uma url identica cadastrada, não é possivel cadastrar duas urls identicas
            /* $vetorProduto = mysql_fetch_assoc($recurso);
              $produto = new Produto();
              $produto->setId($vetorProduto['id']);
              $produto->setNome($vetorProduto['nome']);
              $produto->setValor($vetorProduto['valor']); */
        } else {//query deu errado
            return FALSE; //ERRO ao acessar banco
            //não existe essa url no banco, é possivel cadastrar a url.
        }
        // return $produto;
    }

    public function validarUrl($url) {

        $feed = @file_get_contents($url);// or die('Cadastro não efetuado. Tem certeza que essa URL é de um XML?'); //retorna falso se falhar (o @ evita mensagens de erro caso não funcione)
        if ($feed == FALSE) {
            //falhou
            return FALSE;
        } else {
            $rest = substr($feed, 0, 6);    // deveria retornar "<?xml "
            if ($rest == '<?xml ') {
                //é um xml
                return TRUE;
            } else {
                //nao é xml 
                return FALSE;
            }
        }
    }
    
    
    //atualiza campo novas da tabela feed
    public function atualizarNovas($novas, $id){
        
         $this->comandoSql = 'UPDATE feed SET Novas = '.$novas.' WHERE Id ='.$id;
                $this->execucaoDoComando = mysql_query($this->comandoSql);
                if (!$this->execucaoDoComando) {
                    echo "<br/>" . $this->comandoSql . "<br/>";
                    echo mysql_error() . "<br/>";
                    echo "Erro ao executar o comando!" . "<br/>";
                } else {
                    return TRUE;
                 
                }
       
    }
    
    //pega o id de um feed atraves da url
    public function getIdFeed($url){
        $sql = "select Id  from feed WHERE Url='".$url."'";
        $recurso = mysql_query($sql) or die(mysql_error());
        
        $resultado = mysql_fetch_assoc($recurso);
        return $resultado['Id'];
    }
    
    public function excluirFeed($idFeed){
          //deleta todas as noticias para um feed
        $this->comandoSql = 'DELETE from feed where Id = '.$idFeed;
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
    
  /*      
    public function getTotalAnterior($id){
        $sql = 'select TotalAnterior  from feed WHERE Id='.$id;
        $recurso = mysql_query($sql) or die(mysql_error());
        
        $contagem = mysql_fetch_assoc($recurso);
        return $contagem['TotalAnterior'];
        
        
    }*/
    
    public function XMLgetDescricao($url){
        $feed = file_get_contents($url);
        $rss = new SimpleXmlElement($feed);
        
        $descricaoRSS = isset($rss->channel->description) ? ($rss->channel->description==''? 'descrição não disponível' :$rss->channel->description ) : 'descrição não disponível';
        return $descricaoRSS;
    }
    
    public function XMLgetImagem($url){
        $feed = file_get_contents($url);
        $rss = new SimpleXmlElement($feed);
        
       if(isset($rss->channel->image)){
           //$linkImage = isset($rss->channel->image->link) ? $rss->channel->image->link : '';
           $urlImage = isset($rss->channel->image->url) ? $rss->channel->image->url : 'http://static.freepik.com/fotos-gratis/forma-de-xadrez-peao--ios-7-simbolo-de-interface_318-37075.jpg';
           if(substr($urlImage, 0, 7) == 'http://' || substr($urlImage, 0, 8) == 'https://' ){
           return $urlImage;}
            else 
            { return 'http://static.freepik.com/fotos-gratis/forma-de-xadrez-peao--ios-7-simbolo-de-interface_318-37075.jpg';}
                
            
           
       } 
       else{
           $urlImage ='http://static.freepik.com/fotos-gratis/forma-de-xadrez-peao--ios-7-simbolo-de-interface_318-37075.jpg';
           return $urlImage;
       }
    }
    
    public function XMLgetTotal($url){
        $feed = file_get_contents($url);
        $rss = new SimpleXmlElement($feed);
        
        $totalNoticiasRSS = count($rss->channel->item);
        return $totalNoticiasRSS;
    }
    
    
    

}

