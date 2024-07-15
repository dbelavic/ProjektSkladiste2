<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../config/app.php';

try {
    $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregled podataka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Pregled podataka</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Naziv proizvoda</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Datum kreiranja</th>
            <th>Datum ažuriranja</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['IdProduct']); ?></td>
            <td><?php echo htmlspecialchars($product['NameProduct']); ?></td>
            <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
            <td><?php echo htmlspecialchars($product['Price']); ?></td>
            <td><?php echo htmlspecialchars($product['ProductCreatedAt']); ?></td>
            <td><?php echo htmlspecialchars($product['ProductUpdatedAt']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="AdminView.php">Natrag na admin stranicu</a>
</body>
</html>


