<?php

    if($_GET['deslogar']):
        unset($_COOKIE['token']);
        setcookie('token', null);
        session_destroy();
        header('location: ./');
        exit();
    endif;

    require_once('funcs/database/connect.php'); //BANCO DE DADOS
    require_once('funcs/user/validtoken.php'); //Valida Token e Sessão

    if(!isset($_GET['tokenGet']) !== true){
        $tokenGet = $_GET['tokenGet'];
        $rowToken = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE token='{$tokenGet}'"));

            if($rowToken == 1){
                header("HTTP/1.1 202 Accepted");
                setcookie("token", $_GET['tokenGet']);
                header('location: ./');
                exit(); 
            }
            else{
                header("HTTP/1.1 401 Unauthorized");
                header('location: ./');
                exit(); 
            }        
    }
    else{ 

        if(!isset($_COOKIE['token']) !== TRUE ){
            include_once "view/user/dash.html";
        }
        else{
            include_once "view/login/login.html";
        }

    }



?>