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
    $usuColetaMaterialController = new \Controller\UsuColetaMaterialController($conn);
}

class UsuColetaMaterialController {

    private $usuColetaMaterial;
    private $usuColetaMaterialDAO;
    private $acaoGet;
    private $acaoPost;

    public function __construct(PDO $conn) {
        $this->usuColetaMaterial = new Model\UsuColetaMaterial();
        $this->usuColetaMaterialDAO = new Model\UsuColetaMaterialDAO($conn);
        $this->VerificaTipoAcao();
    }

    function getUsuColetaMAterial() {
        return $this->usuColetaMaterial;
    }

    function getUsuColetaMAterialDAO() {
        return $this->usuColetaMaterialDAO;
    }

    function getAcaoGet() {
        return $this->acaoGet;
    }

    function getAcaoPost() {
        return $this->acaoPost;
    }

    function setUsuColetaMAterial($usuColetaMAterial) {
        $this->usuColetaMaterial = $usuColetaMAterial;
    }

    function setUsuColetaMAterialDAO($usuColetaMAterialDAO) {
        $this->usuColetaMaterialDAO = $usuColetaMAterialDAO;
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

        if ($txtCodUsuario != null && $txtCodMaterial != null) {

            $usuColetaaMaterial = new Model\UsuColetaMaterial();
            $usuColetaaMaterial->setCodUsuario($txtCodUsuario);
            $usuColetaaMaterial->setCodMaterial($txtCodMaterial);

            $this->usuColetaMaterial = $usuColetaaMaterial;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();

        if ($this->acaoPost == 1) {

            $this->usuColetaMaterialDAO->create($this->usuColetaMaterial);
        } else if ($this->acaoPost == 2) {
            // Como ou o usuário recebe ou não recebe resolvemos não permitir a alteração, 
            // o usuário pode deletar e inserir novamente
            $this->usuColetaMaterialDAO->update($this->usuColetaMaterial);
        }
    }

    public function verificaTipoAcao() {

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

            $this->usuColetaMaterial->setCodUsuario($_GET['idUsuario']);
            $this->usuColetaMaterial->setCodMaterial($_GET['idMaterial']);
            $this->usuColetaMaterialDAO->delete($this->usuColetaMaterial);
        }
    }

    public function listarUsuColetaMateriais() {
        $usuColetaMateriais = json_decode($this->usuColetaMaterialDAO->selectAll(), true);
        return $this->montaLista($usuColetaMateriais);
    }

    public function listarUsuarioColetaMateriaisPorMaterial($nomeMaterial) {
        $this->usuColetaMaterial->setNomeMateiral($nomeMaterial);
        $usuColetaMateriais = json_decode($this->usuColetaMaterialDAO->selectNameMaterial($this->usuColetaMaterial), true);
        return $this->montaLista($usuColetaMateriais);
    }

    public function listarUsuarioColetaMaterialPorUsuario($nomeUsuario) {
        $this->usuColetaMaterial->setNomeUsuario($nomeUsuario);
        $usuColetaMateriais = json_decode($this->usuColetaMaterialDAO->selectNameUser($this->usuColetaMaterial), true);
        return $this->montaLista($usuColetaMateriais);
    }

    public function listarUsuarioColetaMaterialPorCategoria($nomeCategoria) {
        $this->usuColetaMaterial->setNomeCategoria($nomeCategoria);
        $usuColetaMateriais = json_decode($this->usuColetaMaterialDAO->selectNameCategoria($this->usuColetaMaterial), true);
        return $this->montaLista($usuColetaMateriais);
    }

    private function montaLista($usuColetaMateriais) {

        if ($usuColetaMateriais[1] !== "false") {
            $lista = "";
            foreach ($usuColetaMateriais as $usuColetaMaterial) {
                $lista .= "<tr>"
                        . "<td>$usuColetaMaterial[0]</td>"
                        . "<td>$usuColetaMaterial[1]</td>"
                        . "<td>$usuColetaMaterial[2]</td>"
                        . "<td>$usuColetaMaterial[3]</td>"
                        . "<td>$usuColetaMaterial[4]</td>"
                        . "<td>$usuColetaMaterial[6]</td>"
                        . "<td>$usuColetaMaterial[8]</td>"
                        . "<td><a href=#$usuColetaMaterial[0]>Editar</a></td>"
                        . "<td><a href=#$usuColetaMaterial[0]>Remover</a></td>"
                        . "</tr>";
            }
            return $lista;
        }
        return false;
    }

}
