<table>
    <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    //Include para os comentários
    include_once '../Modelo/Comentario.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Comentario.class.php';
    include_once '../Persistencia/ComentarioDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/ComentarioDAO.php';

    //Include para os tópicos
    include_once '../Modelo/Topico.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Topico.class.php';
    include_once '../Persistencia/TopicoDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/TopicoDAO.php';

    //Include para o usuário
    include_once '../Persistencia/UsuarioDAO.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Persistencia/UsuarioDAO.php';
    include_once '../Modelo/Usuario.class.php';//$_SERVER['DOCUMENT_ROOT'] . '/ProjetoIntegrated/Modelo/Usuario.class.php';

    $codigo = (int) $_GET['codigo'];

    $topicoDAO = new TopicoDAO();
    $topico = $topicoDAO->retornaTopico($codigo);
    $usuario = new UsuarioDAO();
    $comentario;

    echo '<div id="topico">';


    echo '<div class="topo">'; //Título do tópico
    echo '<div class="usuario">'; //Primeiro carrega o dono do tópico
    echo $usuario->retornaUsuario($topico->getUsuarioDonoDoTopico());
    echo '</div>';
 
    echo '<div class="titulo">'.$topico->getTitulo()."</div>";
    echo '</div>';



    echo '<div class="texto">'; //Depois carrega o tópico
    echo $topico->getTexto();
    echo '</div>';

    echo '</div>';
    
    
    echo '<aside id="comentarios">';
    echo '<h1>Comentários</h1>';
    echo '<ul>';
    for ($i = 0; $i < count($topico->getComentarios()); $i++) {
        $comentario = $topico->getComentarios()[$i];
        //echo $comentario->getUsuario();
       echo '<li>';
        echo '<div class="usuario">';//Primeiro carrega o usuário do comentário
        echo $usuario->retornaUsuario($comentario->getUsuario());
        echo '</div>';

        echo '<div class="texto">'; //Depois carrega o comentário
        echo $comentario->getTexto();
        echo '</div>';
        
        echo '</li>';
        
    }
    echo '</ul>';
    echo '</aside>';
    ?>
</table>