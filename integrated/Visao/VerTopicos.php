<?php
include_once 'verificarEstado.php';
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
        <title>Tópicos</title><?php $titulo = 'Tópicos'; ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <style>
            section#topicos{
                margin-top:50px;
                //background-color: red;
            }
            section#topicos h1{
                display:none;
            }
            section#topicos ul{
                padding:0;
                margin:0;
                width: 1000px;
                //background: red;
               // border: solid 2px black;
            }
            section#topicos ul li{
                
                display:block;
                width: 1000px;
                background: green;
                //padding-left: 20px;
               // border: solid 2px black;
            }
           
            section#topicos .usuario{
                margin-bottom: 20px;
               background: rgb(9,17,77);
               color:white;
                width: 50px;
                height: 50px;
                float:left;
                text-transform: capitalize;
                text-align: center;
                //display: table-cell;
                //vertical-align: middle;
            }
            section#topicos .topico{
                margin-bottom: 20px;
                background:gray;
                width: 930px;
                height: 50px;
                float:left;
                text-transform: capitalize;
                
            }
           section#topicos a:link, section#topicos a:visited{
               display: block;
               //background:gray;
                //width: 930px;
                height: 50px;
                padding-left: 20px;
                //margin-top:20px;
                
                text-decoration: none;
                color:black;
               // background: white;
           }
           section#topicos a:hover, section#topicos a:active{
               background:rgb(139, 152, 179);
               text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section id="topicos">

                <?php
                //include "./verificarEstado.php";
                ?>

                <h1>Tópicos Cadastrados</h1>
 
                <?php
                include_once './TabelaTopicos.php';
                ?>
            </section>
            <footer>rodape</footer>
        </div>
    </body>
</html>
