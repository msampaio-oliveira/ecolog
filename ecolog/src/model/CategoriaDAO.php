<?php

namespace Model;
use Model\Categoria;
use PDO;

class CategoriaDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    private static $SELECTA_ALL = "SELECT * FROM CATEGORIA WHERE STATUS_CATEGORIA = 1";
    
    private static $SELECT_ID = "SELECT * FROM CATEGORIA WHERE STATUS_CATEGORIA = 1 AND COD_CATEGORIA = :COD_CATEGORIA";
    
    private static $SELECT_CATEGOTIA = "SELECT * FROM CATEGORIA WHERE STATUS_CATEGORIA = 1 AND NOME_CATEGORIA LIKE :NOME_CATEGORIA";
    
    private static $INSERT = "INSERT INTO CATEGORIA(NOME_CATEGORIA) VALUES(:NOME_CATEGORIA)";
    
    private static $UPDATE = "UPDATE CATEGORIA SET NOME_CATEGORIA = :NOME_CATEGORIA WHERE COD_CATEGORIA = :COD_CATEGORIA";
    
    private static $DELETE = "UPDATE CATEGORIA SET STATUS_CATEGORIA = 0 WHERE COD_CATEGORIA = :COD_CATEGORIA";

    public function create(Categoria $objCategoria) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(CategoriaDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        'NOME_CATEGORIA' => $objCategoria->getNomeCategoria()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(Categoria $objCategoria) {
        $resul = false;
        try {
            $prepareUpdate = $this->conn->prepare(CategoriaDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_CATEGORIA' => $objCategoria->getNomeCategoria(),
                        ':COD_CATEGORIA' => $objCategoria->getCodCategoria()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(Categoria $objCategoria) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(CategoriaDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_CATEGORIA' => $objCategoria->getCodCategoria()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectALL() {
        try {
            $sqlSelect = CategoriaDAO::$SELECTA_ALL;
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

    public function selectId(Categoria $objCategoria) {
        try {
            $stmt = $this->conn->prepare(CategoriaDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_CATEGORIA' => $objCategoria->getCodCategoria()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $categoria = new Categoria();
            $categoria->setCodCategoria($result->COD_CATEGORIA);
            $categoria->setNomeCategoria($result->NOME_CATEGORIA);
            $categoria->setStatusCategoria($result->STATUS_CATEGORIA);
            
            return $categoria;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectName(Categoria $objCategoria) {
        try {
            $stmt = $this->conn->prepare(CategoriaDAO::$SELECT_CATEGOTIA);
            $stmt->execute(
                    array(
                        ':NOME_CATEGORIA' => '%' . $objCategoria->getNomeCategoria() . '%'
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
    
    public function existByName($nome) {
        $exist = false;
        try {
            $prepareSeletc = $this->conn->prepare(CategoriaDAO::$SELECT_CATEGOTIA);
            $prepareSeletc->execute(
                    array(
                        ':NOME_CATEGORIA' => $nome
                    )
            );
            $numLinha = $prepareSeletc->rowCount();
            if($numLinha == 1) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

}
