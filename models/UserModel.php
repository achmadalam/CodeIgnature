<?php

    namespace models;

    use lib\MVC\Model\BaseModel;
    use SystemCore\MysqlBuilder;
    
    class UserModel extends BaseModel {
        public $nama;
        public $email;

        public function __construct($nama, $email) {
            $this->nama = $nama;
            $this->email = $email;
        }

        public static function getUsers() {
            $conn = self::getDB();
            
            $builder = new MysqlBuilder('users','userid');
            
            $builder->select();
            $query = $builder->getsql();
            
            $sth = $conn->prepare($query);
            $sth->execute();
        
            $result = array();
            foreach ($sth->fetchAll(\PDO::FETCH_ASSOC) as $key => $row) {
                array_push($result,
                       new Pengguna($row["fullname"], $row["email"]));
            }

            return $result;
        }

        public function login($username,$password) {
            $conn = self::getDB();
            
            $builder = new MysqlBuilder('users','userid');
            
            $builder->select();
            
            $builder->where("username",$username);            
            $builder->where("md5(password)",md5($password));
            $builder->build();
            $query = $builder->getsql();
            var_dump($query);die;
            // $sth = $conn->prepare($query);
            // $sth->execute();
        
            // $result = array();
            // foreach ($sth->fetchAll(\PDO::FETCH_ASSOC) as $key => $row) {
            //     array_push($result,
            //            new Pengguna($row["fullname"], $row["email"]));
            // }

            // return $result;
        }
    }
    ?>