<?php

// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "../../";
require_once $ajuste . 'config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao($ajuste . 'config/bd_mysql.ini');

require_once("../../vendor/phpmailer/class.phpmailer.php");



function popula($usuario) {
    $user = $usuario;
}
