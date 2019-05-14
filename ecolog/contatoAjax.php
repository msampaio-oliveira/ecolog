<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$contato = isset($_POST['contato']) ? $_POST['contato'] : null;

if($contato != null) {
    $contato = new Model\Contato(0, trim($contato));
    $contatoDAO = new Model\ContatoDAO($conection);
    echo $contatoDAO->selectContact($contato);
}