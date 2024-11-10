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
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'];

            $hinh_anh=$_FILES['hinh_anh'];

            //luu hinnh anh vaoo
            $file_thumb=uploadFile($hinh_anh,'./uploads/');

            //mang hinh anh
            $img_array=$_FILES['img_array'];
            // Tạo một mảng trống để chứa dữ liệu lỗi
            // Tạo một mảng trống để chứa dữ liệu lỗi
            $errors = [];

            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm không được để trống';
            }

            // Nếu không có lỗi, tiến hành thêm sản phẩm
            if (empty($errors)) {
                // Code xử lý khi không có lỗi, ví dụ thêm vào cơ sở dữ liệu
                // echo 'Dữ liệu hợp lệ. Tiến hành thêm sản phẩm...';
                // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                $this->AdminSanPham->insertSanPham($ten_san_pham,$gia_san_pham,$gia_khuyen_mai,$so_luong,$ngay_nhap,$danh_muc_id,$trang_thai ,$mo_ta, $hinh_anh);
                header('location:index.php?act=san-pham');
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
        $id = $_GET['id_san_pham'];
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

            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo một mảng trống để chứa dữ liệu lỗi
            $errors = [];

            // Kiểm tra tên sản phẩm
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }

            // Nếu không có lỗi, tiến hành sửa sản phẩm
            if (empty($errors)) {
                // Code xử lý khi không có lỗi, ví dụ sửa vào cơ sở dữ liệu
                echo 'Dữ liệu hợp lệ. Tiến hành thêm sản phẩm...';
                // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                $this->AdminSanPham->updateSanPham($id, $ten_san_pham, $mo_ta);
                header('location:index.php');
                exit();
            } else {
                // Trả về form và hiển thị lỗi
                $SanPham = ['id' => $id, 'ten_san_pham' => $ten_san_pham, 'mo_ta' => $mo_ta];
                require_once './views/sanpham/editSanPham.php';
            }
        }
    }
    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->AdminSanPham->getDetailSanPham($id);
        if ($SanPham) {
            $this->AdminSanPham->destroySanPham($id);
        }
        header('location:index.php?act=san-pham');
        exit();
    }
}