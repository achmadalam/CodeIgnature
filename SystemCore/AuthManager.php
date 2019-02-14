<?php 
namespace SystemCore;

use SystemCore\SessionManager;

class AuthManager {
    private $db;
    private $error;
    private $session;

    public function __construct($dbconnection){
        $this->db=$dbconnection;
        $session = new SessionManager();
    }

    public function register($nama,$email,$password){
        
    }

    public function login($nama,$password){
        
    }

    public function isLoggedIn(){
        // Apakah user session sudah ada di session 

       if($session->getSession('user_session') != '') 

       { 

         return true; 

       } 
    }

    public function getUser(){

    }

    public function logout(){
        session_destroy();

        return true; 
    }

    public function getLastError(){
        return $this->error; 
    }

}
?>