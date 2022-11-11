<?php
    $user = $obj->{'user'};
    $pass = $obj->{'pass'};
    


    if($user == null || $pass == null){
        $retorno = array("status" => false, "tokenDevice" => $tokenD);
        echo json_encode($retorno);
        exit();
    }

?>


