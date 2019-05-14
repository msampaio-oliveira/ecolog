<?php

namespace Util;

use PDO;
use PDOException;
use Exception;

class ConnectionFactory {

    private function __construct() {    
    }

    public static function getConexao($arq) {
        if (file_exists($arq)) {
            $db = parse_ini_file($arq);
        } else {
            throw new Exception("Arquivo não encontrado: $arq");
        }
        $usuario = isset($db['usuario']) ? $db['usuario'] : null;
        $senha = isset($db['senha']) ? $db['senha'] : null;
        $nome = isset($db['nome']) ? $db['nome'] : null;
        $host = isset($db['host']) ? $db['host'] : null;
        $sgbd = isset($db['sgbd']) ? $db['sgbd'] : null;
        $porta = isset($db['porta']) ? $db['porta'] : null;
        
        switch ($sgbd) {
            case 'mysql': $porta = $porta ? $porta : '3306';
                try {
                    $conexao = new PDO("mysql:host={$host};port={$porta};dbname={$nome}", $usuario, $senha);
                } catch (PDOException $e) {
                    print_r($e);
                } break;
            case 'mssql': try {
                    $conexao = new PDO("sqlsrv:server={$host};database=$nome", $usuario, $senha);
                } catch (PDOException $e) {
                    print_r($e);
                } break;
        }
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }

}
