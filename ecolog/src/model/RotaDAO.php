<?php

namespace Model;
use Model\Rota;
use PDO;

class RotaDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE STATUS_ROTA = 1";
    
    private static $SELECT_ID = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE ROTA.COD_ROTA = :COD_ROTA AND STATUS_ROTA = 1";
    
    private static $SELECT_USER_NAME = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE USUARIO.NOME_USUARIO LIKE :NOME_USUARIO AND STATUS_ROTA = 1";
    
    private static $SELECT_CEP_INICIAL = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE ROTA.CEP_INICIAL_ROTA = :CEP_INICIAL AND STATUS_ROTA = 1";
    
    private static $SELECT_CEP_FINAL = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE ROTA.CEP_FINAL_ROTA = :CEP_FINAL AND STATUS_ROTA = 1";
    
    private static $SELECT_CEP_INICIAL_AND_FINAL = "SELECT ROTA.COD_ROTA, ROTA.CEP_INICIAL_ROTA, ROTA. LATITUDE_INICIAL_ROTA, "
            . "ROTA.LONGITUDE_INICIAL_ROTA, ROTA.CEP_FINAL_ROTA, ROTA.LATITUDE_FINAL_ROTA, "
            . "ROTA.LONGITUDE_FINAL_ROTA, ROTA.DATA_CAD_ROTA, ROTA.OBS_ROTA, "
            . "USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ROTA.STATUS_ROTA "
            . "FROM ROTA INNER JOIN USUARIO "
            . "ON ROTA.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE ROTA.CEP_INICIAL_ROTA = :CEP_INICIAL AND ROTA.CEP_FINAL_ROTA = :CEP_FINAL AND STATUS_ROTA = 1";
    
    private static $INSERT = "INSERT INTO ROTA (CEP_INICIAL_ROTA, LATITUDE_INICIAL_ROTA, LONGITUDE_INICIAL_ROTA, CEP_FINAL_ROTA, LATITUDE_FINAL_ROTA, "
            . "LONGITUDE_FINAL_ROTA, DATA_CAD_ROTA, OBS_ROTA, COD_USUARIO)"
            . "VALUES (:CEP_INICIAL_ROTA, :LATITUDE_INICIAL_ROTA, :LONGITUDE_INICIAL_ROTA, :CEP_FINAL_ROTA, :LATITUDE_FINAL_ROTA,"
            . ":LONGITUDE_FINAL_ROTA, :DATA_CAD_ROTA, :OBS_ROTA, :COD_USUARIO)";
    
    private static $UPDATE = "UPDATE ROTA SET CEP_INICIAL_ROTA = :CEP_INICIAL_ROTA, LATITUDE_INICIAL_ROTA = :LATITUDE_INICIAL_ROTA, LONGITUDE_INICIAL_ROTA = :LONGITUDE_INICIAL_ROTA, "
            . "CEP_FINAL_ROTA = :CEP_FINAL_ROTA, LATITUDE_FINAL_ROTA = :LATITUDE_FINAL_ROTA, LONGITUDE_FINAL_ROTA = :LONGITUDE_FINAL_ROTA, "
            . "DATA_CAD_ROTA = :DATA_CAD_ROTA, OBS_ROTA = :OBS_ROTA, COD_USUARIO = :COD_USUARIO "
            . "WHERE COD_ROTA = :COD_ROTA AND STATUS_ROTA = 1";
    
    private static $DELETE = "UPDATE ROTA SET STATUS_ROTA = 0 WHERE COD_ROTA = :COD_ROTA";

    public function create(Rota $objRota) {
        try {
            $result = false;
            $prepareInsert = $this->conn->prepare(RotaDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':CEP_INICIAL_ROTA' => $objRota->getCepInicialRota(),
                        ':LATITUDE_INICIAL_ROTA' => $objRota->getLatitudeInicialRota(),
                        ':LONGITUDE_INICIAL_ROTA' => $objRota->getLongitudeInicialRota(),
                        ':CEP_FINAL_ROTA' => $objRota->getCepFinalRota(),
                        ':LATITUDE_FINAL_ROTA' => $objRota->getLatitudeFinalRota(),
                        ':LONGITUDE_FINAL_ROTA' => $objRota->getLongitudeFinalRota(),
                        ':DATA_CAD_ROTA' => $objRota->getDataCadRota(),
                        ':OBS_ROTA' => $objRota->getObsRota(),
                        ':COD_USUARIO' => $objRota->getCodUsuario()
                    )
            );
  
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function update(Rota $objRota) {
        try {
            $result = false;
            $preapreUpdate = $this->conn->prepare(RotaDAO::$UPDATE);
            $result = $preapreUpdate->execute(
                    array(
                        ':CEP_INICIAL_ROTA' => $objRota->getCepInicialRota(),
                        ':LATITUDE_INICIAL_ROTA' => $objRota->getLatitudeInicialRota(),
                        ':LONGITUDE_INICIAL_ROTA' => $objRota->getLongitudeInicialRota(),
                        ':CEP_FINAL_ROTA' => $objRota->getCepFinalRota(),
                        ':LATITUDE_FINAL_ROTA' => $objRota->getLatitudeFinalRota(),
                        ':LONGITUDE_FINAL_ROTA' => $objRota->getLongitudeFinalRota(),
                        ':DATA_CAD_ROTA' => $objRota->getDataCadRota(),
                        ':OBS_ROTA' => $objRota->getObsRota(),
                        ':COD_USUARIO' => $objRota->getCodUsuario(),
                        ':COD_ROTA' => $objRota->getCodRota()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(Rota $objRota) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(RotaDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_ROTA' => $objRota->getCodRota()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $querySelect = RotaDAO::$SELECT_ALL;
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

    public function selectId(Rota $objRota) {
        try {
            $stmt = $this->conn->prepare(RotaDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_ROTA' => $objRota->getCodRota()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            $rota = new Rota();
            $rota->setCodRota($result->COD_ROTA);
            $rota->setCepInicialRota($result->CEP_INICIAL_ROTA);
            $rota->setLatitudeInicialRota($result->LATITUDE_INICIAL_ROTA);
            $rota->setLongitudeInicialRota($result->LONGITUDE_INICIAL_ROTA);
            $rota->setCepFinalRota($result->CEP_FINAL_ROTA);
            $rota->setLatitudeFinalRota($result->LATITUDE_FINAL_ROTA);
            $rota->setLongitudeFinalRota($result->LONGITUDE_FINAL_ROTA);
            $rota->setDataCadRota($result->DATA_CAD_ROTA);
            $rota->setObsRota($result->OBS_ROTA);
            $rota->setCodUsuario($result->COD_USUARIO);
            $rota->setNomeUsuario($result->NOME_USUARIO);
            $rota->setStatusRota($result->STATUS_ROTA);
           
            return $rota;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectUserName(Rota $objRota) {
        try {
            $stmt = $this->conn->prepare(RotaDAO::$SELECT_USER_NAME);
            $stmt->execute(
                    array(
                        ':NOME_USUARIO' => '%' . $objRota->getNomeUsuario() . '%'
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

    public function selectCepInicial(Rota $objRota) {
        try {
            $stmt = $this->conn->prepare(RotaDAO::$SELECT_CEP_INICIAL);
            $stmt->execute(
                    array(
                        ':CEP_INICIAL' => $objRota->getCepInicialRota()
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
    
    public function selectCepFinal(Rota $objRota) {
        try {
            $stmt = $this->conn->prepare(RotaDAO::$SELECT_CEP_FINAL);
            $stmt->execute(
                    array(
                        ':CEP_FINAL' => $objRota->getCepFinalRota()
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
    
    public function selectCepInicialAndFinal(Rota $objRota) {
        try {
            $stmt = $this->conn->prepare(RotaDAO::$SELECT_CEP_INICIAL_AND_FINAL);
            $stmt->execute(
                    array(
                        ':CEP_INICIAL' => $objRota->getCepInicialRota(),
                        ':CEP_FINAL' => $objRota->getCepFinalRota()
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
