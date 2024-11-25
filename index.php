<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/GioHang.php';
require_once './controllers/TaiKhoan.php';
require_once './controllers/SanPham.php';
require_once './controllers/DanhMuc.php';


// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';



// Require toàn bộ file Views

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {

    '/' => (new HomeController())->home(),
    // Trang chủ
    'chi-tiet-san-pham' => (new SanPhamController())->chitietSanPham(),
    'gui-binh-luan' => (new SanPhamController())->guiBinhLuan(),
    
    
    'lien-he' => (new HomeController())->lienHe(),
    'gioi-thieu' => (new HomeController())->gioiThieu(),
    'search' => (new HomeController())->timKiem(),
    //sanpham
    'san-pham-theo-danh-muc' => (new DanhMucController())->sanPhamDanhMuc(),


    // Giỏ hàng ,đơn hàng
    'them-gio-hang' => (new GioHangDonHangController())->addGioHang(),
    'gio-hang' => (new GioHangDonHangController())->gioHang(),
    'thanh-toan' => (new GioHangDonHangController())->thanhToan(),
    'xu-ly-thanh-toan' => (new GioHangDonHangController())->postThanhToan(),
    'xoa-san-pham-gio-hang' => (new GioHangDonHangController())->xoaSp(),
    'da-dat-hang' => (new GioHangDonHangController())->daDatHang(),

    //authe
    'login' => (new TaiKhoanController())->formLogin(),
    'check-login' => (new TaiKhoanController())->postlogin(),
    'logout' => (new TaiKhoanController())->logout(),
    'quen-mat-khau' => (new TaiKhoanController())->quenMatKhau(),
    'lay-mat-khau' => (new TaiKhoanController())->layMatKhau(),
    'form-dang-ky' => (new TaiKhoanController())->formDangKy(),
    'dang-ky' => (new TaiKhoanController())->dangKy(),


    'tai-khoan' => (new TaiKhoanController())->taiKhoan(),
    'sua-mat-khau-ca-nhan' => (new TaiKhoanController())->postEditMatKhauCaNhan(),
};
