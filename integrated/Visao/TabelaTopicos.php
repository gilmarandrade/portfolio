 <!--<table>
   <tr>
        <td>Usuário</td>
        <td>Título</td>
    <tr>-->
<ul>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        include_once '../Persistencia/TopicoDAO.php';//$_SERVER['DOCUMENT_ROOT'].'/ProjetoIntegrated/Persistencia/TopicoDAO.php';
         include_once '../Persistencia/UsuarioDAO.php';//$_SERVER['DOCUMENT_ROOT'].'/ProjetoIntegrated/Persistencia/UsuarioDAO.php';
    
        $topicoDAO = new TopicoDAO();
        $topicos = $topicoDAO->listarTopicos();
        
        foreach($topicos as $topico){
            $idUsuario = $topico->getUsuarioDonoDoTopico();
            $usuarioDAO = new UsuarioDAO();
            
        echo '<li>';
            echo '<div class="usuario">'.$usuarioDAO->retornaUsuario($idUsuario).'</div>';
            echo '<div class="topico"><a href=./Topico.php?codigo='.$topico->getId()." title='ver tópico'>".$topico->getTitulo().'</div></a>';
       echo '</li>';
    }

?>
</ul>
 <!--</table>-->