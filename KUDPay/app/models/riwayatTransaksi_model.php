<?php

class riwayatTransaksi_model {

    private $table = 'riwayat_transaksi';
    private $db;
  
    public function __construct()
    {
        $this->db = new Database;
   
    }

    private function loadModel($modelName) {
        require_once "../models/{$modelName}.php";
        return new $modelName();
    }

    public function getRiwayatTransaksi(){
        $this->db->query('SELECT * FROM '. $this->table);
        return $this->db->resultSet();
    }

    // public function getCariRiwayatTransaksi(){
        
    //     $keyword = $_POST['keyword'];
    //     $query = "SELECT * FROM riwayat_transaksi where customer LIKE :keyword";
    //     $this->db->query($query);
    //     $this->db->bind('keyword', "%$keyword%");

    //     return $this->db->resultSet();
    // }

    public function getCariRiwayatTransaksi(){
        
        $keyword = $_POST['keyword'] ?? ''; // Ambil keyword dari POST
        $startDate = $_POST['tglAwal'] ?? null; // Ambil tanggal awal dari POST
        $endDate = $_POST['tglAkhir'] ?? null; // Ambil tanggal akhir dari POST
    
        $query = "SELECT * FROM riwayat_transaksi WHERE jenisTransaksi LIKE :keyword";
    
        // Tambahkan kondisi tanggal hanya jika parameter diberikan
        if ($startDate && $endDate) {
            $query .= " AND waktuTransaksi BETWEEN :startDate AND :endDate";

        }
    
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
    
        if ($startDate && $endDate) {
            $this->db->bind('startDate', $startDate); // Bind langsung dari input tanggal
            $this->db->bind('endDate', $endDate);
        }
    
        return $this->db->resultSet();
    }

    public function riwayatTransaksi($data,$jenis,$admin){
        $nama = $admin['ussername'];
        var_dump($nama);
        $customerModel = new customer_model();
        $customer = $customerModel->getCustomerbyId($data['idKartu']);
        var_dump($customer);

        $this->db->query("INSERT INTO riwayat_transaksi (customer, admin, jenisTransaksi, 
        nominalTransaksi, waktuTransaksi) VALUES (:customer, :admin, :jenisTransaksi, 
        :nominalTransaksi, :waktuTransaksi)");

        $this->db->bind('customer', $customer['idKartu']);
        $this->db->bind('admin', $nama); // Pastikan $admin adalah string
        $this->db->bind('jenisTransaksi', $jenis);
        $this->db->bind('nominalTransaksi', $data['nominal']); // Bind nominal dari data
        $this->db->bind('waktuTransaksi', date('Y-m-d H:i:s')); // Bind waktu saat ini

        $this->db->execute();

    }



    
}