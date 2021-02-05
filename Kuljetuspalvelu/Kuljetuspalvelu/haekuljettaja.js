document.getElementById('btnMuutaKuljettaja').addEventListener('click', muutaKuljettaja);
document.getElementById('btnPoistaKuljettaja').addEventListener('click', poistaKuljettaja);

window.onload = loadKuljettajat();
document.getElementById('kuljettajat-dropdown').addEventListener('click', getSelectValue); //muuttaKuljettaja()

let kuljettajat;

function loadKuljettajat(){

  let dropdown = document.getElementById('kuljettajat-dropdown');
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
    kuljettajat = JSONdataObject;

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
    var indeksi = document.getElementById("kuljettajat-dropdown").value;
    document.getElementById("Etunimi").value = kuljettajat[indeksi].Etunimi;
    document.getElementById("Sukunimi").value = kuljettajat[indeksi].Sukunimi;
    document.getElementById("Kaupunki").value = kuljettajat[indeksi].Kaupunki;
    document.getElementById("Lahiosoite").value = kuljettajat[indeksi].Lahiosoite;
    document.getElementById("Postinumero").value = kuljettajat[indeksi].Postinumero;
    document.getElementById("Puhelinnumero").value = kuljettajat[indeksi].Puhelinnumero;
    document.getElementById("Sahkoposti").value = kuljettajat[indeksi].Sahkoposti; 
} 

function muutaKuljettaja()
{
  
    const xhrObject = new XMLHttpRequest();
    let url = 'muutakuljettaja.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    let ktun = document.getElementById("kuljettajat-dropdown");
    let valittuKtun = ktun.options[ktun.selectedIndex].text;
    
    let etunimi = document.getElementById("Etunimi").value;  
    let sukunimi = document.getElementById("Sukunimi").value;
    let kaupunki = document.getElementById("Kaupunki").value;  
    let lahiosoite = document.getElementById("Lahiosoite").value;
    let postinumero = document.getElementById("Postinumero").value;  
    let puhelinnumero = document.getElementById("Puhelinnumero").value;
    let sposti = document.getElementById("Sahkoposti").value;
    
    console.log("kuljettajat-dropdown=" + valittuKtun + "&Etunimi=" + etunimi + "&Sukunimi=" + sukunimi +
    "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite + "&Postinumero=" + postinumero +
    "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti);

    xhrObject.send("kuljettajat-dropdown=" + valittuKtun + "&Etunimi=" + etunimi + "&Sukunimi=" + sukunimi +
    "&Kaupunki=" + kaupunki + "&Lahiosoite=" + lahiosoite + "&Postinumero=" + postinumero +
    "&Puhelinnumero=" + puhelinnumero + "&Sahkoposti=" + sposti); 
       
    
  xhrObject.onload = function() {
    
    if (xhrObject.status === 200) {

      console.log(xhrObject.responseText);
      document.getElementById("Ilmoitus").value = xhrObject.responseText;
    } 
  }
  xhrObject.onerror = function() {
    console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
  };

}

function poistaKuljettaja(){

  const xhrObject = new XMLHttpRequest();
  let url = 'poistakuljettaja.php';
  xhrObject.open('POST', url, true);
        
  xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
  let ktun = document.getElementById("kuljettajat-dropdown");  
  let valittuKtun = ktun.options[ktun.selectedIndex].text;
  console.log("kuljettajat-dropdown=" + valittuKtun); 
  xhrObject.send("kuljettajat-dropdown=" + valittuKtun);    
        
  xhrObject.onload = function() {
    if (xhrObject.status === 200) {
    
        console.log(xhrObject.responseText);
        document.getElementById("Etunimi").value = "";  
        document.getElementById("Sukunimi").value = "";
        document.getElementById("Kaupunki").value = "";  
        document.getElementById("Lahiosoite").value = "";
        document.getElementById("Postinumero").value = "";  
        document.getElementById("Puhelinnumero").value = "";
        document.getElementById("Sahkoposti").value = "";
        document.getElementById("kuljettajat-dropdown").value = "";
        document.getElementById("Ilmoitus2").value = xhrObject.responseText;
    
      } 
  }
  xhrObject.onerror = function() {
  console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
      };
}

