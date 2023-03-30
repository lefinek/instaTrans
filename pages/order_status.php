<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaTRANS - Symulator zmiany statusu przesyłek</title>
    <link rel="stylesheet" type="text/css" href="../styles/simulator.css">
    <script src="../scripts/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="formular_sim" id="formular_sim" style="margin-top: 10%; height: 30%; gap: 10px;">
            <h2 class="sim_title"><span style="color: white">Zmień p</span>rzesyłkę</h2>
            <form class="sim_form" method="POST" action="../actionPages/order_status_action.php">
                <select class="holder" id="delivery_option" style="height: 50px; margin-top: 20px;" name="orderId">
                            <?php
                                $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');

                                $query = "SELECT orderId from orders order by orderId";
                                $result = mysqli_query($connect, $query);
                                while($row = mysqli_fetch_row($result)){
                                    echo '<option value="'. $row[0] . '">' . $row[0] . '</option>';
                                }

                                mysqli_close($connect);
                            ?>
                        </select>
                        <select class="holder" id="size_option" style="height: 50px; margin-top: 20px;" name="status">
                            <option value="wysłano">wysłano</option>
                            <option value="awizo">awizo</option>
                            <option value="odebrano">odebrano</option>
                            <option value="do_odebrania">do odebrania</option>
                            <option value="do_opłacenia">do opłacenia</option>
                            <option value="opłacono">opłacono</option>
                        </select>
                <input type="submit" value="Zmień status przesyłki" class="button" style="margin-top: 40px">
            </form>
        </div>
    </div>
</body>
</html>