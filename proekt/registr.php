<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require ('conf.php');
session_start();


$registrationMessage = "";

if (isset($_POST["register"])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));

    $cool = "superpaev";
    $krypt = crypt($pass, $cool);

    global $yhendus;
    $kask = $yhendus->prepare("INSERT INTO kasutajad (Email, Parool) VALUES (?, ?)");

    try {
        $kask->bind_param("ss", $login, $krypt);
        $success = $kask->execute();

        if ($success) {
            $registrationMessage = "Registreerimine õnnestus!";
        } else {
            $registrationMessage = "Registreerimine ebaõnnestus. Palun proovige uuesti.";
        }
    } catch (mysqli_sql_exception $e) {
        $registrationMessage = "Registreerimine ebaõnnestus. Kasutajanimi on juba võetud.";
    }

    $kask->close();
}

function isAdmin()
{
    return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
}

?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pidu</title>
    <link rel="stylesheet" type="text/css" href="still/style.css">
</head>
<body>
<header>
    <h1 style="user-select: none">Maagiline pidu</h1>
    <?php
    if (isset($_SESSION['kasutaja'])) {
        ?>
        <h3>Tere, <?= $_SESSION['kasutaja'] ?></h3>
        <a href="logout.php">Logi välja</a>
        <?php
    } else {
        ?>
            <div id="verti" style="user-select: none">
                <a href="#" onclick="openModal()">Logi sisse</a>
                <a href="#" onclick="openRegisterModal()" id="register">Registreerimine</a>
            </div>

        <?php
    }
    ?>
</header>
<div id="content">
    <div id="header">
        <span style="font-size:80px;cursor:pointer;color: #fdfdfe;
    text-shadow: 0px 0px 5px #b393d3, 0px 0px 10px #b393d3, 0px 0px 10px #b393d3,
    0px 0px 20px #b393d3; user-select: none" onclick="toggleNav()">&#x2261; </span>
    </div
</div>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 style="user-select: none">Login</h2>
            <form action="login.php" method="post">
                <label for="login" style="user-select: none">Email:</label>
                <br>
                <input type="text" id="login" name="login" required>
                <br>
                <label for="password" style="user-select: none">Parool:</label>
                <br>
                <input type="password" id="password" name="pass" required>
                <br>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>

    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeRegisterModal()">&times;</span>
            <h2 style="user-select: none">Registreerimine</h2>
            <form method="post" action="kasutajaLeht.php" onsubmit="return validateRegistration()">
                <label for="login" style="user-select: none">Eesnimi:</label>
                <br>
                <input type="text" id="login" name="login" required>
                <br>
                <br>
                <label for="pass" style="user-select: none">Parool:</label>
                <div class="password-input">
                    <input type="password" id="pass" name="pass" required>
                </div>
                <br>
                <label for="confirmPass" style="user-select: none">Parooli kinnitamine:</label>
                <br>
                <input type="password" id="confirmPass" name="confirmPass" required>
                <br>
                <input type="checkbox" id="showPass" onchange="togglePasswordVisibility()"> Näita salasõna
                <br>
                <br>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
    </div>
<div class="image-box" style="user-select: none">
    <div class="border"></div>
    <img src="images/party1.jpg">
    <div class="image-content">
        <h3 class="image-header" style="user-select: none">Pidu</h3>
        <p style="user-select: none">Oled tüdinenud pidevast kontorielust? Tule meie peole ja pääse kõigist muredest!</p>
    </div>
</div>
<div class="image-box2" style="user-select: none">
    <div class="border"></div>
    <img src="images/party3.jpg">
    <div class="image-content">
        <h3 class="image-header" style="user-select: none">Kohtumine sõpradega</h3>
        <p style="user-select: none">Kas te ei ole oma sõpru või perekonda ammu näinud? Registreeru peole ja tule kokku!</p>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('loginModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('loginModal').style.display = 'none';
    }

    window.onclick = function (event) {
        var modal = document.getElementById('loginModal');
        if (event.target == modal) {

            modal.style.display = 'none';
        }
    }

    function openRegisterModal() {
        document.getElementById('registerModal').style.display = 'block';
    }

    function closeRegisterModal() {
        document.getElementById('registerModal').style.display = 'none';
    }

    window.onclick = function (event) {
        var modal = document.getElementById('registerModal');
        if (event.target == modal) {
            showImages();
            modal.style.display = 'none';
        }
    }


    function validateRegistration() {
        var password = document.getElementById('pass').value;
        var confirmPass = document.getElementById('confirmPass').value;

        if (password !== confirmPass) {
            alert('Paroolid ei vasta.');
            return false;
        }

        var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!regex.test(password)) {
            alert('Salasõna peab sisaldama vähemalt 8 märki, sealhulgas ühte suurtähte ja ühte numbrit.');
            return false;
        }

        return true;
    }

    function togglePasswordVisibility() {
        var passInput = document.getElementById('pass');
        var confirmPassInput = document.getElementById('confirmPass');
        var showPassCheckbox = document.getElementById('showPass');

        passInput.type = showPassCheckbox.checked ? 'text' : 'password';
        confirmPassInput.type = showPassCheckbox.checked ? 'text' : 'password';
    }

    function toggleNav() {
        var verti = document.getElementById("verti");
        if (verti.style.left === "0px") {
            closeNav();
        } else {
            openNav();
        }
    }

    function openNav() {
        document.getElementById("verti").style.left = "0";
    }

    function closeNav() {
        document.getElementById("verti").style.left = "-250px";
    }
</script>

