<?php
class Home extends Controller{
    public function index() {
        $data['judul'] = 'Home';
        $this->view('tamplate/header', $data);
        $this->view('home/index');
        $this->view('tamplate/footer');
    }


}