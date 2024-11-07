<?php
class AdminDanhMucController
{
     public $AdminDanhMuc;
     public function __construct()
     {
          $this->AdminDanhMuc = new AdminDanhMuc();
     }
     public function danhSachDanhMuc()
     {
          $listDanhMuc = $this->AdminDanhMuc->getAllDanhMuc();
          // var_dump($listDanhMuc);
          // die;
          require_once "./views/DanhMuc.php";
     }
}