<?php
require_once('PHPMailer/PHPMailerAutoload.php');
class Mail {
        public static function sendMail($subject, $body, $address) {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'invertarium.net';
                $mail->Port = '465';
                $mail->isHTML();
                $mail->Username = 'help@invertarium.net';
                $mail->Password = 'aT^[,g_+f=f)';
                $mail->SetFrom('no-reply@invertarium.net');
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($address);

                $mail->Send();
        }
}
?>
