<?php

        $token = $_COOKIE['token'];

        $sqlListMail = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");        
        $resultListMail = mysqli_fetch_array($sqlListMail);
        $idUserMail = $resultListMail['id'];
      
        $dadosMailServer = mysqli_query($connect, "SELECT * FROM mailsserver WHERE id_user='{$idUserMail}'");
        $linhaMailServer = mysqli_fetch_array($dadosMailServer);
        $total = mysqli_num_rows($dadosMailServer);
        
        
        $EmailS = array();

        if ($total > 12) {
            do{

                $us = $aux['usermail'];
                $ma = $aux['domain'];
                $mailss = "$us@$ma";
                array_push($EmailS, $mailss);
            }
            while($aux = mysqli_fetch_assoc($dadosMailServer));
        }







        
        $retorno = array("status" => true, 'listMails' => $EmailS);
        echo json_encode($retorno);
        exit();
        
        /*
        $emailTest = $linhaMailServer['domain'];
        $arrayTest = [];

 
        foreach($emailTest as $valor){
            array_push($arrayTest, $valor);
        }

        print_r($arrayTest);


        
        $retorno = array("status" => true, 'listMails' => $retorno);
        echo json_encode($retorno);
        exit();


    
        if ($total > 0) {
            
            do { 
                $usermail = $linhaMailServer['usermail'];
                $userdomain = $linhaMailServer['domain'];
                $mailSQL =  "$usermail@$userdomain";
                $retornoa = array("user" => $usermail, "domain" => $userdomain);

            } 
            while ($linhaMailServer = mysqli_fetch_assoc($dadosMailServer));
        } 
        
        
        else {
            echo 'Não tem nenhum email para mostrar agora.';
        } 
        


        */

?>