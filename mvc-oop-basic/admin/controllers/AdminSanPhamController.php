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
        $listDanhMuc = $this->AdminDanhMuc->getAllDanhMuc();
        require_once "./views/sanpham/addSanPham.php";
        //xoa session sau khi error
        deleteSessionError();
    }
    public function postAddSanPham()
    {
        // Xử lý khi có yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Xử lý upload ảnh chính
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            // Mảng chứa lỗi
            $errors = [];

            // Kiểm tra dữ liệu đầu vào
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
            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
            }

            $_SESSION['error'] = $errors;
            // Kiểm tra ảnh đã upload thành công chưa nếu ảnh là bắt buộc
            if (!$file_thumb) {
                $errors['hinh_anh'] = 'Lỗi upload ảnh, vui lòng thử lại.';
            }

            // Nếu không có lỗi, tiến hành thêm sản phẩm
            if (empty($errors)) {
                // Gọi hàm insert để lưu sản phẩm vào cơ sở dữ liệu
                $san_pham_id = $this->AdminSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );
                $img_array = $_FILES['img_array'];
                //xu li them anh san pham 
                if (!empty($img_array['name'])) {
                    // Loop through each file in the array
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]
                        ];

                        // Upload file and retrieve the path
                        $link_hinh_anh = uploadFile($file, './uploads/');

                        // Insert file link into the product's album
                        $this->AdminSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }

                // Chuyển hướng đến danh sách sản phẩm sau khi thêm thành công
                header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // Trả về form và hiển thị lỗi nếu có lỗi
                //dat chi thi xoa session sau khi hien thi form
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }


    public function formEditSanPham()
    {
        //ham nay hien thi form nhap
        $id = $_GET['id_san_pham'];
        $sanpham = $this->AdminSanPham->getDetailSanPham($id);
        $listSanPham = $this->AdminSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->AdminDanhMuc->getAllDanhMuc($id);
        if ($sanpham) {
            require_once "./views/sanpham/editSanPham.php";
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }
    public function postEditSanPham()
    {
        // Xử lý khi có yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $san_pham_id = $_POST['san_pham_id'];

            // Truy vấn để lấy thông tin sản phẩm cũ
            $sanPhamOld = $this->AdminSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh'];

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Mảng chứa lỗi
            $errors = [];

            // Kiểm tra dữ liệu đầu vào
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
            // Kiểm tra và xử lý upload ảnh chính nếu có
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            if ($hinh_anh && $hinh_anh['error'] === 0) {
                $new_file = uploadFile($hinh_anh, './uploads/');
                if ($new_file) {
                    if (!empty($old_file)) {
                        deleteFile($old_file); // Xóa ảnh cũ nếu có ảnh mới
                    }
                } else {
                    $errors['hinh_anh'] = 'Lỗi khi tải lên ảnh mới';
                }
            } else {
                $new_file = $old_file; // Giữ ảnh cũ nếu không có ảnh mới
            }

            // Nếu không có lỗi, tiến hành cập nhật sản phẩm
            if (empty($errors)) {
                // Cập nhật sản phẩm vào cơ sở dữ liệu
                $status = $this->AdminSanPham->updateSanPham(
                    $san_pham_id,
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $new_file
                );
                // Chuyển hướng đến danh sách sản phẩm sau khi cập nhật thành công
                header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form
                $_SESSION['error'] = $errors;
                header('location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }
    public function postEditAnhSanPham()
    {
        // At the beginning of the PHP file

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            // Lấy danh sách ảnh hiện tại của sản phẩm
            $listAnhSanPhamCurrent = $this->AdminSanPham->getListAnhSanPham($san_pham_id);

            // Xử lý các ảnh được gửi từ form
            $img_array = $_FILES['img_array'];

            // Sửa cú pháp isset
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            // Khai báo mảng để lưu ảnh thêm mới hoặc thay thế ảnh cũ
            $upload_file = [];

            // Upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    // Lấy đường dẫn của ảnh cũ
                    $old_file = $this->AdminSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // Cập nhật ảnh cũ
                    $this->AdminSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // Xóa ảnh cũ khỏi thư mục nếu cần
                    deleteFile($old_file);
                } else {
                    // Thêm ảnh mới
                    $this->AdminSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];

                // Kiểm tra nếu ảnh ID nằm trong danh sách cần xóa
                if (in_array($anh_id, $img_delete)) {
                    // Xóa ảnh trong cơ sở dữ liệu
                    $this->AdminSanPham->destroyAnhSanPham($anh_id);

                    // Xóa file khỏi hệ thống tệp

                    deleteFile($anhSP['link_hinh_anh']);
                }
            }

            // Chuyển hướng sau khi xử lý xong
            header("Location:  ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=$san_pham_id");
            exit();
        }
    }
    public function detailSanPham()
    {
        //ham nay hien thi form nhap
        $id = $_GET['id_san_pham'];
        $sanpham = $this->AdminSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->AdminSanPham->getListAnhSanPham($id);
        if ($sanpham) {
            require_once "./views/sanpham/detailSanPham.php";
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }


    public function deleteSanPham()
    {
        // Lấy ID sản phẩm từ GET request
        $id = $_GET['id_san_pham'];

        // Lấy thông tin chi tiết sản phẩm và danh sách ảnh của sản phẩm
        $sanPham = $this->AdminSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->AdminSanPham->getListAnhSanPham($id);

        // Nếu sản phẩm tồn tại
        if ($sanPham) {
            // Xóa file ảnh chính của sản phẩm
            deleteFile($sanPham['hinh_anh']);

            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $this->AdminSanPham->destroySanPham($id);
        }

        // Nếu có danh sách ảnh bổ sung của sản phẩm
        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $anhSP) {
                // Xóa từng file ảnh bổ sung
                deleteFile($anhSP['link_hinh_anh']);

                // Xóa từng ảnh khỏi cơ sở dữ liệu
                $this->AdminSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }

        // Chuyển hướng về trang sản phẩm sau khi xóa
        header("Location:  ' . BASE_URL_ADMIN . '?act=san-pham");
        exit();
    }
}
