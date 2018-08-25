<?php
        // put your code here
            include_once './verificarEstado.php';
            if( $logado!=TRUE ){
                header('Location: index.php');
           }
        ?>
<!--
 <!DOCTYPE html>
Vai mostrar lista de url dos feeds cadastrados no banco de dados
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>-->
<div class="msg">
<?php
if(isset($_GET['msg3'])){
    echo $_GET['msg3'];
}
?>
</div>
<!--
<ul>
    <li>
       <div class="icone">
           <img src="http://img1.olhardigital.uol.com.br/img/logo_olhar_digital.gif" alt=""/>
       </div>
        <div class="titulos" >
        <h2><a href="">Olhar Digital</a></h2>
        <h3>Mega Curioso - As curiosidades mais interessantes estão aqui</h3>
        <a class="link" href="">em http://olhardigital.uol.com.br/rss/ultimas_noticias.php</a>
        </div>
       
        <div class="atualizar">
            <form><input class="btAtualizar" type="button" value="atualizar" /></form>
        </div>  
         <div class="excluir">
            <form><input class="btExcluir" type="button" value="excluir" /></form>
        </div>
        <div class="visualizar">
            <form><input class="btVisualizar" type="button" value="visualizar" /></form>
        </div>
        <div class="novas">
            7
        </div>
    </li>
    
</ul>
   -->   
   <ul>
            <?php
            include_once '../Persistencia/FeedDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/FeedDAO.php';

            //$produtoDAO = new ProdutoDAO();
            $feedDAO = new FeedDAO();
            //$produtos = $produtoDAO->listar();

            foreach ($feedDAO->listar() as $feed) {
                
            echo '<li>';
                 echo '<div class="icone">';
                 echo '<img src="'.$feed->getImagem().'" alt=""/>';
                 echo '</div>';
                 
                 echo '<div class="titulos" >';
                 echo '<h2><a href="'.$feed->getUrl().'" title="ir para feed" target="_blank" >'.$feed->getNome().'</a></h2>';
                 echo '<h3>'.$feed->getDescricao().'</h3>';
                 echo '<a class="link" href="'.$feed->getUrl().'" target="_blank" title="ir para feed">em '.$feed->getUrl().'</a>';
                 echo '</div>';
       
                 echo '<div class="atualizar">';
                 echo '<form method="post" action="../Controle/NoticiaControle.class.php?acao=atualizar">' .
                            '<input type="hidden" name="id" value="'.$feed->getId().'" />'.
                            '<input type="hidden" name="url" value="'.$feed->getUrl().'" />'.
                            '<input class="btAtualizar" type="submit" value="Atualizar" title="atualizar notícias" />'.
                      '</form>';
                 echo '</div>';
                 
                 echo '<div class="excluir">';
                 echo '<form method="post" action="../Controle/FeedControle.class.php?acao=excluir">' .
                            '<input type="hidden" name="id" value="'.$feed->getId().'" />'.
                            '<input class="btExcluir" type="submit" value="Excluir" title="excluir URL" />'.
                      '</form>';
                 echo '</div>';
                   
                 echo '<div class="visualizar">';
                 echo '<form method="post" action="../Controle/NoticiaControle.class.php?acao=visualizar">' .
                            '<input type="hidden" name="id" value="'.$feed->getId().'" />'.
                            '<input type="hidden" name="url" value="'.$feed->getUrl().'" />'.
                            '<input class="btVisualizar" type="submit" value="Visualizar" title="visualizar notícias" />'.
                        '</form>';
                 echo '</div>';
            
                 echo '<div class="novas"'; 
                 if($feed->getNovas() > 0)
                 {  echo 'title="noticias novas">';
                     echo $feed->getNovas();}
                     else{
                         echo ' >';
                     }
                 echo '</div>';
            echo '</li>';
                
            }
            ?>
   </ul>
    <!--</body>
</html>
-->