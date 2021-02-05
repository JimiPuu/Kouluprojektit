<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tervetuloa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ text-align: center;}
    </style> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="page-header">
        <h1>Tervetuloa <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    </div class="valikko">
    <p>

        <a href="haeKuljettaja.html" class="btn btn-primary">Kuljettajan haku</a> <br> <br>
        <a href="lisaaKuljettaja.html" class="btn btn-primary">Lisää kuljettaja</a><br><br>
        <a href="haeTuote.html" class="btn btn-primary">Tuotteen haku</a><br><br>
        <a href="lisaaTuote.html" class="btn btn-primary">Tuotteen lisäys</a><br><br>

    </p>
    <section id="account-section">
    <div class="container">
    <a href="reset-password.php"class="btn btn-warning">Nollaa salasana</a> 
        <a href="logout.php" class="btn btn-danger">Kirjaudu ulos</a>
          </div>  
</div>         
</section> 
</body>
</html>