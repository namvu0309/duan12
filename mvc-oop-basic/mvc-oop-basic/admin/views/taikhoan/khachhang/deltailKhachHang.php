<!-- header -->
<?php require './views/layout/header.php';?>
 <!-- Navbar -->
 <?php include './views/layout/navbar.php';?>
 <!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php';?>

<!-- Content Wrapper. Contains page ontent -->
 <div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý tài khoản khách hàng</h1>
            </div>
        </div>
    </div>
 </section>
 
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
            <img 
        src="<?= '.' . $khachHang['anh_dai_dien'] ?>" 
        width="100%" 
        alt="" 
        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'"/>


        </div>
        <div class="col-8">

            <div class="container">
            <table class="table table-borderless">
                <tbody style="font-size: large;">
                    <tr>
                        <th>Họ tên:</th>
                        <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Ngày sinh:</th>
                        <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?= $khachHang['email'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Giới tính:</th>
                        <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ:</th>
                        <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Trạng thái:</th>
                        <td><?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>

            <div class="col-12">
                <h2>Thông tin mua hàng</h2>
                <table></table>
            </div>
            
            
        </>
    </>

  </section>

 </div>
 <?php include './views/layout/footer.php'; ?>
 


