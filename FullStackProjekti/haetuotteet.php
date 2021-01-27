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

$haeTuotteet = $yhteys->prepare("SELECT Nimi, TuoteID, Hinta FROM Tuote");
$haeTuotteet->execute();

$data2 = $haeTuotteet->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data2);


?>