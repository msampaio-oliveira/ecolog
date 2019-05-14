<?php

namespace Model;

class Material {

    private $codCategoria;
    private $nomeCategoria;
    private $codMaterial;
    private $nomeMaterial;
    private $descMaterial;
    private $statusMaterial;

    function getCodMaterial() {
        return $this->codMaterial;
    }

    function getNomeMaterial() {
        return $this->nomeMaterial;
    }

    function getDescMaterial() {
        return $this->descMaterial;
    }

    function getCodCategoria() {
        return $this->codCategoria;
    }

    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function getStatusMaterial() {
        return $this->statusMaterial;
    }

    function setCodMaterial($codMaterial) {
        $this->codMaterial = $codMaterial;
    }

    function setNomeMaterial($nomeMaterial) {
        $this->nomeMaterial = $nomeMaterial;
    }

    function setDescMaterial($descMaterial) {
        $this->descMaterial = $descMaterial;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }
    
    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function setStatusMaterial($statusMaterial) {
        $this->statusMaterial = $statusMaterial;
    }

    public function __construct($codMaterial = "", $nomeMaterial = "", $descMaterial = "", $codCategoria = "" , $nomeCategoria = "", $statusMaterial = "") {
        $this->codMaterial = $codMaterial;
        $this->nomeMaterial = $nomeMaterial;
        $this->descMaterial = $descMaterial;
        $this->codCategoria = $codCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->statusMaterial = $statusMaterial;
    }

    public function __toString() {
        $obj = array(
            'codMaterial' => $this->codMaterial,
            'nomeMaterial' => $this->nomeMaterial,
            'descMaterial' => $this->descMaterial,
            'codCategoria' => $this->codCategoria,
            'nomeCategoria' => $this->nomeCategoria,
            'statusMaterial' => $this->statusMaterial
        );
        return json_encode($obj);
    }

}
