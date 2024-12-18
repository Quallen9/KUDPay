<?php
class Admin extends Controller{
    public function index() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }

        $data['judul'] = 'Admin';
        $data['admin'] = $this->model('admin_model')->getAdmin();
        $this->view('tamplate/header_onLogin', $data);
        $this->view('admin/index', $data);
        $this->view('tamplate/footer');
    }
    

    public function authenticate() {

            // Check if session is already started
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

        $ussername = $_POST['ussername'];
        $password = $_POST['password'];

        $user = $this->model('admin_model')->login($ussername, $password);       

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: " . BASEURL . "/admin");
            exit;
        } else {
            // Jika login gagal
            flasher::setFlashLogin('gagal', 'Username atau Password salah', 'danger');
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASEURL . "/login");
        exit;
    }

    public function topUp_saldo() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idKartu = htmlspecialchars(strip_tags($_POST['InputIDKartu']));
            $customerModel = $this->model('customer_model');
            $data['customer'] = $customerModel->getCustomerbyId($idKartu);
    
            if ($data['customer']) {
                // Jika data pelanggan ditemukan
                $data['judul'] = 'Top Up Saldo';
                $data['admin'] = $this->model('admin_model')->getAdmin();
                $this->view('tamplate/header_onPage', $data);
                $this->view('admin/topUp_saldo', $data);
                $this->view('tamplate/footer');
            } else {
                // Jika data pelanggan tidak ditemukan
                flasher::setFlash('gagal', 'ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/topUp_saldo');
                exit;
            }
        } else {
            // Jika bukan metode POST
            $data['customer'] = null;
            $data['judul'] = 'Top Up Saldo';
            $data['admin'] = $this->model('admin_model')->getAdmin();
            $this->view('tamplate/header_onPage', $data);
            $this->view('admin/topUp_saldo', $data);
            $this->view('tamplate/footer');
        }
    }

    public function input_voucher(){
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $noRek = htmlspecialchars(strip_tags($_POST['InputNoRek']));
            $customerModel = $this->model('customer_model');
            $data['customer'] = $customerModel->getCustomerbyNoRek($noRek);
    
            if ($data['customer']) {  
                //Jika data pelanggan ditemukan
                $data['judul'] = 'Input Voucher';
                $data['admin'] = $this->model('admin_model')->getAdmin();
                $this->view('tamplate/header_onPage', $data);
                $this->view('admin/input_voucher', $data);
                $this->view('tamplate/footer');
            } else {
                // Jika data pelanggan tidak ditemukan
                flasher::setFlash('gagal', 'ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/input_voucher');
                exit;
            }
        } else {
            // Jika bukan metode POST
            $data['customer'] = null;
            $data['judul'] = 'Input Voucher';
            $data['admin'] = $this->model('admin_model')->getAdmin();
            $this->view('tamplate/header_onPage', $data);
            $this->view('admin/input_voucher', $data);
            $this->view('tamplate/footer');
        }
    }

    public function pembayaran_angsuran() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        $data['judul'] = 'Pembayaran Angsuran';
        $data['admin'] = $this->model('admin_model')->getAdmin();
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/pembayaran_angsuran');
        $this->view('tamplate/footer');
    }

    public function pembayaran_belanja() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        $data['judul'] = 'Pembayaran Belanja';
        $data['admin'] = $this->model('admin_model')->getAdmin();
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/pembayaran_belanja');
        $this->view('tamplate/footer');
    }

    public function daftar_customer() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        $data['judul'] = 'Daftar Customer';
        $data['customer'] = $this->model('customer_model')->getCustomer();
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/daftar_customer', $data);
        $this->view('tamplate/footer');
    }

    public function buat_voucher() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        $data['judul'] = 'Buat Voucher';
        $data['customer'] = $this->model('customer_model')->getCustomer();
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/buat_voucher', $data);
        $this->view('tamplate/footer');
    }

    public function cek_saldo() {
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $idKartu = htmlspecialchars(strip_tags($_POST['InputIDKartu']));
            $customerModel = $this->model('customer_model');
            $data['customer'] = $customerModel->getCustomerbyId($idKartu);
    
            if ($data['customer']) {
                // Jika data pelanggan ditemukan
                $data['judul'] = 'Cek Saldo';
                $data['admin'] = $this->model('admin_model')->getAdmin();
                $this->view('tamplate/header_onPage', $data);
                $this->view('admin/cek_saldo', $data);
                $this->view('tamplate/footer');
            } else {
                // Jika data pelanggan tidak ditemukan
                flasher::setFlash('gagal', 'ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/cek_saldo');
                exit;
            }
        } else {
            // Jika bukan metode POST
            $data['customer'] = null;
            $data['judul'] = 'Cek Saldo';
            $data['admin'] = $this->model('admin_model')->getAdmin();
            $this->view('tamplate/header_onPage', $data);
            $this->view('admin/cek_saldo', $data);
            $this->view('tamplate/footer');
        }
    }

    // public function riwayat_transaksi(){
    //     // Periksa apakah sudah login
    //     if (!isset($_SESSION['user'])) {
    //         header("Location: " . BASEURL . "/login");
    //         exit;
    //     }
    //     $data['judul'] = 'Riwayat Transaksi';
    //     $data['riwayat_transaksi'] = $this->model('riwayatTransaksi_model')->getRiwayatTransaksi();
    //     $this->view('tamplate/header_onPage', $data);
    //     $this->view('admin/riwayat_transaksi', $data);
    //     $this->view('tamplate/footer');
    // }

    public function riwayat_transaksi(){
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
    
        // Ambil input tanggal dari form (jika ada)
        $awalTgl = $_POST['tglAwal'] ?? '';
        $akhirTgl = $_POST['tglAkhir'] ?? '';
    
        // Persiapkan data riwayat transaksi
        $data['judul'] = 'Riwayat Transaksi';
        $data['awalTgl'] = $awalTgl; // Kirim nilai tanggal ke view
        $data['akhirTgl'] = $akhirTgl;
        
        // Ambil data riwayat transaksi (jika ada filter)
        if ($awalTgl && $akhirTgl) {
            $data['riwayat_transaksi'] = $this->model('riwayatTransaksi_model')->getCariRiwayatTransaksi();
        } else {
            $data['riwayat_transaksi'] = $this->model('riwayatTransaksi_model')->getRiwayatTransaksi();
        }
    
        // Kirim data ke view
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/riwayat_transaksi', $data);
        $this->view('tamplate/footer');
    }
    

    public function cari_transaksi(){
        // Periksa apakah sudah login
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASEURL . "/login");
            exit;
        }
        $data['judul'] = 'Riwayat Transaksi';
        $data['riwayat_transaksi'] = $this->model('riwayatTransaksi_model')->getCariRiwayatTransaksi();
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/riwayat_transaksi', $data);
        $this->view('tamplate/footer');
    }

    public function cetak_laporanTransaksi(){
        $data['judul'] = 'Riwayat Transaksi';
        $this->view('tamplate/header_onPage', $data);
        $this->view('admin/cetak_laporanTransaksi');
        $this->view('tamplate/footer');
       }

    
}