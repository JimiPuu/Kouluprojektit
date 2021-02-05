<?php

if (isset($_POST['kuljettajat-dropdown'])) {
$ktun = $_POST['kuljettajat-dropdown'];
$ktun = filter_var($ktun, FILTER_SANITIZE_STRING);

  if (empty($ktun)){
    echo "Anna henkilötunnus";
  }
  else {
    $palvelin = "mysql.cc.puv.fi";
    $username = "e1900910";
    $password = "TkRePgD4pyzq";
    
    try {
      $errorInfo = "";

      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

      $poistoLause = "DELETE FROM Kuljettaja WHERE KuljettajaID=:ktun;";
      
      $tietoKantaKasittely = $yhteys->prepare($poistoLause);

      $tietoKantaKasittely->bindValue(':ktun', $ktun);
      $onnistuiko = $tietoKantaKasittely->execute();
      $poistettujenLkm = $tietoKantaKasittely->rowCount();
      
      $errorInfo = $tietoKantaKasittely->errorInfo();
     
      if ($poistettujenLkm > 0) {
         echo "Kuljettajan poistaminen onnistui";
        } else {
          echo "Poistettavaa kuljettajaa ei löytynyt";
        }
    } 
    catch(PDOException $message) {
        $errorInfo = $message->getMessage();

        echo "Poisto ei onnistu";
    }
 }
}

?>