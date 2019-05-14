<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$nomeCategoria = isset($_POST['nomeCategoria']) ? $_POST['nomeCategoria'] : null;

if($nomeCategoria != null) {
    $categoria = new Model\Categoria(0, trim($nomeCategoria));
    $categoriaDAO = new Model\CategoriaDAO($conection);
    echo $categoriaDAO->selectName($categoria);
}