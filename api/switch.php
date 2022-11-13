<?php

    $HeaderClientFunction = $_SERVER['HTTP_HEADERFUNCTION'];

    switch ($HeaderClientFunction) {
        case 'login':
                require_once('../funcs/user/login.php');
                exit();
            break;
        

        case 'inboxMail':
            
            
            break;

            
        default: //SEM ROTA API VAI RETORNA UM ERROR 
                $retorno = array("status" => 'ERROR');
                echo json_encode($retorno);
                exit();
            break;
    }

?>