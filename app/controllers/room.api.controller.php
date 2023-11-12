<?php
require_once 'app/models/rooms.model.php';
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
class RoomApiController extends ApiController{
    private $model;
    private $authHelper;
    
    function __construct(){
        parent::__construct();
        $this->model = new RoomsModel(); 
        $this->authHelper = new authHelper;
    }

    function get($params = []){
        if(empty($params)){
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1; 
            $per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; 
            $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    
            $rooms = $this->model->getRooms($sort_by, $order, $page, $per_page);
            return $this->view->response($rooms, 200);
        }else{
            $room = $this->model->getRoom($params[":ID"]);
            if(!empty($room)){
            return $this->view->response($room, 200);
            }else{
            $this->view->response(['msg' =>'la habitacion con el id=' . $params[':ID']. 'no existe'], 404);
            }
        }

    }

    function update($params = []){
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->admin != 1){
            $this->view->response('Forbidden', 403);
            return;
        }
        $id = $params[':ID'];
        $reserve = $this->model->getRoom($id);
          if($reserve){
              $body = $this->getData();
              $tamaño= $body->tamaño;
              $descripcion = $body->descripcion;
              $imagen = $body->imagen;
              $precio = $body->precio;
              $this->model->updateRooms($tamaño, $descripcion, $imagen, $precio, $id);
  
              $this->view->response('la habitacion con id=' . $id . 'ha sido modificada con exito', 200);
          }else{
              $this->view->response('la habitacion con id=' . $id . 'no existe', 404);
          }
      }

    function create(){
        $user = $this->authHelper->currentUser();
        if(!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        if($user->admin != 1){
            $this->view->response('Forbidden', 403);
            return;
        }
        $body = $this->getData();
        $tamaño = $body->tamaño;
        $descripcion = $body->descripcion;
        $imagen = $body->imagen;
        $precio = $body->precio;

        $id = $this->model->insertRooms($tamaño,$descripcion,$imagen,$precio);
        $this->view->response(('la habitacion fue insertada') , 201);
    }

    public function filterRooms(){
        
        $filter = $_GET['filter'];
        $type = $_GET['type'];

        if($filter == 'id' || $filter == 'tamaño' || $filter == 'descripcion' || $filter == 'imagen' || $filter == 'precio'){
         $data = $this->model->filterRooms($filter,$type);
         $this->view->response($data,200);
        }else{
            $this->view->response(['el filtro ingresado no existe'],404);
        }
    }

  
}