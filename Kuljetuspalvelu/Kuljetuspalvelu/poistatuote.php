<?php

if (isset($_POST['tuoteID'])) {
$tuoteID = $_POST['tuoteID'];
$tuoteID = filter_var($tuoteID, FILTER_SANITIZE_STRING);

    $palvelin = "mysql.cc.puv.fi";
    $username = "e1900910";
    $password = "TkRePgD4pyzq";
    
    try {
      $errorInfo = "";

      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

      $poistoLause = "DELETE FROM Tuote WHERE TuoteID=:tuoteID;";
      
      $tietoKantaKasittely = $yhteys->prepare($poistoLause);

      $tietoKantaKasittely->bindValue(':tuoteID', $tuoteID);
      $onnistuiko = $tietoKantaKasittely->execute();
      $poistettujenLkm = $tietoKantaKasittely->rowCount();
      
      $errorInfo = $tietoKantaKasittely->errorInfo();
     
      if ($poistettujenLkm > 0) {
         echo "Tuotteen poistaminen onnistui";
        } else {
          echo "Poistettavaa tuotetta ei löytynyt";
        }
    } 
    catch(PDOException $message) {
        $errorInfo = $message->getMessage();

        echo "Poisto ei onnistu";
    }
 }


?>