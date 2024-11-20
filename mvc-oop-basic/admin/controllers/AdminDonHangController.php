<?php
class AdminDonHangController
{
    public $modelDonHang;
    public $modelDanhMuc;
    public function __construct()
    {
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
        // Lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        // var_dump($sanPhamDonHang);DIE();
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
    // public function postEditAnhDonHang()
    // {
    //     // At the beginning of the PHP file

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';

    //         // Lấy danh sách ảnh hiện tại của sản phẩm
    //         $listAnhDonHangCurrent = $this->modelDonHang->getListAnhDonHang($san_pham_id);

    //         // Xử lý các ảnh được gửi từ form
    //         $img_array = $_FILES['img_array'];

    //         // Sửa cú pháp isset
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids = $_POST['current_img_ids'] ?? [];

    //         // Khai báo mảng để lưu ảnh thêm mới hoặc thay thế ảnh cũ
    //         $upload_file = [];

    //         // Upload ảnh mới hoặc thay thế ảnh cũ
    //         foreach ($img_array['name'] as $key => $value) {
    //             if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './uploads/', $key);
    //                 if ($new_file) {
    //                     $upload_file[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file
    //                     ];
    //                 }
    //             }
    //         }
    //         foreach ($upload_file as $file_info) {
    //             if ($file_info['id']) {
    //                 // Lấy đường dẫn của ảnh cũ
    //                 $old_file = $this->modelDonHang->getDetailAnhDonHang($file_info['id'])['link_hinh_anh'];

    //                 // Cập nhật ảnh cũ
    //                 $this->modelDonHang->updateAnhDonHang($file_info['id'], $file_info['file']);

    //                 // Xóa ảnh cũ khỏi thư mục nếu cần
    //                 deleteFile($old_file);
    //             } else {
    //                 // Thêm ảnh mới
    //                 $this->modelDonHang->insertAlbumAnhDonHang($san_pham_id, $file_info['file']);
    //             }
    //         }

    //         foreach ($listAnhDonHangCurrent as $anhSP) {
    //             $anh_id = $anhSP['id'];

    //             // Kiểm tra nếu ảnh ID nằm trong danh sách cần xóa
    //             if (in_array($anh_id, $img_delete)) {
    //                 // Xóa ảnh trong cơ sở dữ liệu
    //                 $this->modelDonHang->destroyAnhDonHang($anh_id);

    //                 // Xóa file khỏi hệ thống tệp

    //                 deleteFile($anhSP['link_hinh_anh']);
    //             }
    //         }

    //         // Chuyển hướng sau khi xử lý xong
    //         header("Location:  ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=$san_pham_id");
    //         exit();


    //     }
    // }
    // public function detailDonHang()
    // {
    //     //ham nay hien thi form nhap
    //     $id = $_GET['id_san_pham'];
    //     $DonHang = $this->modelDonHang->getDetailDonHang($id);
    //     $listAnhDonHang = $this->modelDonHang->getListAnhDonHang($id);
    //     if ($DonHang) {
    //         require_once "./views/DonHang/detailDonHang.php";
    //     } else {
    //         header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
    //         exit();
    //     }
    // }


    // public function deleteDonHang()
    // {
    //     // Lấy ID sản phẩm từ GET request
    //     $id = $_GET['id_san_pham'];

    //     // Lấy thông tin chi tiết sản phẩm và danh sách ảnh của sản phẩm
    //     $DonHang = $this->modelDonHang->getDetailDonHang($id);
    //     $listAnhDonHang = $this->modelDonHang->getListAnhDonHang($id);

    //     // Nếu sản phẩm tồn tại
    //     if ($DonHang) {
    //         // Xóa file ảnh chính của sản phẩm
    //         deleteFile($DonHang['hinh_anh']);

    //         // Xóa sản phẩm khỏi cơ sở dữ liệu
    //         $this->modelDonHang->destroyDonHang($id);
    //     }

    //     // Nếu có danh sách ảnh bổ sung của sản phẩm
    //     if ($listAnhDonHang) {
    //         foreach ($listAnhDonHang as $anhSP) {
    //             // Xóa từng file ảnh bổ sung
    //             deleteFile($anhSP['link_hinh_anh']);

    //             // Xóa từng ảnh khỏi cơ sở dữ liệu
    //             $this->modelDonHang->destroyAnhDonHang($anhSP['id']);
    //         }
    //     }

    //     // Chuyển hướng về trang sản phẩm sau khi xóa
    //     header("Location:  ' . BASE_URL_ADMIN . '?act=san-pham");
    //     exit();
    // }

}

