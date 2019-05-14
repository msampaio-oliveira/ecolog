<?php

namespace Controller;

use Model;
use PDO;

class TipoDocumentoController {

    // Atributos
    private $tipoDocumento;
    private $tipoDocumentoDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Grava || 2 Altera

    // Construtor

    public function __construct(PDO $conn) {
        $this->tipoDocumento = new Model\TipoDocumento();
        $this->tipoDocumentoDAO = new Model\TipoDocumentoDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    function getTipoDocumentoDAO() {
        return $this->tipoDocumentoDAO;
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

    function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    function setTipoDocumentoDAO($tipoDocumentoDAO) {
        $this->tipoDocumentoDAO = $tipoDocumentoDAO;
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

    //Métodos Especialistas 
    public function recuperarDadosFormulario() {
        $txtCodTipoDocumento = isset($_POST['txtCodTipoDocumento']) ? $_POST['txtCodTipoDocumento'] : null;
        $txtNomeTipoDocumento = isset($_POST['txtNomeTipoDocumento']) ? $_POST['txtNomeTipoDocumento'] : null;
        
        if ($txtNomeTipoDocumento != null) {

            $tipoDocumento = new Model\TipoDocumento();
            $tipoDocumento->setCodTipoDocumento($txtCodTipoDocumento);
            $tipoDocumento->setNomeTipoDocumento(trim($txtNomeTipoDocumento));

            $this->tipoDocumento = $tipoDocumento;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->tipoDocumentoDAO->create($this->tipoDocumento);
        } else if ($this->acaoPOST == 2) {

            $this->tipoDocumentoDAO->update($this->tipoDocumento);
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
            $this->tipoDocumento->setCodTipoDocumento($_GET['id']);
            $tipoDocumento = json_decode($this->tipoDocumentoDAO->selectId($this->tipoDocumento), true);
            $this->tipoDocumento = new Model\TipoDocumento($tipoDocumento['codTipoDocumento'], $tipoDocumento['nomeTipoDocumento'], $tipoDocumento['statusTipoDocumento']);
        }

        if ($this->acaoGET == 3) {

            $this->tipoDocumento->setCodTipoDocumento($_GET['id']);
            $this->tipoDocumentoDAO->delete($this->tipoDocumento);
        }
    }

    public function listarTiposDocumento() {
        $tiposDocumentos = json_decode($this->tipoDocumentoDAO->selectAll(), true);
        return $this->montaLista($tiposDocumentos);
    }

    public function listarTipoDocumentosPorNome($nome) {
        $this->tipoDocumento->setNomeTipoDocumento($nome);
        $tiposDocumentos = json_decode($this->tipoDocumentoDAO->selectName($this->tipoDocumento), true);
        return $this->montaLista($tiposDocumentos);
    }

    public function montaLista($tiposDocumentos) {
        if ($tiposDocumentos[1] !== "false") {
            $lista = "";
            foreach ($tiposDocumentos as $tipoDocumento) {
                $lista .= "<tr>"
                        . "<td>$tipoDocumento[0]</td>"
                        . "<td>$tipoDocumento[1]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoDocumento&acao=2&id=" . $tipoDocumento[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoDocumento&acao=3&id=" . $tipoDocumento[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
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
