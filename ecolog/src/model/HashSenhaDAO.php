<?php

namespace Model;

use Model\HashSenha;
use PDO;
use PDOException;

class HashSenhaDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $INSERT = "INSERT INTO HASH_SENHA (HASH_SENHA, DATA_GERACAO, COD_USUARIO) VALUES (:HASH_SENHA, :DATA_GERACAO, :COD_USUARIO)";
    private static $SELECT_HASH = "SELECT * FROM HASH_SENHA WHERE HASH_SENHA = :HASH_SENHA and DATA_GERACAO = :DATA_GERACAO";

    public function create(HashSenha $hashSenha) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(HashSenhaDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':HASH_SENHA' => $hashSenha->getHashSenha(),
                        ':DATA_GERACAO' => $hashSenha->getDataGeracao(),
                        ':COD_USUARIO' => $hashSenha->getCodUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectHash(HashSenha $hash) {
        try {
            $prepareSelect = $this->conn->prepare(HashSenhaDAO::$SELECT_HASH);
            $prepareSelect->execute(
                    array(
                        ':HASH_SENHA' => $hash->getHashSenha(),
                        ':DATA_GERACAO' => $hash->getDataGeracao()
                    )
            );
            $numLinha = $prepareSelect->rowCount();
            if ($numLinha == 0) {
                return false;
            }
            $result = $prepareSelect->fetch(PDO::FETCH_OBJ);
            $hashSenha = new \Model\HashSenha();
            $hashSenha->setHashSenha($result->HASH_SENHA);
            $hashSenha->setDataGeracao($result->DATA_GERACAO);
            $hashSenha->setCodUsuario($result->COD_USUARIO);

            return $hashSenha;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

}
