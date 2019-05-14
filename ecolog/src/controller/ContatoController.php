<?php

namespace Controller;

use Model;
use PDO;

class ContatoController {

    // Atributos
    private $contato;
    private $contatoDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET; // 3 Remove
    private $acaoPOST; // 1 Cadastra || 2 Altera

    // Contrutor

    public function __construct(PDO $conn) {
        $this->contato = new Model\Contato();
        $this->contatoDAO = new Model\ContatoDAO($conn);
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getContato() {
        return $this->contato;
    }

    function getContatoDAO() {
        return $this->contatoDAO;
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

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setContatoDAO($contatoDAO) {
        $this->contatoDAO = $contatoDAO;
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

    // Metodos Especialistas
    public function recuperarDadosFormulario() {

        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        $txtCodContato = isset($_POST['txtCodContato']) ? $_POST['txtCodContato'] : null;
        $txtContato = isset($_POST['txtContato']) ? $_POST['txtContato'] : null;
        $txtCodTipoContato = isset($_POST['txtCodTipoContato']) ? $_POST['txtCodTipoContato'] : null;

//        echo $txtCodUsuario . "<br>";
//        echo $txtCodContato . "<br>";
//        echo $txtContato . "<br>";
//        echo $txtCodTipoContato . "<br>";

        if ($txtContato != null && $txtCodTipoContato != null && $txtCodUsuario != null) {
            $contato = new Model\Contato();
            $contato->setCodUsuario($txtCodUsuario);
            $contato->setCodContato($txtCodContato);
            $contato->setContato(trim($txtContato));
            $contato->setCodTipoContato($txtCodTipoContato);

            $this->contato = $contato;
        }
    }

    public function gravarAlterar() {

        $this->recuperarDadosFormulario();

        if ($this->acaoPOST == 1) {

            $this->contatoDAO->create($this->contato);
        } else if ($this->acaoPOST == 2) {

            $this->contatoDAO->update($this->contato);
        }
    }

    public function verificaTipoAcao() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $this->acaoPOST = isset($_POST['txtAcao']) ? $_POST['txtAcao'] : 0;
            $this->gravarAlterar();
        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->acaoGET = isset($_GET['acao']) ? $_GET['acao'] : 0;
            $this->executarAcaoGet();
        }
        $this->mostrarListaFomulario();
    }

    public function executarAcaoGet() {

        if ($this->acaoGET == 2) {
            $this->contato->setCodContato($_GET['id']);
            $contato = json_decode($this->contatoDAO->selectId($this->contato), true);
            $this->contato = new Model\Contato($contato['codContato'], $contato['contato'], $contato['statusContato'], $contato['codTipoContato'], $contato['codUsuario'], $contato['nomeUsuario']);
        }

        if ($this->acaoGET == 3) {

            $this->contato->setCodContato($_GET['id']);
            $this->contatoDAO->delete($this->contato);
        }
    }

    public function listarContatos() {
        $contatos = json_decode($this->contatoDAO->selectAll(), true);
        return $this->montaLista($contatos);
    }

    public function listarContato($contato) {
        $this->contato->setContato($contato);
        $contatos = json_decode($this->contatoDAO->selectContact($this->contato), true);
        return $this->montaLista($contatos);
    }

    public function listarContstosPorUsuario($usuario) {
        $this->contato->setNomeUsuario($usuario);
        $contatos = json_decode($this->contatoDAO->selectUserName($this->contato), true);
        return $this->montaLista($contatos);
    }

    private function montaLista($contatos) {

        if ($contatos[1] !== "false") {
            $lista = "";
            foreach ($contatos as $contato) {
                $lista .= "<tr>"
                        . "<td>$contato[0]</td>"
                        . "<td>$contato[1]</td>"
                        . "<td>$contato[4]</td>"
                        . "<td>$contato[6]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroContato&acao=2&id=" . $contato[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroContato&acao=3&id=" . $contato[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
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
