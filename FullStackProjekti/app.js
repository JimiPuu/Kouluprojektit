document.getElementById('btnLisaa').addEventListener('click', lisaaKuljettaja);
document.getElementById('btnMuuta').addEventListener('click', muutaTietoja);
document.getElementById('btnPoista').addEventListener('click', poistaKuljettaja);
document.getElementById('btnLisaa2').addEventListener('click', lisaaTuote);

function lisaaKuljettaja()
{
    document.getElementById("txtIlmoitus").value = "Lisätään kuljettajaa.";

    const xhrObject = new XMLHttpRequest();
    let url = 'lisaakuljettaja.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    
    xhrObject.onload = function() {
    if (xhrObject.status === 200) {
      console.log('1. palattiin onnistuneesti ' + xhrObject.responseText);

      if (xhrObject.responseText == 'OK')
      {
        console.log('2. Tietokantatoiminto onnistui ' + xhrObject.responseText);
        document.getElementById("txtIlmoitus").value = "Kuljettaja lisätty";
      } else 
      {
        console.log('3. Tietokantatoiminto ei onnistu ' + xhrObject.responseText);
        document.getElementById("txtIlmoitus").value = xhrObject.responseText;
      } 
    }
  }
  xhrObject.onerror = function() {
    console.error('Virhe lisäyksessä ' + url);
  };

  let enimi = document.getElementById("txtEtunimi").value;  
  let snimi = document.getElementById("txtSukunimi").value;
  let kaupunki = document.getElementById("txtKaupunki").value;
  let lahiosoite = document.getElementById("txtLahiosoite").value;
  let postinumero = document.getElementById("txtPostinumero").value;
  let puhelinnumero = document.getElementById("txtPuhelinnumero").value;
  let sposti = document.getElementById("txtSahkoposti").value;

  xhrObject.send("Etunimi=" + enimi + "&Sukunimi=" + snimi + "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite
  + "&Postinumero=" + postinumero + "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti);

}


window.onload = loadPlaces();
document.getElementById('places-dropdown').addEventListener('click', getSelectValue, muutaTietoja());

let henkilot;

function loadPlaces(){

  let dropdown = document.getElementById('places-dropdown');
  let defaultOption = document.createElement('option');
  defaultOption.text = 'Valitse kuljettajatunnus';
  defaultOption.value = '';
  dropdown.add(defaultOption);
  dropdown.selectedIndex = 0;

  const xhrObject = new XMLHttpRequest();
  let url = 'haekuljettaja.php';
  xhrObject.open('GET', url, true);
 
  xhrObject.onload = function() {
  if (xhrObject.status === 200) {

    console.log(xhrObject.responseText);
    
    const JSONdataObject = JSON.parse(xhrObject.responseText);
    henkilot = JSONdataObject;

    let option;
    for (let i = 0; i < JSONdataObject.length; i++) {
      option = document.createElement('option');
      option.text = JSONdataObject[i].KuljettajaID;
      option.value = i;
      dropdown.add(option);
    }
    
  } 
}

xhrObject.onerror = function() {
  console.error('An error occurred fetching the JSON from ' + url);
};
xhrObject.send();
}
function getSelectValue()
{ 
    var indeksi = document.getElementById("places-dropdown").value;
    document.getElementById("Etunimi").value = henkilot[indeksi].Etunimi;
    document.getElementById("Sukunimi").value = henkilot[indeksi].Sukunimi;
    document.getElementById("Kaupunki").value = henkilot[indeksi].Kaupunki;
    document.getElementById("Lahiosoite").value = henkilot[indeksi].Lahiosoite;
    document.getElementById("Postinumero").value = henkilot[indeksi].Postinumero;
    document.getElementById("Puhelinnumero").value = henkilot[indeksi].Puhelinnumero;
    document.getElementById("Sahkoposti").value = henkilot[indeksi].Sahkoposti; 
} 



function muutaTietoja()
{
  
    const xhrObject = new XMLHttpRequest();
    let url = 'muuta.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    let ktun = document.getElementById("places-dropdown");
    let valittuKtun = ktun.options[ktun.selectedIndex].text;
    
    let etunimi = document.getElementById("Etunimi").value;  
    let sukunimi = document.getElementById("Sukunimi").value;
    let kaupunki = document.getElementById("Kaupunki").value;  
    let lahiosoite = document.getElementById("Lahiosoite").value;
    let postinumero = document.getElementById("Postinumero").value;  
    let puhelinnumero = document.getElementById("Puhelinnumero").value;
    let sposti = document.getElementById("Sahkoposti").value;
    
    console.log("places-dropdown=" + valittuKtun + "&Etunimi=" + etunimi + "&Sukunimi=" + sukunimi +
    "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite + "&Postinumero=" + postinumero +
    "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti); 
    xhrObject.send("places-dropdown=" + valittuKtun + "&Etunimi=" + etunimi + "&Sukunimi=" + sukunimi +
    "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite + "&Postinumero=" + postinumero +
    "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti); 
       
    
  xhrObject.onload = function() {
    
    if (xhrObject.status === 200) {

      console.log(xhrObject.responseText);
      document.getElementById("txtIlmo").value = xhrObject.responseText;

    } 
  }
  xhrObject.onerror = function() {
    console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
  };

}

function poistaKuljettaja(){

  const xhrObject = new XMLHttpRequest();
  let url = 'poista.php';
  xhrObject.open('POST', url, true);
        
  xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
  let ktun = document.getElementById("places-dropdown");  
  let valittuKtun = ktun.options[ktun.selectedIndex].text;
  console.log("places-dropdown=" + valittuKtun); 
  xhrObject.send("places-dropdown=" + valittuKtun);    
        
  xhrObject.onload = function() {
    if (xhrObject.status === 200) {
    
        console.log(xhrObject.responseText);
        document.getElementById("txtIlmo").value = xhrObject.responseText;
        document.getElementById("Etunimi").value = "";  
        document.getElementById("Sukunimi").value = "";
        document.getElementById("Kaupunki").value = "";  
        document.getElementById("Lahiosoite").value = "";
        document.getElementById("Postinumero").value = "";  
        document.getElementById("Puhelinnumero").value = "";
        document.getElementById("Sahkoposti").value = "";
    
      } 
  }
  xhrObject.onerror = function() {
  console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
      };
}


window.onload = loadTuotteet();
document.getElementById('tuotteet-dropdown').addEventListener('click', getSelectValue2);

let tuotteet;

function loadTuotteet(){

  let dropdown = document.getElementById('tuotteet-dropdown');
  let defaultOption = document.createElement('option');
  defaultOption.text = 'Valitse tuote';
  defaultOption.value = '';
  dropdown.add(defaultOption);
  dropdown.selectedIndex = 0;

  const xhrObject = new XMLHttpRequest();
  let url = 'haetuotteet.php';
  xhrObject.open('GET', url, true);
 
  xhrObject.onload = function() {
  if (xhrObject.status === 200) {

    console.log(xhrObject.responseText);
    
    const JSONdataObject = JSON.parse(xhrObject.responseText);
    tuotteet = JSONdataObject;

    let option;
    for (let i = 0; i < JSONdataObject.length; i++) {
      option = document.createElement('option');
      option.text = JSONdataObject[i].Nimi;
      option.value = i;
      dropdown.add(option);
    }
    
  } 
}

xhrObject.onerror = function() {
  console.error('An error occurred fetching the JSON from ' + url);
};
xhrObject.send();
}
function getSelectValue2()
{ 
    var indeksi = document.getElementById("tuotteet-dropdown").value;
    document.getElementById("tuoteID").value = tuotteet[indeksi].TuoteID;
    document.getElementById("tuoteHinta").value = tuotteet[indeksi].Hinta;
} 

function lisaaTuote()
{
    document.getElementById("txtIlmoitus2").value = "Lisätään tuote.";

    const xhrObject = new XMLHttpRequest();
    let url = 'lisaatuote.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    
    xhrObject.onload = function() {
    if (xhrObject.status === 200) {
      console.log('1. palattiin onnistuneesti ' + xhrObject.responseText);

      if (xhrObject.responseText == 'OK')
      {
        console.log('2. Tietokantatoiminto onnistui ' + xhrObject.responseText);
        document.getElementById("txtIlmoitus2").value = "Osastotieto lisätty.";
      } else 
      {
        console.log('2. Tietokantatoiminto ei onnistu ' + xhrObject.responseText);
        document.getElementById("txtIlmoitus2").value = xhrObject.responseText;
      } 
    }
  }
  xhrObject.onerror = function() {
    console.error('Virhe lisäyksessä ' + url);
  };


  let tuoteNimi = document.getElementById("txtTuoteNimi").value;  
  let tuoteHinta = document.getElementById("txtTuoteHinta").value;


  xhrObject.send("tuoteNimi=" + tuoteNimi + "&tuoteHinta=" + tuoteHinta);

  console.log(tuoteNimi + tuoteHinta);
}