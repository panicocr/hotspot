<?php
// Instalar PHPMailer - #apt-get install libphp-phpmailer
require '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';
require '/usr/share/php/libphp-phpmailer/src/SMTP.php';
require '/usr/share/php/libphp-phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarEmail($destinatario, $assunto, $mensagem) {
    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'seuservidorsmtp'; // Seu servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'seuenderecodeemail'; // Seu e-mail SMTP
        $mail->Password   = 'suasenha'; // Sua senha SMTP
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS ou PHPMailer::ENCRYPTION_SMTPS para SSL
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // TLS ou PHPMailer::ENCRYPTION_SMTPS para SSL
        $mail->Port       = 465; // Porta do SMTP (geralmente 587 para TLS ou 465 para SSL)

        // Remetente e destinatário
        $mail->setFrom('seuenderecodeemail', 'seutitulo');
        $mail->addAddress($destinatario);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem);

        // Enviar o e-mail
        return $mail->send();
    } catch (Exception $e) {
        //error_log("Erro ao enviar e-mail: " . $mail->ErrorInfo);
		header("Location: cad_avisos.php?erro=codigo_erro_envio_email");
		//exit();
        return false;
    }
}
?>
