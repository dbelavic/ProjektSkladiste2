<?php 
session_start(); // Pokreće sesiju

// Provjera je li korisnik prijavljen
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View - Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            font-family: Arial, sans-serif;
        }

        h1 {
            display: flex; 
            justify-content: space-around;
            align-items: baseline;
            font-family: Arial, sans-serif;
        }

        p {
            display: flex;
            justify-content: center;
            align-items: center;
            
            font-family: Arial, sans-serif;
        }

    </style>
</head>
<body>
    <h1>Admin View - Dashboard</h1>
    <p>Dobrodošli, <br> <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    
    <div class="link"><a href="../database/dataView.php">Pregledaj podatke</a></div><br>
    <div class="link"><a href="../database/dataCreate.php">Unesi podatke</a></div><br>
    <div class="link"><a href="../database/dataUpdate.php">Izmijeni podatke</a></div><br>
    <p><br><br></p>
    <p><div class="logout">
        <a href="logout.php">Odjava</a>
    </div></p>
</body>
</html>

