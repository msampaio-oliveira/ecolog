<?php

namespace Controller;

use Model;
use PDO;

class TipoContatoController {

    // Atributos 
    private $tipoContato;
    private $tipoContatoDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Grava || 2 Altera

    // Contrutor

    public function __construct(PDO $conn) {
        $this->tipoContato = new Model\TipoContato();
        $this->tipoContatoDAO = new Model\TipoContatoDAO($conn);
        $this->verficaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getTipoContato() {
        return $this->tipoContato;
    }

    function getTipoContatoDAO() {
        return $this->tipoContatoDAO;
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

    function setTipoContato($tipoContato) {
        $this->tipoContato = $tipoContato;
    }

    function setTipoContatoDAO($tipoContatoDAO) {
        $this->tipoContatoDAO = $tipoContatoDAO;
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

    // Métodos Especialistas 
    public function recuperarDadosFormulario() {
        $txtCodTipoContato = isset($_POST['txtCodTipoContato']) ? $_POST['txtCodTipoContato'] : null;
        $txtDescContato = isset($_POST['txtDescTipoContato']) ? $_POST['txtDescTipoContato'] : null;

        if ($txtDescContato != null) {
            $tipoContato = new Model\TipoContato();
            $tipoContato->setCodTipoContato($txtCodTipoContato);
            $tipoContato->setDescContato(trim($txtDescContato));

            $this->tipoContato = $tipoContato;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->tipoContatoDAO->create($this->tipoContato);
        } else if ($this->acaoPOST == 2) {

            $this->tipoContatoDAO->update($this->tipoContato);
        }
    }

    public function verficaTipoAcao() {
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
            $this->tipoContato->setCodTipoContato($_GET['id']);
            $tipoContato = json_decode($this->tipoContatoDAO->selectId($this->tipoContato), true);
            $this->tipoContato = new Model\TipoContato($tipoContato['codTipoContato'], $tipoContato['descContato'], $tipoContato['statusTipoContato']);
        }

        if ($this->acaoGET == 3) {

            $this->tipoContato->setCodTipoContato($_GET['id']);
            $this->tipoContatoDAO->delete($this->tipoContato);
        }
    }

    public function listarTiposContatos() {
        $tiposContatos = json_decode($this->tipoContatoDAO->selectAll(), true);
        return $this->montaLista($tiposContatos);
    }

    public function listarTiposContatosPorNome($nome) {
        $this->tipoContato->setDescContato($nome);
        $tiposContatos = json_decode($this->tipoContatoDAO->selectDescName($this->tipoContato), true);
        return $this->montaLista($tiposContatos);
    }

    public function montaLista($tiposContatos) {

        if ($tiposContatos[1] !== "false") {
            $lista = "";
            foreach ($tiposContatos as $tipoContato) {
                $lista .= "<tr>"
                        . "<td>$tipoContato[0]</td>"
                        . "<td>$tipoContato[1]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoContato&acao=2&id=" . $tipoContato[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoContato&acao=3&id=" . $tipoContato[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
                        . "</tr>";
            }
            return $lista;
        }
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
