<?php
// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

$id = isset($_POST['id']) ? $_POST['id'] : null;
if ($id != null) {
    $materialDAO = new Model\MaterialDAO($conection);
    $material = new Model\Material();
    $material->setCodMaterial($id);
    echo $materialDAO->selectId($material);
}
?>
