<?php

namespace Controller;

use Model;
use PDO;

class TipoUsuarioController {

    // Atributos
    private $tipoUsuario;
    private $tipoUsuarioDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Grava || 2 Altera

    // Construtor

    public function __construct(PDO $conn) {
        $this->tipoUsuario = new Model\TipoUsuario();
        $this->tipoUsuarioDAO = new Model\TipoUsuarioDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function getTipoUsuarioDAO() {
        return $this->tipoUsuarioDAO;
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

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    function setTipoUsuarioDAO($tipoUsuarioDAO) {
        $this->tipoUsuarioDAO = $tipoUsuarioDAO;
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
        $txtCodTipoUsuario = isset($_POST['txtCodTipoUsuario']) ? $_POST['txtCodTipoUsuario'] : null;
        $txtNomeTipoUsuario = isset($_POST['txtNomeTipoUsuario']) ? $_POST['txtNomeTipoUsuario'] : null;

        if ($txtNomeTipoUsuario != null) {

            $tipoUsuario = new Model\TipoUsuario();
            $tipoUsuario->setCodTipoUsuario($txtCodTipoUsuario);
            $tipoUsuario->setNomeTipoUsuario(trim($txtNomeTipoUsuario));

            $this->tipoUsuario = $tipoUsuario;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->tipoUsuarioDAO->create($this->tipoUsuario);
        } else if ($this->acaoPOST == 2) {

            $this->tipoUsuarioDAO->update($this->tipoUsuario);
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
            $this->tipoUsuario->setCodTipoUsuario($_GET['id']);
            $tipoUsuario = json_decode($this->tipoUsuarioDAO->selectId($this->tipoUsuario), true);
            $this->tipoUsuario = new Model\TipoUsuario($tipoUsuario['codTipoUsuario'], $tipoUsuario['nomeTipoUsuario'], $tipoUsuario['statusTipoUsuario']);
        }

        if ($this->acaoGET == 3) {

            $this->tipoUsuario->setCodTipoUsuario($_GET['id']);
            $this->tipoUsuarioDAO->delete($this->tipoUsuario);
        }
    }

    public function listarTiposContatos() {
        $tiposUsuarios = json_decode($this->tipoUsuarioDAO->selectAll(), true);
        return $this->montaLista($tiposUsuarios);
    }

    public function listarTiposContatosPorNome($nome) {
        $this->tipoUsuario->setNomeTipoUsuario($nome);
        $tiposUsuarios = json_decode($this->tipoUsuarioDAO->selectName($this->tipoUsuario), true);
        return $this->montaLista($tiposUsuarios);
    }

    public function montaLista($tiposUsuarios) {

        if ($tiposUsuarios[1] !== "false") {
            $lista = "";
            foreach ($tiposUsuarios as $tipoUsuario) {
                $lista .= "<tr>"
                        . "<td>$tipoUsuario[0]</td>"
                        . "<td>$tipoUsuario[1]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoUsuario&acao=2&id=" . $tipoUsuario[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroTipoUsuario&acao=3&id=" . $tipoUsuario[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
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
