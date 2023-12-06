<?php
    class Ocorrencia
    {
        public $responsavel;
        public $data;
        public $laboratorio;
        public $problema;
        public $titulo;
        public $descricao;
        public $arquivado;

        function __construct($responsavel, $data, $titulo, $laboratorio, $problema, $descricao, $arquivado)
        {
            $this->responsavel = $responsavel;
            $this->data = $data;
            $this->laboratorio = $laboratorio;
            $this->problema = $problema;
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->arquivado = $arquivado;
        }

        function PegarValor($valor)
        {
            if (isset($valor) && $valor != '')
            {
                return $valor;
            }
            return '';
        }

        function PegarData($data)
        {
            switch ($data)
            {
                case '3 meses':
                    return "data BETWEEN CURDATE() - INTERVAL 90 DAY AND CURDATE()";
                
                case '6 meses':
                    return "data BETWEEN CURDATE() - INTERVAL 180 DAY AND CURDATE()";

                case '1 ano':
                    return "data BETWEEN CURDATE() - INTERVAL 365 DAY AND CURDATE()";
            }
            return '';
        }

        // function MostrarOcorrencias($problema, $data, $lab)
        // {
        //     require('../conexao/conexaoBD.php');
        //     $conexao = ConectarBanco();
            
        //     if (isset($problema) && $problema != '' && isset($data) && $data != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Diagnostico->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data`DESC");
        //     }
        //     else if (isset($problema) && $problema != '' && isset($data) && $data != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Diagnostico->PegarData($_GET['data']) . " ORDER BY `Data` DESC");
        //     }
        //     else if (isset($data) && $data != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Diagnostico->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
        //     }
        //     else if (isset($problema) && $problema != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
        //     }
        //     else if (isset($problema) && $problema != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "'  ORDER BY `Data` DESC");
        //     }
        //     else if (isset($data) && $data != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Diagnostico->PegarData($_GET['data']) . "  ORDER BY `Data` DESC");
        //     }
        //     else if (isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `laboratorio`='" . $_GET['lab'] . "'  ORDER BY `Data` DESC");
        //     }
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` ORDER BY `Data` DESC");
            
        // }
    }
?>