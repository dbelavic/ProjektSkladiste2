<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../public/login.php');
    exit;
}

require_once '../config/app.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM products WHERE IdProduct = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            ?>
            <!DOCTYPE html>
            <html lang="hr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Ažuriranje proizvoda</title>
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
                <form action="dataUpdateProcessFinal.php" method="post">
                    <h2>Ažuriranje proizvoda</h2>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['IdProduct']); ?>">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($product['NameProduct']); ?>" required>
                    <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required>
                    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
                    <button type="submit">Ažuriraj</button>
                </form>
                <br>
                <a href="dataUpdate.php">Natrag</a>
            </body>
            </html>
            <?php
        } else {
            echo "Proizvod nije pronađen.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
