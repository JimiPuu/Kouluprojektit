<?php
// tutkitaan onko htun-tieto oikein tullut ja putsataan se mahdollisista html-tageista
if (isset($_POST['tuoteNimi'])) {
$tuoteNimi = $_POST['tuoteNimi'];
$tuoteNimi = filter_var($tuoteNimi, FILTER_SANITIZE_STRING);

// varmistetaan, että htun-tieto on annettu ja jos on, niin lähdetään hakemaan tietoa tietokannasta
  if (empty($tuoteNimi)){
       echo json_encode("");
  }
  else {
    $palvelin = "mysql.cc.puv.fi";
    $username = "e1900910";
    $password = "TkRePgD4pyzq";
    
    try {
      $errorInfo = "";

      $yhteys = new PDO("mysql:host=$palvelin;dbname=e1900910_KuljetusPalvelu", $username, $password); 
      $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
     
      // hakuLauseessa on vaihtuvan tiedon kohdalla nimetty parametri :htun
      $hakuLause = "SELECT Nimi, TuoteID, Hinta FROM Tuote WHERE Nimi = :tuoteNimi";
      
      $tietoKantaKasittely = $yhteys->prepare($hakuLause);
      // nimetylle parametrille annetaan tässä arvo (arvo vaihtuu, käyttäjän antaman arvon mukaan)
      $tietoKantaKasittely->bindValue(':tuoteNimi', $tuoteNimi);
      $tietoKantaKasittely->execute();
    
      $errorInfo = $tietoKantaKasittely->errorInfo();
      // executen jälkeen haun tulokset siirretään fetchAll-komennolla muuttujaan $data
      $data = $tietoKantaKasittely->fetchAll(PDO::FETCH_ASSOC);
      
      // tässä tapauksessa löytyi yksi asiakas, koska haettiin perusavaimen mukaan
 
      echo json_encode($data);
      
    } 
    catch(PDOException $message) {
        // lähetetään tyhjä Json-tieto ja käsitellään virhe asiakaspuolella
        echo json_encode("");
    }
  }
}
else
{
    // tässä tapauksessa phpkoodiin tullaan väärää reittiä

    echo json_encode("");
}
?>