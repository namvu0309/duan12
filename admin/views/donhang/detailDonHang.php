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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <h1>Quản lý danh sách đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (isset($donHang['trang_thai_id'])) {
                                if ($donHang['trang_thai_id'] == 1) {
                                    $colorAlerts = 'primary';
                                } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                                    $colorAlerts = 'warning';
                                } elseif ($donHang['trang_thai_id'] == 10) {
                                    $colorAlerts = 'success';
                                } else {
                                    $colorAlerts = 'danger';
                                }
                            } else {
                                // Xử lý trường hợp khi khóa 'trang_thai_id' không tồn tại
                                $colorAlerts = 'danger';
                            }
                            ?>
                            <div class="alert alert-<?= $colorAlerts ?>" role="alert">
                                Đơn hàng: <?= $donHang['ten_trang_thai'] ?>
                            </div>


                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-cat"></i> Shop thú cưng
                                            <small class="float-right">Ngày đặt: <?= formatDate($donHang['ngay_dat']); ?></small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Thông tin người đặt
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
                                            Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                            Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                            Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Thông tin
                                        <address>
                                            <strong>Mã đơn hàng: <?= $donHang['ma_don_hang'] ?></strong><br>
                                            Tổng tiền: <?= $donHang['tong_tien'] ?><br>
                                            Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                            Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                            Thanh toán: <?= $donHang['ten_phuong_thuc'] ?> <br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div>
                                    <table id="example1" class="table table-bordered table-striped ">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Người bình luận</th>
                                                <th>Nội dung</th>
                                                <th>Ngày bình luận</th>

                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listBinhLuan as $key => $binhLuan) { ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id'] ?>"><?= $binhLuan['ho_ten'] ?></a></td>
                                                    <td><?= $binhLuan['noi_dung'] ?></td>
                                                    <td><?= $binhLuan['ngay_dang'] ?></td>
                                                    <td>
                                                        <form action="<?= BASE_URL_ADMIN . '?act=xoa-binh-luan' ?>" method="POST">
                                                            <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">

                                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có muốn xóa bình luận này không?')">
                                                                Xóa
                                                            </button>

                                                            </a>


                                </div>

                                </form>

                                </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->

                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Ngày đặt hàng: <?= $donHang['ngay_dat'] ?></p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Thành tiền:</th>
                                                <td><?= $tong_tien ?></td>
                                            </tr>
                                            <tr>
                                                <th>Vận chuyển:</th>
                                                <td>200000</td>
                                            </tr>
                                            <tr>
                                                <th>Tổng tiền:</th>
                                                <td><?= $tong_tien + 200000 ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!--footer-->
    <?php include './views/layout/footer.php'; ?>

    <!-- /.control-sidebar -->
    </div>
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
                "responsive": true,
            });
        });
        var faqs_row = 0;

        function addfaqs() {

            html = '<tr id="faqs-row' + faqs_row + '">';
            html += '<td><input type="text" class="form-control" placeholder="User name"></td>';
            html += '<td><input type="text" placeholder="Product name" class="form-control"></td>';
            html += '<td class="text-danger mt-10"> 18.76% <i class="fa fa-arrow-down"></i></td>';
            html += '<td class="mt-10"><button class="badge badge-danger" onclick="$(\'#faqs-row' + faqs_row + '\').remove();"><i class="fa fa-trash"></i> Delete</button></td>';

            html += '</tr>';

            $('#faqs tbody').append(html);

            faqs_row++;
        }
    </script>
</body>

</html>