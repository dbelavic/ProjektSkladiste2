<?php
session_start();
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
    <title>Unos podataka</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="dataCreateProcess.php" method="post">
        <h2>Unos podataka</h2>
        <input type="text" name="name" placeholder="Naziv proizvoda" required>
        <input type="number" name="quantity" placeholder="Količina" required>
        <input type="number" step="0.01" name="price" placeholder="Cijena" required>
        <button type="submit">Unesi podatke</button>
    </form>
    <br>
    <a href="AdminView.php">Natrag na admin stranicu</a>
</body>
</html>
