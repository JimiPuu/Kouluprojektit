
document.getElementById('btnPoistaTuote').addEventListener('click', poistaTuote);
document.getElementById('btnHaeTuote').addEventListener('click', haeTuote);

function haeTuote()
{
    const xhrObject = new XMLHttpRequest();
    let url = 'haetuote.php';
    xhrObject.open('POST', url, true);
    
    xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
    let tuote = document.getElementById("tuoteNimi").value;  
    xhrObject.send("tuoteNimi=" + tuote);    
    
  xhrObject.onload = function() {
    if (xhrObject.status === 200) {
      const JSONdataObject = JSON.parse(xhrObject.responseText);
      console.log(xhrObject.responseText);

      if (JSONdataObject[0] != undefined )
      {
        let palautettuTuoteID = JSONdataObject[0].TuoteID;
        document.getElementById("tuoteID").value = palautettuTuoteID;
        let palautettuTuoteHinta = JSONdataObject[0].Hinta;
        document.getElementById("tuoteHinta").value = palautettuTuoteHinta;
        document.getElementById("Ilmoitus3").value = "Tuotteen haku onnistui";
      }
      else
      {
        document.getElementById("tuoteID").value = "";
        document.getElementById("tuoteHinta").value = "";
        document.getElementById("Ilmoitus3").value = "Tuotetta ei löytynyt";
      }
    } 
  }
  xhrObject.onerror = function() {
    console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
  };

}

function poistaTuote()
{
  const xhrObject = new XMLHttpRequest();
  let url = 'poistatuote.php';
  xhrObject.open('POST', url, true);
        
  xhrObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
  let tuoteID = document.getElementById("tuoteID").value;  
  console.log("tuoteID=" + tuoteID); 
  xhrObject.send("tuoteID=" + tuoteID);    
        
  xhrObject.onload = function() {
    if (xhrObject.status === 200) {
    
        console.log(xhrObject.responseText);
        document.getElementById("Ilmoitus4").value = xhrObject.responseText;
        document.getElementById("tuoteNimi").value = "";  
        document.getElementById("tuoteID").value = "";
        document.getElementById("tuoteHinta").value = "";
    
      } 
  }
  xhrObject.onerror = function() {
  console.error('Virhe etsittäessä JSON tietoa osoitteesta ' + url);
      };
}