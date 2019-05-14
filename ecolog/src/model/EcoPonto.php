<?php

namespace Model;

class EcoPonto {

    private $codEcoponto;
    private $nomeEcoponto;
    private $horarioFuncEcoponto;
    private $cepEcoponto;
    private $longitudeEcoponto;
    private $latitudeEcoponto;
    private $numEcoponto;
    private $complementoEcoponto;
    private $statusEcoponto;

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

    function getLongitudeEcoponto() {
        return $this->longitudeEcoponto;
    }

    function getLatitudeEcoponto() {
        return $this->latitudeEcoponto;
    }

    function getNumEcoponto() {
        return $this->numEcoponto;
    }

    function getComplementoEcoponto() {
        return $this->complementoEcoponto;
    }

    function getStatusEcoponto() {
        return $this->statusEcoponto;
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

    function setLongitudeEcoponto($longitudeEcoponto) {
        $this->longitudeEcoponto = $longitudeEcoponto;
    }

    function setLatitudeEcoponto($latitudeEcoponto) {
        $this->latitudeEcoponto = $latitudeEcoponto;
    }

    function setNumEcoponto($numEcoponto) {
        $this->numEcoponto = $numEcoponto;
    }

    function setComplementoEcoponto($complementoEcoponto) {
        $this->complementoEcoponto = $complementoEcoponto;
    }

    function setStatusEcoponto($statusEcoponto) {
        $this->statusEcoponto = $statusEcoponto;
    }

    function __construct($codEcoponto = "", $nomeEcoponto = "", $horarioFuncEcoponto = "", $cepEcoponto = "", $longitudeEcoponto = "", $latitudeEcoponto = "", $numEcoponto = "", $complementoEcoponto = "", $statusEcoponto = "") {
        $this->codEcoponto = $codEcoponto;
        $this->nomeEcoponto = $nomeEcoponto;
        $this->horarioFuncEcoponto = $horarioFuncEcoponto;
        $this->cepEcoponto = $cepEcoponto;
        $this->longitudeEcoponto = $longitudeEcoponto;
        $this->latitudeEcoponto = $latitudeEcoponto;
        $this->numEcoponto = $numEcoponto;
        $this->complementoEcoponto = $complementoEcoponto;
        $this->statusEcoponto = $statusEcoponto;
    }

    public function __toString() {
        $obj = array(
            'codEcoponto' => $this->codEcoponto,
            'nomeEcoponto' => $this->nomeEcoponto,
            'horarioFuncEcoponto' => $this->horarioFuncEcoponto,
            'cepEcoponto' => $this->cepEcoponto,
            'longitudeEcoponto' => $this->longitudeEcoponto,
            'latitudeEcoponto' => $this->latitudeEcoponto,
            'numEcoponto' => $this->numEcoponto,
            'complementoEcoponto' => $this->complementoEcoponto,
            'statusEcoponto' => $this->statusEcoponto
        );
        return json_encode($obj);
    }

}
