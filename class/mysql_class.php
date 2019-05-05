<?php

include '../config/config.php';

class sql
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "bus-tracker";
    private $conn;
    
    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function select($sql)
    {
       $result = $this->conn->query($sql);
        
       return $result->num_rows > 0 ? $result : "0 results";      

    }
    
    public function insert($sql)
    {         
        echo $this->conn->query($sql) ? "New record created successfully" : "Error: " . $sql . "<br>" . $this->conn->error;      
    }

    public function update($sql)
    {
       $result = $this->conn->query($sql);
        
       return $result;      

    }

   function __destruct()
   {
        $this->conn->close();
   }
    
}

?>