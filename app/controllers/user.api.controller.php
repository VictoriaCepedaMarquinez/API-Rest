<?php
require_once 'app/models/user.model.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/controllers/api.controller.php';
class UserApiController extends ApiController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->authHelper = new authHelper();
        $this->model = new UserModel();
    }

    function getToken($params = [])
    {
        $basic = $this->authHelper->getAuthHeaders(); 
        if (empty($basic)) {
            $this->view->response('No envió encabezados de autenticación.', 401);
            return;
        }

        $basic = explode(" ", $basic);
        if ($basic[0] != "Basic") {
            $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            return;
        }

        $userpass = base64_decode($basic[1]);
        $userpass = explode(":", $userpass); 

        $user = $userpass[0];
        $pass = $userpass[1];


        $userData = $this->model->getUserByName($user);

        if($userData && $userData->nombre == $user && password_verify($pass, $userData->contraseña)) {
       
            $token = $this->authHelper->createToken($userData);
            $this->view->response($token, 200);
        } else {
            $this->view->response('El usuario o contraseña son incorrectos.', 401);
        }
    }
}
