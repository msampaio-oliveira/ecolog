<?php

//carregamento do arquivo de configuração
$ajuste = "";
require_once './config/config.php';

// Variável de sessão -
session_start();

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao('./config/bd_mysql.ini');

//Sistema de roteamento - ROUTER - 
if (isset($_GET['area']) && $_GET['area'] == "adm") {
    require_once "./src/view/adm/index_adm.php";
} else if (isset($_GET['area']) && $_GET['area'] == "login") {
    require_once "./src/view/front/login.php";
} else if (isset($_GET['area']) && $_GET['area'] == "home") {
    require_once "./src/view/front/index.php";
} else if (isset($_GET['area']) && $_GET['area'] == "cadastro") {
    require_once "./src/view/front/cadastroUsuario.php";
} else if (isset($_GET['area']) && $_GET['area'] == "alteracao") {
    require_once "./src/view/front/alterarSenha.php";
} else if (isset($_GET['area']) && $_GET['area'] == "esqueceuSenha") {
    require_once "./src/view/front/esqueceuSenha.php";
}else if (isset($_GET['area']) && $_GET['area'] == "ecopontos") {
    require_once "./src/view/front/ecopontos.php";
}else if (isset($_GET['area']) && $_GET['area'] == "mapeamento") {
    require_once "./src/view/front/mapeamento.php";
}else if (isset($_GET['area']) && $_GET['area'] == "recuperarSenha") {
    require_once "./src/view/front/recuperarSenha.php";
} else {
    if (isset($_GET['page']) && $_GET['page'] != "") {
        $page = $_GET['page'] . ".php";
        require_once "./src/view/front/$page";
    } else {
        require_once "./src/view/front/index.php ";
    }
}

