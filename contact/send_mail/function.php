<?php

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function send($email_admin_1, $email_admin_2, $email_client, $subject, $content){

        $PHPMailer = new PHPMailer(true);

        try {
            $result = false;

            $PHPMailer->SMTPDebug = 0;
            $PHPMailer->isSMTP();
            $PHPMailer->Host = 'smtp.gmail.com';
            $PHPMailer->SMTPAuth = true;
//            $PHPMailer->Username = 'noreply-contact@wagokoro.co.jp';
//            $PHPMailer->Password = 'n7MG2gvL@123';
            $PHPMailer->Username = 'chiennguyen1702@gmail.com';
            $PHPMailer->Password = 'bmrzwgweibpebghh';
            $PHPMailer->SMTPSecure = 'tls';
            $PHPMailer->Port = 587;
            $PHPMailer->CharSet  = 'UTF-8';

            $PHPMailer->setFrom($email_admin_1, '和心HP問い合わせアカウント');
            $PHPMailer->addAddress($email_client);
            $PHPMailer->addAddress($email_admin_1);
            if(!empty($email_admin_2)){
                $PHPMailer->addAddress($email_admin_2);
            }
            $PHPMailer->addReplyTo($email_admin_1);
            $PHPMailer->isHTML(true);

            $PHPMailer->Subject = $subject;
            $PHPMailer->Body = $content;

            $result = $PHPMailer->send();

        } catch (Exception $exception) {
            echo $PHPMailer->ErrorInfo;
        }

        return $result;
    }

?>