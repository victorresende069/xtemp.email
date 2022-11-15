<?php

        $tokenHeader = $_COOKIE['token'];

        $resultdataUser = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM user WHERE token='{$tokenHeader}'"));
        $tokenUser = $resultdataUser['token']; //Token

        $validToken = !strcmp($tokenHeader, $tokenUser);

        if($validToken){

            $idUser = $resultdataUser['id']; //ID do Usuário
            $nameUser = $resultdataUser['nome']; //Nome
            $levelUser = $resultdataUser['nivel']; //Nivel
            $emailUser = $resultdataUser['email']; //Email
            $maxEmails = $resultdataUser['maxemails']; //Max de Emails

            if($levelUser == 1){
                $levelUser = 'Grátis';
            }
            else if($levelUser == 2){
                $levelUser = 'Membro';
            }
            else if($levelUser == 2){
                $levelUser = 'Moderador';
            }
            else if($levelUser == 3){
                $levelUser = 'Administrador';
            }
            else if($levelUser == 4){
                $levelUser = 'Dono';
            }
            else{
                $levelUser = 'Visitante';
            }

            $rowMailsCreate = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mailsserver WHERE id_user='{$idUser}'"));


        }
        else{   
            header('Location: ./?deslogar=true'); //MATA A SESSÃO E DESLOGAR
        }

?>