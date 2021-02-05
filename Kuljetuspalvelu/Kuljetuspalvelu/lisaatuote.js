document.getElementById('btnLisaaTuote').addEventListener('click', lisaaTuote);

function lisaaTuote()
{

  let tuoteNimi = document.getElementById("tuoteNimi").value;  
  let tuoteHinta = document.getElementById("tuoteHinta").value;
    const xhrObject = new XMLHttpRequest();
    let url = 'lisaatuote.php';
    xhrObject.open('POST', url, true);
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    xhrObject.onload = function(){
    
        if (xhrObject.status === 200) {
          console.log('1. palattiin onnistuneesti ' + xhrObject.responseText);
          document.getElementById("Ilmoitus5").value = "Lisätään tuote.";
            if (xhrObject.responseText == 'OK')
            {
            console.log('2. Tietokantatoiminto onnistui ' + xhrObject.responseText);
            document.getElementById("Ilmoitus5").value = "Tuote lisätty";
            } else 
            {
            console.log('2. Tietokantatoiminto ei onnistu ' + xhrObject.responseText);
            document.getElementById("Ilmoitus5").value = xhrObject.responseText;
    }
  }
}
  xhrObject.onerror = function() {
    console.error('Virhe lisäyksessä ' + url);
  };
 

  xhrObject.send("tuoteNimi=" + tuoteNimi + "&tuoteHinta=" + tuoteHinta);

  console.log(tuoteNimi + tuoteHinta);
}
