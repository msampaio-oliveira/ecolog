<?php

namespace Model;

use Model\Usuario;
use PDO;

class UsuarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private static $SELECT_EXIST_LOGIN = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO FROM USUARIO WHERE LOGIN_USUARIO = :LOGIN_USUARIO AND STATUS_USUARIO = 1";
    private static $SELECT_EXIST = "SELECT USUARIO.NOME_USUARIO FROM USUARIO WHERE DOC_USUARIO = :DOC_USUARIO AND STATUS_USUARIO = 1";
    private static $SELECT_AUTENTICACAO = "SELECT * FROM USUARIO WHERE LOGIN_USUARIO = :LOGIN_USUARIO AND STATUS_USUARIO = 1";
    private static $SELECT_AUTENTICACAO_SEM_CRIPTOGRAFIA = "SELECT * FROM USUARIO WHERE LOGIN_USUARIO = :LOGIN_USUARIO AND SENHA_USUARIO = :SENHA_USUARIO AND STATUS_USUARIO = 1";
    private static $SELECET_ALL = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO, "
            . "USUARIO.SENHA_USUARIO, USUARIO.DOC_USUARIO, USUARIO.COD_TIPO_DOCUMENTO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO,"
            . "USUARIO.COMPLEMENTO_USUARIO,  USUARIO.STATUS_USUARIO, TIPO_USUARIO.COD_TIPO_USUARIO, TIPO_USUARIO.NOME_TIPO_USUARIO "
            . "FROM USUARIO INNER JOIN TIPO_USUARIO "
            . "ON USUARIO.COD_TIPO_USUARIO = TIPO_USUARIO.COD_TIPO_USUARIO WHERE USUARIO.STATUS_USUARIO = 1";
    private static $SELECT_ID = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO,"
            . " USUARIO.SENHA_USUARIO, USUARIO.DOC_USUARIO, USUARIO.COD_TIPO_DOCUMENTO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO,"
            . " USUARIO.COMPLEMENTO_USUARIO, USUARIO.STATUS_USUARIO, TIPO_USUARIO.COD_TIPO_USUARIO, TIPO_USUARIO.NOME_TIPO_USUARIO,"
            . " USUARIO.URL_FOTO_USUARIO, USUARIO.LONGITUDE_USUARIO, USUARIO.LATITUDE_USUARIO"
            . " FROM USUARIO INNER JOIN TIPO_USUARIO "
            . " ON USUARIO.COD_TIPO_USUARIO = TIPO_USUARIO.COD_TIPO_USUARIO WHERE USUARIO.STATUS_USUARIO = 1"
            . " AND USUARIO.COD_USUARIO = :COD_USUARIO";
    private static $SELECT_NAME = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO, "
            . " USUARIO.SENHA_USUARIO, USUARIO.DOC_USUARIO, USUARIO.COD_TIPO_DOCUMENTO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, "
            . "USUARIO.COMPLEMENTO_USUARIO,  USUARIO.STATUS_USUARIO, TIPO_USUARIO.COD_TIPO_USUARIO, TIPO_USUARIO.NOME_TIPO_USUARIO "
            . " FROM USUARIO INNER JOIN TIPO_USUARIO "
            . " ON USUARIO.COD_TIPO_USUARIO = TIPO_USUARIO.COD_TIPO_USUARIO WHERE USUARIO.STATUS_USUARIO = 1 AND USUARIO.NOME_USUARIO LIKE :NOME_USUARIO";
    private static $SELECT_USER_CEP = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO, "
            . "USUARIO.SENHA_USUARIO, USUARIO.DOC_USUARIO, USUARIO.COD_TIPO_DOCUMENTO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, "
            . "USUARIO.COMPLEMENTO_USUARIO,  USUARIO.STATUS_USUARIO, TIPO_USUARIO.COD_TIPO_USUARIO, TIPO_USUARIO.NOME_TIPO_USUARIO "
            . "FROM USUARIO INNER JOIN TIPO_USUARIO "
            . "ON USUARIO.COD_TIPO_USUARIO = TIPO_USUARIO.COD_TIPO_USUARIO WHERE USUARIO.STATUS_USUARIO = 1 AND USUARIO.CEP_USUARIO LIKE :CEP_USUARIO";
    private static $SELECT_USER_TIPO = "SELECT USUARIO.COD_USUARIO, USUARIO.NOME_USUARIO, USUARIO.LOGIN_USUARIO, "
            . "USUARIO.SENHA_USUARIO, USUARIO.DOC_USUARIO, USUARIO.COD_TIPO_DOCUMENTO, USUARIO.CEP_USUARIO, USUARIO.NUM_USUARIO, "
            . "USUARIO.COMPLEMENTO_USUARIO,  USUARIO.STATUS_USUARIO, TIPO_USUARIO.COD_TIPO_USUARIO, TIPO_USUARIO.NOME_TIPO_USUARIO FROM USUARIO INNER JOIN "
            . "TIPO_USUARIO ON USUARIO.COD_TIPO_USUARIO = TIPO_USUARIO.COD_TIPO_USUARIO WHERE  USUARIO.STATUS_USUARIO = 1 "
            . "AND TIPO_USUARIO.NOME_TIPO_USUARIO = :NOME_TIPO_USUARIO";
    private static $INSERT = "INSERT INTO USUARIO "
            . "(NOME_USUARIO,"
            . "LOGIN_USUARIO,"
            . "SENHA_USUARIO,"
            . "DOC_USUARIO,"
            . "COD_TIPO_DOCUMENTO,"
            . "CEP_USUARIO,"
            . "NUM_USUARIO,"
            . "COMPLEMENTO_USUARIO,"
            . "COD_TIPO_USUARIO,"
            . "URL_FOTO_USUARIO,"
            . "LONGITUDE_USUARIO,"
            . "LATITUDE_USUARIO) "
            . "VALUES "
            . "(:NOME_USUARIO,"
            . ":LOGIN_USUARIO,"
            . ":SENHA_USUARIO,"
            . ":DOC_USUARIO,"
            . ":COD_TIPO_DOCUMENTO,"
            . ":CEP_USUARIO,"
            . ":NUM_USUARIO,"
            . ":COMPLEMENTO_USUARIO,"
            . ":COD_TIPO_USUARIO,"
            . ":URL_FOTO_USUARIO,"
            . ":LONGITUDE_USUARIO,"
            . ":LATITUDE_USUARIO)";
    private static $UPDATE = "UPDATE USUARIO SET NOME_USUARIO = :NOME_USUARIO,"
            . "LOGIN_USUARIO = :LOGIN_USUARIO,"
            . "DOC_USUARIO = :DOC_USUARIO,"
            . "COD_TIPO_DOCUMENTO = :COD_TIPO_DOCUMENTO,"
            . "CEP_USUARIO = :CEP_USUARIO,"
            . "NUM_USUARIO = :NUM_USUARIO,"
            . "COMPLEMENTO_USUARIO = :COMPLEMENTO_USUARIO,"
            . "COD_TIPO_USUARIO = :COD_TIPO_USUARIO,"
            . "URL_FOTO_USUARIO = :URL_FOTO_USUARIO,"
            . "LONGITUDE_USUARIO = :LONGITUDE_USUARIO,"
            . "LATITUDE_USUARIO = :LATITUDE_USUARIO "
            . "WHERE COD_USUARIO = :COD_USUARIO";
    private static $DELETE = "UPDATE USUARIO SET STATUS_USUARIO = 0 WHERE COD_USUARIO = :COD_USUARIO";
    private static $SELECT_ID_UPDATE = "SELECT * FROM USUARIO WHERE COD_USUARIO = :COD_USUARIO";
    private static $SELECT_SENHA = "SELECT SENHA_USUARIO FROM USUARIO WHERE COD_USUARIO = :COD_USUARIO AND STATUS_USUARIO = 1";
    private static $UPDATE_SENHA = "UPDATE USUARIO SET SENHA_USUARIO = :SENHA_USUARIO WHERE COD_USUARIO = :COD_USUARIO";

    public function create(Usuario $objUsuario) {
        $result = false;
        try {
            if ($this->exist($objUsuario->getDocUsuario())) {
                return $result;
            }
            $prepareInsert = $this->conn->prepare(UsuarioDAO::$INSERT);
            $result = $prepareInsert->execute(
                    array(
                        ':NOME_USUARIO' => $objUsuario->getNomeUsuario(),
                        ':LOGIN_USUARIO' => $objUsuario->getLoginUsuario(),
                        ':SENHA_USUARIO' => $objUsuario->getSenhaUsuario(),
                        ':DOC_USUARIO' => $objUsuario->getDocUsuario(),
                        ':COD_TIPO_DOCUMENTO' => $objUsuario->getCodTipoDocumento(),
                        ':CEP_USUARIO' => $objUsuario->getCepUsuario(),
                        ':NUM_USUARIO' => $objUsuario->getNumUsuario(),
                        ':COMPLEMENTO_USUARIO' => $objUsuario->getComplementoUsuario(),
                        ':COD_TIPO_USUARIO' => $objUsuario->getCodTipoUsuario(),
                        ':URL_FOTO_USUARIO' => $objUsuario->getUrlFotoUsuario(),
                        ':LONGITUDE_USUARIO' => $objUsuario->getLongitudeUsuario(),
                        ':LATITUDE_USUARIO' => $objUsuario->getLatitudeUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function update(Usuario $objUsuario) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(UsuarioDAO::$UPDATE);
            $result = $prepareUpdate->execute(
                    array(
                        ':NOME_USUARIO' => $objUsuario->getNomeUsuario(),
                        ':LOGIN_USUARIO' => $objUsuario->getLoginUsuario(),
                        ':DOC_USUARIO' => $objUsuario->getDocUsuario(),
                        ':COD_TIPO_DOCUMENTO' => $objUsuario->getCodTipoDocumento(),
                        ':CEP_USUARIO' => $objUsuario->getCepUsuario(),
                        ':NUM_USUARIO' => $objUsuario->getNumUsuario(),
                        ':COMPLEMENTO_USUARIO' => $objUsuario->getComplementoUsuario(),
                        ':COD_TIPO_USUARIO' => $objUsuario->getCodTipoUsuario(),
                        ':COD_USUARIO' => $objUsuario->getCodUsuario(),
                        ':URL_FOTO_USUARIO' => $objUsuario->getUrlFotoUsuario(),
                        ':LONGITUDE_USUARIO' => $objUsuario->getLongitudeUsuario(),
                        ':LATITUDE_USUARIO' => $objUsuario->getLatitudeUsuario()
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function delete(Usuario $objUsuario) {
        $result = false;
        try {
            $prepareDelete = $this->conn->prepare(UsuarioDAO::$DELETE);
            $result = $prepareDelete->execute(
                    array(
                        ':COD_USUARIO' => $objUsuario->getCodUsuario()
                    )
            );

            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectAll() {
        try {
            $sqlSelect = UsuarioDAO::$SELECET_ALL;
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

    public function selectId(Usuario $objUsuario) {
        try {
            $stmt = $this->conn->prepare(UsuarioDAO::$SELECT_ID);
            $stmt->execute(
                    array(
                        ':COD_USUARIO' => $objUsuario->getCodUsuario()
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $usuario = new Usuario();
            $usuario->setCodTipoUsuario($result->COD_TIPO_USUARIO);
            $usuario->setNomeTipoUsuario($result->NOME_TIPO_USUARIO);
            $usuario->setCodUsuario($result->COD_USUARIO);
            $usuario->setNomeUsuario($result->NOME_USUARIO);
            $usuario->setLoginUsuario($result->LOGIN_USUARIO);
            $usuario->setSenhaUsuario($result->SENHA_USUARIO);
            $usuario->setDocUsuario($result->DOC_USUARIO);
            $usuario->setCodTipoDocumento($result->COD_TIPO_DOCUMENTO);
            $usuario->setCepUsuario($result->CEP_USUARIO);
            $usuario->setNumUsuario($result->NUM_USUARIO);
            $usuario->setComplementoUsuario($result->COMPLEMENTO_USUARIO);
            $usuario->setStatusUsuario($result->STATUS_USUARIO);
            $usuario->setUrlFotoUsuario($result->URL_FOTO_USUARIO);
            $usuario->setLatitudeUsuario($result->LATITUDE_USUARIO);
            $usuario->setLongitudeUsuario($result->LONGITUDE_USUARIO);

            return $usuario;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

    public function selectName(Usuario $objUsuario) {
        try {
            $stmt = $this->conn->prepare(UsuarioDAO::$SELECT_NAME);
            $stmt->execute(
                    array(
                        ':NOME_USUARIO' => '%' . $objUsuario->getNomeUsuario() . '%'
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

    public function selecetUserCep(Usuario $objUsuario) {
        try {
            $stmt = $this->conn->prepare(UsuarioDAO::$SELECT_USER_CEP);
            $stmt->execute(
                    array(
                        ':CEP_USUARIO' => '%' . $objUsuario->getCepUsuario() . '%'
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

    public function selectUserTipo(Usuario $objUsuario) {
        try {
            $stmt = $this->conn->prepare(UsuarioDAO::$SELECT_USER_TIPO);
            $stmt->execute(
                    array(
                        ':NOME_TIPO_USUARIO' => $objUsuario->getNomeTipoUsuario()
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

    // SC = Sem criptografia
    public function autenticarUsuarioSC($login, $senha) {
        $usuario = false;
        try {
            $stmtSelect = $this->conn->prepare(UsuarioDAO::$SELECT_AUTENTICACAO_SEM_CRIPTOGRAFIA);
            $result = $stmtSelect->execute(
                    array(
                        ':LOGIN_USUARIO' => $login,
                        ':SENHA_USUARIO' => $senha
                    )
            );
            $numLinha = $stmtSelect->rowCount();
            if ($result && $numLinha == 1) {
                $usuario = $stmtSelect->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }
        return $usuario;
    }

    public function autenticar($login, $senha) {
        $result = false;
        try {
            $stmtSelect = $this->conn->prepare(UsuarioDAO::$SELECT_AUTENTICACAO);
            $resultSelect = $stmtSelect->execute(
                    array(
                        ':LOGIN_USUARIO' => $login
                    )
            );
            $numLinha = $stmtSelect->rowCount();
            if ($resultSelect && $numLinha == 1) {
                $usuario = $stmtSelect->fetch(PDO::FETCH_OBJ);
                $senhaBanco = $usuario->SENHA_USUARIO;

                if (\Util\Bcrypt::check($senha, $senhaBanco)) {
                    $result = $usuario;
                }
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
        return $result;
    }

    public function exist($documento) {
        $result = false;
        $exist = false;
        try {
            $prepareSelect = $this->conn->prepare(UsuarioDAO::$SELECT_EXIST);
            $result = $prepareSelect->execute(
                    array(
                        ':DOC_USUARIO' => $documento
                    )
            );
            $numLinha = $prepareSelect->rowCount();
            if ($numLinha == 1) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function existLogin($login, $return = 0) {
        $exist = false;
        try {
            $prepareSelect = $this->conn->prepare(UsuarioDAO::$SELECT_EXIST_LOGIN);
            $prepareSelect->execute(
                    array(
                        ':LOGIN_USUARIO' => $login
                    )
            );
            $numLinha = $prepareSelect->rowCount();
            if ($numLinha == 1) {
                $exist = true;
            }

            if ($return == 1) {
                if ($numLinha == 1) {
                    return json_encode($prepareSelect->fetchAll());
                } else if ($numLinha == 0) {
                    return null;
                }
            } else {
                return $exist;
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    public function selectUpdate($cod) {
        $result = false;
        try {
            $stmtSelect = $this->conn->prepare(UsuarioDAO::$SELECT_ID_UPDATE);
            $resultSelect = $stmtSelect->execute(
                    array(
                        ':COD_USUARIO' => $cod
                    )
            );
            $numLinha = $stmtSelect->rowCount();
            if ($resultSelect && $numLinha == 1) {
                $usuario = $stmtSelect->fetch(PDO::FETCH_OBJ);
                $result = $usuario;
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
        return $result;
    }

    public function selectSenha($id, $senha) {
        $result = false;
        try {
            $stmtSelect = $this->conn->prepare(UsuarioDAO::$SELECT_SENHA);
            $resultSelect = $stmtSelect->execute(
                    array(
                        ':COD_USUARIO' => $id
                    )
            );
            $numLinha = $stmtSelect->rowCount();
            if ($resultSelect && $numLinha == 1) {
                $usuario = $stmtSelect->fetch(PDO::FETCH_OBJ);
                $senhaBanco = $usuario->SENHA_USUARIO;

                if (\Util\Bcrypt::check($senha, $senhaBanco)) {
                    $result = true;
                }
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
        return $result;
    }

    public function updateSenha($senha, $cod) {
        $result = false;
        try {
            $prepareUpdate = $this->conn->prepare(UsuarioDAO::$UPDATE_SENHA);
            $result = $prepareUpdate->execute(
                    array(
                        ':SENHA_USUARIO' => $senha,
                        ':COD_USUARIO' => $cod
                    )
            );
            return $result;
        } catch (PDOException $ex) {
            var_dump($ex);
        }
    }

}
