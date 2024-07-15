<?php

class LoginException extends Exception {
    protected $message = 'Invalid username or password.';

    public function __construct($message = null, $code = 0, Exception $previous = null) {
        if ($message) {
            $this->message = $message;
        }
        parent::__construct($this->message, $code, $previous);
    }
}

?>