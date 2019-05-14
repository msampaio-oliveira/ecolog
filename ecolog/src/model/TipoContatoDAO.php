<?php

namespace Model;
use Model\TipoContato;
use PDO;

class TipoContatoDAO {

    private $conn;
    
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    
    private static $SELECT_ALL = "SELECT * FROM TIPO_CONTATO WHERE STATUS_TIPO_CONTATO = 1";
    
    private static $SELECT_ID = "SELECT * FROM TIPO_CONTATO WHERE STATUS_TIPO_CONTATO = 1 AND COD_TIPO_CONTATO = :COD_TIPO_CONTATO;";
    
    private static $SELECT_DES_CONTATO = "SELECT * FROM TIPO_CONTATO WHERE STATUS_TIPO_CONTATO = 1 AND DESC_CONTATO LIKE :DESC_CONTATO";
    
    private static $INSERT = "INSERT INTO TIPO_CONTATO (DESC_CONTATO) VALUES (:DESC_CONTATO)";
    
    private static $UPDATE = "UPDATE TIPO_CONTATO SET DESC_CONTATO = :DESC_CONTATO WHERE COD_TIPO_CONTATO = :COD_TIPO_CONTATO";
    
    private static $DELETE = "UPDATE TIPO_CONTATO SET STATUS_TIPO_CONTATO = 0 WHERE COD_TIPO_CONTATO = :COD_TIPO_CONTATO";
    
    public function create(TipoContato $objTipoContato) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(TipoContatoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':DESC_CONTATO' => $objTipoContato->getDescContato()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(TipoContato $objTipoContato) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(TipoContatoDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':DESC_CONTATO' => $objTipoContato->getDescContato(),
                        ':COD_TIPO_CONTATO' => $objTipoContato->getCodTipoContato()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(TipoContato $objTipoContato) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(TipoContatoDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_TIPO_CONTATO' => $objTipoContato->getCodTipoContato()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = TipoContatoDAO::$SELECT_ALL;
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

    public function selectId(TipoContato $objTipoContato) {
        try {
            $stmt = $this->conn->prepare(TipoContatoDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ":COD_TIPO_CONTATO" => $objTipoContato->getCodTipoContato()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $tipoUsuario = new TipoContato();
            $tipoUsuario->setCodTipoContato($result->COD_TIPO_CONTATO);
            $tipoUsuario->setDescContato($result->DESC_CONTATO);
            $tipoUsuario->setStatusTipoContato($result->STATUS_TIPO_CONTATO);
            
            return $tipoUsuario;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectDescName(TipoContato $objTipoContato) {
        try {
            $stmt = $this->conn->prepare(TipoContatoDAO::$SELECT_DES_CONTATO);
            $stmt->execute(
                    array(
                        ':DESC_CONTATO' => '%'.$objTipoContato->getDescContato().'%'
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
        return $arrayResult;
    }

}
