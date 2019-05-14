<?php

namespace Controller;

use Model;
use PDO;

require_once("vendor/phpmailer/class.phpmailer.php");

class UsuarioController {

    // Atributos
    private $usuario;
    private $usuarioDAO;
    private $lista = "on";
    private $fomulario = "off";
    private $acaoGET;
    private $acaoPOST; // 1 Grava || 2 Altera
    private $login; // 1 Efetua login apos cadastrar
    private $txtSenhaUsuarioSemCriptografia;
    private $conn;

    // Construtor

    public function __construct(PDO $conn) {
        $this->usuario = new Model\Usuario();
        $this->usuarioDAO = new Model\UsuarioDAO($conn);
        $this->conn = $conn;
        $this->verificaTipoAcao();
    }

    //Métodos GETTERS e SETTERS
    function getUsuario() {

        return $this->usuario;
    }

    function getUsuarioDAO() {
        return $this->usuarioDAO;
    }

    function getLista() {
        return $this->lista;
    }

    function getFomulario() {
        return $this->fomulario;
    }

    function getAcaoGET() {
        return $this->acaoGET;
    }

    function getAcaoPOST() {
        return $this->acaoPOST;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setLista($lista) {
        $this->lista = $lista;
    }

    public function setFomulario($fomulario) {
        $this->fomulario = $fomulario;
    }

    function setUsuarioDAO($usuarioDAO) {
        $this->usuarioDAO = $usuarioDAO;
    }

    function setAcaoGET($acaoGET) {
        $this->acaoGET = $acaoGET;
    }

    function setAcaoPOST($acaoPOST) {
        $this->acaoPOST = $acaoPOST;
    }

    // Métodos Especialistas 
    public function recuperarDadosFormulario() {

        $txtCodTipoUsuario = isset($_POST['txtCodTipoUsuario']) ? $_POST['txtCodTipoUsuario'] : null;
        $txtCodUsuario = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
        $txtNomeUsuario = isset($_POST['txtNomeUsuario']) ? $_POST['txtNomeUsuario'] : null;
        $txtLoginUsuario = isset($_POST['txtLoginUsuario']) ? $_POST['txtLoginUsuario'] : null;
        $txtSenhaUsuario = isset($_POST['txtSenhaUsuario']) ? $_POST['txtSenhaUsuario'] : null;
        $txtDocUsuario = isset($_POST['txtDocUsuario']) ? $_POST['txtDocUsuario'] : null;
        $txtCodTipoDocumento = isset($_POST['txtCodTipoDocumento']) ? $_POST['txtCodTipoDocumento'] : null;
        $txtCepUsuario = isset($_POST['txtCep']) ? $_POST['txtCep'] : null;
        $txtNumUsuario = isset($_POST['txtNumero']) ? $_POST['txtNumero'] : null;
        $txtComplementoUsuario = isset($_POST['txtComplementoUsuario']) ? $_POST['txtComplementoUsuario'] : null;
        $txtFotoUsuario = isset($_FILES['arquivo']['name']) ? "public/upload/" . $_FILES['arquivo']['name'] : null;
        $txtLongitude = isset($_POST['txtLongitude']) ? $_POST['txtLongitude'] : null;
        $txtLatitude = isset($_POST['txtLatitude']) ? $_POST['txtLatitude'] : null;
        $this->txtSenhaUsuarioSemCriptografia = $txtSenhaUsuario;

        if ($txtFotoUsuario === "public/upload/") {
            $fotoSalva = isset($_POST['txtFotoSalva']) ? $_POST['txtFotoSalva'] : null;

            if ($fotoSalva != "" && $fotoSalva != null) {
                $txtFotoUsuario = $fotoSalva;
            } else {
                $txtFotoUsuario .= "img_user.png";
            }
        }

        if ($txtCodTipoUsuario != null && $txtNomeUsuario != null && $txtLoginUsuario != null && $txtDocUsuario != null && $txtCodTipoDocumento != null && $txtCepUsuario != null && $txtNumUsuario != null && $txtLongitude != null && $txtLatitude != null) {

            //Encriptando a senha do usuário 
            $hashSenha = \Util\Bcrypt::hash(trim($txtSenhaUsuario));

            $usuario = new Model\Usuario();
            $usuario->setCodUsuario($txtCodUsuario);
            $usuario->setNomeUsuario(trim($txtNomeUsuario));
            $usuario->setLoginUsuario(trim($txtLoginUsuario));
            $usuario->setSenhaUsuario($hashSenha); //Senha Enciptada 
            $usuario->setDocUsuario(trim($txtDocUsuario));
            $usuario->setCodTipoDocumento($txtCodTipoDocumento);
            $usuario->setCepUsuario(trim(str_replace("-", "", $txtCepUsuario)));
            $usuario->setNumUsuario(trim($txtNumUsuario));
            $usuario->setComplementoUsuario(trim($txtComplementoUsuario));
            $usuario->setCodTipoUsuario($txtCodTipoUsuario);
            $usuario->setUrlFotoUsuario($txtFotoUsuario);
            $usuario->setLongitudeUsuario($txtLongitude);
            $usuario->setLatitudeUsuario($txtLatitude);
            $this->usuario = $usuario;
        }
    }

    public function gravarAlterar() {

        if ($this->acaoPOST == 5) {
            $id = isset($_POST['txtCodUsuario']) ? $_POST['txtCodUsuario'] : null;
            $senha = isset($_POST['txtSenhaUsuarioNova']) ? $_POST['txtSenhaUsuarioNova'] : null;
            if ($senha != null && $id != null) {
                $hashSenha = \Util\Bcrypt::hash(trim($senha));
                $this->usuarioDAO->updateSenha($hashSenha, $id);
                header("Location: " . _URLBASE_ . "index.php?&mensagem=sucesso");
            }
            return;
        }

        if ($this->acaoPOST == 4) {
            $email = isset($_POST['txtEmailUsuario']) ? $_POST['txtEmailUsuario'] : null;

            $user = json_decode($this->existLogin($email, 1), true);

            if (!$user) {
                echo "<script>setTimeout(()=>toastrErrorFront('E-mail incorreto!', 'E-mail não coincide com os nossos registros. Tentar novamente.'), 1000);</script>";
            } else {

                $hashSenha = new Model\HashSenha();
                $hashSenha->setHashSenha(hash("md5", $email));
                $hashSenha->setDataGeracao(date('Y/m/d H:i:s'));
                $hashSenha->setCodUsuario($user[0]['COD_USUARIO']);

                $Vai = "Olá, " . $user[0]['NOME_USUARIO'] . "\n\nAcesse este link para redefinir sua senha.\n\n" . _URLBASE_ . "?area=recuperarSenha&hash=" . $hashSenha->getHashSenha() . "&data=" . str_replace(" ", ".", $hashSenha->getDataGeracao()) . "\n\nEste link é válido por apenas 24h";

                define('GUSER', 'projectecolog@gmail.com'); // <-- Insira aqui o seu GMail
                define('GPWD', 'SomostodosASK2019');  // <-- Insira aqui a senha do seu GMail

                function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
                    global $error;
                    $mail = new \PHPMailer();
                    $mail->IsSMTP();  // Ativar SMTP
                    $mail->CharSet = 'UTF-8';
                    $mail->SMTPDebug = 0;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
                    $mail->SMTPAuth = true;  // Autenticação ativada
                    $mail->SMTPSecure = 'ssl'; // SSL REQUERIDO pelo GMail
                    $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
                    $mail->Port = 465;    // A porta 587 deverá estar aberta em seu servidor
                    $mail->Username = GUSER;
                    $mail->Password = GPWD;
                    $mail->SetFrom($de, $de_nome);
                    $mail->Subject = $assunto;
                    $mail->Body = $corpo;
                    $mail->AddAddress($para);
                    if (!$mail->Send()) {
                        $error = 'Mail error: ' . $mail->ErrorInfo;
                        return false;
                    } else {
                        $error = 'Mensagem enviada!';
                        return true;
                    }
                }

                if (smtpmailer($email, GUSER, "Ecolog", "Recuperação de senha", $Vai)) {
                    $hashSenhaDAO = new Model\HashSenhaDAO($this->conn);
                    $hashSenhaDAO->create($hashSenha);
                    header("Location:" . _URLBASE_ . "index.php?mensagem=redefinição");
                } else
                if (!empty($error))
                    echo $error;
            }
            return;
        }

        if ($this->acaoPOST == 3) {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $senha = isset($_POST['txtSenhaUsuario']) ? $_POST['txtSenhaUsuario'] : null;
            $senhaNova = isset($_POST['txtSenhaUsuarioNova']) ? $_POST['txtSenhaUsuarioNova'] : null;

            if ($senha != null && $senhaNova != null && $id != null) {
                if ($this->usuarioDAO->selectSenha($id, $senha)) {
                    $hashSenha = \Util\Bcrypt::hash(trim($senhaNova));
                    $this->usuarioDAO->updateSenha($hashSenha, $id);
                    header("Location: " . _URLBASE_ . "index.php?area=cadastro&acao=2&login=1&id=" . $id . "&mensagem=sucesso");
                } else {
                    echo "<script>setTimeout(()=>toastrErrorFront('Senha atual incorreta!', 'Senha atual não coincide. Tentar novamente.'), 1000);</script>";
                    return;
                }
            }
        }

        $this->recuperarDadosFormulario();
        $this->efetuarUpload();


        if ($this->acaoPOST == 1) {
            $this->usuarioDAO->create($this->usuario);
            enviaEmail($this->usuario->getLoginUsuario(), $this->usuario->getNomeUsuario());
            $this->login = isset($_GET['login']) ? $_GET['login'] : 0;
            if ($this->login == 1) {
                $_SESSION['login'] = $this->usuario->getLoginUsuario();
                $_SESSION['senha'] = $this->txtSenhaUsuarioSemCriptografia;

                header("Location: " . _URLBASE_ . "?mensagem=cadastro");
            }
        } else if ($this->acaoPOST == 2) {
            $this->usuarioDAO->update($this->usuario);
            $_SESSION['usuarioLogado'] = $this->usuarioDAO->selectUpdate($this->usuario->getCodUsuario());
            $this->login = isset($_GET['login']) ? $_GET['login'] : 0;
            if ($this->login == 1) {
                header("Location: " . _URLBASE_ . "index.php");
            }
        }
    }

    public function verificaTipoAcao() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->acaoPOST = isset($_POST['txtAcao']) ? $_POST['txtAcao'] : 0;
            $this->gravarAlterar();
        } else if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $this->login = isset($_GET['login']) ? $_GET['login'] : 0;
            $this->acaoGET = isset($_GET['acao']) ? $_GET['acao'] : 0;
            $this->executarAcaoGet();
        }
        $this->mostrarListaFomulario();
    }

    public function executarAcaoGet() {

        if ($this->acaoGET == 2) {

            $this->usuario->setCodUsuario($_GET['id']);
            $usuario = json_decode($this->usuarioDAO->selectId($this->usuario), true);
            $this->usuario = new Model\Usuario($usuario['codTipoUsuario'], $usuario['nomeTipoUsuario'], $usuario['codUsuario'], $usuario['nomeUsuario'], $usuario['loginUsuario'], $usuario['senhaUsuario'], $usuario['docUsuario'], $usuario['codTipoDocumento'], $usuario['cepUsuario'], $usuario['numUsuario'], $usuario['complementoUsuario'], $usuario['statusUsuario'], $usuario['urlFotoUsuario'], $usuario['latitudeUsuario'], $usuario['longitudeUsuario']);
        }

        if ($this->acaoGET == 3) {

            $this->usuario->setCodUsuario($_GET['id']);
            $this->usuarioDAO->delete($this->usuario);
        }

        if ($this->acaoGET == 4) {
            $documento = $_GET['documento'];
            $this->exist($documento);
        }

        if ($this->acaoGET == 5) {
            $login = $_GET['login'];
            $this->existLogin($login);
        }

        if ($this->acaoGET == 6) {
            $this->usuario->setCodUsuario($_GET['id']);
            $this->usuarioDAO->delete($this->usuario);
            unset($_SESSION['usuarioLogado']);
        }
    }

    public function mostrarListaFomulario() {
        if ($this->acaoGET == 0 || $this->acaoGET == 3) {
            $this->fomulario = "off";
            $this->lista = "on";
        } elseif ($this->acaoGET == 1 || $this->acaoGET == 2) {
            $this->fomulario = "on";
            $this->lista = "off";
        }
    }

    public function listarUsuarios() {
        $usuarios = json_decode($this->usuarioDAO->selectAll(), true);
        return $this->montaLista($usuarios);
    }

    public function listarUsuariosPorNome($nome) {
        $this->usuario->setNomeUsuario($nome);
        $usuarios = json_decode($this->usuarioDAO->selectName($this->usuario), true);
        return $this->montaLista($usuarios);
    }

    public function listarUsuariosPorCep($cep) {
        $this->usuario->setCepUsuario($cep);
        $usuarios = json_decode($this->usuarioDAO->selecetUserCep($this->usuario), true);
        return $this->montaLista($usuarios);
    }

    public function listarUsuariosPorTipo($tipo) {
        $this->usuario->setNomeTipoUsuario($tipo);
        $usuarios = json_decode($this->usuarioDAO->selectUserTipo($this->usuario), true);
        return $this->montaLista($usuarios);
    }

    public function montaLista($usuarios) {

        if ($usuarios[1] !== "false") {
            $lista = "";
            foreach ($usuarios as $usuario) {
                $lista .= "<tr>"
                        . "<td>$usuario[0]</td>"
                        . "<td>$usuario[1]</td>"
                        . "<td>$usuario[2]</td>"
                        . "<td>$usuario[4]</td>"
                        . "<td>$usuario[5]</td>"
                        . "<td>$usuario[10]</td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroUsuario&acao=2&id=" . $usuario[0] . "'><img src='" . _URLBASE_ . "public/img/editar.jpg'></a></td>"
                        . "<td><a href='index.php?area=adm&folder=cadastro&page=cadastroUsuario&acao=3&id=" . $usuario[0] . "'><img src='" . _URLBASE_ . "public/img/excluir.jpg'></a></td>"
                        . "</tr>";
            }
            return $lista;
        }
        return false;
    }

    public function exist($documento) {
        $result = $this->usuarioDAO->exist($documento);
        echo $result;
    }

    public function existLogin($login, $return) {
        $result = $this->usuarioDAO->existLogin($login, $return);
        return $result;
    }

    public function efetuarUpload() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $local = "public" . DIRECTORY_SEPARATOR . "upload";
            $listaPermitidos = array(0 => "image/png", 1 => "image/gif",
                2 => "image/jpeg", 3 => "image/webp", 4 => "image/bmp",
                5 => "image/vnd.sealedmedia.softseal.jpg");

            $up = new \Util\Upload($local, $listaPermitidos);
            $x = $up->upload();

            if ($x === false) {
                switch ($x) {
                    case 1:
                        echo "<script>alert('Arquivo maior quer o permitido!')</script>";
                        break;
                    case 2:
                        echo "<script>alert('Arquivo maior quer o permitido pelo Form HTML!')</script>";
                        break;
                }
            }
        }
    }

}

function enviaEmail($email, $nomeUsuario) {
    $Vai = "Olá, $nomeUsuario \n\n Você acabou de se juntar a Ecolog! Aqui nós somos entusiasmados em ajudar todas as pessoas a como tratar os resíduos descartáveis e lixos recicláveis. \n\n " .
            "Aqui vão algumas dicas de como começar:\n\n" .
            "-Utilize nosso sistema de 'vender recicláveis', onde você vê os melhores preços em locais mais próximos da sua residência.\n\n" .
            "-favorite as empresas que mais gostar, veja a bolsa de valores, acompanhe os preços dos materiais, avaliações de usuários e comentários!" .
            "A melhor forma de prever o futuro é criá-lo\n\n" .
            "*Saudações, Equipe Ecolog.*";

    define('GUSER', 'projectecolog@gmail.com'); // <-- Insira aqui o seu GMail
    define('GPWD', 'SomostodosASK2019');  // <-- Insira aqui a senha do seu GMail

    function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
        global $error;
        $mail = new \PHPMailer();
        $mail->IsSMTP();  // Ativar SMTP
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;  // Autenticação ativada
        $mail->SMTPSecure = 'ssl'; // SSL REQUERIDO pelo GMail
        $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
        $mail->Port = 465;    // A porta 587 deverá estar aberta em seu servidor
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom($de, $de_nome);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        $mail->AddAddress($para);
        if (!$mail->Send()) {
            $error = 'Mail error: ' . $mail->ErrorInfo;
            return false;
        } else {
            $error = 'Mensagem enviada!';
            return true;
        }
    }

    if (smtpmailer($email, GUSER, "Ecolog", "Boas Vindas", $Vai)) {
        
    } else
    if (!empty($error))
        echo $error;
}
