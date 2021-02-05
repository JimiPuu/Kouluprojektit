<?php

 if (isset($_POST['kuljettajat-dropdown'])) {
    $ktun = $_POST['kuljettajat-dropdown'];
}
if (isset($_POST['Etunimi'])) {
    $kuljEnimi = $_POST['Etunimi'];
    $kuljEnimi = filter_var($kuljEnimi, FILTER_SANITIZE_STRING);
  }
  if (isset($_POST['Sukunimi'])) {
    $kuljSnimi = $_POST['Sukunimi'];
    $kuljSnimi = filter_var($kuljSnimi, FILTER_SANITIZE_STRING);
  } 
  if (isset($_POST['Kaupunki'])) {
      $kuljKaupunki = $_POST['Kaupunki'];
      $kuljKaupunki = filter_var($kuljKaupunki, FILTER_SANITIZE_STRING);
    } 
    if (isset($_POST['Lahiosoite'])) {
      $kuljLahiosoite = $_POST['Lahiosoite'];
      $kuljLahiosoite = filter_var($kuljLahiosoite, FILTER_SANITIZE_STRING);
    } 
    if (isset($_POST['Postinumero'])) {
      $kuljPostinumero = $_POST['Postinumero'];
      $kuljPostinumero = filter_var($kuljPostinumero, FILTER_SANITIZE_STRING);
    } 
    if (isset($_POST['Puhelinnumero'])) {
      $kuljPuhelinnumero = $_POST['Puhelinnumero'];
      $kuljPuhelinnumero = filter_var($kuljPuhelinnumero, FILTER_SANITIZE_STRING);
    } 
    if (isset($_POST['Sahkoposti'])) {
      $kuljSposti = $_POST['Sahkoposti'];
      $kuljSposti = filter_var($kuljSposti, FILTER_SANITIZE_STRING);
    } 
    $palvelin = "mysql.cc.puv.fi";
    $username = "e1900910";
    $password = "TkRePgD4pyzq";
    
    
    try {
      $errorInfo = "";

      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

      $muutosLause = "UPDATE Kuljettaja SET Etunimi=:enimi, Sukunimi=:snimi, Kaupunki=:kaupunki, Lahiosoite=:lahios,
      Postinumero=:pnum, Puhelinnumero=:puhnro, Sahkoposti=:sposti WHERE KuljettajaID=:ktun;";
      $tietoKantaKasittely = $yhteys->prepare($muutosLause);

      $tietoKantaKasittely->bindValue(':ktun', $ktun);
      $tietoKantaKasittely->bindValue(':enimi', $kuljEnimi);
      $tietoKantaKasittely->bindValue(':snimi', $kuljSnimi);
      $tietoKantaKasittely->bindValue(':kaupunki', $kuljKaupunki);
      $tietoKantaKasittely->bindValue(':lahios', $kuljLahiosoite);
      $tietoKantaKasittely->bindValue(':pnum', $kuljPostinumero);
      $tietoKantaKasittely->bindValue(':puhnro', $kuljPuhelinnumero);
      $tietoKantaKasittely->bindValue(':sposti', $kuljSposti);
      if ($kuljEnimi === ""){
        echo "Tarkista etunimi";
      }elseif ($kuljSnimi === ""){
        echo "Tarkista sukunimi";
      }elseif ($kuljKaupunki === ""){
        echo "Tarkista kaupunki";
      }elseif ($kuljLahiosoite === ""){
        echo "Tarkista lähiosoite";
      }elseif ($kuljSposti === ""){
        echo "Tarkista sähköposti";
      }elseif ($kuljPostinumero === ""){
        echo "Tarkista postinumero";
      }elseif($kuljPuhelinnumero === ""){
        echo "Tarkista puhelinnumero";
      }else{
      $onnistuiko = $tietoKantaKasittely->execute();
    
      $errorInfo = $tietoKantaKasittely->errorInfo();
      $muutettujenLkm = $tietoKantaKasittely->rowCount();
      if ($muutettujenLkm > 0) {
         echo "Tietojen muutos onnistui";
        } else {
          echo "Tarkista tiedot";
        }
      }
    } 
    catch(PDOException $message) {
        $errorInfo = $message->getMessage();
        echo "Muuttaminen ei onnistunut";
       } 
    

 
?>