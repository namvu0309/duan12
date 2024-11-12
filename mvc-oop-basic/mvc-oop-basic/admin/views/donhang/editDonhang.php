<!-- header -->
<?php
include "./views/layout/header.php"
?>
<!-- end header -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include "./views/layout/navbar.php"
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include "./views/layout/sidebar.php"
        ?>
        <!-- end sidebar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">


                            <a href="index.php?act=form-sua-danh-muc">
                                <h1>Quản Lý thong tin đơn hàng</h1>
                            </a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sửa thông tin đơn hàng:<?= $donHang['mã dơn hang']?></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action='index.php?act=sua-don_hang' method="post">
                    <input type="text" name="don_hang_id" value="<?= $don_hang['id'] ?>" hidden>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên người nhận</label>
                            <input type="text" class="form-control" name='ten_nguoi_nhan' value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập Danh Mục">
                            <?php
                            if (isset($errors['ten_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['ten_nguoi_nhan']; ?></p>

                            <?php
                            } ?>
                        </div>
                        <div class="form-group">
                            <label>Số điẹn thoại</label>
                            <input type="text" class="form-control" name='sdt_nguoi_nhan' value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập Danh Mục">
                            <?php
                            if (isset($errors['sdt_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['sdt_nguoi_nhan']; ?></p>

                            <?php
                            } ?>
                        </div>
                        <div class="form-group">
                            <label>Eamil</label>
                            <input type="email" class="form-control" name='email_nguoi_nhan' value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập Danh Mục">
                            <?php
                            if (isset($errors['email_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['email_nguoi_nhan']; ?></p>

                            <?php
                            } ?>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ </label>
                            <input type="text" class="form-control" name='dia_chi_nguoi_nhan' value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập Danh Mục">
                            <?php
                            if (isset($errors['dia_chi_nguoi_nhan'])) { ?>
                                <p class="text-danger"><?= $errors['dia_chi_nguoi_nhan']; ?></p>

                            <?php
                            } ?>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea type="text" name='ghi_chu' class="form-control" placeholder="Nhập Mô Tả"><?= $donHang['mo_ta'] ?></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                                            <label for="inputStatus">Trạng thái đơn hàng</label>
                                            <select id="inputStatus" name='trang_thai_id' class="form-control custom-select">
                                                <?php foreach ($listTrangThaDonhang as $trangThai): ?>
                                                    <option
                                                       <?php
                                                          if ($donHang['trang_thai_id'] > $trangThai['id'] 
                                                                ||$donHang['trang_thai_id'] == 9
                                                                ||$donHang['trang_thai_id'] == 10
                                                                ||$donHang['trang_thai_id'] == 11)
                                                            {
                                                            echo 'disabled';
                                                            }
                                                        ?>
                                                       <?= $trangThai['id'] == $donHang['trang_thai_id'] ? "selected" : '' ?>
                                                         value="<?= $trangThai['id']; ?>">
                                                        <?= $trangThai['ten_trang_thai']; ?>
                                                    </option>
                                                <?php endforeach ?>


                                            </select>
                                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->


                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Page specific script -->

        <!-- Code injected by live-server -->
        <!-- footer -->
        <?php
        include "./views/layout/footer.php"
        ?>

        <!-- end footer -->
</body>

</html>