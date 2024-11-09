<?php
class AdminDanhMucController
{
     public $AdminDanhMuc;
     public function __construct()
     {
          $this->AdminDanhMuc = new AdminDanhMuc();
     }
     public function danhSachDanhMuc()
     {
          $listDanhMuc = $this->AdminDanhMuc->getAllDanhMuc();
          require_once "./views/listDanhMuc.php";
     }
     public function formAddDanhMuc()
     {
          //ham nay hien thi form nhap
          require_once "./views/addDanhMuc.php";
     }
     public function postAddDanhMuc()
     {
          //dung de xu li them du lieu
          // Kiểm tra xem dữ liệu có phải do submit lên không
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               // Lấy ra dữ liệu
               $ten_danh_muc = $_POST['ten_danh_muc'];
               $mo_ta = $_POST['mo_ta'];

               // Tạo một mảng trống để chứa dữ liệu lỗi
               $errors = [];

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }

               // Nếu không có lỗi, tiến hành thêm danh mục
               if (empty($errors)) {
                    // Code xử lý khi không có lỗi, ví dụ thêm vào cơ sở dữ liệu
                    echo 'Dữ liệu hợp lệ. Tiến hành thêm danh mục...';
                    // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                    $this->AdminDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                    header('location:index.php');
                    exit();
               } else {
                    // Trả về form và hiển thị lỗi
                    require_once './views/addDanhMuc.php';
               }
          }
     }
     public function formEditDanhMuc()
     {
          //ham nay hien thi form nhap
          $id=$_GET['id_danh_muc'];
          $danhmuc=$this->AdminDanhMuc->getDetailDanhMuc($id);
          if($danhmuc){
               require_once "./views/editDanhMuc.php";
          }else{
               header('location:index.php');
               exit();
          }
     }
     public function postEditDanhMuc()
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

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }

               // Nếu không có lỗi, tiến hành sửa danh mục
               if (empty($errors)) {
                    // Code xử lý khi không có lỗi, ví dụ sửa vào cơ sở dữ liệu
                    echo 'Dữ liệu hợp lệ. Tiến hành thêm danh mục...';
                    // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                    $this->AdminDanhMuc->updateDanhMuc($id,$ten_danh_muc, $mo_ta);
                    header('location:index.php');
                    exit();
               } else {
                    // Trả về form và hiển thị lỗi
                    $danhmuc=['id'=>$id,'ten_danh_muc'=>$ten_danh_muc,'mo_ta'=>$mo_ta];
                    require_once './views/editDanhMuc.php';
               }
          }
     }
     public function deleteDanhMuc(){
          $id = $_GET['id_danh_muc'];
          $danhmuc = $this->AdminDanhMuc->getDetailDanhMuc($id);
          if($danhmuc){
               $this->AdminDanhMuc->destroyDanhMuc($id);
          }
          header('location:index.php');
          exit();
     }
}
