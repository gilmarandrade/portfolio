<?php
include_once 'verificarEstado.php';

include_once '../Persistencia/NoticiaDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/NoticiaDAO.php';

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
        <title>Home</title><?php $titulo = 'Home'; //esse titulo sera usado no arquivo incluído 'cabecalho.inc.php'    ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />

        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/jquery.cycle2.min.js"></script>
        <style>
            //plugin cycle2
            .cycle-slideshow{
              // margin: 0;
            //   margin-top: -50px;
                background: white;

            }
            .cycle-slideshow img{
                //position: absolute;
                //top: 0; 
                //left: 0;
                width: 100%;
                padding: 0; 
                display: block;
                //margin-top:-50px;
                //width:1000px;
                height: 350px;
            }
            .cycle-pager { 
                text-align: center; width: 100%; z-index: 500; 
                position: absolute; 
                top:10px; 
                overflow: hidden;
            }
            .cycle-pager span { 
                font-family: arial;
                font-size: 50px; 
                width: 16px; 
                height: 16px; 
                //display: inline-block;
                color: #ddd;
                cursor: pointer; 

            }
            .cycle-pager span.cycle-pager-active { color: #000000;}
            .cycle-pager > * { cursor: pointer;}
            
            
            //indexBasico
            section.colunas2{
                width:1000px;
                //background-color: green;
            }
            article#primeira-col{
                display:block;
                //background: rgba(256,256,256,0.3);
                width:400px;
                height:400px;
                float:left;
                padding-top:0;
                padding-right: 40px;
                margin-right: 100px;
                margin-top: 20px;
                margin-bottom: 20px;
                
            }
            
            article.col{
                display:block;
                //background: rgba(0,0,0,0.3);
                width:400px;
                min-height:400px;
                float:left;
                padding-right: 40px;
                
                float:left;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            article#primeira-col h1, article.col h1{
                margin:0;
                
                
            }
            article#primeira-col h1 a, article.col h1 a{
               width:396px;
               display:block;
                margin:0;
                background: black;
                border:solid 2px black;
                padding: 20px 30px 10px 10px;
                text-align:right;
                color:white;
                text-decoration:none;
                text-transform:uppercase;
                
            }
            article#primeira-col h1 a:hover, article.col h1 a:hover{
                display:block;
                background: white;
                border:solid 2px black;
                color:black;
                padding: 20px 30px 10px 10px;
                text-align:right;
            }
            article#primeira-col ul, article.col ul{
                display:block;
                //background: red;
                width:400px;
                margin:0;
                padding:0;
            }
            article#primeira-col li, article.col li{
                display:block;
                width:400px;
                //background:hotpink;
                padding:20px 10px 20px 30px;
            }
            article#primeira-col li a, article#primeira-col li  a:visited, article.col div a, article.col div a:visited{
                text-decoration: none;
                font-size: 1em;
                padding:20px 10px 20px 0px;
                color:#333333;
            }
            article#primeira-col a:hover, article#primeira-col a:active, article.col div a:hover, article.col div a:active{
               text-decoration: underline;
               color:#666666;
            }
            article#primeira-col li .dono{
                font-size:1em;
                font-weight: 600;
                text-transform:capitalize;
                text-align: left;
                float:left;
                margin:0;
                margin-bottom: 4px;
                //padding-left: 20px;
            }
            article#primeira-col li .data{
                font-size:1em;
                font-weight: 600;
                //text-transform:capitalize;
                text-align: right;
                
                padding-right: 20px;
                margin:0;
            }
            article#primeira-col li p{
                font-size:1em;
                margin:0;
                margin-top:10px;
                
            }
        </style>
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            exit;
            break;
            ?>
            <aside  class="cycle-slideshow"  data-cycle-fx="fadeout" data-cycle-timeout="7000" data-cycle-pager-event="mouseover" data-cycle-loader="true" data-cycle-progressive="#images2" data-cycle-speed="4000">
                <div class="cycle-pager"></div>
                <img src="imagem/baner1.png">
                <script id="images2" type="text/cycle">
                    <img src="imagem/baner2.png">
                    <img src="imagem/baner3.png">
                    <img src="imagem/baner4.png">
                </script>

            </aside>
            <section class="colunas2"> 
                <article id="primeira-col">
                    <h1><a href="Noticias.php" title="var todas">Últimas Notícias</a></h1>
                    <ul>
                        <?php
                         $noticiaDAO = new NoticiaDAO();
                         $i=0;
                        foreach ($noticiaDAO->listarNoticiasSelecionadas() as $noticia) {
                            if($i==3){
                                break;
                            }
                            $i++;
                            //data
                            $data = $noticia->getDataPub();
                            $dia = substr($data, 8, 2);
                            $mes = (int) substr($data, 5, 2);
                            switch ($mes) {
                                case 1:
                                    $mes = 'JAN';
                                    break;
                                case 2:
                                    $mes = 'FEV';
                                    break;
                                case 3:
                                    $mes = 'MAR';
                                    break;
                                case 4:
                                    $mes = 'ABR';
                                    break;
                                case 5:
                                    $mes = 'MAI';
                                    break;
                                case 6:
                                    $mes = 'JUN';
                                    break;
                                case 7:
                                    $mes = 'JUL';
                                    break;
                                case 8:
                                    $mes = 'AGO';
                                    break;
                                case 9:
                                    $mes = 'SET';
                                    break;
                                case 10:
                                    $mes = 'OUT';
                                    break;
                                case 11:
                                    $mes = 'NOV';
                                    break;
                                case 12:
                                    $mes = 'DEZ';
                                    break;
                                default:
                                    $mes = '';
                                    break;
                            }

                            //titulo sem o nome do dono
                            $titulo = stristr($noticia->getTitulo(), ' -', true);
                            $nomeDono = stristr($noticia->getTitulo(), ' -');
                            $nomeDono = str_replace('-', '', $nomeDono);

                              echo '<li>';
                              echo '<a href="'.$noticia->getLink().'" target="_blank"><h2 class="dono">'.$nomeDono.'</h2><h3 class="data">'.$dia.'/'.$mes.'</h3><p>'. $titulo.'</p></a>'; 
                              echo '</li>';
                        }
                        ?>
                    </ul>

                </article>
                <article class="col">
                    <h1><a href="Downloads.php">Top Downloads</a></h1>
                     <?php
                include_once '../Visao/verificarEstado.php';
                include_once '../Persistencia/DownloadsDAO.php';
                //include_once 'cabecalho.inc.php';

                $downloadsDAO = new DownloadsDAO();
                $download = $downloadsDAO->listarDownloads();

                foreach ($downloadsDAO->listarDownloads() as $download) {
                    echo '<div class="lista_Downloads">';
                    
                    echo '<h2>';
                    echo '<a href="../Controle/DownloadControle.class.php?acao=contadorDownloads&id=' . $download->getId() . '&url=' . $download->getUrl() . '">';
                    echo $download->getNome() . '</a></h2>';
                    //echo '<img src="imagem/reipreto.png" alt="' . $download->getNome() . '" class="downloads">';
                    echo '<p>' . $download->getDescricao() . '</p>';
                    echo '<td>' . $download->getNum_Downloads() . '</td>';
              
                    //echo '<td>' . $download->getData() . '</td>';
                    
                    //secho '</a>';
                    echo '</div>';
                }
                ?> 

                </article>
            </section>
           
            <footer style="clear:both">
                rodapé...
            </footer>
        </div>
    </body>
</html>
