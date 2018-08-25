<header id="cabecalhoPrincipal">
    <div id="navBar">
        <nav>

            <a href="index.php">Home</a>
            <a href="Noticias.php">Notícias</a>
            
            <a href="Downloads.php">Downloads</a>
            <!--<a href="Contato.php">Contato</a>-->
            <?php
            if (isset($idUsuario)) {
                //logado
                echo '<a href="VerTopicos.php">Forum</a>';
                echo '<a href="PerfilUsuario.php">Meu Perfil</a>';
                echo '<a href="../Controle/UsuarioControle.class.php?acao=logout">Logout</a>';
            } else {
                //nao logado
                echo '<a href="LoginDeUsuario.php">Login</a>';
                echo '<a href="CadastroDeUsuario.php">Cadastro</a>';
            }
            ?>

            <input type="text" id="pesquisa" placeholder="Pesquisar..."/>

        </nav>
    </div>
    <div id="logo">
        <img src="imagem/reipreto.png" /><h1><?php echo $titulo; ?></h1>
    </div>
</header>
