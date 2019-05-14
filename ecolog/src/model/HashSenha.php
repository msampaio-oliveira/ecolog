<?php

namespace Model;

class HashSenha {

    private $hashSenha;
    private $dataGeracao;
    private $codUsuario;

    function __construct($hashSenha = "", $dataGeracao = "", $codUsuario = "") {
        $this->hashSenha = $hashSenha;
        $this->dataGeracao = $dataGeracao;
        $this->codUsuario = $codUsuario;
    }

    function getHashSenha() {
        return $this->hashSenha;
    }

    function getDataGeracao() {
        return $this->dataGeracao;
    }

    function getCodUsuario() {
        return $this->codUsuario;
    }

    function setHashSenha($hashSenha) {
        $this->hashSenha = $hashSenha;
    }

    function setDataGeracao($dataGeracao) {
        $this->dataGeracao = $dataGeracao;
    }

    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    public function __toString() {
        $obj = array(
            'hash' => $this->getHashSenha(),
            'data' => $this->getDataGeracao(),
            'codUsuario' => $this->getCodUsuario()
        );

        return json_encode($obj);
    }

}
