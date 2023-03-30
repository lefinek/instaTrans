<?php
    session_start();
    $_SESSION["login"] = $_POST['loginSession_saldoboost'];
    $_SESSION["password"] = $_POST['passwordSession_saldoboost'];
    $login = $_POST['loginSession_saldoboost'];
    $value = $_POST['saldo_boost_amount_name'];
    $date = date("Y-m-d");

    $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
    $query1 = "start transaction";
    $query2 = "savepoint save1";
    $query3 = "UPDATE saldos right join accounts on accounts.saldo = saldos.saldoId set saldos.value = saldos.value + '$value' WHERE accounts.username = '$login'";
    $query4 = "savepoint save2";
    $query5 = "UPDATE saldos right join accounts on accounts.saldo = saldos.saldoId set saldos.lastUpdated = '$date' WHERE accounts.username = '$login'";
    $query6 = "commit";
    
    $result1 = mysqli_query($connect, $query1);
    $result2 = mysqli_query($connect, $query2);
    $result3 = mysqli_query($connect, $query3);
    $result4 = mysqli_query($connect, $query4);
    $result5 = mysqli_query($connect, $query5);
    $result6 = mysqli_query($connect, $query6);

    mysqli_close($connect);
    header("location: ../pages/app.php");
    exit();
?>