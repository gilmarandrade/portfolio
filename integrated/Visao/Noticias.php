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
        <title>Notícias</title><?php $titulo = 'Notícias'; ?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/listaNoticias.css" />
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section>    
                <article id="listaNoticias">
                    
                    <ul>
                        <?php
                        $noticiaDAO = new NoticiaDAO();
                        foreach ($noticiaDAO->listarNoticiasSelecionadas() as $noticia) {
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
                            echo '<div class="topo">';
                            echo '<div class="data" title="' . $data . '"><strong>' . $dia . '</strong><span class="mes">' . $mes . '</span></div>';


                            echo '<div class="btSelectDeselect">';
                           
                            echo '</div>';
                            echo '<div class="btExpandir"></div>';

                            echo '<div class="titulo"><span class="dono">' . $nomeDono . '</span><h2 class="tituloNoticia" ><a href="' . $noticia->getLink() . '" title="ver notícia completa" target="_blank">' . $titulo . '</a></h2></div>';

                            echo '</div>';
                            echo '<div class="descricao">' . $noticia->getDescricao() . '</div>';

                            echo '</li>';
                        }
                        ?>
                    </ul>
                </article>
            </section>
            <footer>
                rodapé...
            </footer>
        </div>
    </body>
</html>
