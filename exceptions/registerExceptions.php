<?php
class RegisterExceptions extends Exception {
    public static function validateUsername($username) {
        if (!preg_match("/^[a-zA-Z0-9]{3,}$/", $username)) {
            throw new Exception("Korisničko ime mora sadržavati barem 3 znaka i smije sadržavati samo slova i brojeve.");
        }
    }

}
