<?php

        $token = $_COOKIE['token'];

        $resultListMail = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'"));
        $idUserMail = $resultListMail['id']; //ID DO USUÁRIO
        $username = $resultListMail['user']; //USUÁRIO
        
      
        $sqlDomainsUser = mysqli_query($connect, "SELECT domain, usermail FROM mailsserver WHERE user='{$username}'");

        $linhaMailServer = mysqli_fetch_array($dadosMailServer);
        
        $total = mysqli_num_rows($sqlDomainsUser);



        $EmailS = array();
        $status = true;

        if ($total > 0) {
            do{
                $us = $aux['usermail'];
                $ma = $aux['domain'];
                $mailss = "$us@$ma";
                
                array_push($EmailS, $mailss);
            }
            while($aux = mysqli_fetch_assoc($sqlDomainsUser));
        }
        else {
            $msg = 'Você não tem nenhum email.';
            $status = false;
        } 

     



        $retorno = array("status" => $status, 'listMails' => $EmailS, 'return' => $msg);
        echo json_encode($retorno);
        exit();
    
?>