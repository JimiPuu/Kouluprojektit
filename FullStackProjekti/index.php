<html>
<head>
</head>
<body>
<h2>Kuljettajan lisäys</h2>
<div>
        Etunimi
        <input id="txtEtunimi" type="text" value=""  />
        <br>
        Sukunimi
        <input id="txtSukunimi" type="text" value="" />
        <br> 
        Kaupunki
        <input id="txtKaupunki" type="text" value="" />
        <br> 
        Lähiosoite
        <input id="txtLahiosoite" type="text" value="" />
        <br>
        Postinumero
        <input id="txtPostinumero" type="text" value="" />
        <br> 
        Puhelinnumero
        <input id="txtPuhelinnumero" type="text" value="" />
        <br> 
        Sähköposti
        <input id="txtSahkoposti" type="text" value="" />
        <br> 
        <input type="submit" value="Lisää" id="btnLisaa" />
        <br>
</div>
<input id="txtIlmoitus" type="text" value="" />
        <br>


<div class="container">
    <h1>Kuljettajat</h1>  
    <div id="places">
      <select id="places-dropdown" >
      </select> <br>
      Nimi
      <input type="text" id="Etunimi"> <br>
      Sukunimi
      <input type="text" id="Sukunimi"> <br>
      Kaupunki
      <input type="text" id="Kaupunki"> <br>
      Lähiosoite
      <input type="text" id="Lahiosoite"> <br>
      Postinumero
      <input type="text" id="Postinumero"> <br>
      Puhelinnumero
      <input type="text" id="Puhelinnumero"> <br>
      Sähköposti
      <input type="text" id="Sahkoposti">
    </div>
</div>
        <input type="submit" value="Muuta tiedot" id="btnMuuta" />
        <input type="submit" value="Poista kuljettaja" id="btnPoista" /><br>
        Ilmoitus:
        <input id="txtIlmo" type="text" value="" maxlength="49" size="49"> 
        <br>

        <div class="container">
    <h1>Tuotteet</h1>  
    <div id="tuotteet">
      <select id="tuotteet-dropdown" >
      </select> <br>
      TuoteID:
      <input type="text" id="tuoteID"> <br>
      Hinta:
      <input type="text" id="tuoteHinta"> <br>
</div>

<h2>Tuotteen lisäys</h2>
<div>
Tuotteen nimi
        <input id="txtTuoteNimi" type="text" value=""  />
        <br>
        Tuotteen hinta
        <input id="txtTuoteHinta" type="text" value="" />
        <br> 
        <input type="submit" value="Lisää" id="btnLisaa2" />
        <input id="txtIlmoitus2" type="text" value="" />
</div>
<script src="app.js"></script>
</body>
</html>
