<?php

namespace Model;
use Model\EcoPonto;
use PDO;

class EcoPontoDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    private static $SELECT_ALL = "SELECT * FROM ECOPONTO WHERE STATUS_ECOPONTO = 1";
    
    private static $SELECT_ID = "SELECT * FROM ECOPONTO WHERE STATUS_ECOPONTO = 1 AND COD_ECOPONTO = :COD_ECOPONTO";
    
    private static $SELECT_NAME_ECOPONTO = "SELECT * FROM ECOPONTO WHERE STATUS_ECOPONTO = 1 AND NOME_ECOPONTO LIKE :NOME_ECOPONTO";
    
    private static $SELECT_HORARIO_FUNCIONAMENTO = "SELECT * FROM ECOPONTO WHERE STATUS_ECOPONTO = 1  AND HORARIO_FUNC_ECOPONTO LIKE :HORARIO_FUNCIONAMENTO";
    
    private static $SELECT_CEP = "SELECT * FROM ECOPONTO WHERE STATUS_ECOPONTO = 1 AND CEP_ECOPONTO LIKE :CEP_ECOPONTO";
    
    private static $INSERT = "INSERT INTO ECOPONTO (NOME_ECOPONTO, "
            . "HORARIO_FUNC_ECOPONTO, "
            . "CEP_ECOPONTO, "
            . "LONGITUDE_ECOPONTO, "
            . "LATITUDE_ECOPONTO, "
            . "NUM_ECOPONTO, "
            . "COMPLEMENTO_ECOPONTO)"
            . "VALUES"
            . "(:NOME_ECOPONTO, "
            . ":HORARIO_FUNC_ECOPONTO,"
            . ":CEP_ECOPONTO,"
            . ":LONGITUDE_ECOPONTO,"
            . ":LATITUDE_ECOPONTO,"
            . ":NUM_ECOPONTO,"
            . ":COMPLEMENTO_ECOPONTO)";
    
    private static $UPDATE = "UPDATE ECOPONTO SET NOME_ECOPONTO = :NOME_ECOPONTO, HORARIO_FUNC_ECOPONTO = :HORARIO_FUNC_ECOPONTO,"
            . "CEP_ECOPONTO = :CEP_ECOPONTO, LONGITUDE_ECOPONTO = :LONGITUDE_ECOPONTO,"
            . "LATITUDE_ECOPONTO = :LATITUDE_ECOPONTO,"
            . "NUM_ECOPONTO = :NUM_ECOPONTO, COMPLEMENTO_ECOPONTO = :COMPLEMENTO_ECOPONTO "
            . "WHERE COD_ECOPONTO = :COD_ECOPONTO";
    
    private static $DELETE = "UPDATE ECOPONTO SET STATUS_ECOPONTO = 0 WHERE COD_ECOPONTO = :COD_ECOPONTO";

    public function create(EcoPonto $objEcoponto) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(EcoPontoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':NOME_ECOPONTO' => $objEcoponto->getNomeEcoponto(),
                        ':HORARIO_FUNC_ECOPONTO' => $objEcoponto->getHorarioFuncEcoponto(),
                        ':CEP_ECOPONTO' => $objEcoponto->getCepEcoponto(),
                        ':LONGITUDE_ECOPONTO' => $objEcoponto->getLongitudeEcoponto(),
                        ':LATITUDE_ECOPONTO' => $objEcoponto->getLatitudeEcoponto(),
                        ':NUM_ECOPONTO' => $objEcoponto->getNumEcoponto(),
                        ':COMPLEMENTO_ECOPONTO' => $objEcoponto->getComplementoEcoponto()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(EcoPonto $objEcoponto) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(EcoPontoDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_ECOPONTO' => $objEcoponto->getNomeEcoponto(),
                        ':HORARIO_FUNC_ECOPONTO' => $objEcoponto->getHorarioFuncEcoponto(),
                        ':CEP_ECOPONTO' => $objEcoponto->getCepEcoponto(),
                        ':LONGITUDE_ECOPONTO' => $objEcoponto->getLongitudeEcoponto(),
                        ':LATITUDE_ECOPONTO' => $objEcoponto->getLatitudeEcoponto(),
                        ':NUM_ECOPONTO' => $objEcoponto->getNumEcoponto(),
                        ':COMPLEMENTO_ECOPONTO' => $objEcoponto->getComplementoEcoponto(),
                        ':COD_ECOPONTO' => $objEcoponto->getCodEcoponto()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(EcoPonto $objEcoponto) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(EcoPontoDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_ECOPONTO' => $objEcoponto->getCodEcoponto()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = EcoPontoDAO::$SELECT_ALL;
            $stmt = $this->conn->query($sqlSelect);
            $numLinha = $stmt->rowCount();
            if($numLinha == 0) {
                $result = array('result', false);
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectId(EcoPonto $objEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcoPontoDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_ECOPONTO' => $objEcoponto->getCodEcoponto()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $ecoponto = new EcoPonto();
            $ecoponto->setCodEcoponto($result->COD_ECOPONTO);
            $ecoponto->setNomeEcoponto($result->NOME_ECOPONTO);
            $ecoponto->setHorarioFuncEcoponto($result->HORARIO_FUNC_ECOPONTO);
            $ecoponto->setCepEcoponto($result->CEP_ECOPONTO);
            $ecoponto->setLongitudeEcoponto($result->LONGITUDE_ECOPONTO);
            $ecoponto->setLatitudeEcoponto($result->LATITUDE_ECOPONTO);
            $ecoponto->setNumEcoponto($result->NUM_ECOPONTO);
            $ecoponto->setComplementoEcoponto($result->COMPLEMENTO_ECOPONTO);
            $ecoponto->setStatusEcoponto($result->STATUS_ECOPONTO);
            
            return $ecoponto;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectNameEcoponto(EcoPonto $objEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcoPontoDAO::$SELECT_NAME_ECOPONTO);
            $stmt->execute(
                    array(
                        ':NOME_ECOPONTO' => '%'.$objEcoponto->getNomeEcoponto().'%'
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

    public function selectHorarioFuncionamento(EcoPonto $objEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcoPontoDAO::$SELECT_HORARIO_FUNCIONAMENTO);
            $stmt->execute(
                    array(
                        ':HORARIO_FUNCIONAMENTO' => '%' . $objEcoponto->getHorarioFuncEcoponto() . '%'
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

    public function selectCep(EcoPonto $objEcoponto) {
        try {
            $stmt = $this->conn->prepare(EcoPontoDAO::$SELECT_CEP);
            $stmt->execute(
                    array(
                        ':CEP_ECOPONTO' => '%' . $objEcoponto->getCepEcoponto() . '%'
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
