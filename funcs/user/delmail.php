<?php

    $mail = $obj->{'mail'};

    $token = $_COOKIE['token'];

    $sqlListMail = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");        
    $resultListMail = mysqli_fetch_array($sqlListMail);
    $idUserMail = $resultListMail['id'];
    $userSQL = $resultListMail['user'];


        $lengthArroba = strpos($mail,"@"); // posição onde inicia a string "não é que" = 20
        $resultUserMail = substr($mail, 0, $lengthArroba); //posição inicial = 0, comprimento = 20
 
        $emailDelete = $api->deleteMail($mail);
        $statusMail = $emailDelete['status'];
        $msgMail = $emailDelete['msg'];

        if($statusMail){
            if(mysqli_query($connect, "DELETE FROM `mailsserver` WHERE `mailsserver`.`usermail` = '{$resultUserMail}'")): 
                $status = true;
            else:
                $msgDB = "Erro ao salvar";
                $status = false;
            endif;

            $retorno = array("status" => $status, "msg" => $msgMail, "server" => $msgDB);
            echo json_encode($retorno);
            exit();
        }
        else{
            echo json_encode($emailDelete);
            exit();
        }


    //DELETE FROM `mailsserver` WHERE `mailsserver`.`id` = 14

?>