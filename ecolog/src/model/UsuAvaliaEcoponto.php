<?php

namespace Model;

class UsuAvaliaEcoponto {

    private $codUsuario;
    private $nomeUsuario;
    private $codEcoponto;
    private $nomeEcoponto;
    private $notaAvaliacao;
    private $obsAvaliacao;
    private $dataHoraAvaliacao;

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getCodEcoponto() {
        return $this->codEcoponto;
    }

    function getNomeEcoponto() {
        return $this->nomeEcoponto;
    }

    function getNotaAvaliacao() {
        return $this->notaAvaliacao;
    }

    function getObsAvaliacao() {
        return $this->obsAvaliacao;
    }

    function getDataHoraAvaliacao() {
        return $this->dataHoraAvaliacao;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setCodEcoponto($codEcoponto) {
        $this->codEcoponto = $codEcoponto;
    }

    function setNomeEcoponto($nomeEcoponto) {
        $this->nomeEcoponto = $nomeEcoponto;
    }

    function setNotaAvaliacao($notaAvaliacao) {
        $this->notaAvaliacao = $notaAvaliacao;
    }

    function setObsAvaliacao($obsAvaliacao) {
        $this->obsAvaliacao = $obsAvaliacao;
    }

    function setDataHoraAvaliacao($dataHoraAvaliacao) {
        $this->dataHoraAvaliacao = $dataHoraAvaliacao;
    }

    function __construct($codUsuario = "", $nomeUsuario = "", $codEcoponto = "", $nomeEcoponto = "",
            $notaAvaliacao = "", $obsAvaliacao = "", $dataHoraAvaliacao = "") {
        $this->codUsuario = $codUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->codEcoponto = $codEcoponto;
        $this->nomeEcoponto = $nomeEcoponto;
        $this->notaAvaliacao = $notaAvaliacao;
        $this->obsAvaliacao = $obsAvaliacao;
        $this->dataHoraAvaliacao = $dataHoraAvaliacao;
    }

    public function __toString() {
        $obj = array(
            'codUsuario' => $this->codUsuario,
            'nomeUsuario' => $this->nomeUsuario,
            'codEcoponto' => $this->codEcoponto,
            'nomeEcoponto' => $this->nomeEcoponto,
            'notaAvaliacao' => $this->notaAvaliacao,
            'obsAvaliacao' => $this->obsAvaliacao,
            'dataHoraAvaliacao' => $this->dataHoraAvaliacao
        );
        //Pega um objeto do php e transforma em json 
        return json_encode($obj);
    }

}
