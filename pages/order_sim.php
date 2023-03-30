<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaTRANS - Symulator wysyłania przesyłek</title>
    <link rel="stylesheet" type="text/css" href="../styles/simulator.css">
    <script src="../scripts/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="formular_sim" id="formular_sim">
            <h2 class="sim_title"><span style="color: white">Dodaj</span> przesyłkę</h2>
            <form class="sim_form" method="POST" action="../actionPages/order_sim_action.php">
                <input type="text" class="holder" placeholder="nazwa nadawcy" name="nameFrom">
                <select class="holder" style="height: 50px" name="idTo">
                    <option value="" selected disabled hidden>Wybierz odbiorcę</option>
                    <?php
                        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
                        $query = "SELECT accounts.accountId, users.name, users.lastName FROM accounts right join users on users.userId = accounts.userId where accounts.accountId not in('2147483647')";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_row($result)){
                            echo '<option value="' . $row[0] . '">DO: ' . $row[1] . ' ' . $row[2] . '</option>';
                        }

                        mysqli_close($connect);
                    ?>
                </select>
                <input type="number" class="holder" placeholder="koszt" min="1" max="500" name="value" step="0.01">
                <input type="date" class="holder" placeholder="data nadania" name="date">
                <input type="text" class="holder" placeholder="adres nadawcy" name="addressFrom">
                <input type="text" class="holder" placeholder="adres odbiorcy" name="addressTo">
                <select class="holder" id="delivery_option" style="height: 50px" name="deliveryType">
                    <option value="" selected disabled hidden>Wybierz dostawę</option>
                    <option value="P">Paczkomat</option>
                    <option value="K">Kurier</option>
                    <option value="KE">KurierExpress</option>
                </select>
                <select class="holder" id="size_option" style="height: 50px" name="size">
                    <option value="" selected disabled hidden>Wybierz rozmiar</option>
                    <option value="S">Mała (max 8x38x64cm)</option>
                    <option value="M">Średnia (max 19x38x64cm)</option>
                    <option value="XL">Duża (max 41x38x64cm)</option>
                </select>
                <input type="submit" value="Dodaj przesyłkę do systemu" class="button">
            </form>
        </div>
    </div>
</body>
</html>