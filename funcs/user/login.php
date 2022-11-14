<?php
     $user = $obj->{'user'};
     $pass = $obj->{'pass'};
    

    if($user == null || $pass == null):
        $retorno = array("status" => 401);
        echo json_encode($retorno);
        header("HTTP/1.1 401 Unauthorized");
        exit();
    endif;

    if($user == '' || $pass == ''):
        $retorno = array("status" => 401);
        echo json_encode($retorno);
        header("HTTP/1.1 401 Unauthorized");
        exit();
    endif;
    
    $sqlLogin = mysqli_query($connect, "SELECT senha FROM user WHERE user='{$user}'");
    $sqlLogin = mysqli_fetch_array($sqlLogin);

    if(!strcmp($pass, $sqlLogin[0])){

        $toUs = "$user$fulldate";
        $token = substr(md5($toUs), 0, 12);

        mysqli_query($connect, "UPDATE user SET token='$token' WHERE user='{$user}'");
        //setcookie("token", $token); //SALVA COOKIE

        $retorno = array("status" => 202, "token" => $token);
        echo json_encode($retorno);
        header("HTTP/1.1 202 Accepted");
    }
    else{
        $retorno = array("status" => 401, "return" => "E-mail e/ou senha incorreta");
        echo json_encode($retorno);
        exit(); 
    }

?>