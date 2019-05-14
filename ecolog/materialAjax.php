<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$nomeMaterial = isset($_POST['nomeMaterial']) ? $_POST['nomeMaterial'] : null;

if($nomeMaterial != null) {
    $material = new Model\Material();
    $material->setNomeMaterial(trim($nomeMaterial));
    
    $materialDAO = new Model\MaterialDAO($conection);
    echo $materialDAO->selectName($material);
}