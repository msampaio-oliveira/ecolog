<?php

namespace Model;

class Categoria {

    private $codCategoria;
    private $nomeCategoria;
    private $statusCategoria;

    function getCodCategoria() {
        return $this->codCategoria;
    }

    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function getStatusCategoria() {
        return $this->statusCategoria;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function setStatusCategoria($statusCategoria) {
        $this->statusCategoria = $statusCategoria;
    }

    public function __construct($codCategoria = "", $nomeCategoria = "", $statusCategoria = "") {
        $this->codCategoria = $codCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->statusCategoria = $statusCategoria;
    }

    public function __toString() {
        $obj = array(
            'codCategoria' => $this->codCategoria,
            'nomeCategoria' => $this->nomeCategoria,
            'statusCategoria' => $this->statusCategoria
        );
        return json_encode($obj);
    }

}
