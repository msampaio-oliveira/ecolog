<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$nomeIipoUsuario = isset($_POST['nomeTipoUsuario']) ? $_POST['nomeTipoUsuario'] : null;

if ($nomeIipoUsuario != null) {
    $tipoUsuario = new Model\TipoUsuario(0, trim($nomeIipoUsuario), 0);
    $tipoUsuarioDAO = new Model\TipoUsuarioDAO($conection);
    echo $tipoUsuarioDAO->selectName($tipoUsuario);
}
?>
