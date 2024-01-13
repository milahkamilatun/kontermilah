<?php
    class User{
    // Connection
    private $conn;
    // Table
    private $db_table = "User";
    // Columns
    public $id;
    public $fullname;
    public $email;
    public $password;
    public $role;
    public $created;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getUser(){
        $sqlQuery = "SELECT id, fullname, email, password, role, created created FROM "
        . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createUser(){
        $sqlQuery = "INSERT INTO
        ". $this->db_table ."
            SET
                fullname = :fullname,
                email = :email,
                password = :password,
                role = :role,
                created = :created";
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->created=htmlspecialchars(strip_tags($this->created));
        // bind data
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":created", $this->created);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
        // READ single
        public function getSingleUser(){
        $sqlQuery = "SELECT
                    id,
                    fullname,
                    email,
                    password,
                    role,
                    created
                    FROM
                        ". $this->db_table ."
                    WHERE
                        id = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->fullname = $dataRow['fullname'];
        $this->email = $dataRow['email'];
        $this->password = $dataRow['password'];
        $this->role = $dataRow['role'];
        $this->created = $dataRow['created'];
        }
        // UPDATE
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        fullname = :fullname,
                        email = :email,
                        password = :password,
                        role = :role,
                        created = :created
                        WHERE
                        id = :id";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind data
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
        // DELETE
        function deleteUser(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
        return true;
        }
        return false;
        }
        // READ single
        public function proseslogin(){
            $sqlQuery = "SELECT
                        id,
                        fullname,
                        email,
                        password,
                        role,
                        created
                        FROM
                            ". $this->db_table ."
                        WHERE
                            email = :email AND
                            password = :password
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if(empty($dataRow)){
                return false;
            }else{
                return $dataRow;
            }
        }
        public function prosesregister(){
            $sqlQuery = "SELECT
                        id,
                        fullname,
                        email,
                        password,
                        role,
                        created
                        FROM
                            ". $this->db_table ."
                        WHERE
                            email = :email AND
                            password = :password
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if(empty($dataRow)){
                return false;
            }else{
                return $dataRow;
            }
        }

        public function proseslogout(){
            session_start();
            session_unset();
            session_destroy();
            return true;
        }
    }

?>