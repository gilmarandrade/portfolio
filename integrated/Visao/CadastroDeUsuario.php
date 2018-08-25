<?php //a pagina de cadastro também não pode ser acessada se o usuario estiver logado
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
        <title>Cadastro de Usuário</title><?php $titulo = 'Cadastro'; ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/formularios.css" />
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoCadastroUsuario.css" />
    </head>
    <body>
        <div id="wrap">
            <?php include_once 'cabecalho.inc.php'; ?>
            <section>
                <article class="form2">
                <h1 class="tituloForm">Área de Cadastro</h1>
                <form action="../Controle/UsuarioControle.class.php?acao=inserir" method="POST">
                    <label for="nome">Nome</label><input type="text" name="nome" id="nome" title="nome" placeholder="nome" />
                    <label for="email">E-mail</label><input type="email" name="email" id="email" title="e-mail" placeholder="e-mail" />
                    <label for="login">Login</label><input type="text" name="login" id="login" title="nome de usuário" placeholder="nome de usuário" />
                    <label for="senha">Senha</label><input type="password" name="senha" id="senha" class="botao" title="senha" placeholder="senha" />
                    <input type="submit" value="cadastrar" id="submit" title="cadastrar" />
                </form>
               
                </article>
                 <div class="msgForm2">
                <?php
                if(isset($_GET['msg'])){
                echo $_GET['msg'];
                }
                ?>
                </div>
            </section>
            <footer>
                rodapé...
            </footer>
        </div>
    </body>
</html>
