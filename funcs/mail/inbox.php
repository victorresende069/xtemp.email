<?php
             

    $mail = $obj->{'mail'};


    require_once('../funcs/server/mail.php');

    
    $emailInbox = $api->GetMails($mail);
    $mailData = $emailInbox['data'];
    $jsonMail = json_encode($mailData);
    //$body = $mailData[]
    
?>
