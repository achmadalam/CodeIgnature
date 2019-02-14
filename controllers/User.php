<?php

namespace controllers;

use lib\MVC\Controller\BaseController;
use models\UserModel;

class User extends BaseController {
    protected function index() {
        $this->RenderView($viewModel);
    }

    protected function login(){
        $userModel = new UserModel(); 
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel->login($username,$password);
    }
}

?>