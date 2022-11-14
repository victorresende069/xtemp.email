<?php
            
    $mail = $obj->{'mail'};

    $emailInbox = $api->GetMails($mail);
    $mailData = $emailInbox['data'];
    $jsonMail = json_encode($mailData);

    echo $jsonMail;

?>
