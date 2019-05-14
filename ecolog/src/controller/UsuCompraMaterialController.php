<?php

namespace Controller;

use Model;
use PDO;
// Para testes
use Util;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $ajuste = "../../";
    require_once '../../config/config.php';

    $conn = Util\ConnectionFactory::getConexao('../../config/config_bd.ini');
    $usuCompraMaterialController = new \Controller\UsuCompraMaterialController($conn);
}

class UsuCompraMaterialController {

    private $usuCompraMaterial;
    private $usuCompraMaterialDAO;
    private $acaoGet;
    private $acaoPost;

    public function __construct(PDO $conn) {

        $this->usuCompraMaterial = new Model\UsuCompraMaterial();
        $this->usuCompraMaterialDAO = new Model\UsuCompraMaterialDAO($conn);
        $this->verificarTipoAcao();
    }

    function getUsuCompraMaterial() {
        return $this->usuCompraMaterial;
    }

    function getUsuCompraMaterialDAO() {
        return $this->usuCompraMaterialDAO;
    }

    function getAcaoGet() {
        return $this->acaoGet;
    }

    function getAcaoPost() {
        return $this->acaoPost;
    }

    function setUsuCompraMaterial($usuCompraMaterial) {
        $this->usuCompraMaterial = $usuCompraMaterial;
    }

    function setUsuCompraMaterialDAO($usuCompraMaterialDAO) {
        $this->usuCompraMaterialDAO = $usuCompraMaterialDAO;
    }

    function setAcaoGet($acaoGet) {
        $this->acaoGet = $acaoGet;
    }

    function setAcaoPost($acaoPost) {
        $this->acaoPost = $acaoPost;
    }

    // Métodos Especialistas 
    public function recuperarDadosFormulario() {

        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        $txtCodMaterial = isset($_POST['txtCodMaterial']) ? $_POST['txtCodMaterial'] : null;
        $txtValorComprado = isset($_POST['txtValorComprado']) ? $_POST['txtValorComprado'] : null;
        $txtObsCompra = isset($_POST['txtObsCompra']) ? $_POST['txtObsCompra'] : null;

        if ($txtCodUsuario != null && $txtCodMaterial != null && $txtValorComprado != null && $txtObsCompra != null) {

            $usuCompraMaterial = new Model\UsuCompraMaterial();

            $usuCompraMaterial->setCodUsuario($txtCodUsuario);
            $usuCompraMaterial->setCodMaterial($txtCodMaterial);
            $usuCompraMaterial->setValorComprado(trim($txtValorComprado));
            $usuCompraMaterial->setObsCompra(trim($txtObsCompra));

            $this->usuCompraMaterial = $usuCompraMaterial;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();

        if ($this->acaoPost == 1) {

            $this->usuCompraMaterialDAO->create($this->usuCompraMaterial);
        } else if ($this->acaoPost == 2) {

            $this->usuCompraMaterialDAO->update($this->usuCompraMaterial);
        }
    }

    public function verificarTipoAcao() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $this->acaoPost = isset($_POST['txtAcao']) ? $_POST['txtAcao'] : 0;
            $this->gravarAlterar();
        } else if ($_SERVER['REQUEST_METHOD'] === "GET") {

            $this->acaoGet = isset($_GET['acao']) ? $_GET['acao'] : 0;
            $this->executarAcaoGet();
        }
    }

    public function executarAcaoGet() {

        if ($this->acaoGet == 3) {

            $this->usuCompraMaterial->setCodUsuario($_GET['idUsuario']);
            $this->usuCompraMaterial->setCodMaterial($_GET['idMaterial']);
            $this->usuCompraMaterialDAO->delete($this->usuCompraMaterial);
        }
    }

    public function listarMateriaisComprados() {
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectAll(), true);
        return $this->montaLista($materiaisComprados);
    }

    public function listarMateriaisCompradosPorUsuario($nomeUsuario) {
        $this->usuCompraMaterial->setNomeUsuario($nomeUsuario);
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectByUser($this->usuCompraMaterial), true);
        return $this->montaLista($materiaisComprados);
    }

    public function listarMateriaisCompradosPorMaterial($nomeMaterial) {
        $this->usuCompraMaterial->setNomeMaterial($nomeMaterial);
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectByMaterial($this->usuCompraMaterial), true);
        return $this->montaLista($materiaisComprados);
    }

    public function listarMateriaisCompradosPorCategoria($nomeCategoria) {
        $this->usuCompraMaterial->setNomeCategoria($nomeCategoria);
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectByCategoria($this->usuCompraMaterial), true);
        return $this->montaLista($materiaisComprados);
    }

    public function listarMateriaisCompradosPorCEP($CEP) {
        $this->usuCompraMaterial->setCepUsuario($CEP);
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectByCEP($this->usuCompraMaterial), true);
        return $this->montaLista($materiaisComprados);
    }

    public function listarMateriaisCompradosPorPreco() {
        $materiaisComprados = json_decode($this->usuCompraMaterialDAO->selectMaxMin(), true);
        return $this->montaLista($materiaisComprados);
    }

    private function montaLista($materiaisComprados) {

        if ($materiaisComprados[1] !== "false") {
            $lista = "";
            foreach ($materiaisComprados as $materialComprado) {
                $lista .= "<tr>"
                        . "<td>$materialComprado[0]</td>"
                        . "<td>$materialComprado[1]</td>"
                        . "<td>$materialComprado[2]</td>"
                        . "<td>$materialComprado[3]</td>"
                        . "<td>$materialComprado[4]</td>"
                        . "<td>$materialComprado[6]</td>"
                        . "<td>$materialComprado[8]</td>"
                        . "<td>$materialComprado[9]</td>"
                        . "<td>$materialComprado[10]</td>"
                        . "<td><a href=#$materialComprado[0]>Editar</a></td>"
                        . "<td><a href=#$materialComprado[0]>Remover</a></td>"
                        . "</tr>";
            }
            return $lista;
        }
        return false;
    }

}
