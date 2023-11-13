<?php
    class Ocorrencia
    {
        public $responsavel;
        public $data;
        public $laboratorio;
        public $problema;
        public $titulo;
        public $descricao;

        function __construct($responsavel, $data, $titulo, $laboratorio, $problema, $descricao)
        {
            $this->responsavel = $responsavel;
            $this->data = $data;
            $this->laboratorio = $laboratorio;
            $this->problema = $problema;
            $this->titulo = $titulo;
            $this->descricao = $descricao;
        }
    }
?>