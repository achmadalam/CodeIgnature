<?php

namespace controllers;

use lib\MVC\Controller\BaseController;

class User extends BaseController {
    protected function login() {
        $this->RenderView($viewModel);
    }

    protected function register(){
        var_dump($_REQUEST);die;
    }
}

?>