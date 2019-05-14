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
    $usuAvaliaEcopontoController = new \Controller\UsuAvaliaEcopontoController($conn);
}

class UsuAvaliaEcopontoController {

    private $usuAvaliaEcoponto;
    private $usuAvaliaEcopontoDAO;
    private $acaoGet;
    private $acaoPost;

    public function __construct(PDO $conn) {
        $this->usuAvaliaEcoponto = new Model\UsuAvaliaEcoponto();
        $this->usuAvaliaEcopontoDAO = new Model\UsuAvaliaEcopontoDAO($conn);
        $this->verificaTipoAcao();
    }

    function getUsuAvaliaEcoponto() {
        return $this->usuAvaliaEcoponto;
    }

    function getUsuAvaliaEcopontoDAO() {
        return $this->usuAvaliaEcopontoDAO;
    }

    function getAcaoGet() {
        return $this->acaoGet;
    }

    function getAcaoPost() {
        return $this->acaoPost;
    }

    function setUsuAvaliaEcoponto($usuAvaliaEcoponto) {
        $this->usuAvaliaEcoponto = $usuAvaliaEcoponto;
    }

    function setUsuAvaliaEcopontoDAO($usuAvaliaEcopontoDAO) {
        $this->usuAvaliaEcopontoDAO = $usuAvaliaEcopontoDAO;
    }

    function setAcaoGet($acaoGet) {
        $this->acaoGet = $acaoGet;
    }

    function setAcaoPost($acaoPost) {
        $this->acaoPost = $acaoPost;
    }

    // Metodos Especialistas 
    public function recuperarDadosFormulario() {

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');

        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        $txtCodEcoponto = isset($_POST['txtCodEcoponto']) ? $_POST['txtCodEcoponto'] : null;
        $txtNotaAvaliacao = isset($_POST['txtNotaAvaliacao']) ? $_POST['txtNotaAvaliacao'] : null;
        $txtObsAvaliacao = isset($_POST['txtObsAvaliacao']) ? $_POST['txtObsAvaliacao'] : null;
        $txtDataHoraAvaliacao = $date; //isset($_POST['txtDataHoraAvaliacao']) ? $_POST['txtDataHoraAvaliacao'] : null;

        if ($txtCodUsuario != null && $txtCodEcoponto != null && $txtNotaAvaliacao != null && $txtDataHoraAvaliacao != null) {

            $usuAvaliaEcoponto = new Model\UsuAvaliaEcoponto();
            $usuAvaliaEcoponto->setCodUsuario($txtCodUsuario);
            $usuAvaliaEcoponto->setCodEcoponto($txtCodEcoponto);
            $usuAvaliaEcoponto->setNotaAvaliacao(trim($txtNotaAvaliacao));
            $usuAvaliaEcoponto->setObsAvaliacao(trim($txtObsAvaliacao));
            $usuAvaliaEcoponto->setDataHoraAvaliacao($txtDataHoraAvaliacao);

            $this->usuAvaliaEcoponto = $usuAvaliaEcoponto;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();

        if ($this->acaoPost == 1) {

            echo $this->usuAvaliaEcopontoDAO->create($this->usuAvaliaEcoponto);
        } else if ($this->acaoPost == 2) {
            $this->usuAvaliaEcopontoDAO->update($this->usuAvaliaEcoponto);
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

            $this->usuAvaliaEcoponto->setCodUsuario($_GET['idUsuario']);
            $this->usuAvaliaEcoponto->setCodEcoponto($_GET['idEcoponto']);
            $this->usuAvaliaEcopontoDAO->delete($this->usuAvaliaEcoponto);
        }
    }

    public function listarAvaliacoes() {
        $avaliacoes = json_decode($this->usuAvaliaEcopontoDAO->selectAll(), true);
        return $this->montaLista($avaliacoes);
    }

    public function listarAvaliacoesPorUsuario($codUsuario) {
        $this->usuAvaliaEcoponto->setCodUsuario($codUsuario);
        $avaliacoes = json_decode($this->usuAvaliaEcopontoDAO->selectIdUser($this->usuAvaliaEcoponto), true);
        return $this->montaLista($avaliacoes);
    }

    public function listarAvaliacoesPorEcoponto($codEcoponto) {
        $this->usuAvaliaEcoponto->setCodEcoponto($codEcoponto);
        $avaliacoes = json_decode($this->usuAvaliaEcopontoDAO->selectIdEcoponto($this->usuAvaliaEcoponto), true);
        return $this->montaLista($avaliacoes);
    }

    private function montaLista($avaliacoes) {

        if ($avaliacoes !== "false") {
            $lista = "";
            foreach ($avaliacoes as $avaliacao) {
                $lista .= "<tr>"
                        . "<td>$avaliacao[0]</td>"
                        . "<td>$avaliacao[1]</td>"
                        . "<td>$avaliacao[3]</td>"
                        . "<td>$avaliacao[4]</td>"
                        . "<td>$avaliacao[5]</td>"
                        . "<td>$avaliacao[6]</td>"
                        . "</tr>";
            }
            return $lista;
        }
        return false;
    }

}
