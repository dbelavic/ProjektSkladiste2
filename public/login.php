<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava korisnika</title>
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

        .link {
            text-align: center;
            margin-top: 10px;
        }
        .link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <form action="../loginRegister/loginProcess.php" method="post">
        <h2>Prijava korisnika</h2>
        <input type="text" name="username" placeholder="Korisničko ime" required>
        <input type="password" name="password" placeholder="Lozinka" required>
        <button type="submit">Prijavi se</button>
        <div class="link">
            <a href="index.php">Natrag na početnu stranicu</a>
        </div>
    </form>
    
</body>
</html>
