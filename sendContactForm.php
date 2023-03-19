<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer ;
use PHPMailer\PHPMailer\Exception;
function SendEmail($senderEmail,$name,$message)
{
$developmentMode=true;
$mailer=new PHPMailer($developmentMode);
try
{
    $mailer->SMTPDebug = 2;
    $mailer->isSMTP();

    if ($developmentMode) {
    $mailer->SMTPOptions = [
        'ssl'=> [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ]
    ];
    }


    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'italkforallquery@gmail.com';
    $mailer->Password = 'Jaiganesha@1';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;

    $mailer->setFrom('italkforallquery@gmail.com', 'Aman Agarwal');
    $mailer->addAddress($senderEmail);

    $mailer->isHTML(true);
    $mailer->Subject = 'iTALK';
    $mailer->Body = $message;

    $mailer->send();
    $mailer->ClearAllRecipients();
    return true;
}
catch(Exception $e)
{
    return false;
    echo $mailer->ErrorInfo;
}
}
?>