<?php
require_once '../config/app.php';
require_once '../Exceptions\loginException.php'; 

session_start(); // Pokreće sesiju

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM Users WHERE Username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordUser'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            echo "Login successful.";
            header('Location: AdminView.php');
            exit;
        } else {
            throw new LoginException();
        }
    } catch (LoginException $e) {
        echo $e->getMessage();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>