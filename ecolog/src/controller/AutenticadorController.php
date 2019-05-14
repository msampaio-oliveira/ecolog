<?php

namespace Controller;

use Model;
use PDO;
//Para testes 
use Util;

//if ($_SERVER['REQUEST_METHOD'] === "POST") {
//    $ajuste = "../../";
//    require_once '../../config/config.php';
//
//    $conn = Util\ConnectionFactory::getConexao('../../config/config_bd.ini');
//    $autenticaController = new \Controller\AutenticadorController($conn);
//    session_start();
//    $autenticaController->autenticarUsuario();
//}

class AutenticadorController {

    private $usuario;
    private $usuarioDAO;

    public function __construct(PDO $conn) {
        $this->usuario = new Model\Usuario();
        $this->usuarioDAO = new Model\UsuarioDAO($conn);
    }

    public function autenticarUsuario() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $usuario = isset($_POST['txtEmailUsuario']) ? $_POST['txtEmailUsuario'] : null;
            $senha = isset($_POST['txtSenha']) ? $_POST['txtSenha'] : null;
            
            echo $usuario;
            $_SESSION['ultimoLogin'] = $usuario;

            if ($usuario != null && $senha != null) {

                //Validando usuário usando Criptográfia 
                $usuario = $this->usuarioDAO->autenticar($usuario, $senha); 
                if ($usuario !== false) {
                    $_SESSION['usuarioLogado'] = $usuario;
                    unset($_SESSION['ultimoLogin']);
                    echo "<script>window.location = '"._URLBASE_."index.php?area=home"."'</script>";
                } else {
                    $_SESSION['usuarioLogado'] = null;
                    echo "<script>document.addEventListener('load', toastrErrorFront('Erro na autenticação!', 'Usuário ou senha inválidos!')); document.getElementById('btn-login').click();document.getElementById('txtUsuario').focus();</script>";
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['acao']) && $_GET['acao'] == "sair") {
                $_SESSION['ultimoLogin'] = $_SESSION['usuarioLogado']->LOGIN_USUARIO;
                unset($_SESSION['usuarioLogado']);
                echo "<script>document.addEventListener('load', sair())</script>";
            }
        }
    }

}
