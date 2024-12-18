<?php 

class Customer extends Controller{
    public function index() {
        $data['judul'] = 'Layanan Customer';
        $this->view('tamplate/header', $data);
        $this->view('customer/index', $data);
        $this->view('tamplate/footer');
    }
    public function penarikan_saldo() {
        $data['judul'] = 'Penarikan Saldo';
        $this->view('tamplate/header', $data);
        $this->view('customer/penarikan_saldo', $data);
        $this->view('tamplate/footer');
    }
    public function cek_saldo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idKartu = htmlspecialchars(strip_tags($_POST['InputIDKartu']));
            $data['customer'] = $this->model('customer_model')->getCustomerbyId($idKartu);
    
            if ($data['customer']) {
                // Jika data pelanggan ditemukan
                $data['judul'] = 'Cek Saldo';
                $this->view('tamplate/header', $data);
                $this->view('customer/cek_saldo', $data);
                $this->view('tamplate/footer');
            } else {
                // Jika data pelanggan tidak ditemukan
                flasher::setFlash('gagal', 'ditemukan', 'danger');
                header('Location: ' . BASEURL . '/customer/cek_saldo');
                exit;
            }
        } else {
            // Jika bukan metode POST
            $data['customer'] = null;
            $data['judul'] = 'Cek Saldo';
            $this->view('tamplate/header', $data);
            $this->view('customer/cek_saldo', $data);
            $this->view('tamplate/footer');
        }
    }    
    public function buat_voucher() {

        if ($this->model('customer_model')->cekIDKartu($_POST)>0) {
            if($this->model('customer_model')->buatVoucher($_POST)>0){
                flasher::setFlash('Voucher', 'didaftarkan','success');
                header('Location: '. BASEURL. '/admin');
                exit;
            } else {
                flasher::setFlash('ID Kartu', 'sudah terpakai, ganti ID Kartu lainnnya','danger');
                header('Location: '. BASEURL. '/admin/buat_voucher');
                exit;
            }
        } else {
            flasher::setFlash('ID Kartu', 'sudah terpakai, ganti ID Kartu lainnnya','danger');
            header('Location: '. BASEURL. '/admin/buat_voucher');
            exit;
        }
    }

    public function topUp_saldo() {

        $jenis = "Top UP";
              
        if($this->model('customer_model')->topUp_saldo($_POST)>0){ 
            $this->model('riwayatTransaksi_model')->riwayatTransaksi($_POST, $jenis, $_SESSION['user']);
            flasher::setFlash('Top up berhasil,', 'saldo telah ditambahkan','success');
            header('Location: '. BASEURL. '/admin');
            exit;
        } else {
            flasher::setFlash('Top Up gagal,', 'saldo gagal ditambahkan','danger');
            header('Location: '. BASEURL. '/admin/topUp_saldo');
            exit;
        }
    }

    public function input_voucher() {
        $jenis = "Input Voucher";
              
        if($this->model('customer_model')->input_voucher($_POST)>0){ 
            $this->model('riwayatTransaksi_model')->riwayatTransaksi($_POST, $jenis, $_SESSION['user']);
            flasher::setFlash('Voucher berhasil', 'ditambahkan','success');
            header('Location: '. BASEURL. '/admin');
            exit;
        } else {
            flasher::setFlash('Voucher gagal', 'ditambahkan','danger');
            header('Location: '. BASEURL. '/admin/input_voucher');
            exit;
        }
    }


}