<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if(isset($_SESSION['estado']))
{
    $estado = substr($_SESSION['estado'], 0, 6);
    
    if($estado != 'logado'){
        //header('Location: ./Erro.php');
        //echo "Erro 1";
    }
    else{
      // echo 'Estou logado '; 
       $logado = TRUE;
       $idUsuario = substr($_SESSION['estado'], 7); //gilmar: essas variaveis me ajudam a saber se o usuario esta logado ou não e exibir um menu adequado
      // echo 'Id do Usuario: '.$idUsuario;
    }
}
else{
    //header('Location: ./Erro.php');
    //echo "'Erro 2:' não existe sessão, o usuario não está logado";
}

?>