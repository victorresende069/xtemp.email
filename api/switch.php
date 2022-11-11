<?php

    $HeaderViewServer = $_SERVER['HTTP_HEADERVIEWFUNCTION'];

    switch ($HeaderViewServer) {
        case 'login':
                require_once('../funcs/user/login.php');
            break;
        
            
        default: //SEM ROTA API VAI RETURNA UM ERROR 
                $retorno = array("status" => 'ERROR');
                echo json_encode($retorno);
                exit();
            break;
    }

?>