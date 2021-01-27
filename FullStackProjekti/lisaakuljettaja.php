<?php
$kuljEnimi="";
$kuljSnimi="";
$kuljKaupunki = "";
$kuljLahiosoite = "";
$kuljPostinumero ="";
$kuljPuhelinnumero="";
$kuljSposti="";

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
    $password = "";
    try {
      $errorInfo = "";
      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $yhteys->exec('SET NAMES "utf8"');

      
     $insertLause = "INSERT INTO Kuljettaja (Etunimi, Sukunimi, Kaupunki, Lahiosoite, Postinumero, Puhelinnumero, Sahkoposti)
        VALUES (:Etunimi, :Sukunimi, :Kaupunki, :Lahiosoite, :Postinumero, :Puhelinnumero, :Sahkoposti) ";
    
      $tietokantaKasittely = $yhteys->prepare($insertLause);

      $tietokantaKasittely->bindValue(':Etunimi', $kuljEnimi);
      $tietokantaKasittely->bindValue(':Sukunimi', $kuljSnimi);
      $tietokantaKasittely->bindValue(':Kaupunki', $kuljKaupunki);
      $tietokantaKasittely->bindValue(':Lahiosoite', $kuljLahiosoite);
      $tietokantaKasittely->bindValue(':Postinumero', $kuljPostinumero);
      $tietokantaKasittely->bindValue(':Puhelinnumero', $kuljPuhelinnumero);
      $tietokantaKasittely->bindValue(':Sahkoposti', $kuljSposti);
      $onnistuikoLisays = $tietokantaKasittely->execute();
      $errorInfo = $tietokantaKasittely->errorInfo();

      if($onnistuikoLisays){
        echo "OK";
      } else
      {
        echo "Lisäys ei onnistunut";
      }
      
      
    }
    catch(PDOException $message) {
        $errorInfo = $message->getMessage();       
        echo "Poikkeusilmoitus" .  $errorInfo;
    } 

?>
