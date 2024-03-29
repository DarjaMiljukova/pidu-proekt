<?php
require_once("conf.php");
global $yhendus;
session_start();

//kontrollime kas väljad  login vormis on täidetud
if (!empty($_POST['login']) && !empty($_POST['pass'])) {
    //eemaldame kasutaja sisestusest kahtlase pahna
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));
    //SIIA UUS KONTROLL
    $cool="superpaev";
    $kryp = crypt($pass, $cool);
    //kontrollime kas andmebaasis on selline kasutaja ja parool
    $kask=$yhendus-> prepare("SELECT Eesnimi, onAdmin FROM kasutajad WHERE Email=? AND Parool=?");
    $kask->bind_param("ss", $login, $kryp);
    $kask->bind_result($eesnimi,$onAdmin);
    $kask->execute();
    //kui on, siis loome sessiooni ja suuname
    if ($kask->fetch()) {
        $_SESSION['tuvastamine'] = 'misiganes';
        $_SESSION['eesnimi'] = $login;
        $_SESSION['onAdmin'] = $onAdmin;
        if($onAdmin==1){
            header('Location: adminLeht.php');}
        else{
            header('Location: kasutajaLeht.php');
            $yhendus->close();
            exit();
        }

    } else {
        echo "kasutaja $login või parool $kryp on vale";
        $yhendus->close();
    }
}
?>
