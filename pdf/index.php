<?php

    require('../php/conexao/conexaoBD.php');
    $conexao = ConectarBanco();

    require __DIR__.'/vendor/autoload.php';

    use Dompdf\Dompdf;
    $dompdf = new Dompdf(['enable_remote' => true]);

    $html = '<!DOCTYPE html>';
    $html .= '<html lang="pt-br">';
    $html .= '<head>';
    $html .= '<meta charset="UTF-8">';
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<style>';

    $html .= 'html{';
    $html .= 'min-height: 10vh;';
    $html .= '}';

    $html .= '*{';
    $html .= 'margin: 0;';
    $html .= 'padding: 0;';
    $html .= 'text-decoration: none;';
    $html .= 'list-style: none;';
    $html .= 'letter-spacing: normal;';
    $html .= '}';

    $html .= 'body{';
    $html .= 'font-family:"Poppins", sans-serif;';
    $html .= 'font-weight: 470;';
    $html .= 'letter-spacing: 5px; ';
    $html .= '}';

    $html .= 'h2{';
    $html .= 'color: #24416B;';
    $html .= 'text-transform: uppercase;';
    $html .= 'margin: 0 0 0 8%;';
    $html .= 'letter-spacing: normal;';
    $html .= 'font-size: 30px;';
    $html .= 'font-family: "Poppins", sans-serif; ';
    $html .= '}';

    // geral
    $html .= '.container-geral{';
    $html .= 'clear: both;';
    $html .= 'position: relative;';
    $html .= '}';

    //quantidades
    $html .= '.container-1{';
    $html .= 'position: absolute;';
    $html .= 'left: 300pt;';
    $html .= 'width: 320px;';
    $html .= 'margin: 2.9% 0 0 8%;';
    $html .= 'font-family: "Poppins", sans-serif;';
    $html .= 'font-weight: 400;';
    $html .= 'text-align: justify;';
    $html .= 'word-spacing: 3px;';
    $html .= '}';

    //problemas
    $html .= '.container-2{';
    $html .= 'text-align: justify;';
    $html .= 'width: 320px;';
    $html .= 'margin-left: 8%;';
    $html .= 'border-bottom: 1px solid #7d7d7d;';
    $html .= '}';

    $html .= '.problema-data{';
    $html .= 'display: flex;';
    $html .= 'justify-content:space-between;';
    $html .= '}';

    $html .= '.titulo-problema{';
    $html .= 'color: #24416B;';
    $html .= 'letter-spacing: normal;';
    $html .= 'font-size: 115%;';
    $html .= 'font-family: "Poppins", sans-serif;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.titulo-ocorrencia{';
    $html .= 'font-size: 110%;';
    $html .= '}';

    $html .= '.infos-ocorrencia{';
    $html .= 'display: flex;';
    $html .= 'flex-direction: column;';
    $html .= '}';

    $html .= '.responsavel{';
    $html .= 'color: #24416B;';
    $html .= 'margin: 0 0 1% 0;';
    $html .= 'font-size: 110%;';
    $html .= 'font-family: "Poppins", sans-serif;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.laboratorio{';
    $html .= 'color: #24416B;';
    $html .= 'margin: 0 0 1% 0;';
    $html .= 'font-size: 110%;';
    $html .= 'font-family: "Poppins", sans-serif;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.descricao-ocorrencia{';
    $html .= 'margin: 0 0 4% 0;';
    $html .= 'text-align: justify;';
    $html .= '}';

    $html .= '</style>';
    
    $html .= '<script src="https://unpkg.com/@phosphor-icons/web"></script>';
    $html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />';
    $html .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
    $html .= '</head>';
    $html .= '<br><br><br><h2>Ocorrências Arquivadas</h2><br><br>';
    $html .= '<div class="container-geral">';
    $html .= '<div class="container-1">';

    $faltaInternet = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Falta de internet'");
    $quantidadeFalta = mysqli_num_rows($faltaInternet);
 
    $pcDesorganizado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Computadores desorganizados'");
    $quantidadePC = mysqli_num_rows($pcDesorganizado);
 
    $sumicoDispositivo = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Sumiço de dispositivos'");
    $quantidadeSumico = mysqli_num_rows($sumicoDispositivo);
    
    $dispositivoQuebrado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Dispositivo quebrado'");
    $quantidadeDispQuebrado = mysqli_num_rows($dispositivoQuebrado);
    
    $CadeirasDesorganizadas = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cadeiras desorganizadas'");
    $quantidadeCadeiras = mysqli_num_rows($CadeirasDesorganizadas);
    
    $cabosDesconectados = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cabos desconectados'");
    $quantidadeCabos = mysqli_num_rows($cabosDesconectados);
    
    $disjuntorDesligado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Disjuntor desligado'");
    $quantidadeDisjuntor = mysqli_num_rows($disjuntorDesligado);
    
    $janelaAberta = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Janela aberta'");
    $quantidadeJanela = mysqli_num_rows($janelaAberta);
    
    $quedaEnergia = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Queda de energia'");
    $quantidadeQueda = mysqli_num_rows($quedaEnergia);

    $html .= '<label class="problemas">'.$quantidadeFalta.'x Falta de internet</label><br>';
    $html .= '<label class="problemas">'.$quantidadePC.'x Computadores desorganizados</label><br>';
    $html .= '<label class="problemas">'.$quantidadeSumico.'x Sumiço de dispositivo</label><br>';
    $html .= '<label class="problemas">'.$quantidadeDispQuebrado.'x Dispositivo quebrado</label><br>';
    $html .= '<label class="problemas">'.$quantidadeCadeiras.'x Cadeiras desorganizadas</label><br>';
    $html .= '<label class="problemas">'.$quantidadeCabos.'x Cabos desconectados</label><br>';
    $html .= '<label class="problemas">'.$quantidadeDisjuntor.'x Disjuntor desligado</label><br>';
    $html .= '<label class="problemas">'.$quantidadeJanela.'x Janela Aberta</label><br>';
    $html .= '<label class="problemas">'.$quantidadeQueda.'x Queda de energia</label><br>';
    $html .= '</div>';

    $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` ORDER BY `Data`DESC") or die ($conexao->error);


    if ($sql_query->num_rows > 0)
    {
        while ($row = $sql_query->fetch_object())
        {
            $html .= '<div class="container-2">';
            $html .= '<div class="cabecalho-ocorrencia">';
            $html .= '<div class="problema-data"><br>';
            $html .= '<label class="titulo-problema">'. $row->problema .'</label><br>';
            $html .= '<label class="laboratorio">'. $row->laboratorio .': </label>';
            $html .= '<label class="data-ocorrencia"> '. $row->data .'</label><br>';
            $html .= '</div>';
            $html .= '<div class="titulo-ocorrencia">'. $row->titulo .'</div>';
            $html .= '</div>';
            $html .= '<div class="infos-ocorrencia">';
            $html .= '<label class="responsavel">Registrada por: '. $row->responsavel .'</label><br>';
            // $html .= '<label class="laboratorio">'. $row->laboratorio .'</label><br>';
            $html .= '</div>';
            $html .= '<div class="descricao-ocorrencia">';
            $html .= $row->descricao;
            $html .= '</div>';
            $html .= '</div>';
        }
    }

    $html .= '</div>';

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4','portrait');

    $dompdf->render();
    header('Content-type: application/pdf');

    $nomeArquivo = 'relatorio_'.date('d-m-Y').'.pdf';
    echo $dompdf->stream($nomeArquivo);
?>
