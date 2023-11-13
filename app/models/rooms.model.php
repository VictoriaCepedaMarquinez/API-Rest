<?php
require_once "./app/models/model.php";
class RoomsModel extends ModelDB {
    
    function insertRooms($tamaño,$descripcion,$imagen,$precio){
        $query = $this->db->prepare('INSERT INTO habitacion (tamaño, descripcion, imagen, precio) VALUES(?,?,?,?)');
        $query->execute([$tamaño,$descripcion,$imagen,$precio]);
    }
    
    public function updateRooms($tamaño, $descripcion, $imagen, $precio, $id) {
        $query = $this->db->prepare("UPDATE habitacion SET tamaño=?, descripcion=?, imagen=?, precio=? WHERE id=?");
        $query->execute([$tamaño, $descripcion, $imagen, $precio, $id]);
    }

    public function getRoom($room_id){
        $query=$this->db->prepare('SELECT * FROM habitacion WHERE id=?');
        $query->execute([$room_id]);
        $room=$query->fetch(PDO::FETCH_OBJ);
        return $room;
    }

    public function getRooms($sort_by, $order, $page, $per_page) {
        $limit = $per_page;
        $offset = ($page - 1) * $per_page;
        $query = $this->db->prepare("SELECT * FROM habitacion ORDER BY $sort_by $order LIMIT :limit OFFSET :offset");
    
        // Vincula los valores de los marcadores de posición
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $rooms = $query->fetchAll(PDO::FETCH_OBJ);
        return $rooms;
    } 


    public function filterRooms($filter, $type) {
        $allowedFilters = ["id","tamaño", "descripcion", "imagen", "precio"];
        $filter = in_array($filter, $allowedFilters) ? $filter : "precio";
        $query = $this->db->prepare("SELECT * FROM habitacion WHERE $filter = :type");
    
        // Vincular el valor del marcador de posición
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->execute();
        $roomsFilter = $query->fetchAll(PDO::FETCH_OBJ);
        return $roomsFilter;
    }
}
