<?php


            $token = $_COOKIE['token'];

            $sqlUser = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");        
            $resultsqlUser = mysqli_fetch_array($sqlUser);
            $iduser = $resultsqlUser['id'];
            $name = $resultsqlUser['nome'];
            $user = $resultsqlUser['user'];
            $email = $resultsqlUser['email'];
            $senha = $resultsqlUser['senha'];


            $retorno = array("status" => true, "id" => $iduser, "name" => $name, "user" => $user, "email" => $email, "senha" => $senha);
            echo json_encode($retorno);
            exit();

?>

