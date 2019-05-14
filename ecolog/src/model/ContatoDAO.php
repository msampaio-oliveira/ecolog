<?php

namespace Model;
use Model\Contato;
use PDO;

class ContatoDAO {

    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    private static $SELECT_ALL = "SELECT CONTATO.COD_CONTATO, CONTATO.CONTATO, CONTATO.STATUS_CONTATO, TIPO_CONTATO.COD_TIPO_CONTATO, "
            . "TIPO_CONTATO.DESC_CONTATO, USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO "
            . "FROM CONTATO INNER JOIN TIPO_CONTATO ON CONTATO.COD_TIPO_CONTATO = TIPO_CONTATO.COD_TIPO_CONTATO "
            . "INNER JOIN USUARIO ON CONTATO.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE CONTATO.STATUS_CONTATO = 1";
    
    private static $SELECT_ID = "SELECT CONTATO.COD_CONTATO, CONTATO.CONTATO, CONTATO.STATUS_CONTATO, TIPO_CONTATO.COD_TIPO_CONTATO,"
            . "TIPO_CONTATO.DESC_CONTATO, USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO "
            . "FROM CONTATO INNER JOIN TIPO_CONTATO ON CONTATO.COD_TIPO_CONTATO = TIPO_CONTATO.COD_TIPO_CONTATO "
            . "INNER JOIN USUARIO ON CONTATO.COD_USUARIO = USUARIO.COD_USUARIO "
            . "WHERE CONTATO.STATUS_CONTATO = 1 AND CONTATO.COD_CONTATO = :COD_CONTATO";
    
    private static $SELECT_CONTACT = "SELECT  CONTATO.COD_CONTATO, CONTATO.CONTATO, CONTATO.COD_TIPO_CONTATO, CONTATO.STATUS_CONTATO, TIPO_CONTATO.DESC_CONTATO, "
            . " USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO FROM CONTATO INNER JOIN TIPO_CONTATO ON CONTATO.COD_TIPO_CONTATO = TIPO_CONTATO.COD_TIPO_CONTATO "
            . "INNER JOIN USUARIO ON CONTATO.COD_USUARIO = USUARIO.COD_USUARIO WHERE CONTATO.STATUS_CONTATO = 1 AND CONTATO.CONTATO LIKE :CONTATO";
     
        private static $SELECT_NAME_USER = "SELECT  CONTATO.COD_CONTATO, CONTATO.CONTATO , CONTATO.STATUS_CONTATO, CONTATO.COD_TIPO_CONTATO, TIPO_CONTATO.DESC_CONTATO, USUARIO.COD_USUARIO,"
                . "USUARIO.NOME_USUARIO FROM CONTATO INNER JOIN TIPO_CONTATO ON CONTATO.COD_TIPO_CONTATO = TIPO_CONTATO.COD_TIPO_CONTATO INNER JOIN USUARIO "
                . "ON CONTATO.COD_USUARIO = USUARIO.COD_USUARIO WHERE CONTATO.STATUS_CONTATO = 1 AND USUARIO.NOME_USUARIO LIKE :NOME_USUARIO";
    
    private static $INSERT = "INSERT INTO CONTATO (CONTATO, "
            . "COD_TIPO_CONTATO, "
            . "COD_USUARIO) "
            . "VALUES (:CONTATO, "
            . ":COD_TIPO_CONTATO, "
            . ":COD_USUARIO)";
    
    private static $UPDATE = "UPDATE CONTATO SET "
            . "CONTATO = :CONTATO, "
            . "COD_TIPO_CONTATO = :COD_TIPO_CONTATO, "
            . "COD_USUARIO = :COD_USUARIO "
            . "WHERE COD_CONTATO = :COD_CONTATO ";
    
    private static $DELETE = "UPDATE CONTATO SET STATUS_CONTATO = 0 WHERE COD_CONTATO = :COD_CONTATO";

    public function create(Contato $objContato) {
        $result = false;
        try {
            $prepareInsert = $this->conn->prepare(ContatoDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':CONTATO' => $objContato->getContato(),
                        ':COD_TIPO_CONTATO' => $objContato->getCodTipoContato(),
                        ':COD_USUARIO' => $objContato->getCodUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(Contato $objContato) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(ContatoDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':CONTATO' => $objContato->getContato(),
                        ':COD_TIPO_CONTATO' => $objContato->getCodTipoContato(),
                        ':COD_USUARIO' => $objContato->getCodUsuario(),
                        ':COD_CONTATO' => $objContato->getCodContato()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(Contato $objContato) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(ContatoDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_CONTATO' => $objContato->getCodContato()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = ContatoDAO::$SELECT_ALL;
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

    public function selectId(Contato $objContato) {
        try {
            $stmt = $this->conn->prepare(ContatoDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_CONTATO' => $objContato->getCodContato()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $contato = new Contato();
            $contato->setCodContato($result->COD_CONTATO);
            $contato->setContato($result->CONTATO);
            $contato->setStatusContato($result->STATUS_CONTATO);
            $contato->setCodTipoContato($result->COD_TIPO_CONTATO);
            $contato->setCodUsuario($result->COD_USUARIO);
            $contato->setNomeUsuario($result->NOME_USUARIO);
            return $contato;
            
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectContact(Contato $objContato) {
        try {
            $stmt = $this->conn->prepare(ContatoDAO::$SELECT_CONTACT);
            $stmt->execute(
                    array(
                        ':CONTATO' => '%' . $objContato->getContato() . '%'
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

    public function selectUserName(Contato $objContato) {
        try {
            $stmt = $this->conn->prepare(ContatoDAO::$SELECT_NAME_USER);
            $stmt->execute(
                    array(
                         ':NOME_USUARIO' => '%' . $objContato->getNomeUsuario() . '%'
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
