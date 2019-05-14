<?php

// Variável de sessão -
session_start();

//carregamento do arquivo de configuração
$ajuste = "../../";
require_once $ajuste.'config/config.php';

//criando a conexão com o BD
$conection = \Util\ConnectionFactory::getConexao($ajuste.'config/bd_mysql.ini');

$Nome = $_POST["txtName"]; // Pega o valor do campo Nome
$Email = $_POST["txtUsuario"]; // Pega o valor do campo Email
$Assunto = $_POST["txtAssunto"]; // Pega o valor do campo Assunto
$Mensagem = $_POST["txtMensagem"]; // Pega os valores do campo Mensagem
// Variável que junta os valores acima e monta o corpo do email

$Vai = "Nome: $Nome\n\nE-mail: $Email\n\nMensagem: $Mensagem\n";


require_once("../../vendor/phpmailer/class.phpmailer.php");

define('GUSER', 'projectecolog@gmail.com'); // <-- Insira aqui o seu GMail
define('GPWD', 'SomostodosASK2019');  // <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
    global $error;
    $mail = new PHPMailer();
    $mail->IsSMTP();  // Ativar SMTP
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

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
// o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

if (smtpmailer(GUSER, $Email, $Nome, $Assunto, $Vai)) {

    header("Location:"._URLBASE_."?mensagem=email");
} else
if (!empty($error))
    echo $error;
?>