<?php
class Login extends Controller{
    public function index() {
        $data['judul'] = 'Login';
        $this->view('tamplate/header', $data);
        $this->view('login/index');
        $this->view('tamplate/footer');
    }
}