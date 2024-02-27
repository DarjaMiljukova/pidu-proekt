# ${\color{violet}Peoõhtu registreerimisvorm}$

<div align="center">
    <img src="images/party.jpg" alt="Logo" width="600" height="400">

</div>

_**Minu projekt, on vormi sait sirvida ja registreerida kasutaja-poolne puhkus**_
> Projekt kasutab kahte kasutajat, administraatorit ja tavakasutajat.
>
> Tavakasutajal on ainult üks lehekülg, kuid administraatoril on 2 lehekülge.
> 

## ${\color{violet}Veebisait}$

<a href="https://darjamiljukova22.thkit.ee/jsleht/content/andmebaas/proekt/registr.php">
    <img src="images/skrin.png" alt="Logo" width="800" height="400">
</a>    

### ${\color{violet}Programmid}$
* [![XAMPP][XAMPP-shield]][XAMPP-url]
* [![PHP][PHP-shield]][PHP-url]
* [![CSS][CSS-shield]][CSS-url]
* [![JavaScript][JavaScript-shield]][JavaScript-url]

<br>

## ${\color{violet}Võimalused}$


| Osa           | Õigused       
| ------------- |:-------------:
| Admin         | Lisamine/Muutmine/Kustuta andmed pidud ja andmed kasutaja
| Kasutaja      | Registreerimine pidule

<br>
<br>

 ### ${\color{violet}Kasutaja}$

- [ ] Registreerimine
- [ ] Logi sisse
- [ ] Peo vaatamine
    - [ ] Registreerimine pidule
- [ ] Logi välja

<br>

### ${\color{violet}Admin}$

- [ ] Autoriseerimine
- [ ] Kasutaja andmed vaatamine
    - [ ] Kustuta kasutaja andmed    
- [ ] Peo vaatamine
    - [ ] Lisamine pidu andmed
    - [ ] Kustutamine pidu andmed
    - [ ] Muutmine pidu andmed
- [ ] Logi välja

<br>

![pilt](https://github.com/DarjaMiljukova/pidu-proekt/assets/120181585/c18e840e-ba95-4a96-a2d1-e97b575891ca)
![pilt](https://github.com/DarjaMiljukova/pidu-proekt/assets/120181585/c0257813-76d3-4686-aa52-1de2c3ecefde)



[XAMPP-shield]: https://img.shields.io/badge/XAMPP-F37623?style=for-the-badge&logo=xampp&logoColor=white
[XAMPP-url]: https://www.apachefriends.org/index.html

[PHP-shield]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/

[CSS-shield]: https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white
[CSS-url]: https://developer.mozilla.org/en-US/docs/Web/CSS

[JavaScript-shield]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[JavaScript-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript

[product-screenshot]: images/skrin.png
**See on kood, mis paneb kasutajad nägema kõiki pidud/sündmusi.**
```
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
```
