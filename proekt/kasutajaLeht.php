<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require ('conf.php');
session_start();

if(isset($_REQUEST["uuskasutaja"]) && !empty($_REQUEST["uuskasutaja"]) && isAdmin()){
    global $yhendus;
    $kask=$yhendus->prepare("INSERT INTO kasutajad (Eesnimi, Perekonnanimi, Email) values (?, NOW())");
    $kask->bind_param("sss", $_REQUEST["uuskasutaja"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $yhendus->close();
    exit();
}?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pidu</title>
    <link rel="stylesheet" type="text/css" href="still/AdminStyle.css">
</head>
<body>
<header>
</header>
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="login">Login:</label>

            <input type="text" id="login" name="login" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="pass" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRegisterModal()">&times;</span>
        <h2>Registreerimine</h2>
        <form method="post" action="kasutajaLeht.php" onsubmit="return validateRegistration()">
            <label for="login">Login:</label>
            <br>
            <input type="text" id="login" name="login" required>
            <br>
            <label for="pass">Parool:</label>
            <div class="password-input">
                <input type="password" id="pass" name="pass" required>
            </div>

            <label for="confirmPass">Parooli kinnitamine:</label>
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
<h1>Ettevõte</h1>
<nav>
    <ul>
        <li><a href="kasutajaLeht.php">Kasutaja leht</a></li>
    </ul>
</nav>
<br>
<br>
<table>
    <tr>
        <th>Tüüp</th>
        <th>Pidu</th>
        <th>Kuupäev</th>
    </tr>

    <?php
    global $yhendus;
    $kask=$yhendus->prepare("SELECT Id, Tuup, PiduNimi, Aeg FROM pidu");
    $kask->bind_result($id, $tuup, $pidunimi, $aeg);
    $kask->execute();
    while ($kask->fetch()) {
        echo "<tr>";
        echo "<td>".$tuup."</td>";
        echo "<td>".$pidunimi."</td>";
        echo "<td>".$aeg."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>

