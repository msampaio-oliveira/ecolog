<?php

namespace Model;
use Model\UsuCompraMaterial;
use PDO;

class UsuCompraMaterialDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, "
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO,  MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "ORDER BY NOME_USUARIO, NOME_MATERIAL";
    
    private static $SELECT_BY_USER = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, "
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE USUARIO.NOME_USUARIO LIKE :NOME_USUARIO "
            . "ORDER BY NOME_USUARIO, NOME_MATERIAL";
    
    private static $SELECT_BY_MATERIAL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, "
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.NOME_MATERIAL LIKE :NOME_MATERIAL "
            . "ORDER BY NOME_USUARIO, NOME_MATERIAL";
   
    private static $SELECT_BY_CATEGORIA = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO, "
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE CATEGORIA.NOME_CATEGORIA LIKE :NOME_CATEGORIA "
            . "ORDER BY NOME_USUARIO, NOME_MATERIAL";
    
    private static $SELECT_CEP = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO,"
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE USUARIO.CEP_USUARIO = :USUARIO_CEP "
            . "ORDER BY NOME_USUARIO, NOME_MATERIAL";
    
    private static $SELECT_MAX_MIN = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.CEP_USUARIO,"
            . "USUARIO.NUM_USUARIO, USUARIO.COMPLEMENTO_USUARIO, MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, "
            . "USU_COMPRA_MATERIAL.VALOR_COMPRADO, USU_COMPRA_MATERIAL.OBS_COMPRA "
            . "FROM USU_COMPRA_MATERIAL INNER JOIN USUARIO "
            . "ON USU_COMPRA_MATERIAL.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN MATERIAL "
            . "ON USU_COMPRA_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "ORDER BY VALOR_COMPRADO DESC";
    
    private static $INSERT = "INSERT INTO USU_COMPRA_MATERIAL (COD_USUARIO, COD_MATERIAL, VALOR_COMPRADO, OBS_COMPRA) "
            . "VALUES (:COD_USUARIO,:COD_MATERIAL,:VALOR_COMPRADO, :OBS_COMPRA)";
    
    private static $UPDATE = "UPDATE USU_COMPRA_MATERIAL SET VALOR_COMPRADO = :VALOR_COMPRADO, OBS_COMPRA = :OBS_COMPRA "
            ."WHERE COD_USUARIO = :COD_USUARIO AND COD_MATERIAL = :COD_MATERIAL";
    
    private static $DELETE = "delete from USU_COMPRA_MATERIAL WHERE COD_USUARIO = :COD_USUARIO AND COD_MATERIAL = :COD_MATERIAL";

    public function create(UsuCompraMaterial $objUsuMaterial) {
        try {
            $prepareInsert = $this->conn->prepare(UsuCompraMaterialDAO::$INSERT);
            $result = false;
            $result = $prepareInsert->execute(
                    array(
                        ':COD_USUARIO' => $objUsuMaterial->getCodUsuario(),
                        ':COD_MATERIAL' => $objUsuMaterial->getCodMaterial(),
                        ':VALOR_COMPRADO' => $objUsuMaterial->getValorComprado(),
                        ':OBS_COMPRA' => $objUsuMaterial->getObsCompra()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
    
    public function update(UsuCompraMaterial $objUsuMaterial) {
        try {
            $result = false;
            $prepareUpdate = $this->conn->prepare(UsuCompraMaterialDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':COD_USUARIO' => $objUsuMaterial->getCodUsuario(),
                        ':COD_MATERIAL' => $objUsuMaterial->getCodMaterial(),
                        ':VALOR_COMPRADO' => $objUsuMaterial->getValorComprado(),
                        ':OBS_COMPRA' => $objUsuMaterial->getObsCompra()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(UsuCompraMaterial $objUsuMaterial) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(UsuCompraMaterialDAO::$DELETE);
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
            $sqlSelect = UsuCompraMaterialDAO::$SELECT_ALL;
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

    public function selectByUser(UsuCompraMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuCompraMaterialDAO::$SELECT_BY_USER);
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
    
    public function selectByMaterial(UsuCompraMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuCompraMaterialDAO::$SELECT_BY_MATERIAL);
            $stmt->execute(
                    array(
                        ':NOME_MATERIAL' => '%' . $objUsuMaterial->getNomeMaterial() . '%'
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
    
    public function selectByCategoria(UsuCompraMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuCompraMaterialDAO::$SELECT_BY_CATEGORIA);
            $stmt->execute(
                    array(
                        ':NOME_CATEGORIA' => '%' . $objUsuMaterial->getNomeCategoria() . '%'
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
    
    public function selectByCEP(UsuCompraMaterial $objUsuMaterial) {
        try {
            $stmt = $this->conn->prepare(UsuCompraMaterialDAO::$SELECT_CEP);
            $stmt->execute(
                    array(
                        ':USUARIO_CEP' =>  $objUsuMaterial->getCepUsuario()
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
    
    public function selectMaxMin() {
        try {
            $sqlSelect = UsuCompraMaterialDAO::$SELECT_MAX_MIN;
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
    
}
