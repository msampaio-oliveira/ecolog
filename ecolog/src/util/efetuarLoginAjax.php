<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "../../";
require_once $ajuste.'config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao($ajuste.'config/bd_mysql.ini');

$autenticadorController = new Controller\AutenticadorController($conection);
$autenticadorController->autenticarUsuario();


//
//$txtLogin = isset($_POST['txtLoginUsuario']) ? $_POST['txtLoginUsuario'] : null;
//$txtSenha = isset($_POST['txtSenhaUsuario']) ? $_POST['txtSenhaUsuario'] : null;

//if($txtLogin != null && $txtSenha != null) {
//    $usuario = new Model\Usuario();
//    
//    $usuarioDAO = new Model\UsuarioDAO($conection);
//    echo json_encode($usuarioDAO->autenticar($txtLogin, $txtSenha));
//}