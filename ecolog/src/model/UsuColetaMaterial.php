<?php

namespace Model;

class UsuColetaMaterial {
    
    private $codUsuario;
    private $nomeUsuario;
    
    private $codMaterial;
    private $nomeMateiral;
    
    private $codCategoria;
    private $nomeCategoria;
    
    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getCodMaterial() {
        return $this->codMaterial;
    }

    function getNomeMateiral() {
        return $this->nomeMateiral;
    }
    
    function getCodCategoria() {
        return $this->codCategoria;
    }
    
    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setCodMaterial($codMaterial) {
        $this->codMaterial = $codMaterial;
    }

    function setNomeMateiral($nomeMateiral) {
        $this->nomeMateiral = $nomeMateiral;
    }
    
    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }
    
    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function __construct($codUsuario = "", $nomeUsuario = "", $codMaterial = "", $nomeMateiral = "", $codCategoria = "", $nomeCategoria = "") {
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->codMaterial = $codMaterial;
        $this->nomeMateiral = $nomeMateiral;
        $this->codCategoria = $codCategoria;
        $this->nomeCategoria = $nomeCategoria;
    }

        
    public function __toString() {
        $obj = array(
            'codUsuario' =>  $this->codUsuario, 
            'nomeUsuario' => $this->nomeUsuario, 
            'codMaterial' => $this->codMaterial,
            'nomeMateiral' => $this->nomeMateiral,
            'codCategoria' => $this->codCategoria, 
            'nomeCategoria' => $this->nomeCategoria
        );
        return json_encode($obj);
    }

}
