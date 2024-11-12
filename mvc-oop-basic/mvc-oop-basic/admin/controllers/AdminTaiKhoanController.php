
<?php
// Bắt đầu session để truy cập các biến session
session_start();


class AdminTaiKhoanController
{
    public $AdminTaiKhoan;

    public function __construct()
    {
        $this->AdminTaiKhoan = new AdminTaiKhoan();
    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->AdminTaiKhoan->getAllTaiKhoan(1);
    
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';
        $this->deleteSessionError();
    }

    public function postAddQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }

            $_SESSION['error'] = $errors;

            if (empty($errors)) {
                // Đặt password mặc định
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                $chuc_vu_id = 1;

                $this->AdminTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);

                header("Location: " . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                $_SESSION['flash'] = 'Vui lòng kiểm tra lại thông tin!';
                header("Location: " . '?act=form-them-quan-tri');
                exit();
            }
        }
    }

    private function deleteSessionError()
    {
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
    }

    
    public function formEditQuanTri(){
        $quan_tri_id = $_GET['id_quan_tri'];       
        $quanTri = $this->AdminTaiKhoan->getDetailTaiKhoan($quan_tri_id);
        //var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }

    public function postEditQuanTri(){

        if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';
            $email = $_POST['email'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
           
            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }
            $_SESSION['error'] = $errors;
            
            if (empty($errors)){
                $this->AdminTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai,);
                var_dump($this);
                die();
                header("Location: " . '?act=list-tai-khoan-quan-tri');
                exit();
            }else{
                $_SESSION['flash'] = true;
                
                header("Location: " . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
                
            }           
        }
    }
    
    public function resetPassword(){
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->AdminTaiKhoan->getDetailTaiKhoan($tai_khoan_id);

        $password = password_hash('123@123ab', PASSWORD_BCRYPT);

        $status = $this->AdminTaiKhoan->resetPassword($tai_khoan_id, $password);
        //var_dump($status);die;
        if($status && $tai_khoan['chuc_vu_id'] == 1){
            header("Location: " . '?act=list-tai-khoan-quan-tri');
            exit();
        }elseif($status && $tai_khoan['chuc_vu_id'] == 2){
            header("Location: " . '?act=list-tai-khoan-khach-hang');
            exit();
        }
        else{
            var_dump('Lỗi khi reset tài khoản');die;
        }
    }
    public function danhSachKhachHang()
    {
        $listKhachHang = $this->AdminTaiKhoan->getAllTaiKhoan(2);
    
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    public function formEditKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];       
        $khachHang = $this->AdminTaiKhoan->getDetailTaiKhoan($id_khach_hang);       
        //var_dump($quanTri);die;
        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }

    public function postEditKhachHang(){

        if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            $email = $_POST['email'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';

            $trang_thai = $_POST['trang_thai'] ?? '';

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh người dùng không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống';
            }
            
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }
            $_SESSION['error'] = $errors;
            
            if (empty($errors)){
                $this->AdminTaiKhoan->updateTaiKhoan($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $trang_thai);

                header("Location: " . '?act=list-tai-khoan-khach-hang');
                exit();
            }else{
                $_SESSION['flash'] = true;
                
                header("Location: " . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
            }
        }
    
        public function deltailKhachHang(){
            $id_khach_hang = $_GET['id_khach_hang'];
            $khachHang = $this->AdminTaiKhoan->getDetailTaiKhoan($id_khach_hang);

            require_once './views/taikhoan/khachhang/deltailKhachHang.php';
        }
        public function formLogin(){
            require_once './views/auth/formLogin.php';  
            deleteSessionError();     
        }
    
        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['email'];
                $password = $_POST['password'];
            //var_dump($email);die;
    
                $user = $this->AdminTaiKhoan->checkLogin($email, $password);
    
                if ($user == $email){ // trường hợp thành công 
                    //lưu thông tin vào session
                    $_SESSION['user_admin']= $user;
                    header("Location: " .BASE_URL_ADMIN);
                    exit();
                }else{
                    // lỗi thì lưu lỗi ở session
                    $_SESSION['error'] = $user;
                    //var_dump($_SESSION['error']);die;
    
                    $_SESSION['flash'] = true;
    
                    header("Location: " . '?act=login-admin');
                    exit();
    
                }
            }
    
        }
        public function logout(){
            if(isset($_SESSION['user_admin'])) {
                unset($_SESSION['user_admin']);
                header("Location: " . '?act=login-admin');
            }
    
         }



        public function formEditCaNhanQuanTri(){
            $email = $_SESSION['user_admin'];
            $thongTin = $this->AdminTaiKhoan->getTaiKhoanformEmail($email);
            //var_dump($thongTin);die;
            require_once './views/taikhoan/canhan/editCaNhan.php';
            deleteSessionError();
        }

        public function postEditMatKhauCaNhan(){
            //var_dump($_POST);die;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $old_pass = $_POST['old_pass'];
                $new_pass = $_POST['new_pass'];
                $confirm_pass = $_POST['confirm_pass'];

                //lay thong tin user tu session
                $user = $this->AdminTaiKhoan->getTaiKhoanformEmail($_SESSION['user_admin']);
                //var_dump($user);die;
                if(password_verify($old_pass, $user['mat_khau'])) {
                    var_dump('trùng pass');die;
                }



            }
        }
    }
  

