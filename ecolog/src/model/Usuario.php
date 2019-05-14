<?php

namespace Model;

class Usuario {

    private $codTipoUsuario;
    private $nomeTipoUsuario;
    private $codUsuario;
    private $nomeUsuario;
    private $loginUsuario;
    private $senhaUsuario;
    private $docUsuario;
    private $codTipoDocumento;
    private $cepUsuario;
    private $numUsuario;
    private $complementoUsuario;
    private $statusUsuario;
    private $urlFotoUsuario;
    private $latitudeUsuario;
    private $longitudeUsuario;

    function __construct($codTipoUsuario = "", $nomeTipoUsuario = "", $codUsuario = "", $nomeUsuario = "", $loginUsuario = "", $senhaUsuario = "", $docUsuario = "", $codTipoDocumento = "", $cepUsuario = "", $numUsuario = "", $complementoUsuario = "", $statusUsuario = "", $urlFotoUsuario = "", $latitudeUsuario = "", $longitudeUsuario = "") {
        $this->codTipoUsuario = $codTipoUsuario;
        $this->nomeTipoUsuario = $nomeTipoUsuario;
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->loginUsuario = $loginUsuario;
        $this->senhaUsuario = $senhaUsuario;
        $this->docUsuario = $docUsuario;
        $this->codTipoDocumento = $codTipoDocumento;
        $this->cepUsuario = $cepUsuario;
        $this->numUsuario = $numUsuario;
        $this->complementoUsuario = $complementoUsuario;
        $this->statusUsuario = $statusUsuario;
        $this->urlFotoUsuario = $urlFotoUsuario;
        $this->latitudeUsuario = $latitudeUsuario;
        $this->longitudeUsuario = $longitudeUsuario;
    }

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getLoginUsuario() {
        return $this->loginUsuario;
    }

    function getSenhaUsuario() {
        return $this->senhaUsuario;
    }

    function getDocUsuario() {
        return $this->docUsuario;
    }

    function getCodTipoDocumento() {
        return $this->codTipoDocumento;
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

    function getCodTipoUsuario() {
        return $this->codTipoUsuario;
    }

    function getStatusUsuario() {
        return $this->statusUsuario;
    }

    function getNomeTipoUsuario() {
        return $this->nomeTipoUsuario;
    }

    function getUrlFotoUsuario() {
        return $this->urlFotoUsuario;
    }

    function getLatitudeUsuario() {
        return $this->latitudeUsuario;
    }

    function getLongitudeUsuario() {
        return $this->longitudeUsuario;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setLoginUsuario($loginUsuario) {
        $this->loginUsuario = $loginUsuario;
    }

    function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = $senhaUsuario;
    }

    function setDocUsuario($docUsuario) {
        $this->docUsuario = $docUsuario;
    }

    function setCodTipoDocumento($codTipoDocumento) {
        $this->codTipoDocumento = $codTipoDocumento;
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

    function setCodTipoUsuario($codTipoUsuario) {
        $this->codTipoUsuario = $codTipoUsuario;
    }

    function setStatusUsuario($statusUsuario) {
        $this->statusUsuario = $statusUsuario;
    }

    function setNomeTipoUsuario($nomeTipoUsuario) {
        $this->nomeTipoUsuario = $nomeTipoUsuario;
    }

    function setUrlFotoUsuario($urlFotoUsuario) {
        $this->urlFotoUsuario = $urlFotoUsuario;
    }

    function setLatitudeUsuario($latitudeUsuario) {
        $this->latitudeUsuario = $latitudeUsuario;
    }

    function setLongitudeUsuario($longitudeUsuario) {
        $this->longitudeUsuario = $longitudeUsuario;
    }

    public function __toString() {
        $obj = array(
            'codUsuario' => $this->codUsuario,
            'nomeUsuario' => $this->nomeUsuario,
            'loginUsuario' => $this->loginUsuario,
            'senhaUsuario' => $this->senhaUsuario,
            'docUsuario' => $this->docUsuario,
            'codTipoDocumento' => $this->codTipoDocumento,
            'cepUsuario' => $this->cepUsuario,
            'numUsuario' => $this->numUsuario,
            'complementoUsuario' => $this->complementoUsuario,
            'codTipoUsuario' => $this->codTipoUsuario,
            'nomeTipoUsuario' => $this->nomeTipoUsuario,
            'statusUsuario' => $this->statusUsuario,
            'urlFotoUsuario' => $this->urlFotoUsuario,
            'latitudeUsuario' => $this->latitudeUsuario,
            'longitudeUsuario' => $this->longitudeUsuario
        );
        return json_encode($obj);
    }

}
