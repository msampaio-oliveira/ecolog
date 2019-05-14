<?php

namespace Model;

class EcopontoRecebeMaterial {

    private $codEcoponto;
    private $nomeEcoponto;
    private $horarioFuncEcoponto; 
    private $cepEcoponto; 
    private $numEcoponto;
    private $complementoEcoponto;
    
    private $codMaterial;
    private $nomeMaterial;
    
    private $codCategoria;
    private $nomeCategoria;

    function getCodEcoponto() {
        return $this->codEcoponto;
    }

    function getNomeEcoponto() {
        return $this->nomeEcoponto;
    }

    function getHorarioFuncEcoponto() {
        return $this->horarioFuncEcoponto;
    }

    function getCepEcoponto() {
        return $this->cepEcoponto;
    }

    function getNumEcoponto() {
        return $this->numEcoponto;
    }

    function getComplementoEcoponto() {
        return $this->complementoEcoponto;
    }

    function getCodMaterial() {
        return $this->codMaterial;
    }

    function getNomeMaterial() {
        return $this->nomeMaterial;
    }

    function getCodCategoria() {
        return $this->codCategoria;
    }

    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function setCodEcoponto($codEcoponto) {
        $this->codEcoponto = $codEcoponto;
    }

    function setNomeEcoponto($nomeEcoponto) {
        $this->nomeEcoponto = $nomeEcoponto;
    }

    function setHorarioFuncEcoponto($horarioFuncEcoponto) {
        $this->horarioFuncEcoponto = $horarioFuncEcoponto;
    }

    function setCepEcoponto($cepEcoponto) {
        $this->cepEcoponto = $cepEcoponto;
    }

    function setNumEcoponto($numEcoponto) {
        $this->numEcoponto = $numEcoponto;
    }

    function setComplementoEcoponto($complementoEcoponto) {
        $this->complementoEcoponto = $complementoEcoponto;
    }

    function setCodMaterial($codMaterial) {
        $this->codMaterial = $codMaterial;
    }

    function setNomeMaterial($nomeMaterial) {
        $this->nomeMaterial = $nomeMaterial;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function __construct($codEcoponto = "", $nomeEcoponto = "", $horarioFuncEcoponto = "", $cepEcoponto = "", $numEcoponto = "",
            $complementoEcoponto = "", $codMaterial = "", $nomeMaterial = "", $codCategoria = "", $nomeCategoria = "") {
        $this->codEcoponto = $codEcoponto;
        $this->nomeEcoponto = $nomeEcoponto;
        $this->horarioFuncEcoponto = $horarioFuncEcoponto;
        $this->cepEcoponto = $cepEcoponto;
        $this->numEcoponto = $numEcoponto;
        $this->complementoEcoponto = $complementoEcoponto;
        $this->codMaterial = $codMaterial;
        $this->nomeMaterial = $nomeMaterial;
        $this->codCategoria = $codCategoria;
        $this->nomeCategoria = $nomeCategoria;
    }

    public function __toString() {
        $obj = array(
            'codEcoponto' => $this->codEcoponto,
            'nomeEcoponto' => $this->nomeEcoponto,
            'horarioFuncEcoponto' => $this->horarioFuncEcoponto,
            'cepEcoponto' => $this->cepEcoponto,
            'numEcoponto' => $this->numEcoponto,
            'complementoEcoponto' => $this->complementoEcoponto,
            'codMaterial' => $this->codMaterial,
            'nomeMaterial' => $this->nomeMaterial,
            'codCategoria' => $this->codCategoria,
            'nomeCategoria' => $this->nomeCategoria
        );
        return json_encode($obj);
    }

}
