<?php

class flasher {
    public static function setFlash($pesan, $aksi, $tipe){
        $_SESSION['flash']=[
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash(){
        if(isset($_SESSION['flash'])){
            echo '<div class="alert alert-'.$_SESSION['flash']['tipe'].' alert-dismissible fade show" role="alert">
            <strong>'.$_SESSION['flash']['pesan'].'</strong> '.$_SESSION['flash']['aksi'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function setFlashLogin($pesan, $aksi, $tipe){
        $_SESSION['flashLogin']=[
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flashLogin(){
        if(isset($_SESSION['flashLogin'])){
            echo '<div class="alert alert-'.$_SESSION['flashLogin']['tipe'].' alert-dismissible fade show" role="alert">
            Login <strong>'.$_SESSION['flashLogin']['pesan'].'</strong> '.$_SESSION['flashLogin']['aksi'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['flashLogin']);
        }
    }

}