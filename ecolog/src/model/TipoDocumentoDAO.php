<?php

namespace Model;

use Model\TipoDocumento;
use PDO;

class TipoDocumentoDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    private static $SELECT_ALL = "SELECT * FROM TIPO_DOCUMENTO WHERE STATUS_TIPO_DOCUMENTO = 1";
    private static $SELECT_ID = "SELECT * FROM TIPO_DOCUMENTO WHERE COD_TIPO_DOCUMENTO = :COD_TIPO_DOCUMENTO AND STATUS_TIPO_DOCUMENTO = 1";
    private static $SELECT_NAME = "SELECT * FROM TIPO_DOCUMENTO WHERE NOME_TIPO_DOCUMENTO = :NOME_TIPO_DOCUMENTO AND STATUS_TIPO_DOCUMENTO = 1";
    private static $INSERT = "INSERT INTO TIPO_DOCUMENTO (NOME_TIPO_DOCUMENTO) VALUES (:NOME_TIPO_DOCUMENTO)";
    private static $UPDATE = "UPDATE TIPO_DOCUMENTO SET NOME_TIPO_DOCUMENTO = :NOME_TIPO_DOCUMENTO WHERE COD_TIPO_DOCUMENTO = :COD_TIPO_DOCUMENTO";
    private static $DELETE = "UPDATE TIPO_DOCUMENTO SET STATUS_TIPO_DOCUMENTO = 0 WHERE COD_TIPO_DOCUMENTO = :COD_TIPO_DOCUMENTO";

    public function create(TipoDocumento $objTipoDocumento) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(TipoDocumentoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':NOME_TIPO_DOCUMENTO' => $objTipoDocumento->getNomeTipoDocumento()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(TipoDocumento $objTipoDocumento) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(TipoDocumentoDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_TIPO_DOCUMENTO' => $objTipoDocumento->getNomeTipoDocumento(),
                        ':COD_TIPO_DOCUMENTO' => $objTipoDocumento->getCodTipoDocumento()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(TipoDocumento $objTipoDocumento) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(TipoDocumentoDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_TIPO_DOCUMENTO' => $objTipoDocumento->getCodTipoDocumento()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = TipoDocumentoDAO::$SELECT_ALL;
            $stmt = $this->conn->query($sqlSelect);
            $numLinha = $stmt->rowCount();
            if ($numLinha == 0) {
                $result = array('result', 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectId(TipoDocumento $objTipoDocumento) {
        try {
            $stmt = $this->conn->prepare(TipoDocumentoDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_TIPO_DOCUMENTO' => $objTipoDocumento->getCodTipoDocumento()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $tipoDocumento = new TipoDocumento();
            $tipoDocumento->setCodTipoDocumento($result->COD_TIPO_DOCUMENTO);
            $tipoDocumento->setNomeTipoDocumento($result->NOME_TIPO_DOCUMENTO);
            $tipoDocumento->setStatusTipoDocumento($result->STATUS_TIPO_DOCUMENTO);

            return $tipoDocumento;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectName(TipoDocumento $objTipoDocumento) {
        try {
            $stmt = $this->conn->prepare(TipoDocumentoDAO::$SELECT_NAME);
            $stmt->execute(
                    array(
                        ':NOME_TIPO_DOCUMENTO' => '%' . $objTipoDocumento->getNomeTipoDocumento() . '%'
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
