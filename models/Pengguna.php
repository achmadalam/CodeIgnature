<?php

    namespace models;

    use lib\MVC\Model\BaseModel;
    use SystemCore\MysqlBuilder;
    
    class User extends BaseModel {
        public $nama;
        public $email;

        public function __construct($nama, $email) {
            $this->nama = $nama;
            $this->email = $email;
        }

        public static function getPengguna() {
            $conn = self::getDB();
            
            $builder = new MysqlBuilder('tbl_user','iduser');
            
            $builder->select();
            $query = $builder->getsql();
            
            $sth = $conn->prepare($query);
            $sth->execute();
        
            $result = array();
            foreach ($sth->fetchAll(\PDO::FETCH_ASSOC) as $key => $row) {
                array_push($result,
                       new Pengguna($row["nama"], $row["email"]));
            }

            return $result;
        }
    }
    ?>