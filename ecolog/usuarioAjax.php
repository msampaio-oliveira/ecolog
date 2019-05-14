<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$login = isset($_POST['login']) ? $_POST['login'] : null;
$documento = isset($_POST['documento']) ? $_POST['documento'] : null;

if ($login != null) {
    $usuarioDAO = new Model\UsuarioDAO($conection);
    echo $usuarioDAO->existLogin(trim($login));
}

if ($documento != null) {
    $usuarioDAO = new Model\UsuarioDAO($conection);
    echo $usuarioDAO->exist(trim($documento));
}