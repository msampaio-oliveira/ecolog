<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$nomeIipoContato = isset($_POST['nomeTipoContato']) ? $_POST['nomeTipoContato'] : null;
if ($nomeIipoContato != null) {
    $tipoContato = new Model\TipoContato(0, trim($nomeIipoContato), 0);
    $tipoContatoDAO = new Model\TipoContatoDAO($conection);
    echo $tipoContatoDAO->selectDescName($tipoContato);
}
?>
