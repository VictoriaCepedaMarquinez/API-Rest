<?php
require_once "./app/models/model.php";
class UserModel extends ModelDB {
    
    public function getByName($name) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $query->execute([$name]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

   
}
