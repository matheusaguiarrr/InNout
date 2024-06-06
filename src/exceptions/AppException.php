<?php
class AppException extends Exception {
    protected $message;
    protected $code;
    protected $previous;
    public function __construct(
            $message, 
            $code = 0, 
            $previous = null
        ){
        parent::__construct($message, $code, $previous);
    }
}