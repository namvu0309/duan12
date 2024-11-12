<?php 

class HomeController
{
    public $modelSanpham;

    public function __construct()
    {
        $this->modelSanpham = new SanPham();   
    }
    public function home(){
        require_once './views/home.php';
    }
    public function trangChu(){
        echo "Day laf trang chu cua tooi ";
    }

}