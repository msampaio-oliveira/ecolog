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
    $usuFavoritaEcopontoController = new \Controller\UsuFavoritaEcoPontoController($conn);
}

class UsuFavoritaEcoPontoController {

    private $usuFavoritaEcoPonto;
    private $usuFavoritaEcoPontoDAO;
    private $acaoGet;
    private $acaoPost;

    public function __construct(PDO $conn) {

        $this->usuFavoritaEcoPonto = new Model\UsuFavoritaEcoPonto();
        $this->usuFavoritaEcoPontoDAO = new Model\UsuFavoritaEcoPontoDAO($conn);
        $this->verificarTipoAcao();
    }

    function getUsuFavoritaEcoPonto() {
        return $this->usuFavoritaEcoPonto;
    }

    function getUsuFavoritaEcoPontoDAO() {
        return $this->usuFavoritaEcoPontoDAO;
    }

    function getAcaoGet() {
        return $this->acaoGet;
    }

    function getAcaoPost() {
        return $this->acaoPost;
    }

    function setUsuFavoritaEcoPonto($usuFavoritaEcoPonto) {
        $this->usuFavoritaEcoPonto = $usuFavoritaEcoPonto;
    }

    function setUsuFavoritaEcoPontoDAO($usuFavoritaEcoPontoDAO) {
        $this->usuFavoritaEcoPontoDAO = $usuFavoritaEcoPontoDAO;
    }

    function setAcaoGet($acaoGet) {
        $this->acaoGet = $acaoGet;
    }

    function setAcaoPost($acaoPost) {
        $this->acaoPost = $acaoPost;
    }

    // Métodos Especilistas
    public function recuperarDadosFormulario() {
        $date = date('Y-m-d H:i:s');

        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        $txtCodEcoponto = isset($_POST['txtCodEcoponto']) ? $_POST['txtCodEcoponto'] : null;
        $dataHoraFavorita = $date;

        if ($txtCodUsuario != null && $txtCodEcoponto != null) {

            $usuFavoritaEcoponto = new Model\UsuFavoritaEcoPonto();
            $usuFavoritaEcoponto->setCodUsuario($txtCodUsuario);
            $usuFavoritaEcoponto->setCodEcoponto($txtCodEcoponto);
            $usuFavoritaEcoponto->setDataHoraFavorita($dataHoraFavorita);

            $this->usuFavoritaEcoPonto = $usuFavoritaEcoponto;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();

        if ($this->acaoPost == 1) {

            $this->usuFavoritaEcoPontoDAO->create($this->usuFavoritaEcoPonto);
        } else if ($this->acaoPost == 2) {
            // Pelo fato do usuário só poder favoritat ou não, 
            // não foi desenvolvido a parte de update ou ele favorita ou ele não favorita
            $this->usuFavoritaEcoPontoDAO->update($this->usuFavoritaEcoPonto);
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
            $this->usuFavoritaEcoPonto->setCodUsuario($_GET['idUsuario']);
            $this->usuFavoritaEcoPonto->setCodEcoponto($_GET['idEcoponto']);
            $this->usuFavoritaEcoPontoDAO->delete($this->usuFavoritaEcoPonto);
        }
    }
    
    public function listarFavoritados() {
        $listaFavoritos = json_decode($this->usuFavoritaEcoPontoDAO->selectAll(), true);
        return $this->montaLista($listaFavoritos);
    }
    
    public function listarFavoritadosPorUsuario($codUsuario) {
        $this->usuFavoritaEcoPonto->setCodUsuario($codUsuario);
        $listaFavoritos = json_decode($this->usuFavoritaEcoPontoDAO->selectIdUser($this->usuFavoritaEcoPonto), true);
        $lista = "";
        foreach ($listaFavoritos as $favorito) {
            $lista .= "<tr>"
                    . "<td>$favorito[3]</td>"
                    . "<td>$favorito[4]</td>"
                    . "<td><a href=#idUsuario=$favorito[0]&idEcoponto=$favorito[2]>Remover</a></td>"
                    . "</tr>";
        }
        return $lista;
    }
    
     public function listarFavoritadosPorEcoponto($codEcoponto) {
        $this->usuFavoritaEcoPonto->setCodEcoponto($codEcoponto);
        $listaFavoritos = json_decode($this->usuFavoritaEcoPontoDAO->selectIdEcoponto($this->usuFavoritaEcoPonto), true);
        $lista = "";
        foreach ($listaFavoritos as $favorito) {
            $lista .= "<tr>"
                    . "<td>$favorito[1]</td>"
                    . "<td>$favorito[4]</td>"
                    . "<td><a href=#idUsuario=$favorito[0]&idEcoponto=$favorito[2]>Remover</a></td>"
                    . "</tr>";
        }
        return $lista;
    }

    private function montaLista($listaFavoritos) {
        $lista = "";
        foreach ($listaFavoritos as $favorito) {
            $lista .= "<tr>"
                    . "<td>$favorito[1]</td>"
                    . "<td>$favorito[3]</td>"
                    . "<td>$favorito[4]</td>"
                    . "<td><a href=#idUsuario=$favorito[0]&idEcoponto=$favorito[2]>Remover</a></td>"
                    . "</tr>";
        }
        return $lista;
    }

}
