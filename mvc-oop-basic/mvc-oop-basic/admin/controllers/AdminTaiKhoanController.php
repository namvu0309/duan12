
<?php
// Bắt đầu session để truy cập các biến session
session_start();


class AdminTaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
    
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuanTri.php';   
        deleteSessionError();   
    }
    
    public function postAddQuanTri(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            $errors = [];
            if(empty($ho_ten)){
                $errors['ho_ten'] = 'Tên không được để trống';
            }

            if(empty($email)){
                $errors['email'] = 'Email không được để trống';
                 
            }

            $_SESSION['error'] = $errors;
            
            if(empty($errors)){
                //đặt password mặc định
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                

                $chuc_vu_id = 1;
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);              

                header("Location: " . '?act=list-tai-khoan-quan-tri');
                exit();
            } else{
                $_SESSION['flash'] = true;

                header("Location: " . '?act=form-them-quan-tri');
                exit();
            }

        }
        
    }
    
    public function formEditQuanTri(){
        $quan_tri_id = $_GET['id_quan_tri'];       
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($quan_tri_id);
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
                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai,);

                header("Location: " . '?act=list-tai-khoan-quan-tri');
                exit();
            }else{
                $_SESSION['flash'] = true;
                
                header("Location: " . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    
}

