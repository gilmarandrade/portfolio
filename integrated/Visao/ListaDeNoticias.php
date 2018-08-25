<?php
        // put your code here
            include_once './verificarEstado.php';
            if( $logado!=TRUE ){
                header('Location: index.php');
           }
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de Notícias</title><?php $titulo = 'Lista de Notícias';?>
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoNoticias.css" />
        <link rel="stylesheet" type="text/css" href="css/listaNoticias.css" />
        <?php
        include_once '../Persistencia/NoticiaDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/NoticiaDAO.php';

        $id = $_GET['id'];
        $noticiaDAO = new NoticiaDAO();
        $nome = $noticiaDAO->getNome($id);
        
        ?>
    </head>
    <body>
        <div id="wrap">
            <?php include_once 'cabecalho.inc.php'; ?>
            <section>

                <aside id="botoes">
                    <ul>
                        <li><a href="CadastroDeFeed.php">voltar para lista de feeds</a></li>
                        <li><a href="../noticias.xml" target="_blank" >ver feed integrated</a></li>
                    </ul>

                </aside>
                <header id="tituloSection">
                    <h1><?php echo $nome; ?></h1>
                </header>
                <div class="msg">
                    <?php
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }

                    if (isset($_GET['msg1'])) {
                        echo $_GET['msg1'];
                    }
                    ?>
                </div>
                <article id="listaNoticias">
                    <ul>
                   <?php
            foreach ($noticiaDAO->listar($id) as $noticia) {
                //data
                $data = $noticia->getDataPub();
                $dia= substr($data, 8, 2);
                $mes=(int)substr($data, 5, 2);
                switch ($mes){
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
                $titulo =stristr($noticia->getTitulo(), '-'.$nome, true);
                $nomeDono = $nome;
                
                echo '<li>';
                         echo '<div class="topo">';
                           echo '<div class="data" title="'.$data.'"><strong>'.$dia.'</strong><span class="mes">'.$mes.'</span></div>';
                           
                           
                           echo '<div class="btSelectDeselect">';
                           if ($noticia->getStatus() == 0) {
                            echo '<form method="post" action="../Controle/NoticiaControle.class.php?acao=selecionar">' .
                            '<input type="hidden" name="idNoticia" value="' . $noticia->getId() . '" />' .
                            '<input type="hidden" name="idFeed" value="' . $id . '" />' .
                            '<input type="submit" class="btSelect" value="Selecionar" title="DESELECIONADO, clique para selecionar"/>' .
                            '</form>';
                          } else {
                            echo '<form method="post" action="../Controle/NoticiaControle.class.php?acao=deselecionar">' .
                            '<input type="hidden" name="idNoticia" value="' . $noticia->getId() . '" />' .
                            '<input type="hidden" name="idFeed" value="' . $id . '" />' .
                            '<input type="submit" class="btDeselect" value="Deselecionar" title="SELECIONADO, clique para deselecionar"/>' .
                            '</form>';
                         } 
                         echo '</div>';
                         echo '<div class="btExpandir"></div>';
                           
                           echo '<div class="titulo"><span class="dono">'.$nomeDono.'</span><h2 class="tituloNoticia" ><a href="'.$noticia->getLink().'" title="ver notícia completa" target="_blank">'.$titulo.'</a></h2></div>';
                           
                         echo '</div>';
                            echo '<div class="descricao">'.$noticia->getDescricao().'</div>';
                     
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

