<?php
require_once "config.php";

class ModelDB {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASSWORD);
        $this->deploy();
    }

    function deploy() {
        // Chequear si la base de datos "hotel" existe
        $query = $this->db->query('SHOW DATABASES LIKE "hotel"');
        $databaseExists = $query->rowCount() > 0;

        if (!$databaseExists) {
            // Si la base de datos no existe, créala
            $this->db->exec('CREATE DATABASE hotel');
        }

        // Seleccionar la base de datos "hotel"
        $this->db->exec('USE hotel');

        // Creación de la tabla "habitacion" (sin restricciones de clave externa)
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS `habitacion` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `tamaño` varchar(50) NOT NULL,
                `descripcion` text NOT NULL,
                `imagen` varchar(250) NOT NULL,
                `precio` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');

        // Insertar datos en la tabla "habitacion" solo si no existen registros
        $query = $this->db->query('SELECT * FROM `habitacion`');
        if ($query->rowCount() == 0) {
            $this->db->exec('
                INSERT INTO `habitacion` (`tamaño`, `descripcion`, `imagen`, `precio`) VALUES
                ("Doble deluxe", "Las habitaciones cuentan con ventilador de techo, LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "images/habitacion_doble.jpg", 30),
                ("Triple superior", "Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "images/habitacion_triple.jpg", 45),
                ("Royal deluxe", "Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "images/habitacion_cuadruple.jpg", 60),
                ("Simple superior", "Las habitaciones cuentan con LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, ventilador de techo, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "images/652dce871c771.jpg", 15)
            ');
        }

        // Creación de la tabla "reserva" (sin restricciones de clave externa)
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS `reserva` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `id_usuario` int(11) NOT NULL,
                `id_habitacion` int(11) NOT NULL,
                `cant_noches` int(11) NOT NULL,
                `finalizada` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');

        // Insertar datos en la tabla "reserva" solo si no existen registros
        $query = $this->db->query('SELECT * FROM `reserva`');
        if ($query->rowCount() == 0) {
            $this->db->exec('
                INSERT INTO `reserva` (`id_usuario`, `id_habitacion`, `cant_noches`, `finalizada`) VALUES
                (2, 5, 9, 0),
                (2, 5, 9, 0),
                (2, 4, 6, 0),
                (2, 5, 1, 0),
                (2, 4, 5, 0),
                (2, 3, 6, 0),
                (2, 3, 3, 0),
                (2, 3, 1, 0),
                (2, 3, 5, 0),
                (2, 3, 1, 0),
                (2, 4, 6, 0),
                (2, 4, 3, 1),
                (2, 4, 3, 1),
                (2, 4, 3, 1),
                (2, 4, 1, 1),
                (2, 3, 1, 0),
                (2, 3, 1, 0),
                (2, 3, 1, 1),
                (2, 3, 1, 0),
                (2, 4, 3, 1)
            ');
        }

        // Creación de la tabla "usuario" (sin restricciones de clave externa)
        $this->db->exec('
            CREATE TABLE IF NOT EXISTS `usuario` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nombre` varchar(50) NOT NULL,
                `apellido` varchar(50) NOT NULL,
                `dni` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `contraseña` varchar(250) NOT NULL,
                `admin` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');

        // Insertar datos en la tabla "usuario" solo si no existen registros
        $query = $this->db->query('SELECT * FROM `usuario`');
        if ($query->rowCount() == 0) {
            $passwordAdmin_hasheada = password_hash(USER_ADMIN_PASSWORD, PASSWORD_DEFAULT);
            $passwordUser_hasheada = password_hash(USER_PASSWORD, PASSWORD_DEFAULT);
            $this->db->exec('
                INSERT INTO `usuario` (`nombre`, `apellido`, `dni`, `email`, `contraseña`, `admin`) VALUES
                ("usuario", "", 0, "", "' . $passwordUser_hasheada . '", 0),
                ("webadmin", "", 0, "", "' . $passwordAdmin_hasheada . '", 1)
            ');
        }
    }
}
?>