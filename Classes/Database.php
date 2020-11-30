<?php

class Database{

    private $connection;
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'blogculinar';
    private $_port = '3308';

    function __construct()
    {
        $this->connect_db();
    }

    public function connect_db(){
        $this->connection = mysqli_connect(
            $this->_host,$this->_username,$this->_password,$this->_database,$this->_port
        );
        if(mysqli_connect_error()){
            die("Conexiunea la baza de date a esuat".mysqli_connect_error().mysqli_connect_errno());
        }
    }
    
    public function getConnection() {
        return $this->connection;
    }
    public function sanitize($var){
        $return = mysqli_real_escape_string($this->connection,$var);
        return $return;
    }
}
?>