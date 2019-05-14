<?php

namespace Model;

class UsuFavoritaEcoPonto {

    private $codUsuario;
    private $nomeUsuario;
    
    private $codEcoponto;
    private $nomeEcoponto;
    
    private $dataHoraFavorita;

    function getCodUsuario() {
        return $this->codUsuario;
    }
    
    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getCodEcoponto() {
        return $this->codEcoponto;
    }
    
    function getNomeEcoponto() {
        return $this->nomeEcoponto;
    }

    function getDataHoraFavorita() {
        return $this->dataHoraFavorita;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }
    
    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setCodEcoponto($codEcoponto) {
        $this->codEcoponto = $codEcoponto;
    }
    function setNomeEcoponto($nomeEcoponto) {
        $this->codNome = $nomeEcoponto;
    }

    function setDataHoraFavorita($dataHoraFavorita) {
        $this->dataHoraFavorita = $dataHoraFavorita;
    }

    function __construct($codUsuario = "", $nomeUsuario = "", $codEcoponto = "", $nomeEcoponto = "", $dataHoraFavorita = "") {
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->codEcoponto = $codEcoponto;
        $this->nomeEcoponto = $nomeEcoponto;
        $this->dataHoraFavorita = $dataHoraFavorita;
    }

    
    public function __toString() {
        $obj = array(
            'codUsuario' => $this->codUsuario, 
            'nomeUsuario' => $this->nomeUsuario, 
            'codEcoponto' => $this->codEcoponto,
            'nomeEcoponto' => $this->nomeEcoponto,
            'dataHoraFunc' => $this->dataHoraFavorita
        );
        return json_encode($obj);
    }

}
