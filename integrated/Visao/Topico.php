<?php
include_once './verificarEstado.php';
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
        <title>Tópico</title><?php $titulo = 'Topico'; ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <style>
            table, td {
                border: solid 2px black;
            }
            section#principal{
                margin-top:50px;
               // background: red;
            }
            section#principal #topico{
               // background: green;
            }
            section#principal #topico .usuario{
                background: rgb(9,17,77);
                color:white;
                width:50px;
                height: 50px;
                text-transform: capitalize;
                text-align: center;
                float:left;
                
            }
            section#principal #topico .topo{
                background:gray;
                width: 1000px;
                min-height: 50px;
            }
            section#principal #topico .titulo{
                background:gray;
               padding-left: 10px;
              // padding-top: 5px;
               //padding-bottom: 5px;
                width: 940px;
                //padding: 10px 0 10px 70px;
               height: 50px;
                display: table-cell;
                vertical-align: middle;
            }
            
            section#principal #topico .texto{
                background: rgb(210,210,210);
                width: 960px;
                padding: 20px 20px 60px 20px;
                
                min-height: 100px;
            }
            
            //comentarios
            section#principal #comentarios{
                //background: green;
                padding-left: 70px;
            }
            section#principal #comentarios h1{
                display: none;
                //background: saddlebrown;
                //display: inline;
            }
            
            section#principal #comentarios ul{
               // background: navy;
                margin: 0 20px;
            }
            
            section#principal #comentarios li{
                display: block;
                background: rgb(210,210,210);
                margin-top: 15px;
                
            }
            section#principal #comentarios .usuario{
               background: rgb(9,17,77);
                color:white;
                width:50px;
                height: 50px;
                text-transform: capitalize;
                text-align: center;
                float:left;
            }
            section#principal #comentarios .texto{
                 background: rgb(210,210,210);
                width: 920px;
                height: 50px;
                display: table-cell;
                vertical-align: middle;
                padding-left: 20px;
                
                //padding: 20px 20px 60px 20px;
                
                //min-height: 100px;
            }
            
            section#principal #novoComent{
               // background: navajowhite;
                margin-top:15px;
                margin-left:60px;
                width: 920px;
            }
            
            section#principal #novoComent h1, section#principal #novoComent label{
                display: none;
            }
            section#principal #novoComent textarea{
                width: 920px;
                
            }
            
            section#principal #novoComent #submit{
               
                border: solid 1px black;//solid 1px green;
                background: black;
                color:white;
                //width:92px;
                //height: 112px;
                padding: 10px 20px;
                cursor:pointer;
            }
             section#principal #novoComent #submit:hover{
               
                border: solid 1px black;//solid 1px green;
                background: white;
                color:black;
                //width:92px;
                //height: 112px;
                padding: 10px 20px;
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section id="principal">
                <?php
                include_once '../Visao/CarregarTopico.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Visao/CarregarTopico.php';
                ?>
                
                <aside id="novoComent">
                <h1>Adicionar comentário</h1>
                <form action="../Controle/ComentarioControle.class.php?acao=inserir" method="post">
                    <label style="float: left;">Novo Comentário: </label>
                    <textarea name="texto" rows="5"></textarea><br/>
                    <?php
                    echo '<input type="hidden" value="' . $_GET['codigo'] . '" name="topico" />';
                    ?>

                    <input type="submit" value="Comentar" id="submit" />
                </form>
                </aside>
            </section>  
            <footer>rodape</footer>
    </body>
</html>
