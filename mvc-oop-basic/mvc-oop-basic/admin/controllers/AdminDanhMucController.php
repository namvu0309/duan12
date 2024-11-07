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
          require_once "./views/DanhMuc.php";
     }
}