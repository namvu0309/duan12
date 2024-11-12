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
                            <h1>Quản Lý Tài khoản khách hàng</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">                                  
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Gọi tên</th>
                                                <th>Ảnh đại diện</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($listKhachHang as $key => $khachHang) :?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $khachHang['ho_ten'] ?></td>
                                                <td>
    <img 
        src="<?= '.' . $khachHang['anh_dai_dien'] ?>" 
        width="100" 
        alt="Avatar" 
        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" 
    />
</td>
                                                <td><?= $khachHang['email'] ?></td>
                                                <td><?= $khachHang['so_dien_thoai'] ?></td>
                                                <td><?= $khachHang['trang_thai'] == 1 ? 'Active':'Inactive' ?></td>

                                                
                                                <td>
                                                    <div class="'btn-group">                          
                                                    <a href="<?='?act=chi-tiet-khach-hang&id_khach_hang=' . $khachHang['id']?>">
                                                    <button class="btn btn-primary">Chi tiết</button>
                                                    </a>
                                                    <a href="<?='?act=form-sua-khach-hang&id_khach_hang=' . $khachHang['id']?>">
                                                    <button class="btn btn-warning">Sửa </button>
                                                    </a>
                                                    <a href="<?='?act=reset-password&id_quan_tri='. $khachHang['id']  ?>" onclick="return confirm('Bạn có muốn reset password của tài khoản này không?')">
                                                            <button class="btn btn-danger">Reset</button>
                                                        </a>
                                                        </div>
                                            </tr>
                                                </td>  
                                            <?php endforeach ?>
                                            
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>STT</th>
                                                <th>Gọ tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Thao Tác</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
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
        </script>
        <!-- Code injected by live-server -->
        <!-- footer -->
        <?php
        include "./views/layout/footer.php"
        ?>

        <!-- end footer -->
</body>

</html>