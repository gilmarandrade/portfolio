<?php
        // put your code here
            include_once './verificarEstado.php';
            if( $logado!=TRUE ){
                header('Location: index.php');
           }
        ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Novo Tópico</title><?php $titulo = 'Novo Tópico';?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/formularios.css" />
        <!--<link rel="stylesheet" type="text/css" href="css/estiloBasicoNovoTopico.css" />-->
    </head>
    <body>
        <div id="wrap">
         <?php include_once 'cabecalho.inc.php'; ?>
        <section>
            <div class="msgForm3">
                     <?php
                        if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        }
                    ?>
                </div>
            <article class="form3">
                <h1 class="tituloForm">Novo Tópico</h1>
        <form action="../Controle/TopicoControle.class.php?acao=NovoTopico" method="POST">
            <label for="titulo">Título</label><input type="text" name="titulo" id="titulo" class="botao" placeholder="Título do Tópico" title="título do tópico"/>
            <input type="submit" name="cadastrar" value="cadastrar" id="submit" title="cadastrar"/>
            <label for="texto" >Texto</label>
            <textarea name="texto"  id="texto" placeholder="Conteúdo"  title="conteúdo"></textarea>
        </form>
            </article>
            
        </section>
        <footer>
            rodapé...
        </footer>
        </div>
    </body>
</html>
