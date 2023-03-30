<?php
    if(!empty($_POST['nameFrom']) && !empty($_POST['idTo']) && !empty($_POST['value']) && !empty($_POST['date']) && !empty($_POST['addressFrom']) && !empty($_POST['addressTo']) && !empty($_POST['deliveryType']) && !empty($_POST['size'])){
        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
        $nameFrom = $_POST['nameFrom'];
        $idTo = $_POST['idTo'];
        $value = $_POST['value'];
        $date = $_POST['date'];
        $addressFrom = $_POST['addressFrom'];
        $addressTo = $_POST['addressTo'];
        $deliveryType = $_POST['deliveryType'];
        $size = $_POST['size'];
        
        $query = "INSERT into orders (value, sendDate, nameFrom, idTo, addressFrom, addressTo, size, deliveryType, status) VALUES ('$value', '$date', '$nameFrom', '$idTo', '$addressFrom', '$addressTo', '$size', '$deliveryType', 'do_opłacenia')";
        $result = mysqli_query($connect, $query);

        mysqli_close($connect);
        header("location: ../pages/order_sim.php");
        echo '<p>Paczka została nadana</p>';
    }
    else{
        header("location: ../pages/order_sim.php");
        echo '<p>Nie udało się nadać paczki!</p>';
    }
?>