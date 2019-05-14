<?php

namespace Model; 

class Rota {

    private $codRota;
    private $cepInicialRota;
    private $latitudeInicialRota;
    private $longitudeInicialRota;
    private $cepFinalRota;
    private $longitudeFinalRota;
    private $latitudeFinalRota;
    private $dataCadRota;
    private $obsRota;
    private $statusRota;
    
    private $codUsuario;
    private $nomeUsuario;

    function getCodRota() {
        return $this->codRota;
    }

    function getCepInicialRota() {
        return $this->cepInicialRota;
    }

    function getLatitudeInicialRota() {
        return $this->latitudeInicialRota;
    }

    function getLongitudeInicialRota() {
        return $this->longitudeInicialRota;
    }

    function getCepFinalRota() {
        return $this->cepFinalRota;
    }

    function getLongitudeFinalRota() {
        return $this->longitudeFinalRota;
    }

    function getLatitudeFinalRota() {
        return $this->latitudeFinalRota;
    }

    function getDataCadRota() {
        return $this->dataCadRota;
    }

    function getObsRota() {
        return $this->obsRota;
    }

    function getStatusRota() {
        return $this->statusRota;
    }

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function setCodRota($codRota) {
        $this->codRota = $codRota;
    }

    function setCepInicialRota($cepInicialRota) {
        $this->cepInicialRota = $cepInicialRota;
    }

    function setLatitudeInicialRota($latitudeInicialRota) {
        $this->latitudeInicialRota = $latitudeInicialRota;
    }

    function setLongitudeInicialRota($longitudeInicialRota) {
        $this->longitudeInicialRota = $longitudeInicialRota;
    }

    function setCepFinalRota($cepFinalRota) {
        $this->cepFinalRota = $cepFinalRota;
    }

    function setLongitudeFinalRota($longitudeFinalRota) {
        $this->longitudeFinalRota = $longitudeFinalRota;
    }

    function setLatitudeFinalRota($latitudeFinalRota) {
        $this->latitudeFinalRota = $latitudeFinalRota;
    }

    function setDataCadRota($dataCadRota) {
        $this->dataCadRota = $dataCadRota;
    }

    function setObsRota($obsRota) {
        $this->obsRota = $obsRota;
    }

    function setStatusRota($statusRota) {
        $this->statusRota = $statusRota;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function __construct($codRota = "", $cepInicialRota = "", $latitudeInicialRota = "", $longitudeInicialRota = "", $cepFinalRota = "", $longitudeFinalRota = "", $latitudeFinalRota = "", $dataCadRota = "", $obsRota = "", $statusRota = "", $codUsuario = "", $nomeUsuario = "") {
        $this->codRota = $codRota;
        $this->cepInicialRota = $cepInicialRota;
        $this->latitudeInicialRota = $latitudeInicialRota;
        $this->longitudeInicialRota = $longitudeInicialRota;
        $this->cepFinalRota = $cepFinalRota;
        $this->longitudeFinalRota = $longitudeFinalRota;
        $this->latitudeFinalRota = $latitudeFinalRota;
        $this->dataCadRota = $dataCadRota;
        $this->obsRota = $obsRota;
        $this->statusRota = $statusRota;
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
    }

    public function __toString() {
        $obj = array(
            'codRota' => $this->codRota,
            'cepInicialRota' => $this->cepInicialRota,
            'latitudeInicialRota' => $this->latitudeInicialRota,
            'longitudeInicialRota' => $this->longitudeInicialRota,
            'cepFinalRota' => $this->cepFinalRota,
            'longitudeFinalRota' => $this->longitudeFinalRota,
            'latitudeFinalRota' => $this->latitudeFinalRota,
            'dataCadRota' => $this->dataCadRota,
            'obsRota' => $this->obsRota,
            'statusRota' => $this->statusRota,
            'codUsuario' => $this->codUsuario,
            'nomeUsuario' => $this->nomeUsuario
        );
        return json_encode($obj);
    }

}
