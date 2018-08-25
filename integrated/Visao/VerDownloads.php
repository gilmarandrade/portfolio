<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <title>Downloads</title><?php $titulo = 'Busca Downloads'; ?>
        <link rel="stylesheet" type="text/css" href= "css/estiloBasicoDownloads.css" media= "all">
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />  
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section> 
                  <article id="listaDownloads">
                <?php
                include_once '../Persistencia/DownloadsDAO.php'; //$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/DownloadsDAO.php';

                $pesquisa = $_POST['termoPesquisado'];
                if ($pesquisa == null || empty($pesquisa)) {
                    echo '<div class="msg">termo de pesquisa invalido</div>';
                } else {
                    $downloadsDAO = new DownloadsDAO();

                    $downloads = $downloadsDAO->procurarDownloads($pesquisa);
                    //print_r($downloads);
                    foreach ($downloads as $download) {

                        echo '<div class="lista_Downloads">';

                        echo '<h2>';
                        echo '<a href="../Controle/DownloadControle.class.php?acao=contadorDownloads&id=' . $download->getId() . '&url=' . $download->getUrl() . '">';
                        echo $download->getNome() . '</a></h2>';
                        echo '<img src="imagem/reipreto.png" alt="' . $download->getNome() . '" class="downloads">';
                        echo '<p>' . $download->getDescricao() . '</p>';
                        echo '<td>' . $download->getNum_Downloads() . '</td>';

                        //echo '<td>' . $download->getData() . '</td>';
                        //secho '</a>';
                        echo '</div>';
                    }
                }
                ?>
                  </article>
            </section>
            <footer>
                rodapé...
            </footer>
        </div>
    </body>
</html>
