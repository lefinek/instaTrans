<?php
    session_start();
    if(empty($_POST["login"]) && empty($_POST["password"])){
        $login_session = $_SESSION["login"];
        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
    }
    else if(!empty($_POST["login"]) && !empty($_POST["password"])){
        $login = $_POST["login"];
        $password = $_POST["password"];
        $en_password = sha1($password);

        $connect = mysqli_connect('localhost', 'root', '', 'instaTrans');
        $query = "SELECT * from accounts WHERE username LIKE '$login' AND password = '$en_password'";
        $result = mysqli_query($connect, $query);
    
        if(mysqli_num_rows($result)==1){
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $en_password;
            $login_session = $_SESSION["login"];
        }
        else{
            header("location: ../pages/login.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaTRANS - Aplikacja</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="icon" href="../images/instatrans.ico" type="image/ico">
    <script src="../scripts/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../images/logo_app.svg" alt="Logo and slogan">
        </div>
        <nav>
            <div class="nav_button" onclick="main()">
                Strona główna
            </div>
            <div class="nav_button" onclick="order()">
                Moje zamówienia
            </div>
            <div class="nav_button" onclick="send()">
                Nadaj przesyłkę
            </div>
            <div class="nav_button" onclick="paid()">
                Opłać
            </div>
            <div class="nav_button" onclick="saldo()">
                Doładuj saldo
            </div>
            <div class="nav_button" style="margin-left: 70px;" onclick="logOut()">
                Wyloguj
            </div>
        </nav>
        <div class="panels">
            <div class="left_panel">
                <h3 class="lp_title">Moje dane</h3>
                <div class="my_data_position">
                    <div class="my_data_title">
                        <p>Imię</p>
                        <p>Nazwisko</p>
                        <p>Saldo</p>
                        <p>Przesyłek</p>
                    </div>
                    <div class="my_data">
                        <?php
                            $query_user_data = "SELECT users.name, users.lastName, saldos.value, (SELECT COUNT(*) FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session') as active_orders FROM users right join accounts on accounts.userId = users.userId left join saldos on saldos.saldoId = accounts.saldo WHERE accounts.username = '$login_session'";
                            $result_user_data = mysqli_query($connect, $query_user_data);
                            $row = mysqli_fetch_assoc($result_user_data);
                            echo '<p>' . $row["name"] . '</p>';
                            echo '<p>' . $row["lastName"] . '</p>';
                            echo '<p>' . $row["value"] . ' zł</p>';
                            echo '<p>' . $row["active_orders"] . '</p>';
                        ?>
                    </div>
                </div>
                <img src="../images/delivery.png" alt="delivery">
            </div>
            <!-- To jest panel "Strona główna" -->
            <div class = "right_panel_main">
                <div class="rpm_l_main">
                    <div class="rpm_l_main_title">
                        <h2>Dzień dobry!</h2>
                    </div>
                    <div class="rpm_l_main_position">
                        <div class="rpm_l_main_data_title">
                            <p>Aktywne zamówienia:</p>
                            <p>Przesyłki do opłacenia:</p>
                            <div class="rpm_l_main_data_order">
                                <?php
                                    $query_topaid_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_opłacenia'";
                                    $result_topaid_orders = mysqli_query($connect, $query_topaid_orders);
                                    if(mysqli_num_rows($result_topaid_orders)>0){
                                        $i = 1;
                                        while($row_topaid_orders = mysqli_fetch_row($result_topaid_orders)){
                                            echo '<p title="' . $row_topaid_orders[1] . '" id="nummer_topaid_orders_main_' . $i . '" onclick="toPaidOrdersMain(event)" class="no_overflow">' . $row_topaid_orders[0] . '</p>';
                                            $i++;
                                        }
                                    }
                                    else{
                                        echo '<p>brak zamówień do opłacenia</p>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="rpm_l_main_data">
                            <?php
                                $query_active_orders = "SELECT COUNT(*) as numer FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status in('wysłano', 'do_odebrania')";
                                $result_active_orders = mysqli_query($connect, $query_active_orders);
                                $row_active_orders = mysqli_fetch_assoc($result_active_orders);
                                echo '<p>' . $row_active_orders["numer"] . '</p>';
                            ?>
                            <?php
                                $query_topaid_orders_numer = "SELECT COUNT(*) as numer FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_opłacenia'";
                                $result_topaid_orders_numer = mysqli_query($connect, $query_topaid_orders_numer);
                                $row_topaid_orders_numer = mysqli_fetch_assoc($result_topaid_orders_numer);
                                echo '<p>' . $row_topaid_orders_numer["numer"] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="rpm_r_main">
                    <div class="rpm_r_main_title">
                        <h2>Ostatnie zamówienia</h2>
                    </div>
                    <div class="rpm_r_main_pick_up">
                        <p class="pick_up_title">Do odebrania:</p>
                        <div class="pick_up_order">
                            <?php
                                $query_topickup_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_odebrania'";
                                $result_topickup_orders = mysqli_query($connect, $query_topickup_orders);
                                if(mysqli_num_rows($result_topickup_orders)>0){
                                    $e = 1;
                                    while($row_pickup_orders = mysqli_fetch_row($result_topickup_orders)){
                                        echo '<p title="' . $row_pickup_orders[1] . '" onclick="toPickUpOrdersMain(event)" id = "nummer_topickup_orders_main_'. $e. '" class="no_overflow">' . $row_pickup_orders[0] . '<p>';
                                        $e++;
                                    }
                                }
                                else{
                                    echo '<p>brak przesyłek do odebrania</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="rpm_r_main_pick_up">
                        <p class="pick_up_title">Nieodebrane:</p>
                        <div class="pick_up_order">
                            <?php
                                $query_awizo_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'awizo'";
                                $result_awizo_orders = mysqli_query($connect, $query_awizo_orders);
                                if(mysqli_num_rows($result_awizo_orders)>0){
                                    $f = 1;
                                    while($row_awizo_orders = mysqli_fetch_row($result_awizo_orders)){
                                        echo '<p title="' . $row_awizo_orders[1] . '" onclick="AwizoOrdersMain(event)" id = "nummer_awizo_orders_main_' . $f . '" class="no_overflow">' . $row_awizo_orders[0] . '<p>';
                                        $f++;
                                    }
                                }
                                else{
                                    echo '<p>brak Awizo</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <img src="../images/packages.png" alt="package">
                </div>
            </div>
            <!-- To jest panel "Moje zamówienia" -->
            <div class="right_panel_order">
                <div class="rpm_l_order">
                    <div class="order_up">
                        <h2 class="rpm_title">Ostatnio odebrane</h2>
                        <div class="order_data">
                            <?php
                                $query_lastpickedup_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'odebrano' limit 3";
                                $result_lastpickedup_orders = mysqli_query($connect, $query_lastpickedup_orders);
                                if(mysqli_num_rows($result_lastpickedup_orders)>0){
                                    $g = 1;
                                    while($row_pickedup_orders = mysqli_fetch_row($result_lastpickedup_orders)){
                                        echo '<p title="' . $row_pickedup_orders[1] . '" onclick="pickedUpOrdersMO(event)" id = "nummer_pickuped_orders_mo_'. $g. '" class="no_overflow">' . $row_pickedup_orders[0] . '<p>';
                                        $g++;
                                    }
                                }
                                else{
                                    echo '<p>brak ostatnio odebranych paczek</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="order_down">
                        <h2 class="rpm_title">Nieopłacone</h2>
                        <div class="order_data">
                            <?php
                                $query_nopaid_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_opłacenia'";
                                $result_nopaid_orders = mysqli_query($connect, $query_nopaid_orders);
                                if(mysqli_num_rows($result_nopaid_orders)>0){
                                    $h = 1;
                                    while($row_nopaid_orders = mysqli_fetch_row($result_nopaid_orders)){
                                        echo '<p title="' . $row_nopaid_orders[1] . '" onclick="noPaidOrdersMO(event)" id = "nummer_nopaid_orders_mo_'. $h. '" class="no_overflow">' . $row_nopaid_orders[0] . '<p>';
                                        $h++;
                                    }
                                }
                                else{
                                    echo '<p>brak nieopłaconych przesyłek</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="rpm_mid_order">
                    <div class="order_up">
                        <h2 class="rpm_title">Do odebrania</h2>
                        <div class="order_data">
                            <?php
                                $query_topick_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_odebrania'";
                                $result_topick_orders = mysqli_query($connect, $query_topick_orders);
                                if(mysqli_num_rows($result_topick_orders)>0){
                                    $j = 1;
                                    while($row_topick_orders = mysqli_fetch_row($result_topick_orders)){
                                        echo '<p title="' . $row_topick_orders[1] . '" onclick="toPickOrdersMO(event)" id = "nummer_topick_orders_mo_'. $j. '" class="no_overflow">' . $row_topick_orders[0] . '<p>';
                                        $j++;
                                    }
                                }
                                else{
                                    echo '<p>brak przesyłek do odebrania</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="order_down">
                        <h2 class="rpm_title">Wysłane</h2>
                        <div class="order_data">
                            <?php
                                $query_sent_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'wysłano'";
                                $result_sent_orders = mysqli_query($connect, $query_sent_orders);
                                if(mysqli_num_rows($result_sent_orders)>0){
                                    $m = 1;
                                    while($row_sent_orders = mysqli_fetch_row($result_sent_orders)){
                                        echo '<p title="' . $row_sent_orders[1] . '" onclick="sentOrdersMO(event)" id = "nummer_sent_orders_mo_'. $m. '" class="no_overflow">' . $row_sent_orders[0] . '<p>';
                                        $m++;
                                    }
                                }
                                else{
                                    echo '<p>brak wysłanych przesyłek</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="rpm_r_order">
                    <div class="order_up">
                        <h2 class="rpm_title">Nieodebrane</h2>
                        <div class="order_data">
                            <?php
                                $query_toawizo_orders = "SELECT orderId, nameFrom FROM orders join accounts on orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'awizo'";
                                $result_toawizo_orders = mysqli_query($connect, $query_toawizo_orders);
                                if(mysqli_num_rows($result_toawizo_orders)>0){
                                    $d = 1;
                                    while($row_toawizo_orders = mysqli_fetch_row($result_toawizo_orders)){
                                        echo '<p title="' . $row_toawizo_orders[1] . '" onclick="toAwizoOrdersMain(event)" id = "nummer_toawizo_orders_main_' . $d . '" class="no_overflow">' . $row_toawizo_orders[0] . '<p>';
                                        $d++;
                                    }
                                }
                                else{
                                    echo '<p>brak Awizo</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="order_down">
                        <img src="../images/letter.png" alt ="letter">
                    </div>
                </div>
            </div>
            <!-- To jest panel "Nadaj przesyłkę" -->
            <form method="POST" action = "../actionPages/send_up_action.php" class="right_panel_send">
                <div class="rpm_l_send">
                    <div class="send_up">
                        <h2 class = "rpm_title">Nadaj paczkę!</h2>
                        <select class="holder" id="delivery_option" onchange="sendCost()" name="send_up_delivery_option">
                            <option value="" selected disabled hidden>Wybierz dostawę</option>
                            <option value="P">Paczkomat</option>
                            <option value="K">Kurier</option>
                            <option value="KE">KurierExpress</option>
                        </select>
                        <select class="holder" id="size_option" onchange="sendCost()" name="send_up_size_option">
                            <option value="" selected disabled hidden>Wybierz rozmiar</option>
                            <option value="S">Mała (max 8x38x64cm)</option>
                            <option value="M">Średnia (max 19x38x64cm)</option>
                            <option value="XL">Duża (max 41x38x64cm)</option>
                        </select>
                        <select class="holder" style="height: 50px" name="send_up_idTo" onchange="sendCost()">
                            <option value="" selected disabled hidden>Wybierz odbiorcę</option>
                            <?php
                                $query_who = "SELECT accounts.accountId, users.name, users.lastName FROM accounts right join users on users.userId = accounts.userId where accounts.userId not in('2147483647')";
                                $result_who = mysqli_query($connect, $query_who);

                                while($row_who = mysqli_fetch_row($result_who)){
                                    echo '<option value="' . $row_who[0] . '">Do: ' . $row_who[1] . ' ' . $row_who[2] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="send_down">
                        <div class="send_down_title">
                            <p class="p_send">Do zapłaty:</p>
                            <p class="p_send">Czas na nadanie:</p>
                        </div>
                        <div class="send_down_data">
                            <p id="send_cost">S/M/XL</p>
                            <input type="hidden" name="send_cost" value="0" id="send_cost_input" step="0.01">
                            <p style="margin-top: 0px" id="time">1/2/3 dni</p>
                        </div>
                    </div>
                </div>
                <div class="rpm_r_send">
                    <div class="send_up">
                        <input type="text" class="holder" value="<?php
                            $query_who_am_i = "SELECT users.name, users.lastName FROM accounts right join users on users.userId = accounts.userId where accounts.username = '$login_session' and accounts.userId not in('2147483647')";
                            $result_who_am_i = mysqli_query($connect, $query_who_am_i);
                            while($row_who_am_i = mysqli_fetch_row($result_who_am_i)){
                                    echo $row_who_am_i[0] . ' ' . $row_who_am_i[1];
                                }
                         ?>" name="send_up_name_from" readonly="readonly">
                        <input type="text" class="holder" placeholder="adres nadawcy" name="send_up_address_from" onchange="sendCost()">
                        <input type="text" class="holder" placeholder="adres odbiorcy" name="send_up_address_to" onchange="sendCost()">
                    </div>
                    <div class="send_down">
                        <input type="submit" value="Nadaj!" class="button" id="summary_tosend_button">
                        <input type="hidden" value="<?php echo $_SESSION["login"];?>" name="loginSession">
                        <input type="hidden" value="<?php echo $_SESSION["password"];?>" name="passwordSession">
                    </div>
                </div>
            </form>
            <!-- To jest panel "Opłać" -->
            <form class="right_panel_paid" method="POST" action="../actionPages/to_paid_action.php">
                <div class="rpm_paid_title">
                    <div class="thing">
                        <p class="title_paid">Paczka</p>
                    </div>
                    <div class="cost">
                        <p class="title_paid">Kwota</p>
                    </div>
                    <div class="date">
                        <p class="title_paid">Data</p>
                    </div>
                    <div class="choose">
                        <p class="title_paid">Wybierz</p>
                    </div>
                </div>
                <div class="rpm_paid_data_position">
                    <?php
                        $query_topaid_data = "SELECT orderId, value, sendDate, nameFrom from orders right join accounts ON orders.idTo = accounts.accountId WHERE accounts.username = '$login_session' AND orders.status = 'do_opłacenia'";
                        $result_topaid_data = mysqli_query($connect, $query_topaid_data);
                        $k = 1;
                        while($row_topaid_data = mysqli_fetch_row($result_topaid_data)){
                            echo '
                                <div class="rpm_paid_data">
                                    <div class="thing">
                                        <p class="data_paid no_overflow" title="' . $row_topaid_data[3] . '" id="data_paid_nummer_' . $k . '" onclick="toPaidData(event)">' . $row_topaid_data[0] . '</p>
                                    </div>
                                    <div class="cost">
                                        <p class="data_paid no_overflow" title = "' . $row_topaid_data[1] . '"id="data_paid_cost_nummer_' . $k . '">' . $row_topaid_data[1] . ' zł</p>
                                    </div>
                                    <div class="date">
                                        <p class="data_paid no_overflow">' . $row_topaid_data[2] . '</p>
                                    </div>
                                    <div class="choose">
                                        <input type="button" value="Wybierz!" class="button_choose" onclick="chooseButton(event)" id="button_choose_topaid_' . $k . '">
                                    </div>
                                </div>
                            ';
                            $k++;
                        }  
                    ?>
                </div>
                <div class="rpm_paid_summary">
                    <div class="summary_title">
                        <p>Wybrane do opłaty:</p>
                        <p>Do zapłaty: </p>
                        <input type="submit" value="Opłać!" class="button" id="summary_topaid_button">
                    </div>
                    <div class="summary_data">
                        <p id="summary_number">0</p>
                        <p id="summary_cost">0 zł</p>
                        <?php
                            $amount_of_saldo_query = "SELECT saldos.value FROM saldos right join accounts on accounts.saldo = saldos.saldoId WHERE accounts.username = '$login_session'";
                            $amount_of_saldo_result = mysqli_query($connect, $amount_of_saldo_query);
                            $amount_of_saldo_row = mysqli_fetch_row($amount_of_saldo_result);
                            $result_of_saldo_amount = $amount_of_saldo_row[0];

                            echo '<input type="hidden" id="result_of_saldo_amount" value="' . $result_of_saldo_amount . '"></input>';
                        ?>
                        <input type="hidden" value="0" id="summary_cost_hidden" name = "summary_cost_hidden_name">
                        <input type="hidden" value="null" id="summary_ids_hidden" name = "summary_ids_hidden_name">
                        <input type="hidden" value="<?php echo $_SESSION["login"];?>" name="loginSession_topaid">
                        <input type="hidden" value="<?php echo $_SESSION["password"];?>" name="passwordSession_topaid">
                    </div>
                </div>
            </form>
            <!-- To jest panel "Doładuj" -->
            <form class="right_panel_saldo" method = "POST" action="../actionPages/saldo_boost_action.php">
                <div class="rpm_saldo_left">
                    <h2>Twoje saldo</h2>
                    <div class="saldo_position">
                        <div class="saldo_title">
                            <p>Nazwa użytkownika:</p>
                            <p>Wielkość salda:</p>
                            <p>Ostatnio doładowane:</p>
                        </div>
                        <div class="saldo_data">
                            <?php
                                $query_saldo_data = "SELECT accounts.username, saldos.value, saldos.lastUpdated FROM saldos right join accounts on accounts.saldo = saldos.saldoId WHERE accounts.username = '$login_session'";
                                $result_saldo_data = mysqli_query($connect, $query_saldo_data);
                                $row_saldo_data = mysqli_fetch_row($result_saldo_data);
                                echo '<p>' . $row_saldo_data[0] . '</p>';
                                echo '<p id="saldo_data_money" title="' . $row_saldo_data[1] . '">' . $row_saldo_data[1] . ' zł</p>';
                                echo '<p>' . $row_saldo_data[2] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="rpm_saldo_right">
                    <h2>Doładuj saldo</h2>
                    <div class="saldo_form">
                        <input type="number" class="holder" placeholder="wartość" step = "0.01" max="500.00" id="saldo_boost_amount_id" name="saldo_boost_amount_name" onchange="saldoBoost()">
                        <input type="submit" value="Doładuj!" class="button" id="saldo_submit_button">
                        <input type="hidden" value="<?php echo $_SESSION["login"];?>" name="loginSession_saldoboost">
                        <input type="hidden" value="<?php echo $_SESSION["password"];?>" name="passwordSession_saldoboost">
                    </div>
                    <p>*Maksymalna wartość salda wynosi 500 zł<p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>