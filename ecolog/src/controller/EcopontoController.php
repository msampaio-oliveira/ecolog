<?php

namespace Controller;

use Model;
use PDO;

class EcopontoController {

    // Atributos 
    private $ecoponto;
    private $ecopontoDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET; // 3 Remove 
    private $acaoPOST; // 1 Cadastra || 2 Altera

    // Construtor

    public function __construct(PDO $conn) {
        $this->ecoponto = new Model\EcoPonto();
        $this->ecopontoDAO = new Model\EcoPontoDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getEcoponto() {
        return $this->ecoponto;
    }

    function getEcopontoDAO() {
        return $this->ecopontoDAO;
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

    function setEcoponto($ecoponto) {
        $this->ecoponto = $ecoponto;
    }

    function setEcopontoDAO($ecopontoDAO) {
        $this->ecopontoDAO = $ecopontoDAO;
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

        $txtCodEcoponto = isset($_POST['txtCodEcoponto']) ? $_POST['txtCodEcoponto'] : null;
        $txtNomeEcoponto = isset($_POST['txtNomeEcoponto']) ? $_POST['txtNomeEcoponto'] : null;
        $txtHorarioFuncEcoponto = isset($_POST['txtHorarioFuncEcoponto']) ? $_POST['txtHorarioFuncEcoponto'] : null;
        $txtCepEcoponto = isset($_POST['txtCep']) ? $_POST['txtCep'] : null;
        $txtLongitudeEcoponto = isset($_POST['txtLongitude']) ? $_POST['txtLongitude'] : null;
        $txtLatitudeEcoponto = isset($_POST['txtLatitude']) ? $_POST['txtLatitude'] : null;
        $txtNumEcoponto = isset($_POST['txtNumero']) ? $_POST['txtNumero'] : null;
        $txtComplementoEcoponto = isset($_POST['txtComplementoEcoponto']) ? $_POST['txtComplementoEcoponto'] : null;
        
        if ($txtNomeEcoponto != null && $txtHorarioFuncEcoponto != null && $txtCepEcoponto != null && $txtLongitudeEcoponto != null &&
                $txtLatitudeEcoponto != null && $txtNumEcoponto != null) {
            $ecoponto = new Model\EcoPonto();
            $ecoponto->setCodEcoponto($txtCodEcoponto);
            $ecoponto->setNomeEcoponto(trim($txtNomeEcoponto));
            $ecoponto->setHorarioFuncEcoponto(trim($txtHorarioFuncEcoponto));
            $ecoponto->setCepEcoponto(trim($txtCepEcoponto));
            $ecoponto->setLongitudeEcoponto(trim($txtLongitudeEcoponto));
            $ecoponto->setLatitudeEcoponto(trim($txtLatitudeEcoponto));
            $ecoponto->setNumEcoponto(trim($txtNumEcoponto));
            $ecoponto->setComplementoEcoponto(trim($txtComplementoEcoponto));

            $this->ecoponto = $ecoponto;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->ecopontoDAO->create($this->ecoponto);
        } else if ($this->acaoPOST == 2) {

            $this->ecopontoDAO->update($this->ecoponto);
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
        $this->mostrarListaFomulario();
    }

    public function executarAcaoGet() {

        if ($this->acaoGET == 2) {
            $this->ecoponto->setCodEcoponto($_GET['id']);
            $ecoponto = json_decode($this->ecopontoDAO->selectId($this->ecoponto), true);
            $this->ecoponto = new Model\EcoPonto($ecoponto['codEcoponto'], $ecoponto['nomeEcoponto'], $ecoponto['horarioFuncEcoponto'], $ecoponto['cepEcoponto'], $ecoponto['longitudeEcoponto'], $ecoponto['latitudeEcoponto'], $ecoponto['numEcoponto'], $ecoponto['complementoEcoponto'], "");
        }

        if ($this->acaoGET == 3) {
            $this->ecoponto->setCodEcoponto($_GET['id']);
            $this->ecopontoDAO->delete($this->ecoponto);
        }
    }

    public function listarEcopontos() {
        $ecopontos = json_decode($this->ecopontoDAO->selectAll(), true);
        return $this->montarLista($ecopontos);
    }

    public function listarEcopontosPorNome($nome) {
        $this->ecoponto->setNomeEcoponto($nome);
        $ecopontos = json_decode($this->ecopontoDAO->selectNameEcoponto($this->ecoponto), true);
        return $this->montarLista($ecopontos);
    }

    public function listarEcopontosPorCEP($CEP) {
        $this->ecoponto->setCepEcoponto($CEP);
        $ecopontos = json_decode($this->ecopontoDAO->selectCep($this->ecoponto), true);
        return $this->montarLista($ecopontos);
    }

    public function listarEcopontosPorHorarioFuncionamento($horarioFuncionamento) {
        $this->ecoponto->setHorarioFuncEcoponto($horarioFuncionamento);
        $ecopontos = json_decode($this->ecopontoDAO->selectHorarioFuncionamento($this->ecoponto), true);
        return $this->montarLista($ecopontos);
    }

    public function montarLista($ecopontos) {
        if ($ecopontos[1] !== false) {
            $lista = "";
            foreach ($ecopontos as $ecoponto) {
                $lista .= "<tr>"
                        . "<td>$ecoponto[0]</td>"
                        . "<td>$ecoponto[1]</td>"
                        . "<td>$ecoponto[2]</td>"
                        . "<td>$ecoponto[3]</td>"
                        . "<td>$ecoponto[6]</td>"
                        . "<td>$ecoponto[7]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcoponto&acao=2&id=" . $ecoponto[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcoponto&acao=3&id=" . $ecoponto[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcopontoRecebeMaterial&acao=1&codEcoponto=" . $ecoponto[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "</tr>";
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
