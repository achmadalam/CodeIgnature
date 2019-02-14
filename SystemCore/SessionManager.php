<?php 
namespace SystemCore;

class SessionManager {

    public function __construct(){
        session_start();
    }

    public function setSession($key,$value){
        $_SESSION[$key] = $value;
    }

    public function unsetSession($key,$value){
        unset($_SESSION[$key]);
    }

    public function getSession($key){
        return $_SESSION[$key];
    }
}
?>