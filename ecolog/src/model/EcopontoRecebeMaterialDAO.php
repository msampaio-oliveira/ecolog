<?php

namespace Model;

use Model\EcopontoRecebeMaterial;
use PDO;

// criar método que list por id

class EcopontoRecebeMaterialDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, ECOPONTO.HORARIO_FUNC_ECOPONTO, "
            . "ECOPONTO.CEP_ECOPONTO, ECOPONTO.NUM_ECOPONTO, "
            . "ECOPONTO.COMPLEMENTO_ECOPONTO, MATERIAL.COD_MATERIAL, "
            . "MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . "INNER JOIN MATERIAL "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "ORDER BY NOME_ECOPONTO, NOME_MATERIAL";
    private static $SELECT_BY_ECOPONTO = "SELECT ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, ECOPONTO.HORARIO_FUNC_ECOPONTO, "
            . "ECOPONTO.CEP_ECOPONTO, ECOPONTO.NUM_ECOPONTO, "
            . "ECOPONTO.COMPLEMENTO_ECOPONTO, MATERIAL.COD_MATERIAL, "
            . "MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . "INNER JOIN MATERIAL "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE ECOPONTO.NOME_ECOPONTO LIKE :NOME_ECOPONTO "
            . "ORDER BY NOME_ECOPONTO, NOME_MATERIAL";
    private static $SELECT_BY_MATERIAL = "SELECT ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, ECOPONTO.HORARIO_FUNC_ECOPONTO, "
            . "ECOPONTO.CEP_ECOPONTO, ECOPONTO.NUM_ECOPONTO, "
            . "ECOPONTO.COMPLEMENTO_ECOPONTO, MATERIAL.COD_MATERIAL, "
            . "MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . "INNER JOIN MATERIAL "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE MATERIAL.NOME_MATERIAL LIKE :NOME_MATERIAL "
            . "ORDER BY NOME_ECOPONTO, NOME_MATERIAL";
    private static $SELECT_BY_CATEGORIA = "SELECT ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, ECOPONTO.HORARIO_FUNC_ECOPONTO, "
            . "ECOPONTO.CEP_ECOPONTO, ECOPONTO.NUM_ECOPONTO, "
            . "ECOPONTO.COMPLEMENTO_ECOPONTO, MATERIAL.COD_MATERIAL,"
            . "MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . "INNER JOIN MATERIAL "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE CATEGORIA.NOME_CATEGORIA LIKE :NOME_CATEGORIA "
            . "ORDER BY NOME_ECOPONTO, NOME_MATERIAL";
    private static $SELECT_BY_CEP = "SELECT ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, ECOPONTO.HORARIO_FUNC_ECOPONTO, "
            . "ECOPONTO.CEP_ECOPONTO, ECOPONTO.NUM_ECOPONTO, "
            . "ECOPONTO.COMPLEMENTO_ECOPONTO, MATERIAL.COD_MATERIAL,"
            . "MATERIAL.NOME_MATERIAL, CATEGORIA.COD_CATEGORIA, CATEGORIA.NOME_CATEGORIA "
            . "FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . "INNER JOIN MATERIAL "
            . "ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . "INNER JOIN CATEGORIA "
            . "ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE ECOPONTO.CEP_ECOPONTO = :CEP_ECOPONTO "
            . "ORDER BY NOME_ECOPONTO, NOME_MATERIAL";
    private static $SELECT_NOT_RELATED = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.NOME_CATEGORIA FROM MATERIAL "
            . "INNER JOIN CATEGORIA ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . "WHERE NOT EXISTS (SELECT * FROM ECOPONTO_RECEBE_MATERIAL WHERE ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL AND ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = :COD_ECOPONTO)";
    private static $SELECT_MATERIAIS_BY_ECOPONTO = "SELECT MATERIAL.COD_MATERIAL, MATERIAL.NOME_MATERIAL, CATEGORIA.NOME_CATEGORIA, ECOPONTO.COD_ECOPONTO"
            . " FROM ECOPONTO_RECEBE_MATERIAL INNER JOIN ECOPONTO "
            . " ON ECOPONTO_RECEBE_MATERIAL.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO "
            . " INNER JOIN MATERIAL "
            . " ON ECOPONTO_RECEBE_MATERIAL.COD_MATERIAL = MATERIAL.COD_MATERIAL "
            . " INNER JOIN CATEGORIA "
            . " ON MATERIAL.COD_CATEGORIA = CATEGORIA.COD_CATEGORIA "
            . " WHERE ECOPONTO.COD_ECOPONTO = :COD_ECOPONTO"
            . " ORDER BY COD_MATERIAL";
    private static $INSERT = "INSERT INTO ECOPONTO_RECEBE_MATERIAL (COD_ECOPONTO, COD_MATERIAL) VALUES (:COD_ECOPONTO, :COD_MATERIAL)";
    private static $DELETE = "DELETE FROM ECOPONTO_RECEBE_MATERIAL WHERE COD_ECOPONTO = :COD_ECOPONTO AND COD_MATERIAL = :COD_MATERIAL";

    public function create(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $result = false;
            $prepareInsert = $this->conn->prepare(EcopontoRecebeMaterialDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':COD_ECOPONTO' => $objEcopontoMaterial->getCodEcoponto(),
                        ':COD_MATERIAL' => $objEcopontoMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(EcopontoRecebeMaterialDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_ECOPONTO' => $objEcopontoMaterial->getCodEcoponto(),
                        ':COD_MATERIAL' => $objEcopontoMaterial->getCodMaterial()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $querySelect = EcopontoRecebeMaterialDAO::$SELECT_ALL;
            $stmt = $this->conn->query($querySelect);
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

    public function selectByEcoponto(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_BY_ECOPONTO);
            $stmt->execute(
                    array(
                        ':NOME_ECOPONTO' => '%' . $objEcopontoMaterial->getNomeEcoponto() . '%'
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

    public function selectByMaterial(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_BY_MATERIAL);
            $stmt->execute(
                    array(
                        ':NOME_MATERIAL' => '%' . $objEcopontoMaterial->getNomeMaterial() . '%'
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

    public function selectByCategoria(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_BY_CATEGORIA);
            $stmt->execute(
                    array(
                        ':NOME_CATEGORIA' => '%' . $objEcopontoMaterial->getNomeCategoria() . '%'
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

    public function selectByCEP(EcopontoRecebeMaterial $objEcopontoMaterial) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_BY_CEP);
            $stmt->execute(
                    array(
                        ':CEP_ECOPONTO' => $objEcopontoMaterial->getCepEcoponto()
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

    public function selectNotRelated($codEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_NOT_RELATED);
            $stmt->execute(
                    array(
                        ':COD_ECOPONTO' => $codEcoponto
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
    
    public function selectMateriaisPorEcoponto($codEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcopontoRecebeMaterialDAO::$SELECT_MATERIAIS_BY_ECOPONTO);
            $stmt->execute(
                    array(
                        ':COD_ECOPONTO' => $codEcoponto
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

}
