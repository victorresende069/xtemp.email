<?php
     $user = $obj->{'user'};
     $pass = $obj->{'pass'};
     $name = $obj->{'name'};
     $email = $obj->{'email'};


     if($user == null || $pass == null || $name == null || $email == null):
        $retorno = array("status" => false, "msg" => "Dados não conferem");
        echo json_encode($retorno);
        header("HTTP/1.1 401 Unauthorized");
        exit();
    endif;

    if($user == '' || $pass == '' || $name == '' || $email == ''):
        $retorno = array("status" => false, "msg" => "Dados não conferem");
        echo json_encode($retorno);
        header("HTTP/1.1 401 Unauthorized");
        exit();
    endif;
    
    $sqlRegisterConsul = mysqli_query($connect, "SELECT * FROM user WHERE user='{$user}'");
    $sqlRegisterConsul = mysqli_fetch_array($sqlRegisterConsul);


    if(!strcmp($user, $sqlRegisterConsul['user'])){
        header("HTTP/1.1 203 Non-Authoritative Information");
        $retorno = array("status" => false, "msg" => "Este usuário já existe");
        echo json_encode($retorno);
        exit(); 
    }
    else{

        $toUs = "$user$fulldate";
        $token = substr(md5($toUs), 0, 12);

    
        if(mysqli_query($connect, "INSERT INTO `user` (`nome`, `user`, `email`, `senha`, `nivel`, `maxemails`, `token`) 
        VALUES ('$name', '$user', '$email', '$senha', '1', '3', '$token');")){
            $status = true;
            $msg = 'Usuário registrado com sucesso!';
            header("HTTP/1.1 202 Accepted");
        }
        else{
            $status = false;
            $msg = 'Erro ao registrar usuário.';
            header("HTTP/1.1 401 Unauthorized");
        }


        $retorno = array("status" => $status, "token" => $token, 'msg' => $msg);
        echo json_encode($retorno);
        exit();

    }



    




?>

