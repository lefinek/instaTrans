<?php
    if(!empty($_POST['orderId']) && !empty($_POST['status'])){
        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
        $orderId = $_POST['orderId'];
        $status = $_POST['status'];

        $query = "UPDATE orders SET status = '$status' WHERE orderId = '$orderId'";
        $result = mysqli_query($connect, $query);

        mysqli_close($connect);
        header("location: ../pages/order_status.php");
    }
    else{
        header("location: ../pages/order_status.php");
    }
?>