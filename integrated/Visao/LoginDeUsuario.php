<?php
session_start(); //toda pagina que trabalha com sessão precisa iniciar com essa primeira linha, antes mesmo do <!doctype>

if (isset($_SESSION['estado'])) {
    
    if (substr($_SESSION['estado'], 0, 6) == 'logado') {
        header("Location: index.php");
    }
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
        <title>Login</title> <?php $titulo = 'Login';?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/formularios.css" />
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoLogin.css" />
    </head>
    <body>
        <div id="wrap">
            <?php include_once 'cabecalho.inc.php'; ?>
            <section >
                <article id="botoesLogin">
                <h1 id="loginTitulo">Login</h1>
                <ul >
                    <li><a href="CadastroDeUsuario.php" >não tem cadastro?</a></li>
                    <li><a href="" >login</a></li>
                    <li class="form1">
                        <form  action="../Controle/UsuarioControle.class.php?acao=autenticaLogin" method="POST">
                            <label for="usuário">Login</label><input type="text" name="login" placeholder="usuário"  id="usuario" title="nome de usuário"/>
                            <label for="senha">Senha</label><input type="password" name="senha" placeholder="senha" class="botao" id="senha" title="senha"/>
                            <input type="submit" value="Entrar" id="submit" title="Entrar"/>
                            <!--<button type="submit" value="Entrar">Entrar<br/>-->
                        </form>
                    </li>
                </ul>
                 
                <div class="msgForm1">
                     <?php
                        if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        }
                    ?>
                    
                </div>
                
                </article>
            </section>   
            <footer>
                rodapé...
            </footer>
        </div>

    </body>
</html>
