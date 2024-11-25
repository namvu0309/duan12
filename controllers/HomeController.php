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
     public function timKiem()
    {
        // Lấy danh sách danh mục và top 10 sản phẩm để hiển thị lên giao diện
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $listtop10 = $this->modelSanPham->top10();

        // Kiểm tra nếu phương thức gửi dữ liệu là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy từ khóa từ người dùng và loại bỏ khoảng trắng thừa
            $keyword = trim($_POST['keyword'] ?? '');

            if (empty($keyword)) {
                // Nếu từ khóa rỗng, chuyển hướng hoặc hiển thị thông báo
                $error = "Vui lòng nhập từ khóa tìm kiếm.";
                header("Location: " . BASE_URL);
                return;
            }

            // Tìm kiếm sản phẩm theo từ khóa
            $listSanPhamTimKiem = $this->modelSanPham->search(htmlspecialchars($keyword));

            // Hiển thị trang tìm kiếm
            require_once './views/timKiemSp.php';
        } else {
            // Chuyển hướng về trang chủ nếu không phải phương thức POST
            header("Location: " . BASE_URL );
            exit;
        }
    }
    public function sanPhamDanhMuc()
    {
        $listtop10 = $this->modelSanPham->top10();

        if (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] > 0) {
            $iddm = $_GET['danh_muc_id'];
            $spdm = $this->modelSanPham->sanPhamTheoDanhMuc($iddm);
            //var_dump($spdm);die();


            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            //    var_dump($listDanhMuc);die();
            require_once './views/sanPhamTheoDanhMuc.php';
        } else {
            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            $listSanPham = $this->modelSanPham->getAllSanPham();

            require_once './views/sanPham.php';
        }
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



    public function formDangKy()
    {

        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once('./views/auth/formDangKy.php');
        deleteSessionErrors();
    }

    public function dangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $mat_khau = $_POST['mat_khau'] ?? '';
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $file_thumb = uploadFile($anh_dai_dien, './uploads/');
            $chuc_vu = 2;

            $_SESSION['old_data'] = array(
                'ho_ten' => $ho_ten,
                'ngay_sinh' => $ngay_sinh,
                'email' => $email,
                'so_dien_thoai' => $so_dien_thoai,
                'gioi_tinh' => $gioi_tinh,
                'dia_chi' => $dia_chi,
                'mat_khau' => $mat_khau,
            );

            // Tạo mảng để lưu lỗi
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }

            $_SESSION['errors'] = $errors;

            // Nếu không có lỗi, thêm tài khoản
            if (empty($errors)) {
                // Mã hóa mật khẩu trước khi lưu
                $mat_khau_hashed = password_hash($mat_khau, PASSWORD_BCRYPT);

                // Gọi model để lưu dữ liệu
                $tai_khoan = $this->modelTaiKhoan->insertTaiKhoan(
                    $ho_ten,
                    $ngay_sinh,
                    $email,
                    $so_dien_thoai,
                    $gioi_tinh,
                    $dia_chi,
                    $mat_khau_hashed, // Lưu mật khẩu mã hóa
                    $chuc_vu,
                    $file_thumb
                );

                // Hiển thị thông báo và chuyển trang sau 2 giây
                echo "
                <script>
                    alert('Đăng ký thành công! Vui lòng chờ để chuyển đến trang đăng nhập.');
                    setTimeout(function() {
                        window.location.href = '" . BASE_URL . "?act=login';
                    });
                </script>
            ";
                exit();
            } else {
                // Trả về lỗi
                $_SESSION['flash'] = true;
                $_SESSION['thongBao'] = 'Đăng ký thất bại';
                header("Location: " . BASE_URL . '?act=form-dang-ky');
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

    public function lienHe()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();


        require_once './views/lienHe.php';
    }
    public function gioiThieu()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();


        require_once './views/gioiThieu.php';
    }
   

    public function quenMatKhau()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $tai_khoan_id = $_SESSION['user_client']['id'] ?? '';

        $thongTin = $this->modelTaiKhoan->thongTinTaiKhoan($tai_khoan_id);
        // var_dump($thongTin);die();

        require_once './views/quenMatKhau.php';
        deleteSessionErrors();
    }

    public function layMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl

            $email = $_POST['email'] ?? '';

            $checkEmail = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
            // var_dump($checkEmail);die();

            // var_dump($checkEmail['mat_khau']);die();

            if (is_array($checkEmail)) {
                //     $_SESSION['user_id'] = $checkUser[0]['id'];
                $_SESSION['layMk'] = 'Mật khẩu của bạn là: ' . $checkEmail[0]['mat_khau'];

                header('Location:' . BASE_URL . '?act=quen-mat-khau');
            } else {
                $_SESSION['flash'] = true;
                $_SESSION['layMk'] = 'Email không tồn tại';

                header('Location:' . BASE_URL . '?act=quen-mat-khau');
            }
        }
    }

    public function taiKhoan()
    {
        $email = $_SESSION['user_client'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);

        require_once './views/taikhoan.php';
        deleteSessionErrors();
    }




    public function postEditMatKhauCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $old_pass = htmlspecialchars(trim($_POST['old_pass']));
            $new_pass = htmlspecialchars(trim($_POST['new_pass']));
            $confirm_pass = htmlspecialchars(trim($_POST['confirm_pass']));

            // Lấy thông tin user từ session
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // Kiểm tra mật khẩu cũ
            $errors = [];
            if (empty($old_pass)) {
                $errors['old_pass'] = 'Mật khẩu cũ không được để trống';
            } elseif (!password_verify($old_pass, $user['mat_khau'])) {
                $errors['old_pass'] = 'Mật khẩu cũ không đúng';
            }

            // Kiểm tra mật khẩu mới
            if (empty($new_pass)) {
                $errors['new_pass'] = 'Mật khẩu mới không được để trống';
            }

            // Kiểm tra xác nhận mật khẩu
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không được để trống';
            } elseif ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }

            // Nếu có lỗi, lưu vào session và chuyển hướng
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL . '?act=sua-mat-khau-ca-nhan');
                exit();
            }

            // Nếu không có lỗi, cập nhật mật khẩu mới
            $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
            $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);

            if ($status) {
                $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                $_SESSION['flash'] = true;
            } else {
                $_SESSION['errors']['system'] = "Có lỗi xảy ra, vui lòng thử lại sau.";
            }

            // Chuyển hướng sau khi xử lý
            header("Location:" . BASE_URL . '?act=sua-mat-khau-ca-nhan');
            exit();
        }
    }
   


    
}
