<?php
include_once 'verificarEstado.php';
if( $logado!=TRUE ){
                header('Location: index.php');
           }
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Downloads</title><?php $titulo = 'Downloads'; ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href= "css/estiloBasicoDownloads.css" media= "all">
        <link rel="stylesheet" type="text/css" href="css/estiloBasicoGeral.css" />  
          <link rel="stylesheet" type="text/css" href="css/formularios.css" />
    </head>
    <body>
        <div id="wrap">
            <?php
            include_once 'cabecalho.inc.php'; //inclui o cabeçalho padrao, com titulo e links de navegacao adequado ao usuario
            ?>

            <section> 
                 <aside id="botoes">
                     <ul>
                         <!--<li><a href="" >pesquisar</a></li>-->
                         <li class="form1" id="formCadastro"><h2>Pesquisar</h2><form action="VerDownloads.php" method="post">
                    <input type="text" class="botao" id="pesquisa" placeholder="Pesquisar..." name="termoPesquisado"/>
                    <input type="submit" class="submit" value="Pesquisar">
                             </form></li>
                             <!--<li><a href=''>inserir download</a></li>-->
                             <li class="form1" id="formCadastro"><h2>Cadastrar</h2><form action="../Controle/DownloadControle.class.php?acao=inserir" method="post" >
                    <label for="inserir" >Nome</label><input type="text" id="inserir" placeholder="Insira nome..." name="nomeInserido">
                    <label for="inserir" >Descrição</label><input type="text" id="inserir" placeholder="Insira descricao..." name="descricaoInserida">
                    <label for="inserir" >Url</label><input type="text" id="inserir" placeholder="Insira URL..." name="urlInserida">
                    <label for="inserir" >Data</label><input type="text" id="inserir" placeholder="Insira data..." name="dataInserida">
                    <input type="submit"  class="submit" value="Inserir">
                                 </form></li>
                     </ul>
                     <div class="msg">
                     <?php
                        if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        }
                    
                    ?>
                </div>
                 </aside>
                <article id="listaDownloads">
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
                    echo '<img src="imagem/reipreto.png" alt="' . $download->getNome() . '" class="downloads">';
                    echo '<p>' . $download->getDescricao() . '</p>';
                    echo '<td>' . $download->getNum_Downloads() . '</td>';
              
                    //echo '<td>' . $download->getData() . '</td>';
                    
                    //secho '</a>';
                    echo '</div>';
                }
                ?> 

                <!--     <div id="lista_Downloads">
                         
                         <a href="">
                             <div id="pri_Lista">
                                 <h2>Halo 4</h2>
                                 <img src="img/halo4.png" alt="Halo 4" class="downloads"/>
                                 <p>
                                     Halo 4 se desenrola em um universo de ficÃ§Ã£o cientÃ­fica futurista, no ano 2557.
                                     Sua jogabilidade Ã© incrÃ­vel e seus grÃ¡ficos sÃ£o de tirar o folÃªgo.
                                 </p>
                             </div>
                         </a>
                -->
                <article>
            </section>
            <footer>
                rodapé...
            </footer>
        </div>
    </body>
</html>


