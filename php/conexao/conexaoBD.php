<?php

    function ConectarBanco()
    {
        $host = "localhost"; 
        $usuario = "root"; 
        $senha = "";
        $banco = "monitoramento_reparos";
        
        $conexao = mysqli_connect($host, $usuario, $senha, $banco);
        if (!$conexao) 
        {
            die("Falha na conexão: " . mysqli_connect_error());
        }
        return $conexao;
    }
?>