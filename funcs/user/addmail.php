<?php

        $token = $_COOKIE['token'];

        $sqlADDMail = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");
        $sqlADDEMailResult = mysqli_fetch_array($sqlADDMail);
        $IDuser = $sqlADDEMailResult['id'];

        $rowMails = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mailsserver WHERE id_user='{$IDuser}'"));


        if($rowMails >= $sqlADDEMailResult['maxemails']):
                $retorno = array('status' => false, 'msg' => 'Você não pode criar mais email!', 'maxMail' => $sqlADDEMailResult['maxemails'], 'emailUsed' => $rowMails);
                echo json_encode($retorno);
                exit();
        endif;

        $listMailDomain = $api->GetListDomainMail();
        $listDomain = $listMailDomain['msg'];
        $dataListDomain = $listDomain['data'];


        $emailDomain = array();

        foreach ($dataListDomain as $key => $value) {
                $valueMail = "<option>".$value['domain']."</option>";
                array_push($emailDomain, $valueMail);
        }



        $retorno = array("status" => true, 'domainMails' => $emailDomain, 'maxMail' => $sqlADDEMailResult['maxemails'], 'emailUsed' => $rowMails);
        echo json_encode($retorno);
        exit();

?>



