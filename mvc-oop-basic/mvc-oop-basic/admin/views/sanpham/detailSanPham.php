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
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">

                                <div class="col-12">
                                    <img style='width:500px; height:500px' src="<?= '.' . $sanpham['hinh_anh'] ?>" class="product-image" alt="Product Image">

                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                                        <div class="product-image-thumb <?= $key == 0 ? 'active' : '' ?>">
                                            <img src="<?= '.' . $anhSP['link_hinh_anh'] ?>" alt="Product Image">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">Tên sản phẩm: <?= $sanpham['ten_san_pham'] ?></h3>
                                <hr>
                                <h4 class="mt-3">Giá tiền: <small><?= $sanpham['gia_san_pham'] ?></small></h4>
                                <h4 class="mt-3">Giá khuyến mãi: <small><?= $sanpham['gia_khuyen_mai'] ?></small></h4>
                                <h4 class="mt-3">Số lượng: <small><?= $sanpham['so_luong'] ?></small></h4>
                                <h4 class="mt-3">Lượt xem: <small><?= $sanpham['luot_xem'] ?></small></h4>
                                <h4 class="mt-3">Ngày nhập: <small><?= $sanpham['ngay_nhap'] ?></small></h4>
                                <h4 class="mt-3">Danh mục: <small><?= $sanpham['ten_danh_muc'] ?></small></h4>
                                <h4 class="mt-3">Trạng thái: <small><?= $sanpham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h4>
                                <h4 class="mt-3">Mô tả Sản Phẩm: <small><?= $sanpham['mo_ta'] ?></small></h4>

                            </div>
                        </div>
                        <div class="container-fluid mt-4">
                            <div class="row">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="binh-luan" data-toggle="tab" href="#binh-luan" role="tab" aria-controls="product-desc" aria-selected="true">Bình Luận của Sản Phẩm</a>
                                    </div>
                                </nav>
                            </div>

                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                    <!-- Chuyển container-fluid ra ngoài để mở rộng toàn màn hình -->
                                    <div class="container-fluid">
                                        <table class="table table-striped table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên người bình luận</th>
                                                    <th>Nội dung</th>
                                                    <th>Ngày đăng</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Namvu</td>
                                                    <td>caotodeptrai</td>
                                                    <td>20/07/2024</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#"><button class="btn btn-warning mr-2">An</button></a>
                                                            <a href="#"><button class="btn btn-danger">Xóa</button></a>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
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

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>


</html>