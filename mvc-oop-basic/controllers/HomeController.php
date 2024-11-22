<?php


class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }


    public function home()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listtop10 = $this->modelSanPham->top10();

        $listSanPham = $this->modelSanPham->getAllSanPham();


        require_once('./views/home.php');
    }

    public function  chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamdDanhMuc($sanPham['id'], $sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc);die();

        if (isset($sanPham)) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }


    public function daDatHang()
    {
        $thongTinDonHang = $this->modelDonHang->getAllDonHang($_SESSION['thong_tin_don_hang']['id']);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //    var_dump($mail['id']);die();

            // lẤy dl giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $_SESSION['flash'] = true;
                $_SESSION['dat_hang_thanh_cong'] = 'Đã đặt hàng thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi';
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $_SESSION['flash'] = true;
                $_SESSION['dat_hang_thanh_cong'] = 'Đã đặt hàng thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi';
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }
        require_once './views/daDatHang.php';
        deleteSessionErrors();
    }


    // danh muc san pham
    public function sanPhamDanhMuc()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listtop10 = $this->modelSanPham->top10();

        if (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] > 0) {
            $iddm = $_GET['danh_muc_id'];
            $spdm = $this->modelSanPham->sanPhamTheoDanhMuc($iddm);
            //var_dump($spdm);die();


            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            //    var_dump($listDanhMuc);die();
            require_once './views/sanPhamTheoDanhMuc.php';
        } else {
            header("Location: " . BASE_URL);
        }
    }



    public function formLogin()
    {
        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        require_once './views/auth/formLogin.php';
        deleteSessionErrors();
    }
    public function postlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay dl
            $email = $_POST['email'];
            $password = $_POST['password'];

            // xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            //    var_dump($user);die();

            if ($user == $email) {
                // dn thanh cong
                // Luu thong tin vao session
                $_SESSION['user_client'] = $user;
                header("Location:" . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['errors'] = $user;
                //    var_dump($_SESSION['errors']);die();

                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL. '?act=login');
                exit();
            }
        }
    }




    public function logout()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            header('Location:' . BASE_URL. '?act=login');
        }
    }
   
}
