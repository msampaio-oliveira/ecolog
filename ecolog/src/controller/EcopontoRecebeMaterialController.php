<?php
    
namespace Controller;

use Model;
use PDO;

class EcopontoRecebeMaterialController {

    // Atributos
    private $ecopontoRecebeMaterial;
    private $ecopontoRecebeMaterialDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGet;
    private $acaoPost;

    // Construtor
    public function __construct(PDO $conn) {
        $this->ecopontoRecebeMaterial = new Model\EcopontoRecebeMaterial();
        $this->ecopontoRecebeMaterialDAO = new Model\EcopontoRecebeMaterialDAO($conn);
        $this->verificarTipoAcao();
    }

    function getEcopontoRecebeMaterial() {
        return $this->ecopontoRecebeMaterial;
    }

    function getEcopontoRecebeMaterialDAO() {
        return $this->ecopontoRecebeMaterialDAO;
    }

    function getLista() {
        return $this->lista;
    }

    function getFomulario() {
        return $this->fomulario;
    }

    function getAcaoGet() {
        return $this->acaoGet;
    }

    function getAcaoPost() {
        return $this->acaoPost;
    }

    function setEcopontoRecebeMaterial($ecopontoRecebeMaterial) {
        $this->ecopontoRecebeMaterial = $ecopontoRecebeMaterial;
    }

    function setEcopontoRecebeMaterialDAO($ecopontoRecebeMaterialDAO) {
        $this->ecopontoRecebeMaterialDAO = $ecopontoRecebeMaterialDAO;
    }

    function setLista($lista) {
        $this->lista = $lista;
    }

    function setFomulario($fomulario) {
        $this->fomulario = $fomulario;
    }

    function setAcaoGet($acaoGet) {
        $this->acaoGet = $acaoGet;
    }

    function setAcaoPost($acaoPost) {
        $this->acaoPost = $acaoPost;
    }

    // Métodos Especialistas

    public function recuperarDadosFormulario() {

        $txtCodEcoponto = isset($_POST['txtCodEcoponto']) ? $_POST['txtCodEcoponto'] : null;
        $txtCodMaterial = isset($_POST['txtCodMaterial']) ? $_POST['txtCodMaterial'] : null;

        if ($txtCodEcoponto != null && $txtCodMaterial != null) {

            $ecopontoRecebeMaterial = new Model\EcopontoRecebeMaterial();
            $ecopontoRecebeMaterial->setCodEcoponto($txtCodEcoponto);
            $ecopontoRecebeMaterial->setCodMaterial($txtCodMaterial);

            $this->ecopontoRecebeMaterial = $ecopontoRecebeMaterial;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();
        
        if ($this->getAcaoPost() == 1) {

            $this->ecopontoRecebeMaterialDAO->create($this->ecopontoRecebeMaterial);
        } else if ($this->getAcaoPost() == 2) {
            // Nao tera update pois ou um usuario recebe um determinado material, ou nao recebe, 
            // pensando nisso nao fizemos o update 
            $this->ecopontoRecebeMaterialDAO->update($this->ecopontoRecebeMaterial);
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
        
        $this->mostrarListaFomulario();
    }

    public function executarAcaoGet() {

        if ($this->acaoGet == 3) {

            $this->ecopontoRecebeMaterial->setCodEcoponto($_GET['idEcoponto']);
            $this->ecopontoRecebeMaterial->setCodMaterial($_GET['idMaterial']);
            $this->ecopontoRecebeMaterialDAO->delete($this->ecopontoRecebeMaterial);
        }
        
        if ($this->acaoGet == 2) {

            $this->ecopontoRecebeMaterial->setCodEcoponto($_GET['idEcoponto']);
            $this->ecopontoRecebeMaterial->setCodMaterial($_GET['idMaterial']);
            $this->ecopontoRecebeMaterialDAO->selectByEcoponto($this->ecopontoRecebeMaterial);
        }
    }

    public function listarEcopontoRecebeMateriais() {
        $ecopontosMateriais = json_decode($this->ecopontoRecebeMaterialDAO->selectAll(), true);
        return $this->montaLista($ecopontosMateriais);
    }

    public function listarEcopontoMaterialPorEcoponto($nomeEcoponto) {
        $this->ecopontoRecebeMaterial->setNomeEcoponto($nomeEcoponto);
        $ecopontosMateriais = json_decode($this->ecopontoRecebeMaterialDAO->selectByEcoponto($this->ecopontoRecebeMaterial), true);
        return $this->montaLista($ecopontosMateriais);
    }

    public function listarEcopontoMaterialPorMaterial($nomeMaterial) {
        $this->ecopontoRecebeMaterial->setNomeMaterial($nomeMaterial);
        $ecopontosMateriais = json_decode($this->ecopontoRecebeMaterialDAO->selectByMaterial($this->ecopontoRecebeMaterial), true);
        return $this->montaLista($ecopontosMateriais);
    }

    public function listarEcopontoMaterialPorCategoria($nomeCategoria) {
        $this->ecopontoRecebeMaterial->setNomeCategoria($nomeCategoria);
        $ecopontosMateriais = json_decode($this->ecopontoRecebeMaterialDAO->selectByCategoria($this->ecopontoRecebeMaterial), true);
        return $this->montaLista($ecopontosMateriais);
    }

    public function listarEcopontoMaterialPorCEP($cepEcoponto) {
        $this->ecopontoRecebeMaterial->setCepEcoponto($cepEcoponto);
        $ecopontosMateriais = json_decode($this->ecopontoRecebeMaterialDAO->selectByCEP($this->ecopontoRecebeMaterial), true);
        return $this->montaLista($ecopontosMateriais);
    }

    public function listarMateriaisPorEcoponto($codEcopontoMateriais) {
        $materiaisEcoponto = json_decode($this->ecopontoRecebeMaterialDAO->selectMateriaisPorEcoponto($codEcopontoMateriais), true);
        return $this->montaListaMateriais($materiaisEcoponto);
    }

    private function montaLista($ecopontosMateriais) {

        if ($ecopontosMateriais[1] !== "false") {
            $lista = "";
            foreach ($ecopontosMateriais as $ecopontoMaterial) {

                $lista .= "<tr>";
                $lista .= "<td>$ecopontoMaterial[0]</td>";
                $lista .= "<td>$ecopontoMaterial[1]</td>";
                $lista .= "<td>$ecopontoMaterial[2]</td>";
                $lista .= "<td>$ecopontoMaterial[3]</td>";
                $lista .= "<td>$ecopontoMaterial[4]</td>";
                $lista .= "<td>$ecopontoMaterial[5]</td>";
                $lista .= "<td>$ecopontoMaterial[7]</td>";
                $lista .= "<td>$ecopontoMaterial[9]</td>";
                $lista .= "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcopontoRecebeMaterial&acao=2&idEcoponto=" . $ecopontoMaterial[0] . "&idMaterial=".$ecopontoMaterial[6]."'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>";
                $lista .= "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcopontoRecebeMaterial&acao=3&idEcoponto=" . $ecopontoMaterial[0] . "&idMaterial=".$ecopontoMaterial[6]."'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>";
                $lista .= "</tr>";
            }
            return $lista;
        }
        return false;
    }

    private function montaListaMateriais($materiaisEcoponto) {

        if ($materiaisEcoponto[1] !== "false") {
            $lista = "";

            foreach ($materiaisEcoponto as $material) {

                $lista .= "<tr>";
                $lista .= "<td>$material[0]</td>";
                $lista .= "<td>$material[1]</td>";
                $lista .= "<td>$material[2]</td>";
                $lista .= "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroEcoponto&acao=2&idMaterial=" . $material[0] . "idEcoponto=" . $material[3] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>";
                $lista .= "</tr>";
            }
            return $lista;
        }
        return false;
    }
    
    public function mostrarListaFomulario() {
        if ($this->acaoGet == 0 || $this->acaoGet == 3) {
            $this->fomulario = "off";
            $this->lista = "on";
        } elseif ($this->acaoGet == 1 || $this->acaoGet == 2) {
            $this->fomulario = "on";
            $this->lista = "off";
        }
    }

}
