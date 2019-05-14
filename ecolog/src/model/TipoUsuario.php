<?php

namespace Model;

class TipoUsuario {

    private $codTipoUsuario;
    private $nomeTipoUsuario;
    private $statusTipoUsuario;

    public function __construct($codTipoUsuario = "", $nomeTipoUsuario = "", $statusTipoUsuario = "") {
        $this->codTipoUsuario = $codTipoUsuario;
        $this->nomeTipoUsuario = $nomeTipoUsuario;
        $this->statusTipoUsuario = $statusTipoUsuario;
    }

    function getCodTipoUsuario() {
        return $this->codTipoUsuario;
    }

    function getNomeTipoUsuario() {
        return $this->nomeTipoUsuario;
    }

    function getStatusTipoUsuario() {
        return $this->statusTipoUsuario;
    }

    function setCodTipoUsuario($codTipoUsuario) {
        $this->codTipoUsuario = $codTipoUsuario;
    }

    function setNomeTipoUsuario($nomeTipoUsuario) {
        $this->nomeTipoUsuario = $nomeTipoUsuario;
    }

    function setStatusTipoUsuario($statusTipoUsuario) {
        $this->statusTipoUsuario = $statusTipoUsuario;
    }

    public function __toString() {
        $obj = array(
            'codTipoUsuario' => $this->codTipoUsuario,
            'nomeTipoUsuario' => $this->nomeTipoUsuario,
            'statusTipoUsuario' => $this->statusTipoUsuario
        );
        return json_encode($obj);
    }

}
