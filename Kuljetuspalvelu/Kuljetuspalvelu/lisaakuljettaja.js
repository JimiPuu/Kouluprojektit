document.getElementById('btnLisaaKuljettaja').addEventListener('click', lisaaKuljettaja);

function lisaaKuljettaja()
{
    document.getElementById("Ilmoitus").value = "Lisätään kuljettajaa.";

    const xhrObject = new XMLHttpRequest();
    let url = 'lisaakuljettaja.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    
    xhrObject.onload = function() {
    if (xhrObject.status === 200) {
      console.log(xhrObject.responseText);
      document.getElementById("Ilmoitus").value = xhrObject.responseText;
      }else 
      {
        console.log('3. Tietokantatoiminto ei onnistu ' + xhrObject.responseText);
        document.getElementById("Ilmoitus").value = xhrObject.responseText;
      } 
    
  }
  xhrObject.onerror = function() {
    console.error('Virhe lisäyksessä ' + url);
  };

  let enimi = document.getElementById("Etunimi").value;  
  let snimi = document.getElementById("Sukunimi").value;
  let kaupunki = document.getElementById("Kaupunki").value;
  let lahiosoite = document.getElementById("Lahiosoite").value;
  let postinumero = document.getElementById("Postinumero").value;
  let puhelinnumero = document.getElementById("Puhelinnumero").value;
  let sposti = document.getElementById("Sahkoposti").value;

  xhrObject.send("Etunimi=" + enimi + "&Sukunimi=" + snimi + "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite
  + "&Postinumero=" + postinumero + "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti);

}