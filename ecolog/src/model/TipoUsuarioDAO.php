<?php

namespace Model;
use Model\TipoUsuario;
use PDO;

class TipoUsuarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT * FROM TIPO_USUARIO WHERE STATUS_TIPO_USUARIO = 1";
    
    private static $SELECT_ID = "SELECT * FROM TIPO_USUARIO WHERE STATUS_TIPO_USUARIO = 1 AND COD_TIPO_USUARIO = :COD_TIPO_USUARIO";
    
    private static $SELECT_NAME = "SELECT * FROM TIPO_USUARIO WHERE STATUS_TIPO_USUARIO = 1 AND NOME_TIPO_USUARIO LIKE :NOME_TIPO_USUARIO";
    
    private static $INSERT = "INSERT INTO TIPO_USUARIO (NOME_TIPO_USUARIO) VALUES (:NOME_TIPO_USUARIO)";
    
    private static $UPDATE = "UPDATE TIPO_USUARIO SET NOME_TIPO_USUARIO = :NOME_TIPO_USUARIO WHERE COD_TIPO_USUARIO = :COD_TIPO_USUARIO";
    
    private static $DELETE = "UPDATE TIPO_USUARIO SET STATUS_TIPO_USUARIO = 0 WHERE COD_TIPO_USUARIO = :COD_TIPO_USUARIO";

    public function create(TipoUsuario $objTipoUsuario) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(TipoUsuarioDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':NOME_TIPO_USUARIO' => $objTipoUsuario->getNomeTipoUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(TipoUsuario $objTipoUsuario) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(TipoUsuarioDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_TIPO_USUARIO' => $objTipoUsuario->getNomeTipoUsuario(),
                        ':COD_TIPO_USUARIO' => $objTipoUsuario->getCodTipoUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(TipoUsuario $objTipoUsuario) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(TipoUsuarioDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_TIPO_USUARIO' => $objTipoUsuario->getCodTipoUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = TipoUsuarioDAO::$SELECT_ALL;
            $stmt = $this->conn->query($sqlSelect);
            $numLinha = $stmt->rowCount();
            if($numLinha == 0) {
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectId(TipoUsuario $objTipoUsuario) {
        try {
            $stmt = $this->conn->prepare(TipoUsuarioDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_TIPO_USUARIO' => $objTipoUsuario->getCodTipoUsuario()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $tipoUsuario = new TipoUsuario();
            $tipoUsuario->setCodTipoUsuario($result->COD_TIPO_USUARIO);
            $tipoUsuario->setNomeTipoUsuario($result->NOME_TIPO_USUARIO);
            $tipoUsuario->setStatusTipoUsuario($result->STATUS_TIPO_USUARIO);
            
            return $tipoUsuario;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectName(TipoUsuario $objTipoUsuario) {
        try {
            $stmt = $this->conn->prepare(TipoUsuarioDAO::$SELECT_NAME);
            $stmt->execute(
                    array(
                        ':NOME_TIPO_USUARIO' => '%'.$objTipoUsuario->getNomeTipoUsuario().'%'
                    )
            );
            $numLinha = $stmt->rowCount();
            if($numLinha == 0){
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }  
    }

}
