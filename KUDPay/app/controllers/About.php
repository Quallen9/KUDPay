<?php

class About extends Controller{
    public function index() {
        $data['judul'] = 'About';
        $this->view('tamplate/header', $data);
        $this->view('about/index');
        $this->view('tamplate/footer');
    }
 
    public function page() {
        $this->view('about/page');
    }
}