<?php

    $HeaderClientFunction = $_SERVER['HTTP_HEADERFUNCTION'];

    switch ($HeaderClientFunction) {
        case 'login':
                require_once('../funcs/user/login.php');
                exit();
            break;
        

        case 'inboxMail':

                    if($obj->{'delete'}): //Deleta Email
                            $mailDelVar = $api->deleteInboxMail($obj->{'path'});
                            $jsonMailDel = json_encode($mailDelVar);
                            echo $jsonMailDel;
                        exit();
                    endif;

                    if($obj->{'view'}):
                            $mail = $obj->{'mail'};
                            $emailInbox = $api->GetMails($mail);
                            $mailData = $emailInbox['data'];
                            $jsonMail = json_encode($mailData[$obj->{'id'}]);
                            echo $jsonMail;
                        exit();
                    endif;

                require_once('../funcs/mail/inbox.php');
                exit();
            break;



            
        default: //SEM ROTA API VAI RETORNA UM ERROR 
                $retorno = array("status" => 'ERROR');
                echo json_encode($retorno);
                exit();
            break;
    }

?>