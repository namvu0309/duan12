<?php 

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelSanPham = new SanPham()  ;
        $this->modelTaiKhoan = new Taikhoan()  ;
        
    }
    
    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }
    public function chitietSanPham(){
        $id = $_GET['id_san_pham'];
        $sanpham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getlistSanPhamCungDanhMuc($sanpham['danh_muc_id']);

       
        if ($sanpham) {
            require_once "./views/detailSanPham.php";
        } else {
            header("location:". BASE_URL.'?act=chi-tiet-san-pham&id-san-pham= $id');
            exit();
        }
    }

    public function formLogin()
    {
        if(isset($_SESSION['user_admin'])){
            header('Location:'.BASE_URL. '?act=login');
            exit();
        }
        require_once './views/auth/formLogin.php';
        deleteSessionErrors();
    }

    public function postLogin()
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

                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }

};