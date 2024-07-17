<?php
require_once '../config/app.php';
require_once '../Exceptions/loginException.php'; 
require_once '../config/Database.php';

session_start(); // Pokreće sesiju

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $database = Database::getInstance();
        $pdo = $database->getConnection();

        $sql = "SELECT * FROM Users WHERE Username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordUser'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            echo "Login successful.";
            header('Location: ../public/AdminView.php');
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