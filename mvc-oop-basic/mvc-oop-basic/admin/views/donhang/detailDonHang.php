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
                        <div class="col-sm-10">
                            <a href="index.php?act=form-them-don-hang">
                                <h1>Quản Lý Danh Sách Đơn Hàng : <?= $donHang['ma_don_hang'] ?></h1>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <form action="" method="post" class="form-group">
                                <select name="trang_thai_id" id="trang_thai_id" class="form-group">
                                    <option value="" disabled selected>Chọn trạng thái</option> <!-- Placeholder option -->
                                    <?php foreach ($listTrangThaiDonHang as $key => $trangThai): ?>
                                        <option
                                            <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : ''; ?>
                                            <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : ''; ?>
                                            value="<?= $trangThai['id']; ?>">
                                            <?= $trangThai['ten_trang_thai']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </form>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if ($donHang['trang_thai_id'] == 1) {
                                $colorAlerts = 'primary';
                                $alertMessage = 'New order placed!';
                            } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                                $colorAlerts = 'warning';
                                $alertMessage = 'Order is being processed.';
                            } elseif ($donHang['trang_thai_id'] == 10) {
                                $colorAlerts = 'success';
                                $alertMessage = 'Order completed successfully.';
                            } else {
                                $colorAlerts = 'danger';
                                $alertMessage = 'Order has been cancelled or has issues.';
                            }
                            ?>
                            <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                                <?= $donHang['ten_trang_thai'] ?>
                            </div>



                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Shop MỸ Phẩm NBH
                                            <small class="float-right">Ngày Đặt : <?= formatDate($donHang['ngay_dat']) ?></small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Thông Tin Người Đặt :
                                        <address>
                                            <strong><?= $donHang['ho_ten'] ?></strong><br>
                                            Email: <?= $donHang['email'] ?><br>
                                            Số điện thoại: <?= $donHang['so_dien_thoai'] ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Người nhận
                                        <address>
                                            <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                            Email:<?= $donHang['email_nguoi_nhan'] ?><br>
                                            Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                            Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">

                                        <b>Mã đơn hàng: <?= $donHang['ma_don_hang']; ?></b><br>
                                        Tổng tiền: <?= $donHang['tong_tien']; ?><br>
                                        Ghi Chú: <?= $donHang['ghi_chu']; ?><br>
                                        Phương thức: <?= $donHang['ten_phuong_thuc']; ?>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $tong_tien = 0; ?>
                                                <?php foreach ($sanPhamDonHang as $key => $sanPham): ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $sanPham['ten_san_pham'] ?></td>
                                                        <td><?= number_format($sanPham['don_gia'], 0, ',', '.') ?></td> <!-- Optional: Format price -->
                                                        <td><?= $sanPham['so_luong'] ?></td>
                                                        <td><?= number_format($sanPham['thanh_tien'], 0, ',', '.') ?></td> <!-- Optional: Format price -->
                                                    </tr>
                                                    <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">

                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">> Ngày đặt hàng: <?= $donHang['ngay_dat'] ?></p>
                                        </p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>

                                                    <th style="width:50%">Thành tiền:</th>
                                                    <td>

                                                        <?= $tong_tien ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Vận chuyển(9.3%)</th>
                                                    <td>200000</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng Tiền:</th>
                                                    <td><?= $tong_tien + 200000 ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">

                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                });
            });
        </script>

        <!-- Code injected by live-server -->
        <!-- footer -->
        <?php
        include "./views/layout/footer.php"
        ?>

        <!-- end footer -->
</body>

</html>