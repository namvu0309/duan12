<?php
class AdminSanPhamController
{
    public $AdminSanPham;
    public $AdminDanhMuc;
    public function __construct()
    {
        $this->AdminSanPham = new AdminSanPham();
        $this->AdminDanhMuc = new AdminDanhMuc();

    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->AdminSanPham->getAllSanPham();
        require_once "./views/sanpham/listSanPham.php";
    }
    public function formAddSanPham()
    {
        //ham nay hien thi form nhap
        $listDanhMuc=$this->AdminDanhMuc->getAllDanhMuc();
        require_once "./views/sanpham/addSanPham.php";
    }
    public function postAddSanPham()
    {
        //dung de xu li them du lieu
        // Kiểm tra xem dữ liệu có phải do submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo một mảng trống để chứa dữ liệu lỗi
            $errors = [];

            // Kiểm tra tên sản phẩm
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên sản phẩm không được để trống';
            }

            // Nếu không có lỗi, tiến hành thêm sản phẩm
            if (empty($errors)) {
                // Code xử lý khi không có lỗi, ví dụ thêm vào cơ sở dữ liệu
                echo 'Dữ liệu hợp lệ. Tiến hành thêm sản phẩm...';
                // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                $this->AdminSanPham->insertSanPham($ten_danh_muc, $mo_ta);
                header('location:index.php');
                exit();
            } else {
                // Trả về form và hiển thị lỗi
                require_once './views/sanpham/addSanPham.php';
            }
        }
    }
    public function formEditSanPham()
    {
        //ham nay hien thi form nhap
        $id = $_GET['id_danh_muc'];
        $SanPham = $this->AdminSanPham->getDetailSanPham($id);
        if ($SanPham) {
            require_once "./views/sanpham/editSanPham.php";
        } else {
            header('location:index.php');
            exit();
        }
    }
    public function postEditSanPham()
    {
        //dung de xu li them du lieu
        // Kiểm tra xem dữ liệu có phải do submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $id = $_POST['id'];

            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo một mảng trống để chứa dữ liệu lỗi
            $errors = [];

            // Kiểm tra tên sản phẩm
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên sản phẩm không được để trống';
            }

            // Nếu không có lỗi, tiến hành sửa sản phẩm
            if (empty($errors)) {
                // Code xử lý khi không có lỗi, ví dụ sửa vào cơ sở dữ liệu
                echo 'Dữ liệu hợp lệ. Tiến hành thêm sản phẩm...';
                // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                $this->AdminSanPham->updateSanPham($id, $ten_danh_muc, $mo_ta);
                header('location:index.php');
                exit();
            } else {
                // Trả về form và hiển thị lỗi
                $SanPham = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/sanpham/editSanPham.php';
            }
        }
    }
    public function deleteSanPham()
    {
        $id = $_GET['id_danh_muc'];
        $SanPham = $this->AdminSanPham->getDetailSanPham($id);
        if ($SanPham) {
            $this->AdminSanPham->destroySanPham($id);
        }
        header('location:index.php');
        exit();
    }
}
