<?php

            $id = $obj->{'id'};
            $name = $obj->{'name'};
            $email = $obj->{'mail'};
            $password = $obj->{'password'};
            
            if(mysqli_query($connect, "UPDATE `user` SET `nome` = '$name', `email` = '$email', `senha` = '$password' WHERE `user`.`id` = '{$id}';")): 
                $status = true;
                $msg = "Your data has been successfully edited!";
            else:
                $msg = "Error when Editing.";
                $status = false;
            endif;


            $retorno = array("status" => $status, 'msg' => $msg);
            echo json_encode($retorno);
            exit();
        
?>

