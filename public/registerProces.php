<?php
require_once '../config/app.php';
require_once '../exceptions/registerExceptions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ime = htmlspecialchars($_POST['ime'], ENT_QUOTES, 'UTF-8');
    $prezime = htmlspecialchars($_POST['prezime'], ENT_QUOTES, 'UTF-8');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // dodati za vrijeme created at 
    $userCreatedAt = date('Y-m-d H:i:s');

    if ($password !== $password_confirm) {
        die('Lozinke se ne podudaraju.');
    }

   
    // passsword se mora hashirati
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
         // validiramo je li username u skladu sa zapisom 
        registerExceptions::validateUsername($username);

        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (ime, prezime, username, passwordUser, UserCreatedAt) 
                VALUES (:ime, :prezime, :username, :password, :UserCreatedAt)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':UserCreatedAt', $userCreatedAt); 

        $stmt->execute();
        echo "<div style='text-align: center; justify-content: center; font-size: 20px;'>
        Registracija uspješna.<br>
        <a href='login.php' style='color: #007bff;'>Krenite na prijavu</a>
      </div>";

    } catch (PDOException $e) {
        echo "Greška: " . $e->getMessage();
    }
}
?>
