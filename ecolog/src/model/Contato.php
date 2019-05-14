<?php

namespace Model;

class Contato {

    private $codUsuario;
    private $nomeUSuario;
    
    private $codContato;
    private $contato;
    private $statusContato;
    private $codTipoContato;

    function __construct($codContato = "", $contato = "", $statusContato = "", $codTipoContato = "", $codUsuario = "", $nomeUsuario = "") {
        $this->codContato = $codContato;
        $this->contato = $contato;
        $this->statusContato = $statusContato;
        $this->codTipoContato = $codTipoContato;
        $this->codUsuario = $codUsuario;
        $this->nomeUSuario = $nomeUsuario;
    }

    function getCodContato() {
        return $this->codContato;
    }

    function getContato() {
        return $this->contato;
    }

    function getStatusContato() {
        return $this->statusContato;
    }

    function getCodTipoContato() {
        return $this->codTipoContato;
    }

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUSuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUSuario = $nomeUsuario;
    }
    
    function setCodContato($codContato) {
        $this->codContato = $codContato;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setStatusContato($statusContato) {
        $this->statusContato = $statusContato;
    }

    function setCodTipoContato($codTipoContato) {
        $this->codTipoContato = $codTipoContato;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    public function __toString() {
        $obj = array(
            'codContato' => $this->codContato,
            'contato' => $this->contato,
            'statusContato' => $this->statusContato,
            'codTipoContato' => $this->codTipoContato,
            'codUsuario' => $this->codUsuario, 
            'nomeUsuario' => $this->nomeUSuario
        );
        return json_encode($obj);
    }

}
