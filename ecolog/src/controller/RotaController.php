<?php

namespace Controller;

use Model;
use PDO;

class RotaController {

    // Atributos
    private $rota;
    private $rotaDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Grava || 2 Altera

    // Construtor

    public function __construct(PDO $conn) {
        $this->rota = new Model\Rota();
        $this->rotaDAO = new Model\RotaDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getRota() {
        return $this->rota;
    }

    function getRotaDAO() {
        return $this->rotaDAO;
    }

    function getLista() {
        return $this->lista;
    }

    function getFomulario() {
        return $this->fomulario;
    }

    function getAcaoGET() {
        return $this->acaoGET;
    }

    function getAcaoPOST() {
        return $this->acaoPOST;
    }

    function setRota($rota) {
        $this->rota = $rota;
    }

    function setRotaDAO($rotaDAO) {
        $this->rotaDAO = $rotaDAO;
    }

    function setLista($lista) {
        $this->lista = $lista;
    }

    function setFomulario($fomulario) {
        $this->fomulario = $fomulario;
    }

    function setAcaoGET($acaoGET) {
        $this->acaoGET = $acaoGET;
    }

    function setAcaoPOST($acaoPOST) {
        $this->acaoPOST = $acaoPOST;
    }

    // Metodos Especialistas 
    public function recuperarDadosFormulario() {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');

        $txtCodRota = isset($_POST['txtCodRota']) ? $_POST['txtCodRota'] : null;
        $txtCepInicialRota = isset($_POST['txtCepInicialRota']) ? $_POST['txtCepInicialRota'] : null;
        $txtLatitudeInicialRota = isset($_POST['txtLatitudeInicialRota']) ? $_POST['txtLatitudeInicialRota'] : null;
        $txtLongitudeInicialRota = isset($_POST['txtLongitudeInicialRota']) ? $_POST['txtLongitudeInicialRota'] : null;
        $txtCepFinalRota = isset($_POST['txtCepFinalRota']) ? $_POST['txtCepFinalRota'] : null;
        $txtLongitudeFinalRota = isset($_POST['txtLongitudeFinalRota']) ? $_POST['txtLongitudeFinalRota'] : null;
        $txtLatitudeFinalRota = isset($_POST['txtLatitudeFinalRota']) ? $_POST['txtLatitudeFinalRota'] : null;
        $txtDataCadRota = $date; //isset($_POST['txtDataCadRota']) ? $_POST['txtDataCadRota'] : null;
        $txtObsRota = isset($_POST['txtObsRota']) ? $_POST['txtObsRota'] : null;
        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        
        
        
        if ($txtCepInicialRota != null && $txtLatitudeInicialRota != null && $txtLongitudeInicialRota != null && $txtCepFinalRota != null && $txtLongitudeFinalRota != null && $txtLatitudeFinalRota != null && $txtDataCadRota != null && $txtCodUsuario != null) {
            $rota = new Model\Rota();
            $rota->setCodRota($txtCodRota);
            $rota->setCepInicialRota(trim($txtCepInicialRota));
            $rota->setLatitudeInicialRota(trim($txtLatitudeInicialRota));
            $rota->setLongitudeInicialRota(trim($txtLongitudeInicialRota));
            $rota->setCepFinalRota(trim($txtCepFinalRota));
            $rota->setLongitudeFinalRota(trim($txtLongitudeFinalRota));
            $rota->setLatitudeFinalRota(trim($txtLatitudeFinalRota));
            $rota->setDataCadRota($txtDataCadRota);
            $rota->setObsRota(trim($txtObsRota));
            $rota->setCodUsuario($txtCodUsuario);

            $this->rota = $rota;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {
            $this->rotaDAO->create($this->rota);
        } else if ($this->acaoPOST == 2) {
            $this->rotaDAO->update($this->rota);
        }
    }

    public function verificaTipoAcao() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $this->acaoPOST = isset($_POST['txtAcao']) ? $_POST['txtAcao'] : 0;
            $this->gravarAlterar();
        } else if ($_SERVER['REQUEST_METHOD'] === "GET") {

            $this->acaoGET = isset($_GET['acao']) ? $_GET['acao'] : 0;
            $this->executarAcaoGet();
        }
    }

    public function executarAcaoGet() {

        if ($this->acaoGET == 2) {
            $this->rota->setCodRota($_GET['id']);
            $rota = json_decode($this->rotaDAO->selectId($this->rota), true);
            $this->rota = new Model\Rota($rota['codRota'], $rota['cepInicialRota'], $rota["latitudeInicialRota"], $rota['longitudeInicialRota'], $rota['cepFinalRota'], $rota['longitudeFinalRota'], $rota['latitudeFinalRota'], $rota['dataCadRota'], $rota['obsRota'], $rota['statusRota'], $rota['codUsuario'], $rota['nomeUsuario']);
        }

        if ($this->acaoGET == 3) {

            $this->rota->setCodRota($_GET['id']);
            $this->rotaDAO->delete($this->rota);
        }
        
        $this->mostrarListaFomulario();
    }

    public function listarRotas() {
        $rotas = json_decode($this->rotaDAO->selectAll(), true);
        return $this->monstaLista($rotas);
    }

    public function listaRotasPorNomeUsuario($nome) {
        $this->rota->setNomeUsuario($nome);
        $rotas = json_decode($this->rotaDAO->selectUserName($this->rota), true);
        return $this->monstaLista($rotas);
    }

    public function listarRotasPorCepInicial($cepInicial) {
        $this->rota->setCepInicialRota($cepInicial);
        $rotas = json_decode($this->rotaDAO->selectCepInicial($this->rota), true);
        return $this->monstaLista($rotas);
    }

    public function listaRotasPorCepFinal($cepFinal) {
        $this->rota->setCepFinalRota($cepFinal);
        $rotas = json_decode($this->rotaDAO->selectCepFinal($this->rota), true);
        return $this->monstaLista($rotas);
    }

    public function listarRotasPorCepInicialFinal($cepInicial, $cepFinal) {
        $this->rota->setCepInicialRota($cepInicial);
        $this->rota->setCepFinalRota($cepFinal);
        $rotas = json_decode($this->rotaDAO->selectCepInicialAndFinal($this->rota), true);
        return $this->monstaLista($rotas);
    }

    public function monstaLista($rotas) {
        if ($rotas[1] !== "false") {
            $lista = "";
            foreach ($rotas as $rota) {
                $lista .= "<tr>"
                        . "<td>$rota[0]</td>"
                        . "<td>$rota[1]</td>"
                        . "<td>$rota[4]</td>"
                        . "<td>$rota[10]</td>"
                        . "<td>$rota[8]</td>"
                        . "<td>$rota[7]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroRota&acao=2&id=" . $rota[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroRota&acao=3&id=" . $rota[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
                        . "<tr>";
            }

            return $lista;
        }
        return false;
    }

    public function mostrarListaFomulario() {
        if ($this->acaoGET == 0 || $this->acaoGET == 3) {
            $this->fomulario = "off";
            $this->lista = "on";
        } elseif ($this->acaoGET == 1 || $this->acaoGET == 2) {
            $this->fomulario = "on";
            $this->lista = "off";
        }
    }

}
