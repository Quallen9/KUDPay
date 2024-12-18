<?php

class admin_model {
    private $table = 'admin';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAdmin(){
        $this->db->query('SELECT * FROM '. $this->table);
        return $this->db->resultSet();
    }

    public function login($ussername, $password) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ussername = :ussername');
        $this->db->bind(':ussername', $ussername);
        $user = $this->db->single();     
    
        // Langsung cek kecocokan password
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    
        return false;
    }


    
    
}