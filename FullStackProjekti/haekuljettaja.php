<?php 

$palvelin = "mysql.cc.puv.fi";
$username = "e1900910";
$password = "TkRePgD4pyzq";

try {
  $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password);    
} 
catch(PDOException $message) {
    echo $message->getMessage();
}

$haeKuljettajat = $yhteys->prepare("SELECT KuljettajaID, Etunimi, Sukunimi, Kaupunki, Lahiosoite, Postinumero, Puhelinnumero, Sahkoposti FROM Kuljettaja");
$haeKuljettajat->execute();

$data = $haeKuljettajat->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);


?>
