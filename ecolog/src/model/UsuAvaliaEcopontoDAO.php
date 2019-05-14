<?php

namespace Model;
use Model\UsuAvaliaEcoponto;
use PDO;

class UsuAvaliaEcopontoDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, "
            . " USU_AVALIA_ECOPONTO.NOTA_AVALIACAO, USU_AVALIA_ECOPONTO.OBS_AVALIACAO, USU_AVALIA_ECOPONTO.DATA_HORA_AVALIACAO FROM USU_AVALIA_ECOPONTO "
            . " INNER JOIN USUARIO ON USU_AVALIA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . " INNER JOIN ECOPONTO ON USU_AVALIA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO";
    
    private static $SELECT_ID_USER = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, "
            . " USU_AVALIA_ECOPONTO.NOTA_AVALIACAO, USU_AVALIA_ECOPONTO.OBS_AVALIACAO, USU_AVALIA_ECOPONTO.DATA_HORA_AVALIACAO FROM USU_AVALIA_ECOPONTO "
            . " INNER JOIN USUARIO ON USU_AVALIA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . " INNER JOIN ECOPONTO ON USU_AVALIA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO WHERE USUARIO.COD_USUARIO = :COD_USUARIO";
    
    private static $SELECT_ID_ECOPONTO = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, ECOPONTO.NOME_ECOPONTO, "
            . " USU_AVALIA_ECOPONTO.NOTA_AVALIACAO, USU_AVALIA_ECOPONTO.OBS_AVALIACAO, USU_AVALIA_ECOPONTO.DATA_HORA_AVALIACAO FROM USU_AVALIA_ECOPONTO "
            . " INNER JOIN USUARIO ON USU_AVALIA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . " INNER JOIN ECOPONTO ON USU_AVALIA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO WHERE ECOPONTO.COD_ECOPONTO = :COD_ECOPONTO";
    
    private static $INSERT = "INSERT INTO USU_AVALIA_ECOPONTO (COD_USUARIO, COD_ECOPONTO, NOTA_AVALIACAO, OBS_AVALIACAO, DATA_HORA_AVALIACAO)"
            . " VALUES (:COD_USUARIO, :COD_ECOPONTO, :NOTA_AVALIACAO, :OBS_AVALIACAO, :DATA_HORA_AVALIACAO)";
    
    private static $UPDATE = "UPDATE USU_AVALIA_ECOPONTO SET NOTA_AVALIACAO = :NOTA_AVALIACAO , OBS_AVALIACAO = :OBS_AVALIACAO,"
            . " DATA_HORA_AVALIACAO = :DATA_HORA_AVALIACAO WHERE COD_USUARIO = :COD_USUARIO AND COD_ECOPONTO = :COD_ECOPONTO";
    
    private static $DELETE = "DELETE FROM USU_AVALIA_ECOPONTO WHERE COD_USUARIO = :COD_USUARIO AND COD_ECOPONTO = :COD_ECOPONTO";

    public function create(UsuAvaliaEcoponto $objUsuEcoponto) {
        try {
            $result = false;
            $prepareInsert = $this->conn->prepare(UsuAvaliaEcopontoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':COD_USUARIO' => $objUsuEcoponto->getCodUsuario(),
                        ':COD_ECOPONTO' => $objUsuEcoponto->getCodEcoponto(),
                        ':NOTA_AVALIACAO' => $objUsuEcoponto->getNotaAvaliacao(),
                        ':OBS_AVALIACAO' => $objUsuEcoponto->getObsAvaliacao(),
                        ':DATA_HORA_AVALIACAO' => $objUsuEcoponto->getDataHoraAvaliacao()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function update(UsuAvaliaEcoponto $objUsuEcoponto) {
        try {
            $result = false;
            $prepareUpdate = $this->conn->prepare(UsuAvaliaEcopontoDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':COD_USUARIO' => $objUsuEcoponto->getCodUsuario(),
                        ':COD_ECOPONTO' => $objUsuEcoponto->getCodEcoponto(),
                        ':NOTA_AVALIACAO' => $objUsuEcoponto->getNotaAvaliacao(),
                        ':OBS_AVALIACAO' => $objUsuEcoponto->getObsAvaliacao(),
                        ':DATA_HORA_AVALIACAO' => $objUsuEcoponto->getDataHoraAvaliacao()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(UsuAvaliaEcoponto $objUsuEcoponto) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(UsuAvaliaEcopontoDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_USUARIO' => $objUsuEcoponto->getCodUsuario(),
                        ':COD_ECOPONTO' => $objUsuEcoponto->getCodEcoponto()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $stmt = $this->conn->query(UsuAvaliaEcopontoDAO::$SELECT_ALL);
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

    public function selectIdUser(UsuAvaliaEcoponto $objUsuEcoponto) {
        try {
            $stmt = $this->conn->prepare(UsuAvaliaEcopontoDAO::$SELECT_ID_USER);
            $stmt->execute(
                    array(
                        ':COD_USUARIO' => $objUsuEcoponto->getCodUsuario()
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
    
    public function selectIdEcoponto(UsuAvaliaEcoponto $objUsuEcoponto) {
        try {
            $stmt = $this->conn->prepare(UsuAvaliaEcopontoDAO::$SELECT_ID_ECOPONTO);
            $stmt->execute(
                    array(
                        ':COD_ECOPONTO' => $objUsuEcoponto->getCodEcoponto()
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
