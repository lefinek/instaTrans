<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaTRANS - Rejestracja</title>
    <link rel="stylesheet" type="text/css" href="../styles/loginPage.css">
    <script src="../scripts/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../images/login_logo.svg" alt="InstaTransLogo" style="padding: 0px; margin: 0px">
        </div>
        <div class = "login_package">
            <img src="../images/packages.png" alt="package">
        </div>
        <div class="formular_register" id="formular_register">
            <h2 class="login_title">Rejestracja</h2>
            <form class="login_form" method="POST" action="../actionPages/register_action.php" onchange="submit_register()">
                <input type="text" class="holder" placeholder="imię" name="name" id="name" onchange="submit_register()">
                <input type="text" class="holder" placeholder="nazwisko" name="lastName" onchange="submit_register()">
                <input type="text" class="holder" placeholder="login" name="login" onchange="submit_register()">
                <input type="password" class="holder" placeholder="hasło" name="password" onchange="submit_register()">
                <input type="password" class="holder" placeholder="powtórz hasło" name="repassword" onchange="submit_register()">
                <input type="submit" value="Dodaj konto" class="button" id="register_submit">
                <p id="register_submit_alert">*Aby dodać konto, wypełnij wszytkie pola</p>
                <p>Masz już konto? <span style="color: #1254D4"><a href="login.php">Zaloguj się tutaj!</a><span></p>
            </form>
        </div>
    </div>
</body>
</html>