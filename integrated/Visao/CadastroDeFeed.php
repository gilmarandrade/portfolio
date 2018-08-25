<?php
        // put your code here
            include_once './verificarEstado.php';
            if( $logado!=TRUE ){
                header('Location: index.php');
           }
        ?>
<!DOCTYPE html>
<!--
essa pagina serve para o administrador cadastrar endereços de feeds, como  'http://olhardigital.uol.com.br/rss/ultimas_noticias.php'
Apenas o administrador tem acesso a essa pagina, em outra pagina ele poderá visualizar as noticias presentes
nos feeds cadastrados aqui e selecionar quais noticias serão publicadas no site integrated.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Notícias</title><?php $titulo = 'Notícias';?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoNoticias.css" />
        <link rel="stylesheet" type="text/css" href="css/listaFeeds.css" />
    </head>
    <body>
        <div id="wrap">
         <?php include_once 'cabecalho.inc.php'; ?>
        <section>
            
            <aside id="botoes">
                <ul>
                    <li><a href="../noticias.xml" target="_blank" >ver feed integrated</a></li>
                    <li>
                        <form action="../Controle/NoticiaControle.class.php?acao=limpar" method="post">
                            <input  class="botao" type="submit" value="limpar notícias antigas" />
                        </form>
                    </li>
                    <li>
                        <a href="">cadastrar URL</a>
                    </li>
                    <li id="formCadastro">
                        <form action="../Controle/FeedControle.class.php?acao=inserir" method="POST">
                        
                            <label for="nome" >Nome</label><input type="text" id="nome" name="nome" placeholder="nome" title="nome" />
                            <label for="url" >URL</label><input type="text" id="url" name="url" placeholder="URL" title="URL" />
                            <input type="submit" id="inserir" value="cadastrar URL" title="cadastrar URL" />
                            
                        </form>
                    </li>
                </ul>
                <div class="msg">
                     <?php
                        if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        }
                    
                        if(isset($_GET['msg1'])){
                        echo $_GET['msg1'];
                        }
                    ?>
                </div>
            </aside>
        
            <article id="listaFeeds">
                <?php
                require_once('ListaDeFeeds.php');
                ?>
            </article>
            
        </section>
        <footer>
            rodapé...
        </footer>
        </div>
    </body>
</html>
