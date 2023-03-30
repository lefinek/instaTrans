<?php
    session_start();
    $_SESSION["login"] = $_POST['loginSession_topaid'];
    $_SESSION["password"] = $_POST['passwordSession_topaid'];
    $login = $_POST['loginSession_topaid'];
    $value = $_POST['summary_cost_hidden_name'];
    $ids = $_POST['summary_ids_hidden_name'];

    $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');

    $amount_of_saldo_query = "SELECT saldos.value FROM saldos right join accounts on accounts.saldo = saldos.saldoId WHERE accounts.username = '$login'";
    $amount_of_saldo_result = mysqli_query($connect, $amount_of_saldo_query);
    $row = mysqli_fetch_row($amount_of_saldo_result);
    $result = $row[0];

    if($value > $result){
        header("location: ../pages/app.php");
        exit();
    }
    else{
        $query1 = "start transaction";
        $query2 = "savepoint save1";
        $query3 = "UPDATE saldos join accounts on accounts.saldo = saldos.saldoId  set saldos.value = value - $value  WHERE accounts.username = '$login'";
        $query4 = "savepoint save2";
        $query5 = "UPDATE orders SET status = 'opłacono' WHERE orderId in($ids)";
        $query6 = "savepoint save3";
        $query7 = "UPDATE saldos set saldos.value = value + $value  WHERE saldoId = '2147483647'";
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
?>