<?php

// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "../../";
require_once $ajuste . 'config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao($ajuste . 'config/bd_mysql.ini');

$idEcoponto = isset($_POST['codEcoponto']) ? $_POST['codEcoponto'] : null;
$idMaterial = isset($_POST['codMaterial']) ? $_POST['codMaterial'] : null;
$idEcopontoRelacional = isset($_POST['codEcopontoRelacional']) ? $_POST['codEcopontoRelacional'] : null;

if ($idEcoponto != null && $idMaterial == null) {
    $ecoponto = new Model\EcoPonto();
    $ecoponto->setCodEcoponto($idEcoponto);
    $ecopontoDAO = new Model\EcoPontoDAO($conection);
    echo $ecopontoDAO->selectId($ecoponto);
}


if ($idMaterial != null && $idEcoponto == null) {
    $material = new Model\Material();
    $material->setCodMaterial($idMaterial);
    $materialDAO = new Model\MaterialDAO($conection);
    echo $materialDAO->selectId($material);
}

if ($idEcopontoRelacional != null) {
    $ecopontoRecebeMaterialDAO = new Model\EcopontoRecebeMaterialDAO($conection);
    $naorecebidos = $ecopontoRecebeMaterialDAO->selectNotRelated($idEcopontoRelacional);
    echo $naorecebidos;
}
