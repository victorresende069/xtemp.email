<?php


        $token = $_COOKIE['token'];

        
        $sqlADDMail = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");
        $sqlADDEMailResult = mysqli_fetch_array($sqlADDMail);
        $IDuser = $sqlADDEMailResult['id'];

        $rowMails = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mailsserver WHERE id_user='{$IDuser}'"));


        $retorno = array("status" => true, 'maxMail' => $sqlADDEMailResult['maxemails'], 'emailUsed' => $rowMails);
        echo json_encode($retorno);
        exit();

?>



