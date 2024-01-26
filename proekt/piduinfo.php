<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require('conf.php');
session_start();
if (isset($_REQUEST["kustutapidu"])) {
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM pidu WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutapidu"]);
    $kask->execute();
}

function lisaPidu($tuup, $pidunimi, $aeg){
    global $yhendus;
    $kask=$yhendus->prepare("INSERT INTO pidu (Tuup, PiduNimi, Aeg) VALUES(?,?,?)");
    $kask->bind_param("sss", $tuup, $pidunimi, $aeg);
    $kask->execute();
}
function muudaPidu($id, $tuup, $pidunimi, $aeg){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE pidu SET Tuup=?, PiduNimi=?, Aeg=? WHERE id=?");
    $kask->bind_param("sssi", $tuup, $pidunimi, $aeg, $id);
    $kask->execute();
}
if (isset($_REQUEST["lisapidu"]) && !empty($_REQUEST["lisapidu"])){
    lisaPidu($_REQUEST["tuup"], $_REQUEST["pidunimi"], $_REQUEST["aeg"]);
}

if (isset($_REQUEST["salvesta"])) {
    muudaPidu($_REQUEST["muuda_id"], $_REQUEST["tuup"], $_REQUEST["pidunimi"], $_REQUEST["aeg"]);
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
<h1>Pidu Info</h1>
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
        <th>Tüüp</th>
        <th>Pidu</th>
        <th>Kuupäev</th>
        <th>Kustuta pidu</th>
        <th>Muuda pidu</th>
        <th>Lisa pidu</th>
    </tr>

    <?php
    global $yhendus;
    $kask = $yhendus->prepare("SELECT Id, Tuup, PiduNimi, Aeg FROM pidu");
    $kask->bind_result($id, $tuup, $pidunimi, $aeg);
    $kask->execute();
    while ($kask->fetch()) {
        echo "<tr>";
        echo "<td>".$tuup."</td>";
        echo "<td>".$pidunimi."</td>";
        echo "<td>".$aeg."</td>";
        echo "<td><a href='?kustutapidu=$id'>Kustuta pidu</a></td>";
        echo "<td>";
        echo "<form method='post' action='?salvesta'>";
        echo "<input type='hidden' name='muuda_id' value='$id'>";
        echo "<input type='text' name='tuup' value='$tuup'>";
        echo "<input type='text' name='pidunimi' value='$pidunimi'>";
        echo "<input type='date' name='aeg' value='$aeg'>";
        echo "<input type='submit' value='Salvesta'>";
        echo "</form>";
        echo "</td>";
        echo"<td>";
        echo"<input type='button' name='lisaPidu' value='Lisa pidu' onclick='openModalLisa()'>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
<div id="lisa" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalLisa()">&times;</span>
        <form method="post" action="?lisapidu" id="lisa">
            <input type="text" name="tuup" placeholder="Tüüp">

            <input type="text" name="pidunimi" placeholder="PiduNimi">
            <input type="date" name="aeg" placeholder="Aeg">
            <input type="submit" value="Lisa pidu" name="lisapidu">
        </form>
    </div>
</div>
<script>
    function openModalLisa() {
        document.getElementById("lisa").style.display = "block";
    }

    function closeModalLisa() {
        document.getElementById("lisa").style.display = "none";
    }
</script>
</body>
</html>