<?php
    class Usuarios
    {
        public $id;
        public $login;
        public $nome;
        public $senha;

        public function GetNome($nome)
        {
            $this->nome = $nome;
        }
        public function SetNome()
        {
            return $this->nome;
        }

        public function GetLogin($login)
        {
            $this->login = $login;
        }
        public function SetLogin()
        {
            return $this->login;
        }

        public function GetSenha($senha)
        {
            $this->senha = $senha;
        }
        public function SetSenha()
        {
            return $this->senha;
        }
        
        public function Entrar()
        {
            $tipoDeLogin = $_POST['identificacao'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            if (isset($_POST['entrar']))
            {
                switch ($tipoDeLogin) {
                    case 'Dir':
                        require('../conexao/conexaoBD.php');

                        $conexao = ConectarBanco();
                        $query = "SELECT * FROM direcao WHERE login = '$login' AND senha = '$senha'";
                        $resultado = mysqli_query($conexao, $query);
            
                        if (mysqli_num_rows($resultado) > 0) 
                        {
                            $conexao->close();
                            
                            if (!isset($_SESSION)) session_start();
            
                            $_SESSION['login'] = $login;
                            $_SESSION['login_incorreto'] = false;
                            $_SESSION['tipoDeUsuario'] = $tipoDeLogin;

                            header("Location: ../../usuarios/diretoria/inicio.php");
                            
                        }
                        $conexao->close();
                        $_SESSION['login_incorreto'] = true;
                        echo '<link rel="stylesheet" href="../../css/fonte-alert.css">';
                        echo '<script src="../../js/sweetalert.js"></script>';
                        echo '<script src="../../js/erro-de-login.js"></script>';
                        echo '<script>window.onload = function() { MostrarErro(); }; </script>';

                        break;
                        
                    case 'Prof':
                        require('../conexao/conexaoBD.php');

                        $conexao = ConectarBanco();
                        $query = "SELECT * FROM professor WHERE login = '$login' AND senha = '$senha'";
                        $resultado = mysqli_query($conexao, $query);

                        if (mysqli_num_rows($resultado) > 0) 
                        {
                            $conexao->close();

                            if (!isset($_SESSION)) session_start();

                            $_SESSION['login'] = $login;
                            $_SESSION['login_incorreto'] = false;
                            $_SESSION['tipoDeUsuario'] = $tipoDeLogin;

                            header("Location: ../../usuarios/professor/inicio.php");
                        }
                        $conexao->close();
                        $_SESSION['login_incorreto'] = true;
                        echo '<link rel="stylesheet" href="../../css/fonte-alert.css">';
                        echo '<script src="../../js/sweetalert.js"></script>';
                        echo '<script src="../../js/erro-de-login.js"></script>';
                        echo '<script>window.onload = function() { MostrarErro(); }; </script>';

                        break;

                    case 'Mon':
                        require('../conexao/conexaoBD.php');

                        $conexao = ConectarBanco();
                        $query = "SELECT * FROM monitor WHERE login = '$login' AND senha = '$senha'";
                        $resultado = mysqli_query($conexao, $query);

                        if (mysqli_num_rows($resultado) > 0) 
                        {
                            $conexao->close();

                            if (!isset($_SESSION)) session_start();

                            $_SESSION['login'] = $login;
                            $_SESSION['login_incorreto'] = false;
                            $_SESSION['tipoDeUsuario'] = $tipoDeLogin;

                            header("Location: ../../usuarios/monitor/inicio.php");
                        }
                        $conexao->close();
                            $_SESSION['login_incorreto'] = true;
                            echo '<link rel="stylesheet" href="../../css/fonte-alert.css">';
                            echo '<script src="../../js/sweetalert.js"></script>';
                            echo '<script src="../../js/erro-de-login.js"></script>';
                            echo '<script>window.onload = function() { MostrarErro(); }; </script>';

                        break;
                    default:
                    header("Location: ../../../login.php");
                        break;
                }
            }
        }

        public function Sair()
        {
            if ($_GET['resp'])
            {
                session_start();
                session_destroy();
                header("Location: ../../login.php");
            }
        }
    }

    class Direcao extends Usuarios
    {
        public function CadastrarProfessor($nomeProfessor, $loginProfessor, $senhaProfessor)
        {
            require('../conexao/conexaoBD.php');

            $Professor = new Professor();
            $Professor->GetNome($nomeProfessor);
            $Professor->GetLogin($loginProfessor);
            $Professor->GetSenha($senhaProfessor);

            $conexao = ConectarBanco();
            session_start();
        
            $direcao = $_SESSION['login'];
        
            $conexao->query("INSERT INTO professor (login, nome, senha, login_direcao) VALUES 
            ( '" . $Professor->login . "', '" . $Professor->nome . "', '" . $Professor->senha . "', '" 
            .$direcao."')");
        
            $conexao->close();
            return header("Location: ../../../monitoralab/usuarios/diretoria/inicio.php");
        }

        public function ExcluirProfessor($login)
        {
            require('../conexao/conexaoBD.php');
            $conexao = ConectarBanco();

            $conexao->query("DELETE FROM professor WHERE login = '" . $login . "'");
            $conexao->close();
            return header("Location: ../../../monitoralab/usuarios/diretoria/professores-cadastrados.php");
        }

        public function ArquivarOcorrencia($id)
        {
            require("../conexao/conexaoBD.php");
            require("ocorrencias.php");
            $conexao = ConectarBanco();

            $conexao->query("UPDATE ocorrencia SET `arquivado`='sim' WHERE id = '$id'");

            // while ($ocorrencia = $sql_ocorrencia->fetch_assoc())
            // {
            //     $OcorrenciaArquivada = new Ocorrencia();
            //     $OcorrenciaArquivada->RegistrarOcorrencia($ocorrencia['responsavel'], $ocorrencia['data'],
            // $ocorrencia['titulo'], $ocorrencia['laboratorio'], $ocorrencia['problema'], $ocorrencia['descricao']);
            // }

        //     $sql_insert = $conexao->prepare("INSERT INTO `ocorrencias_arquivadas` (data, titulo, laboratorio, problema,
        //     descricao, arquivado, responsavel, login) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        //     $sql_insert->bind_param("ssssssss", $OcorrenciaArquivada->data, $OcorrenciaArquivada->titulo, 
        //     $OcorrenciaArquivada->laboratorio, $OcorrenciaArquivada->problema, $OcorrenciaArquivada->descricao, $arquivado,
        // $OcorrenciaArquivada->responsavel, $login);

        //     $sql_insert->execute();

        //     $conexao->query("DELETE FROM ocorrencia WHERE id='$id'");

            $conexao->close();

            header('Location: ../../usuarios/diretoria/ocorrencias.php');
        }

        public function FiltrarOcorrencia($problema, $data, $lab)
        {
            $location = "Location: ../../usuarios/diretoria/ocorrencias-arquivadas.php?";

            if ($problema != '' && $data != '' && $lab != '')
            {
                return header($location.'problema=' . $problema . '&data=' . $data . '&lab=' . $lab);
            }
            else if ($problema != '' && $data != '')
            {
                return header($location.'problema='. $problema . '&data=' . $data . '&lab=');
            }
            else if ($data != '' && $lab != '')
            {
                return header($location.'problema=&data=' . $data . '&lab=' . $lab);
            }
            else if ($problema != '' && $lab != '')
            {
                return header($location.'problema='. $problema . '&data=&lab=' . $lab);
            }
            else if ($problema != '')
            {
                return header($location.'problema='. $problema . '&data=&lab=');
            }
            else if ($data != '')
            {
                return header($location.'problema=&data=' . $data . '&lab=');
            }
            else if ($lab != '')
            {
                return header($location.'problema=&data=&lab=' . $lab);
            }
            else
            {
                return header($location.'problema=&data=&lab=');
            }
        }

        function LimparFiltro()
        {
            $sql_filtro = "SELECT * FROM `ocorrencias_arquivadas` ORDER BY `Data` DESC";
            return header('Location: ../../usuarios/diretoria/ocorrencias-arquivadas.php?problema=&data=&lab=');
        }
    }

    class Professor extends Usuarios
    {
        public function CadastrarMonitor($nomeMonitor, $loginMonitor, $senhaMonitor)
        {
            require('../conexao/conexaoBD.php');

            $Monitor = new Monitor();
            $Monitor->GetNome($nomeMonitor);
            $Monitor->GetLogin($loginMonitor);
            $Monitor->GetSenha($senhaMonitor);
            session_start();
            $conexao = ConectarBanco();
            $professor = $_SESSION['login'];
            
            $sql_procura_igual = "SELECT * FROM monitor WHERE login = '" . $Monitor->login . "'";
            $resultado = mysqli_query( $conexao, $sql_procura_igual);

            if (mysqli_num_rows($resultado) > 0)
            {
                $conexao->close();
                echo "error";
            }
            else
            {
                if(
                    $conexao->query("INSERT INTO monitor (login, nome, senha, login_professor) VALUES 
                ( '" . $Monitor->login . "', '" . mb_convert_case($Monitor->nome, MB_CASE_TITLE, 'UTF-8') . "', '" . $Monitor->senha . "', '" 
                .$professor ."')"))
                {
                    $conexao->close();
                    echo "success";
                }              
            }
            return false;
        }

        public function ExcluirMonitor($login)
        {
            require('../conexao/conexaoBD.php');
            $conexao = ConectarBanco();

            $conexao->query("DELETE FROM monitor WHERE login = '" . $login . "'");
            $conexao->close();
            return header("Location: ../../../monitoralab/usuarios/professor/monitores-cadastrados.php");
        }

        public function RegistrarOcorrencia($data, $titulo, $laboratorio, $problema, $descricao)
        {
            require('../conexao/conexaoBD.php');
            require('ocorrencias.php');

            session_start();
            $professor = $_SESSION['login'];
            $Ocorrencia = new Ocorrencia();
            $Ocorrencia->GerarOcorrencia($professor, $data, $titulo, $laboratorio, $problema, $descricao, "não");

            $conexao = ConectarBanco();
            $resultado = mysqli_query($conexao, "SELECT nome FROM professor WHERE login = '" . 
                $professor . "'");
            if($resultado)
            {
                $row = mysqli_fetch_assoc($resultado);
                $responsavel = $row['nome'];
            }
            if (
            $conexao->query("INSERT INTO ocorrencia (data, titulo, laboratorio, problema, descricao, responsavel, arquivado, login_prof) 
            VALUES ('" . $Ocorrencia->data . "', '" . $Ocorrencia->titulo . "', '" . $Ocorrencia->laboratorio .
            "', '" . $Ocorrencia->problema . "', '" . 
            $Ocorrencia->descricao . "', '" . $responsavel . "', '". $Ocorrencia->arquivado ."', '" . $professor . "')"))
            {
                $conexao->close();
                return true;
            }
            $conexao->close();
            return false;
        }

        public function EditarOcorrencia($id, $Data, $Titulo, $Laboratorio, $Problema, $Descricao)
        {
            require('../conexao/conexaoBD.php');
            $conexao = ConectarBanco();

            $conexao->query("UPDATE ocorrencia SET `Data`='" . $Data . "', `Titulo`='" . $Titulo . 
            "', `Laboratorio`='" . $Laboratorio . "', `Problema`='" . $Problema . "', 
            `Descricao`='" . $Descricao . "' WHERE id = " . $id);

            header("Location: ../../usuarios/professor/ocorrencias.php");
        }
    }

    class Monitor extends Usuarios
    {
        public function RegistrarDiagnostico()
        {
            require('../conexao/conexaoBD.php');
            require('diagnosticos.php');

            $conexao = ConectarBanco();
            session_start();
        
            $monitor = $_SESSION['login'];
        
            function RegistrarProblema($problemaSelecionado)
            {
                if ($problemaSelecionado == "sel" || $problemaSelecionado == "Sel")
                {
                    return "";
                }
                return $problemaSelecionado;
            }

            $Diagnostico = new Diagnostico($_POST['sele-lab'], $_POST['data'], RegistrarProblema($_POST['prob-apps']),
            $_POST['quantApps'],  RegistrarProblema($_POST['prob-fonte']), $_POST['quantFonte'],
            RegistrarProblema($_POST['prob-hd']), $_POST['quantHD'], RegistrarProblema($_POST['prob-monitor']),
            $_POST['quantMonitor'], RegistrarProblema($_POST['probMouse']), $_POST['quantMouse'],
            RegistrarProblema($_POST['prob-teclado']), $_POST['quantTeclado'], RegistrarProblema($_POST['prob-windows']),
            $_POST['quantWindows'], $_POST['atvExercida'], $_POST['probSolucionados'], $_POST['responsavel']);
                
                $sql = "INSERT INTO reparo (data, acao, Problemas_Nao_Solucionados, 
                responsavel, login_monitor, laboratorio) VALUES ('$Diagnostico->data', '$Diagnostico->atividadeExercida', 
                '$Diagnostico->problemasSolucionados', '$Diagnostico->responsavel','$monitor', '$Diagnostico->laboratorio')";
        
                if ($conexao->query($sql) === true)
                {
                    $id_reparo = $conexao->insert_id;
                }
        
                $conexao->query("INSERT INTO dispositivo (nome, problema, quantidade) VALUES ('Apps', '$Diagnostico->problemaApps', 
                '$Diagnostico->quantApps'), ('Fonte', '$Diagnostico->problemaFonte', '$Diagnostico->quantFonte'), 
                ('HD', '$Diagnostico->problemaHD', '$Diagnostico->quantHD'), ('Monitor', '$Diagnostico->problemaMonitor', 
                '$Diagnostico->quantMonitor'), ('Mouse', '$Diagnostico->problemaMouse', '$Diagnostico->quantMouse'), ('Teclado', 
                '$Diagnostico->problemaTeclado', '$Diagnostico->quantTeclado'), ('Windows', '$Diagnostico->problemaWindows', 
                '$Diagnostico->quantWindows')");
        
                $consultaIDS = "SELECT id FROM dispositivo ORDER BY id DESC LIMIT 7";
                $resultado = mysqli_query($conexao, $consultaIDS);
        
                if (mysqli_num_rows($resultado) > 0) {
                    $ID_dispositivos = array();
                
                    while ($coluna = mysqli_fetch_assoc($resultado)) {
                        $ID_dispositivos[] = $coluna['id'];
                    }
                }
        
                for ($i = 0; $i < 7; $i++)
                {
                    $conexao->query("INSERT INTO dispositivo_reparo (id_dispositivo, id_reparo) 
                    VALUES ($ID_dispositivos[$i], '$id_reparo')");
                }
        
                 $pasta = "../../arquivos/";
        
        
                if (isset($_FILES['foto']))
                {
                    $fotos = $_FILES['foto'];
        
                    foreach ($fotos['tmp_name'] as $index => $imagemTmp) 
                    {
                        $nomeDoArquivo = $fotos['name'][$index];
                        $novoNomeDoArquivo = uniqid();
                        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
            
                        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
                        $armazenou = move_uploaded_file($imagemTmp, $path);
            
                        if ($armazenou)
                        {
                            $conexao->query("INSERT INTO arquivos (id_reparo, path) VALUES ('$id_reparo', '$path')");
                        }
                    }
                }
                $conexao->close();
                return header("Location: ../../../monitoralab/usuarios/monitor/registrar-diagnostico.php");
        }

        public function ExcluirDiagnostico($id)
        {
            require('../conexao/conexaoBD.php');
            $conexao = ConectarBanco();

            $query_delete_diagnostico = "DELETE FROM `reparo` WHERE ID = " . $id;
            $query_select_ids = $conexao->query("SELECT ID_Dispositivo FROM dispositivo_reparo WHERE ID_Reparo = " . $id);

            while ($row = $query_select_ids->fetch_assoc()) {
                $idDispositivo = $row['ID_Dispositivo'];
                $query = "DELETE FROM `dispositivo` WHERE ID = ?";
                $stmt = $conexao->prepare($query);
                $stmt->bind_param("i", $idDispositivo);
                $stmt->execute();
            }
                if($conexao->query($query_delete_diagnostico))
                {
                    $conexao->close();
                    header("Location: ../../usuarios/monitor/inicio.php");
                    exit;
                }
            $conexao->close();
            return false;
        }
    }

    if (isset($_POST['RegistrarDiagnostico']))
    {
        $Monitor = new Monitor();
        $Monitor->RegistrarDiagnostico();
    }

    if (isset($_GET['excluir']))
    {
        $Monitor = new Monitor();
        $Monitor->ExcluirDiagnostico($_GET['id']);
    }

    if (isset($_POST['CadastrarMonitor']))
    {
        $Professor = new Professor();
        $Professor->CadastrarMonitor($_POST['nome'], $_POST['login'], $_POST['senha']);
    }

    if (isset($_GET['login-mon']))
    {
        $Professor = new Professor();
        $Professor->ExcluirMonitor($_GET['login-mon']);
    }

    if (isset($_POST['RegistrarOcorrencia']))
    {
        $Professor = new Professor();
        $Professor->RegistrarOcorrencia($_POST['data'], $_POST['titulo'],
        $_POST['laboratorio'], $_POST['problema'], $_POST['txtDescricao']);
    }

    if (isset($_GET['EditarOcorrencia']))
    {
        $Professor = new Professor();
        $Professor->EditarOcorrencia($_GET['id'], $_GET['data'], $_GET['titulo'], $_GET['laboratorio'],
    $_GET['problema'], $_GET['descricao']);
    }

    if (isset($_POST['filtro']))
    {
        $problema = isset($_POST['problema']) == true ? ($_POST['problema'] != '' ? $_POST['problema'] : '') : '';
        $data = isset($_POST['data']) == true ? ($_POST['data'] != '' ? $_POST['data'] : '') : '';
        $lab = isset($_POST['laboratorio']) == true ? ($_POST['laboratorio'] != '' ? $_POST['laboratorio'] : '') : '';
        $Direcao = new Direcao();
        $Direcao->FiltrarOcorrencia($problema, $data, $lab);
    }

    if (isset($_GET['limpar']))
    {
        $Direcao = new Direcao();
        $Direcao->LimparFiltro();
    }

    if (isset($_POST['CadastrarProfessor']))
    {
        $Direcao = new Direcao();
        $Direcao->CadastrarProfessor($_POST['nome'], $_POST['login'], $_POST['senha']);
    }

    if (isset($_GET['id-arquivar']))
    {
        $Direcao = new Direcao();
        $Direcao->ArquivarOcorrencia($_GET['id-arquivar']);
    }

    if (isset($_GET['login-prof']))
    {
        $Direcao = new Direcao();
        $Direcao->ExcluirProfessor($_GET['login-prof']);
    }

    if (isset($_POST['entrar']))
    {
        $Usuario = new Usuarios();
        $Usuario->Entrar();
    }

    if (isset($_GET['resp']))
    {
        $Usuario = new Usuarios();
        $Usuario->Sair();
    }
?>