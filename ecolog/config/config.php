<?php

include_once $ajuste . 'src/util/Psr4AutoloaderClass.php';

define("_URLBASE_",
    "http://localhost/ecolog/");
define("_URLBASEADM_",
    "http://localhost/ecolog/index.php?area=adm");

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d H:i:s');
 
// TIRAR O COMENTÁRIO QUANDO FOR PARA PRODUÇÃO error_reporting(E_ERROR | E_WARNING | E_PARSE);

$autoLoading = new Util\Psr4AutoloaderClass();
$autoLoading->addNamespace("Util", $ajuste . "src/util");
$autoLoading->addNamespace("Model", $ajuste . "src/model");
$autoLoading->addNamespace("Controller", $ajuste . "src/controller");
$autoLoading->addNamespace("Vendor", $ajuste . "vendor/phpmailer");
$autoLoading->register();

