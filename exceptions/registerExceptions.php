<?php
class RegisterExceptions extends Exception {
    public static function validateUsername($username) {
        if (!preg_match("/^[a-zA-Z0-9]{3,}$/", $username)) {
            throw new Exception("Korisničko ime mora sadržavati barem 3 znaka i smije sadržavati samo slova i brojeve.");
        }
    }
    public static function handleDuplicateUsername($exception) {
        if ($exception->getCode() == 23000 && strpos($exception->getMessage(), 'for key \'username\'') !== false) {
            throw new Exception("Korisničko ime već postoji.");
        } else {
            throw new Exception("Greška s bazom podataka: " . $exception->getMessage());
        }
    }
}
?>

