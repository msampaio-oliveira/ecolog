<?php

namespace Controller;

use Model;
use PDO;

class CategoriaController {

    //Atributos
    private $categoria;
    private $categoriaDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET; // 3 Remove
    private $acaoPOST; // 1 Grava || 2 Altera

    //Metodo construtor
    public function __construct(PDO $conn) {
        $this->categoria = new Model\Categoria();
        $this->categoriaDAO = new Model\CategoriaDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    public function getCategoria() {
        return $this->categoria;
    }

    public function getCategoriaDAO() {
        return $this->categoriaDAO;
    }

    function getLista() {
        return $this->lista;
    }

    function getFomulario() {
        return $this->fomulario;
    }

    public function getAcaoGET() {
        return $this->acaoGET;
    }

    public function getAcaoPOST() {
        return $this->acaoPOST;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setCategoriaDAO($categoriaDAO) {
        $this->categoriaDAO = $categoriaDAO;
    }
    
    function setLista($lista) {
        $this->lista = $lista;
    }

    function setFomulario($fomulario) {
        $this->fomulario = $fomulario;
    }

    public function setAcaoGET($acaoGET) {
        $this->acaoGET = $acaoGET;
    }

    public function setAcaoPOST($acaoPOST) {
        $this->acaoPOST = $acaoPOST;
    }

    //Métodos especialistas
    public function recuperarDadosFormulario() {
        $txtCodCategoria = isset($_POST['txtCodCategoria']) ? $_POST['txtCodCategoria'] : null;
        $txtNomeCategoria = isset($_POST['txtNomeCategoria']) ? $_POST['txtNomeCategoria'] : null;

        if ($txtNomeCategoria != null) {
            $categoria = new Model\Categoria();
            $categoria->setCodCategoria(trim($txtCodCategoria));
            $categoria->setNomeCategoria(trim($txtNomeCategoria));

            $this->setCategoria($categoria);
        }
    }

    public function gravarAlterar() {
        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->categoriaDAO->create($this->categoria);
        } else if ($this->acaoPOST == 2) {

            $this->categoriaDAO->update($this->categoria);
            echo "<script>toastSuccess('Categoria alterada com sucesso!');</script>";
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
            $this->categoria->setCodCategoria($_GET['id']);
            $categoria = json_decode($this->categoriaDAO->selectId($this->categoria), true);
            $this->categoria = new Model\Categoria($categoria['codCategoria'], $categoria['nomeCategoria'], $categoria['statusCategoria']);
        }

        if ($this->acaoGET == 3) {

            $this->categoria->setCodCategoria($_GET['id']);
            $this->categoriaDAO->delete($this->categoria);
        }
    }

    public function listarCategorias() {
        $categorias = json_decode($this->categoriaDAO->selectALL(), true);
        return $this->montaLista($categorias);
    }

    public function listarCategoriasName($name) {
        $this->categoria->setNomeCategoria($name);
        $categorias = json_decode($this->categoriaDAO->selectName($this->categoria), true);
        return $this->montaLista($categorias);
    }

    private function montaLista($categorias) {

        if ($categorias[1] !== "false") {
            $lista = "";
            foreach ($categorias as $categoria) {
                $lista .=
                        "<tr>"
                        . "<td>" . $categoria[0] . "</td>"
                        . "<td>" . $categoria[1] . "</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroCategoria&acao=2&id=" . $categoria[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroCategoria&acao=3&id=" . $categoria[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
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
