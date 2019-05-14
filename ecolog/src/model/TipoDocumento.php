<?php

namespace Model;

class TipoDocumento {

    private $codTipoDocumento;
    private $nomeTipoDocumento;
    private $statusTipoDocumento;

    function __construct($codTipoDocumento = "", $nomeTipoDocumento = "", $statusTipoDocumento = "") {
        $this->codTipoDocumento = $codTipoDocumento;
        $this->nomeTipoDocumento = $nomeTipoDocumento;
        $this->statusTipoDocumento = $statusTipoDocumento;
    }

    function getCodTipoDocumento() {
        return $this->codTipoDocumento;
    }

    function getNomeTipoDocumento() {
        return $this->nomeTipoDocumento;
    }

    function getStatusTipoDocumento() {
        return $this->statusTipoDocumento;
    }

    function setCodTipoDocumento($codTipoDocumento) {
        $this->codTipoDocumento = $codTipoDocumento;
    }

    function setNomeTipoDocumento($nomeTipoDocumento) {
        $this->nomeTipoDocumento = $nomeTipoDocumento;
    }

    function setStatusTipoDocumento($statusTipoDocumento) {
        $this->statusTipoDocumento = $statusTipoDocumento;
    }

    public function __toString() {
        $obj = array(
            'codTipoDocumento' => $this->codTipoDocumento,
            'nomeTipoDocumento' => $this->nomeTipoDocumento,
            'statusTipoDocumento' => $this->statusTipoDocumento
        );
        return json_encode($obj);
    }

}
