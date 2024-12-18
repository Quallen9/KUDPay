<?php

class customer_model {

    private $table = 'customer';
    private $db;

  
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCustomer(){
        $this->db->query('SELECT * FROM '. $this->table);
        return $this->db->resultSet();
    }

    // public function getCustomerbyId(){
    //     $idKartu = $_POST('InputIDKartu');
    //     $this->db->query("SELECT * FROM customer WHERE idKartu LIKE :id");
    //     $this->db->bind('idKartu', "$idKartu");
    //     return $this->db->single();
    // }

    public function getCustomerbyId($idKartu){

        $this->db->query('SELECT * FROM customer WHERE idKartu = :idKartu');
        $this->db->bind('idKartu', $idKartu);

        return $this->db->single();
    }

    public function getCustomerbyNoRek($noRek){

        $this->db->query('SELECT * FROM customer WHERE noRekening = :noRek');
        $this->db->bind('noRek', $noRek);

        return $this->db->single();
    }

    public function cekIDKartu($data){

        $customer = $this->getCustomerbyId($data['idKartu']);

        if ($customer) {
            return -1;
        } else {
            return 1;
        }
    }

    public function buatVoucher ($data){
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO customer VALUES (:idKartu, :noRekening, :nama, :voucher, :saldo, :alamat, :password)");
        $this->db->bind('idKartu', $data['idKartu']);
        $this->db->bind('noRekening', $data['noRekening']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('password', $hashed_password);
        $this->db->bind('voucher', 0);
        $this->db->bind('saldo', 0);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function topUp_saldo($data){

        $customer= $this->getCustomerbyId($data['idKartu']);

        if($customer){
            $saldoBaru = $customer['saldo'] + $data['nominal'];
            // Update saldo
            $this->db->query('UPDATE ' . $this->table . ' SET saldo = :saldo WHERE idKartu = :idKartu');
            $this->db->bind(':saldo', $saldoBaru);
            $this->db->bind(':idKartu', $customer['idKartu']);
            $this->db->execute();
            
            return $this->db->rowCount();
        }

        //customer tidak ditemukan
        return false;
    }

    public function input_voucher($data){

        $customer= $this->getCustomerbyNoRek($data['noRekening']);

        if($customer){
            $saldoVoucherBaru = $customer['voucher'] + $data['nominal'];
            // Update saldo voucher
            $this->db->query('UPDATE ' . $this->table . ' SET voucher = :voucher WHERE noRekening = :noRekening');
            $this->db->bind(':voucher', $saldoVoucherBaru);
            $this->db->bind(':noRekening', $customer['noRekening']);
            $this->db->execute();
            
            return $this->db->rowCount();
        }

        //customer tidak ditemukan
        return false;
    }


}