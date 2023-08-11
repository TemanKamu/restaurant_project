<?php
    class Database{
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $db_name = "datarestoran";

        public function __construct(){
            try{
                $connect = new PDO("mysql:host=$this->hostname;dbname=$this->db_name","$this->username","$this->password");
            }catch(PDOException $e){
                echo "Error: ". $e->getMessage();
            }
        }

        public function showData($table,$columns = '*', $where){
            if(empty($where))
            $query = "SELECT $columns FROM $table";
            $result = $this->executeQuery($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function showData(){

        }
    }
?>