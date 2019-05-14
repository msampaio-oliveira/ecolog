<?php

namespace Model;

class TipoContato {

    private $codTipoContato;
    private $descContato;
    private $statusTipoContato;

    function __construct($codTipoContato = "", $descContato = "", $statusTipoContato = "") {
        $this->codTipoContato = $codTipoContato;
        $this->descContato = $descContato;
        $this->statusTipoContato = $statusTipoContato;
    }

    function getCodTipoContato() {
        return $this->codTipoContato;
    }

    function getDescContato() {
        return $this->descContato;
    }

    function getStatusTipoContato() {
        return $this->statusTipoContato;
    }

    function setCodTipoContato($codTipoContato) {
        $this->codTipoContato = $codTipoContato;
    }

    function setDescContato($descContato) {
        $this->descContato = $descContato;
    }

    function setStatusTipoContato($statusTipoContato) {
        $this->statusTipoContato = $statusTipoContato;
    }

    public function __toString() {
        $obj = array(
            'codTipoContato' => $this->codTipoContato,
            'descContato' => $this->descContato,
            'statusTipoContato' => $this->statusTipoContato
        );
        return json_encode($obj);
    }

}
