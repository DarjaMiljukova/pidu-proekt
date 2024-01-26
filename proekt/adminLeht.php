<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require('conf.php');
session_start();
if (isset($_REQUEST["kustutakasutajad"])) {
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM kasutajad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutakasutajad"]);
    $kask->execute();
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
    <link rel="stylesheet" type="text/css" href="still/AdminStyle.css">
</head>
<body>
<header>
</header>
<h1>AdministreerimisLeht</h1>
<div id="verti">
    <a href="adminLeht.php">Admin leht</a>
    <a href="kasutajaLeht.php">Kasutaja leht</a>
    <a href="piduinfo.php">Pidu info</a>
</div>
<div id="content">
    <div id="header">
        <span style="font-size:80px;cursor:pointer;    color: #fdfdfe;
    text-shadow: 0px 0px 5px #b393d3, 0px 0px 10px #b393d3, 0px 0px 10px #b393d3,
    0px 0px 20px #b393d3;" onclick="toggleNav()">&#x2261; </span>
    </div>
</div>

<script>
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
<br>
<br>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Email</th>
        <th>Kustuta kasutaja</th>
    </tr>

    <?php
    global $yhendus;
    $kask=$yhendus->prepare("SELECT Id, Eesnimi, Email FROM kasutajad");
    $kask->bind_result($id, $eesnimi, $email);
    $kask->execute();
    while ($kask->fetch()) {
        echo "<tr>";
        echo "<td>".$eesnimi."</td>";
        echo "<td>".$email."</td>";
        echo "<td><a href='?kustutakasutajad=$id'>Kustuta kasutaja</a></td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
