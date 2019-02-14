<?php

    namespace lib\MVC\Model;
    use SystemCore\ConnectionManager;

    abstract class BaseModel {
        public static function getDB() {
            $instance = ConnectionManager::getInstance();
            $conn = $instance->getConnection();
            return $conn;
        }

    }
?>