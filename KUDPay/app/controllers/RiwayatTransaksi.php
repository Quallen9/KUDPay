<?php

// app/controllers/RiwayatTransaksi.php
class RiwayatTransaksi extends Controller {
    public function tampilkan() {
        $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "";
        $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : "";

        // Logika untuk mengambil data dari model
        $data['transaksi'] = $this->model('riwayatTransaksi_model')->getTransaksi($tglAwal, $tglAkhir);

        // Set default dates if not provided
        $data['awalTgl'] = empty($tglAwal) ? "01-" . date('m-Y') : $tglAwal;
        $data['akhirTgl'] = empty($tglAkhir) ? date('d-m-Y') : $tglAkhir;

        // Load view dengan data
        $this->view('admin/ctk_laporanTransaksi', $data);
    }

    // public function tampilkan() {
    //     $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "";
    //     $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : "";

    //     // Logika untuk mengambil data dari model
    //     $this->loadModel('riwayatTransaksi_model');
    //     $data['transaksi'] = $this->riwayatTransaksi_model->getTransaksi($tglAwal, $tglAkhir);

    //     // Set default dates if not provided
    //     $data['awalTgl'] = empty($tglAwal) ? "01-" . date('m-Y') : $tglAwal;
    //     $data['akhirTgl'] = empty($tglAkhir) ? date('d-m-Y') : $tglAkhir;

    //     // Load view dengan data
    //     $this->view('admin/ctk_laporanTransaksi', $data);
    // }
}

