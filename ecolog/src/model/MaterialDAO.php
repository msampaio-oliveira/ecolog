<?php
 
namespace Model;
use Model\Material;
use PDO;

class MaterialDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, MATERIAL.DESC_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, MATERIAL.STATUS_MATERIAL "
            . "FROM MATERIAL INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA WHERE MATERIAL.STATUS_MATERIAL = 1";
    
    private static $SELECT_ID = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, MATERIAL.DESC_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, MATERIAL.STATUS_MATERIAL "
            . "FROM MATERIAL INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.STATUS_MATERIAL = 1 AND MATERIAL.COD_MATERIAL = :COD_MATERIAL";
    
    private static $SELECT_NAME_MATERIAL = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, MATERIAL.DESC_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, MATERIAL.STATUS_MATERIAL "
            . "FROM MATERIAL INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.STATUS_MATERIAL = 1 AND MATERIAL.NOME_MATERIAL = :NOME_MATERIAL";
    
    private static $SELECT_NAME_CATEGORIA = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, MATERIAL.DESC_MATERIAL, "
            . "CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA, MATERIAL.STATUS_MATERIAL "
            . "FROM MATERIAL INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.STATUS_MATERIAL = 1 AND CATEGORIA.NOME_CATEGORIA LIKE :NOME_CATEGORIA";
    
    private static $INSERT = "INSERT INTO MATERIAL (NOME_MATERIAL, DESC_MATERIAL, COD_CATEGORIA) "
            . "VALUES"
            . "(:NOME_MATERIAL,"
            . ":DESC_MATERIAL,"
            . ":COD_CATEGORIA)";
    
    private static $UPDATE = "UPDATE MATERIAL SET NOME_MATERIAL = :NOME_MATERIAL, "
            . "DESC_MATERIAL = :DESC_MATERIAL, "
            . "COD_CATEGORIA = :COD_CATEGORIA "
            . "WHERE COD_MATERIAL = :COD_MATERIAL";
    
    private static $DELETE = "UPDATE MATERIAL SET STATUS_MATERIAL = 0 WHERE COD_MATERIAL = :COD_MATERIAL";

    public function create(Material $objMaterial) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(MaterialDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':NOME_MATERIAL' => $objMaterial->getNomeMaterial(),
                        ':DESC_MATERIAL' => $objMaterial->getDescMaterial(),
                        ':COD_CATEGORIA' => $objMaterial->getCodCategoria()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(Material $objMaterial) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(MaterialDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_MATERIAL' => $objMaterial->getNomeMaterial(),
                        ':DESC_MATERIAL' => $objMaterial->getDescMaterial(),
                        ':COD_CATEGORIA' => $objMaterial->getCodCategoria(),
                        ':COD_MATERIAL' => $objMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(Material $objMaterial) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(MaterialDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_MATERIAL' => $objMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = MaterialDAO::$SELECT_ALL;
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

    public function selectId(Material $objMaterial) {
        try {
            $stmt = $this->conn->prepare(MaterialDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_MATERIAL' => $objMaterial->getCodMaterial()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $material = new Material();
            $material->setCodMaterial($result->COD_MATERIAL);
            $material->setNomeCategoria($result->NOME_CATEGORIA);
            $material->setDescMaterial($result->DESC_MATERIAL);
            $material->setCodCategoria($result->COD_CATEGORIA);
            $material->setNomeMaterial($result->NOME_MATERIAL);
            $material->setStatusMaterial($result->STATUS_MATERIAL);
            return $material;
            
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectName(Material $objMaterial) {
        try {
            $stmt = $this->conn->prepare(MaterialDAO::$SELECT_NAME_MATERIAL);
            $stmt->execute(
                    array(
                        ':NOME_MATERIAL' =>  $objMaterial->getNomeMaterial()
                    )
            );
            $numLinha = $stmt->rowCount();
            if($numLinha == 0) {
                $result = array('array', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectNameCategoria(Material $objMateria) {
        try {
            $stmt = $this->conn->prepare(MaterialDAO::$SELECT_NAME_CATEGORIA);
            $stmt->execute(
                    array(
                        ':NOME_CATEGORIA' => '%'.$objMateria->getNomeCategoria().'%' 
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
