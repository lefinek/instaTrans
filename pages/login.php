<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaTRANS - Logowanie</title>
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
        <div class="formular">
            <h2 class="login_title">Logowanie</h2>
            <form class="login_form" method="POST" action="app.php">
                <input type="text" class="holder" placeholder="login" name="login">
                <input type="password" class="holder" placeholder="hasło" name="password">
                <input type="submit" value="Zaloguj" class="button" style="display: initial;">
                <p>Jesteś nowy? <span style="color: #1254D4"><a href="register.php">Zarejestruj się tutaj!</a><span></p>
            </form>
        </div>
    </div>
</body>
</html>