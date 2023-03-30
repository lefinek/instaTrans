<?php
    if(!empty($_POST['name']) && !empty($_POST['lastName']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['repassword'])){
        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
        $login = $_POST['login'];
        $query_username_duplicate = "SELECT * from accounts where username like '$login'";
        $result_username_duplicate = mysqli_query($connect, $query_username_duplicate);
        if(mysqli_num_rows($result_username_duplicate)==0){
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            if($repassword == $password){
                $newPassword = sha1($password);
                $name = $_POST['name'];
                $lastName = $_POST['lastName'];
                $date = date("Y-m-d");

                $query_saldoId = "SELECT saldoId+1 FROM saldos WHERE saldoId not in('2147483647') ORDER by saldoId DESC limit 1";
                $result_saldoId = mysqli_fetch_array(mysqli_query($connect, $query_saldoId))[0];
                $query_userId = "SELECT userId+1 FROM users WHERE userId not in('2147483647') ORDER by userId DESC limit 1";
                $result_userId = mysqli_fetch_array(mysqli_query($connect, $query_userId))[0];
                $query_accountId = "SELECT accountId+1 FROM accounts WHERE accountId not in('2147483647') ORDER by accountId DESC limit 1";
                $result_accountId = mysqli_fetch_array(mysqli_query($connect, $query_accountId))[0];
            
                $query_start = "start transaction";
                $query_save1 = "savepoint first";
                $query_add_saldo = "insert into saldos values ('$result_saldoId', 0.00, '$date')";
                $query_save2 = "savepoint second";
                $query_add_user = "insert into users values ('$result_userId', '$name', '$lastName')";
                $query_save3 = "savepoint third";
                $query_add_account = "insert into accounts values ('$result_accountId', '$result_userId', '$login', '$newPassword', '$result_saldoId')";
                $result_commit = "commit";

                mysqli_query($connect, $query_start);
                mysqli_query($connect, $query_save1);
                mysqli_query($connect, $query_add_saldo);
                mysqli_query($connect, $query_save2);
                mysqli_query($connect, $query_add_user);
                mysqli_query($connect, $query_save3);
                mysqli_query($connect, $query_add_account);
                mysqli_query($connect, $result_commit);

                mysqli_close($connect);
                header("location: ../pages/login.php");
            }
            else{
                printf("Hasła nie są identyczne");
            }
        }
        else{
            printf("Takie konto już istnieje");
        }
    }
    else{
        printf("Nie wszystkie pola zostały wypełnione");
    }
?>