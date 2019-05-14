<?php

namespace Controller;

use Model;
use PDO;

class MaterialController {

    // Atributos 
    private $material;
    private $materialDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Cadastra || 2 Altrera

    // Construtor

    public function __construct(PDO $conn) {
        $this->material = new Model\Material();
        $this->materialDAO = new Model\MaterialDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getMaterial() {
        return $this->material;
    }

    function getMaterialDAO() {
        return $this->materialDAO;
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

    function setMaterial($material) {
        $this->material = $material;
    }

    function setMaterialDAO($materialDAO) {
        $this->materialDAO = $materialDAO;
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

        $txtCodMaterial = isset($_POST['txtCodMaterial']) ? $_POST['txtCodMaterial'] : null;
        $txtNomeMaterial = isset($_POST['txtNomeMaterial']) ? $_POST['txtNomeMaterial'] : null;
        $txtDescMaterial = isset($_POST['txtDescMaterial']) ? $_POST['txtDescMaterial'] : null;
        $txtCodCategoria = isset($_POST['txtCodCategoria']) ? $_POST['txtCodCategoria'] : null;
        
        if ($txtNomeMaterial != null && $txtDescMaterial != null && $txtCodCategoria != null) {
            $material = new Model\Material();
            $material->setCodMaterial($txtCodMaterial);
            $material->setNomeMaterial(trim($txtNomeMaterial));
            $material->setDescMaterial(trim($txtDescMaterial));
            $material->setCodCategoria($txtCodCategoria);

            $this->material = $material;
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->materialDAO->create($this->material);
        } else if ($this->acaoPOST == 2) {

            $this->materialDAO->update($this->material);
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
            $this->material->setCodMaterial($_GET['id']);
            $material = json_decode($this->materialDAO->selectId($this->material), true);
            $this->material = new Model\Material($material['codMaterial'], $material['nomeMaterial'], $material['descMaterial'], $material['codCategoria'], $material['nomeCategoria'], 1);
        }

        if ($this->acaoGET == 3) {
            $this->material->setCodMaterial($_GET['id']);
            $this->materialDAO->delete($this->material);
        }
    }

    public function listarMateriais() {
        $materiais = json_decode($this->materialDAO->selectAll(), true);
        return $this->montaLista($materiais);
    }

    public function listarMateriaisPorNome($nome) {
        $this->material->setNomeMaterial($nome);
        $materiais = json_decode($this->materialDAO->selectName($this->material), true);
        return $this->montaLista($materiais);
    }

    public function listarMateriaisPorCategoria($categoria) {
        $this->material->setNomeCategoria($categoria);
        $materiais = json_decode($this->materialDAO->selectNameCategoria($this->material), true);
        return $this->montaLista($materiais);
    }

    public function montaLista($materiais) {

        if ($materiais[1] !== "false") {
            $lista = "";
            foreach ($materiais as $material) {
                $lista .= "<tr>"
                        . "<td>$material[0]</td>"
                        . "<td>$material[1]</td>"
                        . "<td>$material[2]</td>"
                        . "<td>$material[4]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroMaterial&acao=2&id=" . $material[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroMaterial&acao=3&id=" . $material[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
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
