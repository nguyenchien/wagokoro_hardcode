<?php
    $senderId = isset($_POST['id_sender']) ? $_POST['id_sender'] : '';
    if ($senderId == 'send_recruitment' || $senderId == 'send_cs' || $senderId == 'send_oem' || $senderId == 'send_product'
        || $senderId == 'send_service' || $senderId == 'send_press' || $senderId == 'send_ir'){

        require_once "function.php";

        $alert = '';
        $company_client = !empty($_POST['company_name']) ? $_POST['company_name'] : '';
        $name_client = !empty($_POST['your_name']) ? $_POST['your_name'] : '';
        $kana_client = !empty($_POST['kana_name']) ? $_POST['kana_name'] : '';
        $phone_client = !empty($_POST['your_phone']) ? $_POST['your_phone'] : '';
        $email_client = !empty($_POST['your_email']) ? $_POST['your_email'] : '';
        $message = !empty($_POST['your_message']) ? $_POST['your_message'] : '';

        // detect mailer
        if($senderId == 'send_recruitment'){
            $email_admin_1 = 'saiyo@wagokoro.co.jp';
            $subject = '採用に関するお問合せ';

        }elseif($senderId == 'send_cs'){
            $email_admin_1 = 'cs@wargo.jp';
            $subject = '商品や店舗に関するお問合せ';

        }elseif ($senderId == 'send_oem'){
            $email_admin_1 = 'produce-ml@wagokoro.co.jp';
            $subject = 'OEM生産など、新規お取引に関するお問合せ';

        }elseif ($senderId == 'send_product'){
            $email_admin_1 = 'marketing-ml@wagokoro.co.jp';
            $email_admin_2 = 'produce-ml@wagokoro.co.jp';
            $subject = '商品製作に関するご提案';

        }elseif ($senderId == 'send_service'){
            $email_admin_1 = 'xp-ml@wagokoro.co.jp';
            $email_admin_2 = 'media-ml@wagokoro.co.jp';
            $subject = 'サービス/製品のご提案';

        }elseif ($senderId == 'send_press'){
            $email_admin_1 = 'press@wagokoro.co.jp';
            $subject = '報道関係のお問合せ';

        }elseif ($senderId == 'send_ir'){
            $email_admin_1 = 'keiki-ml@wagokoro.co.jp';
            $subject = 'IRに関するお問合せ';
        }

        $content = " <p>差出人: [$name_client] <[$email_client]></p>
                <p>題名: 採用に関するお問合せ</p>
                <p>フリガナ:</p>
                <p>[$kana_client]</p>
                <p>電話番号:</p>
                <p>$phone_client</p>
                <p>メッセージ本文:</p>
                <br>$message
                </br>
                <p>--</p>
                <p>このメールは 株式会社　和心 - 日本のカルチャーを世界へ (https://www.wagokoro.co.jp) のお問い合わせフォームから送信されました.</p>";

        if(!empty($name_client) && !empty($phone_client) && !empty($email_client) && !empty($message)){

            $sendMail = send($email_admin_1, $email_admin_2, $email_client, $subject, $content);

            if ($sendMail === true){
                $alert = 'あなたのメッセージは送信されました。ありがとうございました。';
            }
        }

        echo $alert;
    }