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
        $query = "SELECT * FROM habitacion ORDER BY $sort_by $order LIMIT $limit OFFSET $offset";
        $data = $this->db->prepare($query);
        $data->execute();
        $rooms = $data->fetchAll(PDO::FETCH_OBJ);
        return $rooms;
    }

    public function filterRooms($filter, $type){
        $query = $this->db->prepare("SELECT * FROM habitacion WHERE $filter = ?");
        $query->execute([$type]);
        $roomsFilter = $query->fetchAll(PDO::FETCH_OBJ);
        return $roomsFilter;
    }

}
