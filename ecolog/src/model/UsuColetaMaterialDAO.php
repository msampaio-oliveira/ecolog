<?php

namespace Model;
use Model\UsuColetaMaterial;
use PDO;

class UsuColetaMaterialDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, "
            ."MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            ."FROM USU_COLETA_MATERIAL INNER JOIN USUARIO ON USU_COLETA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            ."INNER JOIN MATERIAL ON USU_COLETA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            ."INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA";
    
    private static $SELECT_NAME_MATERIAL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, "
            . "MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM USU_COLETA_MATERIAL INNER JOIN USUARIO ON USU_COLETA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL ON USU_COLETA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.NOME_MATERIAL LIKE :NOME_MATERIAL";
    
    private static $SELECT_NAME_USER = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, "
            . "MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM USU_COLETA_MATERIAL INNER JOIN USUARIO ON USU_COLETA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL ON USU_COLETA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE USUARIO.NOME_USUARIO LIKE :NOME_USUARIO";
   
    private static $SELECT_NAME_CATEGORIA = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, "
            . "MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM USU_COLETA_MATERIAL INNER JOIN USUARIO ON USU_COLETA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL ON USU_COLETA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE CATEGORIA.NOME_CATEGORIA LIKE :NOME_CATEGORIA";
    
    private static $INSERT = "INSERT INTO USU_COLETA_MATERIAL (COD_USUARIO, COD_MATERIAL) VALUES (:COD_USUARIO, :COD_MATERIAL)";
    
    private static $DELETE = "DELETE FROM USU_COLETA_MATERIAL WHERE COD_USUARIO = :COD_USUARIO AND COD_MATERIAL = :COD_MATERIAL";

    public function create(UsuColetaMaterial $objUsuMaterial) {
        try {
            $result = false;
            $prepareInsert = $this->conn->prepare(UsuColetaMaterialDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':COD_USUARIO' => $objUsuMaterial->getCodUsuario(),
                        ':COD_MATERIAL' => $objUsuMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(UsuColetaMaterial $objUsuMaterial) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(UsuColetaMaterialDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_USUARIO' => $objUsuMaterial->getCodUsuario(),
                        ':COD_MATERIAL' => $objUsuMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = UsuColetaMaterialDAO::$SELECT_ALL;
            $stmt = $this->conn->query($sqlSelect);
            $numLinha = $stmt->rowCount();
            if ($numLinha == 0) {
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectNameMaterial(UsuColetaMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuColetaMaterialDAO::$SELECT_NAME_MATERIAL);
            $stmt->execute(
                    array(
                        ':NOME_MATERIAL' => '%' . $objUsuMaterial->getNomeMateiral() . '%'
                    )
            );
            $numLinha = $stmt->rowCount();
            if ($numLinha == 0) {
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectNameUser(UsuColetaMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuColetaMaterialDAO::$SELECT_NAME_USER);
            $stmt->execute(
                    array(
                        ':NOME_USUARIO' => '%' . $objUsuMaterial->getNomeUsuario() . '%'
                    )
            );
            $numLinha = $stmt->rowCount();
            if ($numLinha == 0) {
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectNameCategoria(UsuColetaMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuColetaMaterialDAO::$SELECT_NAME_CATEGORIA);
            $stmt->execute(
                    array(
                        ':NOME_CATEGORIA' => '%' . $objUsuMaterial->getNomeCategoria() . '%'
                    )
            );
            $numLinha = $stmt->rowCount();
            if($numLinha == 0) {
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
