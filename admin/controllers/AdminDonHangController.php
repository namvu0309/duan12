<?php
class AdminDonHangController
{
    public $modelSanPham;
    public $modelDonHang;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDonHang = new AdminDonHang();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once "./views/DonHang/listDonHang.php";
    }
    public function detailDonHang()
    {


        $don_hang_id = $_GET['id_don_hang'];

        // Lấy thông tin đơn hàng từ bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // Lấy danh sách sản phẩm đã đặt của đơn hàng từ bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        // Lấy danh sách trạng thái của đơn hàng từ bảng trang_thai_don_hangs
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        // Lấy bình luận cho từng sản phẩm trong đơn hàng
        $listBinhLuan = [];
        foreach ($sanPhamDonHang as $sanPham) {
            $listBinhLuan[$sanPham['id']] = $this->modelSanPham->getBinhLuanFromSanPham($sanPham['id']);
        }

        // Gom tất cả dữ liệu vào mảng $data
        $data = [
            'donHang' => $donHang,
            'sanPhamDonHang' => $sanPhamDonHang,
            'listTrangThaiDonHang' => $listTrangThaiDonHang,
            'listBinhLuan' => $listBinhLuan
        ];

        // Truyền dữ liệu vào view
        require_once './views/donhang/detailDonHang.php';
    }

    // public function formAddDonHang()
    // {
    //     //ham nay hien thi form nhap
    //     $listDanhMuc=$this->modelDanhMuc->getAllDanhMuc();
    //     require_once "./views/DonHang/addDonHang.php";
    //     //xoa session sau khi error
    //     deleteSessionError();
    // }
    // public function postAddDonHang()
    // {
    //     // Xử lý khi có yêu cầu POST
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Lấy dữ liệu từ form
    //         $ten_san_pham = $_POST['ten_san_pham'] ?? '';
    //         $gia_san_pham = $_POST['gia_san_pham'] ?? '';
    //         $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
    //         $so_luong = $_POST['so_luong'] ?? '';
    //         $ngay_nhap = $_POST['ngay_nhap'] ?? '';
    //         $danh_muc_id = $_POST['danh_muc_id'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';
    //         $mo_ta = $_POST['mo_ta'] ?? '';

    //         // Xử lý upload ảnh chính
    //         $hinh_anh = $_FILES['hinh_anh'] ?? null;
    //         $file_thumb = uploadFile($hinh_anh, './uploads/');

    //         // Mảng chứa lỗi
    //         $errors = [];

    //         // Kiểm tra dữ liệu đầu vào
    //         if (empty($ten_san_pham)) {
    //             $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
    //         }
    //         if (empty($gia_san_pham)) {
    //             $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
    //         }
    //         if (empty($gia_khuyen_mai)) {
    //             $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được để trống';
    //         }
    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
    //         }
    //         if (empty($ngay_nhap)) {
    //             $errors['ngay_nhap'] = 'Ngày nhập không được để trống';
    //         }
    //         if (empty($danh_muc_id)) {
    //             $errors['danh_muc_id'] = 'Danh mục không được để trống';
    //         }
    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'Trạng thái sản phẩm không được để trống';
    //         }
    //         if ($hinh_anh['error'] !== 0) {
    //             $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
    //         }

    //         $_SESSION['error']=$errors;
    //         // Kiểm tra ảnh đã upload thành công chưa nếu ảnh là bắt buộc
    //         if (!$file_thumb) {
    //             $errors['hinh_anh'] = 'Lỗi upload ảnh, vui lòng thử lại.';
    //         }

    //         // Nếu không có lỗi, tiến hành thêm sản phẩm
    //         if (empty($errors)) {
    //             // Gọi hàm insert để lưu sản phẩm vào cơ sở dữ liệu
    //             $san_pham_id=$this->modelDonHang->insertDonHang(
    //                 $ten_san_pham,
    //                 $gia_san_pham,
    //                 $gia_khuyen_mai,
    //                 $so_luong,
    //                 $ngay_nhap,
    //                 $danh_muc_id,
    //                 $trang_thai,
    //                 $mo_ta,
    //                 $file_thumb
    //             );
    //             $img_array = $_FILES['img_array'];
    //             //xu li them anh san pham 
    //             if (!empty($img_array['name'])) {
    //                 // Loop through each file in the array
    //                 foreach ($img_array['name'] as $key => $value) {
    //                     $file = [
    //                         'name' => $img_array['name'][$key],
    //                         'type' => $img_array['type'][$key],
    //                         'tmp_name' => $img_array['tmp_name'][$key],
    //                         'error' => $img_array['error'][$key],
    //                         'size' => $img_array['size'][$key]
    //                     ];

    //                     // Upload file and retrieve the path
    //                     $link_hinh_anh = uploadFile($file, './uploads/');

    //                     // Insert file link into the product's album
    //                     $this->modelDonHang->insertAlbumAnhDonHang($san_pham_id, $link_hinh_anh);
    //                 }
    //             }

    //             // Chuyển hướng đến danh sách sản phẩm sau khi thêm thành công
    //             header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
    //             exit();
    //         } else {
    //             // Trả về form và hiển thị lỗi nếu có lỗi
    //             //dat chi thi xoa session sau khi hien thi form
    //             $_SESSION['flash'] =true;
    //             header('location: ' . BASE_URL_ADMIN . '?act=form-them-san-pham');
    //             exit();
    //     }
    // }}


    public function formEditDonHang()
    {
        //lấy thông tin của danh mục cần sửa
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donHang/editDonHang.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }
    // xử lý dữ liệu thêm
    public function postEditDonHang()
    {
        //kiểm tra xem dữ liệu có phải được submit không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Lấy ra dữ liệu
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';


            //tạo 1 mảng trống để chứa dữ liệu
            $error = [];
            if (empty($ten_nguoi_nhan)) {
                $error['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $error['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $error['email_nguoi_nhan'] = 'Email không được để trống';
            }

            if (empty($dia_chi_nguoi_nhan)) {
                $error['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }
            if (empty($trang_thai_id)) {
                $error['trang_thai_id'] = 'Trạng thái không được để trống';
            }



            //nếu không có lỗi -> tiến hành sửa danh mục
            if (empty($error)) {
                $this->modelDonHang->updateDonHang($don_hang_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id);
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                //trả về form và báo lỗi
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
  

}
