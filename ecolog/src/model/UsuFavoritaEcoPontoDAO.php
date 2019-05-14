<?php

namespace Model;
use Model\UsuFavoritaEcoPonto;
use PDO;

class UsuFavoritaEcoPontoDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_ALL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, "
            . "ECOPONTO.NOME_ECOPONTO, USU_FAVORITA_ECOPONTO.DATA_HORA_FAVORITA "
            . "FROM USU_FAVORITA_ECOPONTO INNER JOIN USUARIO ON USU_FAVORITA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN ECOPONTO ON USU_FAVORITA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO";
    
    private static $SELECT_ID_USER = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, "
            . "ECOPONTO.NOME_ECOPONTO, USU_FAVORITA_ECOPONTO.DATA_HORA_FAVORITA "
            . "FROM USU_FAVORITA_ECOPONTO INNER JOIN USUARIO ON USU_FAVORITA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN ECOPONTO ON USU_FAVORITA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO WHERE USUARIO.COD_USUARIO = :COD_USUARIO";
    
    private static $SELECT_ID_ECOPONTO = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, ECOPONTO.COD_ECOPONTO, "
            . "ECOPONTO.NOME_ECOPONTO, USU_FAVORITA_ECOPONTO.DATA_HORA_FAVORITA "
            . "FROM USU_FAVORITA_ECOPONTO INNER JOIN USUARIO ON USU_FAVORITA_ECOPONTO.COD_USUARIO = USUARIO.COD_USUARIO "
            . "INNER JOIN ECOPONTO ON USU_FAVORITA_ECOPONTO.COD_ECOPONTO = ECOPONTO.COD_ECOPONTO WHERE ECOPONTO.COD_ECOPONTO = :COD_ECOPONTO";
    
    private static $INSERT = "INSERT INTO USU_FAVORITA_ECOPONTO (COD_USUARIO, COD_ECOPONTO, DATA_HORA_FAVORITA)"
            . "VALUES (:COD_USUARIO, :COD_ECOPONTO, :DATA_HORA_FAVORITA)";
    
    private static $DELETE = "DELETE FROM USU_FAVORITA_ECOPONTO WHERE COD_USUARIO = :COD_USUARIO AND COD_ECOPONTO = :COD_ECOPONTO";

    public function create(UsuFavoritaEcoPonto $objUsuEcoponto) {
        try {
            $result = false;
            $prepareInsert = $this->conn->prepare(UsuFavoritaEcoPontoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':COD_USUARIO' => $objUsuEcoponto->getCodUsuario(),
                        ':COD_ECOPONTO' => $objUsuEcoponto->getCodEcoponto(),
                        ':DATA_HORA_FAVORITA' => $objUsuEcoponto->getDataHoraFavorita()
                    )
            );
            return $result;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function delete(UsuFavoritaEcoPonto $objUsuEcoponto) {
        try {
            $result = false;
            $prepareDelete = $this->conn->prepare(UsuFavoritaEcoPontoDAO::$DELETE);
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
            $stmt = $this->conn->prepare(UsuFavoritaEcoPontoDAO::$SELECT_ALL);
            $stmt->execute();
            $numLinha = $stmt->rowCount();
            if ($numLinha == 0) {
                $result = array('result' => 'false');
            } else {
                $result = $stmt->fetchAll();
            }
            return json_encode($result);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectIdUser(UsuFavoritaEcoPonto $objUsuEcoponto) {
        try {
            $stmt = $this->conn->prepare(UsuFavoritaEcoPontoDAO::$SELECT_ID_USER);
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
    
    public function selectIdEcoponto(UsuFavoritaEcoPonto $objUsuEcoponto) {
        try {
            $stmt = $this->conn->prepare(UsuFavoritaEcoPontoDAO::$SELECT_ID_ECOPONTO);
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
