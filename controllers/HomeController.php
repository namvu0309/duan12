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
   

   
    // lấy thông tin giỏ hàng của người dung
// $giohang = $this ->modelGioHang -> getDetaiGioHang()    




   
   


    
}
