<?php
    if(!empty($_POST['send_up_delivery_option']) && !empty($_POST['send_up_size_option']) && !empty($_POST['send_up_idTo']) && !empty($_POST['send_cost']) && !empty($_POST['send_up_name_from']) && !empty($_POST['send_up_address_from']) && !empty($_POST['send_up_address_to']) && !empty($_POST['loginSession']) && !empty($_POST['loginSession'])){
        session_start();
        $_SESSION["login"] = $_POST['loginSession'];
        $_SESSION["password"] = $_POST['passwordSession'];
        $login = $_POST['loginSession'];
        
        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
        $delivery_option = $_POST['send_up_delivery_option'];
        $size_option = $_POST['send_up_size_option'];
        $idTo = $_POST['send_up_idTo'];
        $cost = $_POST['send_cost'];
        $name_from = $_POST['send_up_name_from'];
        $address_from = $_POST['send_up_address_from'];
        $address_to = $_POST['send_up_address_to'];
        $date = date("Y-m-d");

        $query1 = "start transaction";
        $query2 = "savepoint save1";
        $query3 = "INSERT into orders (value, sendDate, nameFrom, idTo, addressFrom, addressTo, size, deliveryType, status) VALUES ('$cost', '$date', '$name_from', '$idTo', '$address_from', '$address_to', '$size_option', '$delivery_option', 'wysłano')";
        $query4 = "savepoint save2";
        $query5 = "UPDATE saldos join accounts on accounts.saldo = saldos.saldoId  set saldos.value = value - $cost  WHERE accounts.username = '$login'";
        $query6 = "savepoint save3";
        $query7 = "UPDATE saldos set saldos.value = value + $cost  WHERE saldoId = '2147483647'";
        $query8 = "commit";

        $result1 = mysqli_query($connect, $query1);
        $result2 = mysqli_query($connect, $query2);
        $result3 = mysqli_query($connect, $query3);
        $result4 = mysqli_query($connect, $query4);
        $result5 = mysqli_query($connect, $query5);
        $result6 = mysqli_query($connect, $query6);
        $result7 = mysqli_query($connect, $query7);
        $result8 = mysqli_query($connect, $query8);

        mysqli_close($connect);
        header("location: ../pages/app.php");
        exit();
    }
    else{
        header("location: ../pages/app.php");
        exit();
    }
?>