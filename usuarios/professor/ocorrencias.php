<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
   {
       session_destroy();
       header("Location: ../login.php");
   }

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `ID`, `Data`, `Titulo`, `Descricao`, `Responsavel` FROM ocorrencia
   ORDER BY `Data`DESC") or die ($conexao->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="../../css/ocorrencias-arquivadas.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <link rel="stylesheet" href="../../css/fonte-alert.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../js/sweetalert.js" type="module"></script>
        <title>Ocorrências</title>
    </head>
    <body>
        <nav>
            <h1 class="logo">MonitoraLab</h1>
            <img src="../../icons/icone-professor.png" class="icone-usuario">
            <div class="usuario">Amaral</div>
            <ul>
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="">Ocorrências</a></li>
                <li><a class="nav-li" href="monitores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>

        <div class="voltar">
            <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
            <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
        </div>

        <h2>Ocorrência registradas</h2>
        <a class="botao-registrar" href="registrar-ocorrencia.php">Registrar Ocorrencia<i class="fa-regular fa-pen-to-square"></i></a>
       
        <div class="container">
            <div class="cabecalho-ocorrencia">
                <div class="problema-data">
                    <label class="titulo-problema">Disjuntor desligado</label>
                    <label class="data-ocorrencia">27/10/2323</label>
                </div>
                <div class="titulo-editar">
                    <div class="titulo-ocorrencia">Computadores abertos em período de aula</div>
                    <div class="editar">
                        <button class="editar"><i class="fa-regular fa-pen-to-square editar"></i></button>
                    </div>
                </div>
            </div>
            <div class="infos-ocorrencia">
                <label class="responsavel">Registrada por:</label>
                <label class="laboratorio">Laboratório 4</label>
            </div>
            <div class="descricao-ocorrencia">
                Hoje, na sala de informática, enfrentamos um problema inesperado. Os computadores apresentaram um erro de conexão de rede, impedindo o acesso à internet. Investiguei o problema e descobri que um cabo de rede estava desconectado. Após reconectar o cabo, os computadores voltaram a funcionar normalmente. É fundamental lembrar a importância de verificar as conexões antes de relatar problemas técnicos, pois soluções simples podem evitar interrupções nas atividades dos alunos.
            </div>
        </div>

        <script>
        // function Excluir(element)
        // {
        //     var id = element.getAttribute('id-ocorrencia')

        //     swal({
        //         title: "Tem certeza?",
        //         text: "A ocorrência registrada será perdida.",
        //         icon: "warning",
        //         buttons: ["Cancel", true],
        //         dangerMode: true,
        //         })
        //         .then((value) => {
        //         if (value) {
        //             swal("Ocorrência excluída com sucesso!", {
        //             icon: "success"
        //             });
        //             window.location.href = "../../php/classes/usuarios.php?id-ocorrencia="+id;
        //         } else {
        //             swal("Não foi possível deletar a ocorrência.", {
        //             icon: "error",
        //             });
        //         }
        //         });
        // }

        function Sair()
        {
            swal({
                title: "Deseja realmente sair?",
                icon: "warning",
                buttons: ["Cancel", true],
            }).then(value =>{
                if (value)
                {
                    window.location.href = "../../php/classes/usuarios.php?resp=true";              
                }
            })
            return false;
        }
    </script>
    </body>
</html>