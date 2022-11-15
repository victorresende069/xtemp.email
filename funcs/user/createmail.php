<?php
            $domain = $obj->{'domain'};
            $user = $obj->{'user'};
            $name = $obj->{'name'};
            $storage = 64;
            $type = 0;

            $token = $_COOKIE['token'];

            $sqlListMail = mysqli_query($connect, "SELECT * FROM user WHERE token='{$token}'");        
            $resultListMail = mysqli_fetch_array($sqlListMail);
            $idUserMail = $resultListMail['id'];
            $userSQL = $resultListMail['user'];

            $rowMails = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mailsserver WHERE id_user='{$IDuser}'"));


            if($rowMails > $resultListMail['maxemails']):
                    $retorno = array('status' => false, 'return' => 'Você não pode criar mais email!', 'maxMail' => $sqlADDEMailResult['maxemails'], 'emailUsed' => $rowMails);
                    echo json_encode($retorno);
                    exit();
            endif;
    

            function generatePassword($qtyCaraceters = 8)
                {
                    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
                    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
                    $numbers .= 1234567890;
                    $specialCharacters = str_shuffle('!@#$%*-');
                    $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;
                    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
                    return $password;
                }

            $passgenerateMail =  generatePassword(32);

            $adicionar = $api->addMail($type, $name, $user, $domain, $passgenerateMail, $storage);
            $statusMail = $adicionar['status'];
            $msgMail = $adicionar['msg'];


            if($statusMail){
                if(mysqli_query($connect, "INSERT INTO `mailsserver` (`user`, `name`, `id_user`, `domain`, `type`, `usermail`, `passmail`, `storagemail`, `dateCreate`, `token`) 
                VALUES ('$userSQL', '$name', '$idUserMail', '$domain', '$type', '$user', '$passgenerateMail', '$storage', '$fulldate', '$token');")): 
                    $status = true;
                else:
                    $msgDB = "Erro ao salvar";
                    $status = false;
                endif;

                $retorno = array("status" => $status, "msg" => $msgMail, "server" => $msgDB);
                echo json_encode($retorno);
                exit();
            }
            else{
                $retorno = array("status" => $statusMail, "msg" => $msgMail);
                echo json_encode($retorno);
                exit();
            }



?>