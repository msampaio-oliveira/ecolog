<?php

namespace Model;

class UsuCompraMaterial {

    private $codUsuario;
    private $nomeUsuario;
    private $cepUsuario;
     private $numUsuario;
    private $complementoUsuario;
    
    private $codMaterial;
    private $nomeMaterial;
    
    private $codCategoria;
    private $nomeCategoria;
    
    private $valorComprado;
    private $obsCompra;

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getCepUsuario() {
        return $this->cepUsuario;
    }

    function getNumUsuario() {
        return $this->numUsuario;
    }

    function getComplementoUsuario() {
        return $this->complementoUsuario;
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

    function getValorComprado() {
        return $this->valorComprado;
    }

    function getObsCompra() {
        return $this->obsCompra;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setCepUsuario($cepUsuario) {
        $this->cepUsuario = $cepUsuario;
    }

    function setNumUsuario($numUsuario) {
        $this->numUsuario = $numUsuario;
    }

    function setComplementoUsuario($complementoUsuario) {
        $this->complementoUsuario = $complementoUsuario;
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

    function setValorComprado($valorComprado) {
        $this->valorComprado = $valorComprado;
    }

    function setObsCompra($obsCompra) {
        $this->obsCompra = $obsCompra;
    }

    function __construct($codUsuario = "", $nomeUsuario = "", $cepUsuario = "", $numUsuario = "", $complementoUsuario = "", $codMaterial = "", 
            $nomeMaterial = "", $codCategoria = "", $nomeCategoria = "", $valorComprado = "", $obsCompra = "") {
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->cepUsuario = $cepUsuario;
        $this->numUsuario = $numUsuario;
        $this->complementoUsuario = $complementoUsuario;
        $this->codMaterial = $codMaterial;
        $this->nomeMaterial = $nomeMaterial;
        $this->codCategoria = $codCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->valorComprado = $valorComprado;
        $this->obsCompra = $obsCompra;
    }

    public function __toString() {
        $obj = array(
            'codUsuario' => $this->codUsuario,
            'nomeUsuario' => $this->nomeUsuario,
            'cepUsuario' => $this->cepUsuario,
            '$numUsuario' => $this->numUsuario,
            '$complementoUsuario' => $this->complementoUsuario,
            'codMaterial' => $this->codMaterial,
            'nomeMaterial' => $this->nomeMaterial,
            'codCategoria' => $this->codCategoria,
            'nomeCategoria' => $this->nomeCategoria,
            'valorComprado' => $this->valorComprado,
            'obsCompra' => $this->obsCompra
        );
    }

}
