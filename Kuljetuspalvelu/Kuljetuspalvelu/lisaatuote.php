<?php
$tuoteNimi="";
$tuoteHinta="";

 if (isset($_POST['tuoteNimi'])) {
  $tuoteNimi = $_POST['tuoteNimi'];
  $tuoteNimi = filter_var($tuoteNimi, FILTER_SANITIZE_STRING);
}
if (isset($_POST['tuoteHinta'])) {
  $tuoteHinta = $_POST['tuoteHinta'];
  $tuoteHinta = filter_var($tuoteHinta, FILTER_SANITIZE_STRING);
} 

    $palvelin = "mysql.cc.puv.fi";
    $username = "e1900910";
    $password = "TkRePgD4pyzq";
    try {
      $errorInfo = "";
      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $yhteys->exec('SET NAMES "utf8"');

      
     $insertLause = "INSERT INTO Tuote (Nimi, Hinta)
        VALUES (:Nimi, :Hinta) ";
    
      $tietokantaKasittely = $yhteys->prepare($insertLause);

      $tietokantaKasittely->bindValue(':Nimi', $tuoteNimi);
      $tietokantaKasittely->bindValue(':Hinta', $tuoteHinta);
      if($tuoteNimi === ""){
        echo "Anna tuotteelle nimi";
      }
      elseif ($tuoteHinta === ""){
        echo "Anna tuotteelle hinta";
      }elseif(is_numeric($tuoteHinta))
      {
        if($tuoteHinta <= 0){
          echo "Anna positiivinen luku";
          return;
        }
      $onnistuikoLisays = $tietokantaKasittely->execute();
      $errorInfo = $tietokantaKasittely->errorInfo();
      
      if($onnistuikoLisays){
        echo "OK";
      } else
      {
        echo "Lisäys ei onnistunut";
      }
      
    }else{
      echo "Anna numeerinen tieto";
    }
    }
    catch(PDOException $message) {
        $errorInfo = $message->getMessage();       
        echo "Poikkeusilmoitus" .  $errorInfo;
    } 

?>