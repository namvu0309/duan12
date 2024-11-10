<?php
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';



// Require toàn bộ file Models
require_once './models/AdminSanPham.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminTaiKhoan.php';


// Require toàn bộ file Views






// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
     //route báo cáo thống kê - trang chủ
     '/' => (new AdminBaoCaoThongKeController())->home(),
     //route quản lý tài khoản
       // Quản lý tài khoản quản trị
       'list-tai-khoan-quan-tri' =>(new AdminTaiKhoanController())->danhSachQuanTri(),
       'form-them-quan-tri' =>(new AdminTaiKhoanController())->formAddQuanTri(),
       'them-quan-tri' =>(new AdminTaiKhoanController())->postAddQuanTri(),
       'form-sua-quan-tri' =>(new AdminTaiKhoanController())->formEditQuanTri(),
       'sua-quan-tri' =>(new AdminTaiKhoanController())->postEditQuanTri(),





       // route
       'danhmuc' =>(new AdminDanhMucController())->danhSachDanhMuc(),


     // Trang chủ
     "/" => (new AdminDanhMucController())->danhSachDanhMuc(),
     
};

