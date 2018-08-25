<?php
include_once 'verificarEstado.php';
include_once '../Persistencia/UsuarioDAO.php';//$_SERVER['DOCUMENT_ROOT'].'/ProjetoIntegrated/Persistencia/UsuarioDAO.php'; 
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
        <title>Perfil do Usuário</title>
        <?php $usuarioDAO = new UsuarioDAO(); $titulo = $usuarioDAO->retornaUsuario($idUsuario); ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section>    
                <h1>Bem vindo</h1>
                
                <a href='NovoTopico.php'>Novo Tópico</a><br/>
                <a href='VerTopicos.php'>Ver todos os tópicos</a><br/>
                <!--<p>aqui voce pode ver informações sobre o usuario, fazer logout, ver topicos cadastrados e criar novos topicos alem de , sei lá,tudo relacionado a um usuario logado que André vai por.</p>-->
                
                <!--<h2>Se eu fosse um usuario com permissão de administrador</h2>
                <p>eu poderia tambem:</p>-->
                <a href='CadastroDeFeed.php'>Gerenciar Feeds</a><br/>
                <a href='Downloads.php'>Gerenciar Downloads</a><br/>
         
                <?php
                ?>
            </section>
            <footer>
                rodapé...
            </footer>
        </div>
    </body>
</html>
