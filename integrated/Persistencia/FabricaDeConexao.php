<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    //Está usando o usuário 'root' apenas durante o desenvolvimento
    //$stringDeConexao = mysql_connect("127.0.0.1", "root", "");
    //Conexão com banco de gilmar: 
    $stringDeConexao = mysql_connect("127.0.0.1", "root", "112358");
    
    /* Verificar a conexão */
    if(!$stringDeConexao){
        echo "Falha na conexão com o banco de dados";
    } else {
       // echo "Banco de Dados encontrado com sucesso!";
        $nomeDoBD = mysql_select_db("projetointegrated");
        if(!$nomeDoBD){
            echo "Falha na conexão com o banco selecionado!";
        } else {
           // echo "Banco selecionado com sucesso!";
        }
    }

?>
