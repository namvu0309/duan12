<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<style>
    .pro-large-img {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 400px;
        /* Điều chỉnh chiều cao theo thiết kế */
    }

    .pro-large-img img {
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease-in-out;
        /* Hiệu ứng thu phóng */
    }

    .pro-large-img:hover img {
        transform: scale(1.5);
        /* Phóng to ảnh khi hover */
        cursor: zoom-in;
    }
</style>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=' ?>">Sản Phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham) { ?>
                                        <div class="pro-large-img">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>"
                                                alt="product-details" />
                                        </div>
                                    <?php } ?>


                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham) { ?>

                                        <div class="pro-nav-thumb">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product-details"
                                                style='width:75px; height: 75px;' />
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"><?= $sanPham['ten_danh_muc'] ?></a>
                                    </div>
                                    <h3 class="product-name"><?= $sanPham['ten_san_pham'] ?></h3>
                                    <div class="ratings d-flex">
                                        <div class="pro-review">
                                            <?php $countComment = count($listBinhLuan); ?>
                                            <span><?= $countComment . ' Bình luận' ?></span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai'] > 0) { ?>
                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } else { ?>
                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                        <?php }    ?>

                                    </div>

                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?= $sanPham['so_luong'] . ' sản phẩm' ?></span>
                                    </div>

                                    <p class="pro-desc"><?= $sanPham['mo_ta'] ?></p>
                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST">
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                <div class="pro-qty"><input type="text" value="1" name="so_luong"></div>
                                            </div>
                                            <div class="action_link">
                                                <button class="btn btn-cart2" type="submit">Thêm vào giỏ hàng</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">

                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận
                                                (<?= $countComment ?>)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">

                                        <div class="tab-pane fade show active" id="tab_three">

                                            <div class="tab-content reviews-tab">
                                                <div class="tab-pane fade show active" id="tab_three">

                                                    <!-- Hiển thị danh sách bình luận -->
                                                    <?php foreach ($listBinhLuan as $binhLuan): ?>
                                                        <div class="total-reviews d-flex align-items-start mb-3">
                                                            <div class="rev-avatar me-3">
                                                                <img src="<?= htmlspecialchars($binhLuan['anh_dai_dien']) ?>" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
                                                            </div>
                                                            <div class="review-box w-100">
                                                                <div class="post-author mb-2">
                                                                    <p class="mb-1">
                                                                        <strong><?= htmlspecialchars($binhLuan['ho_ten']) ?></strong>
                                                                        <small class="text-muted ms-2"><?= htmlspecialchars($binhLuan['ngay_dang']) ?></small>
                                                                    </p>
                                                                </div>
                                                                <p class="mb-2"><?= htmlspecialchars($binhLuan['noi_dung']) ?></p>
                                                                <!-- Nút "Thu Hồi Bình Luận" căn phải -->
                                                                <div class="text-end">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <!-- Form gửi bình luận -->
                                                    <form action="<?= BASE_URL . '?act=gui-binh-luan' ?>" method="POST" class="review-form">
                                                        <!-- Gửi ID sản phẩm qua form -->
                                                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">

                                                        <!-- Kiểm tra nếu người dùng chưa đăng nhập -->
                                                        <?php if (!isset($_SESSION['user_client'])): ?>
                                                            <p class="text-danger">Vui lòng <a href="<?= BASE_URL . '?act=login' ?>">đăng nhập</a> để gửi bình luận.</p>
                                                        <?php else: ?>
                                                            <!-- Gửi ID tài khoản người dùng qua form -->
                                                            <input type="hidden" name="tai_khoan_id" value="<?= $_SESSION['user_client'] ?>">

                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label for="binh_luan" class="col-form-label">
                                                                        <span class="text-danger">*</span> Nội Dung Bình Luận
                                                                    </label>
                                                                    <textarea name="binh_luan" class="form-control" id="binh_luan" rows="3" required></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <button type="submit" class="btn btn-primary">Gửi Bình Luận</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                        <p class="sub-title"></p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                        <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngayHienTai = new DateTime();
                                        $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                        if ($tinhNgay->days <= 7) {
                                        ?>
                                            <div class="product-label new">
                                                <span>Mới </span>
                                            </div>
                                            <?php

                                            ?>

                                            <?php
                                            if ($sanPham['gia_khuyen_mai'])
                                            ?>

                                            <div class="product-label discount">
                                                <span>Giảm giá</span>
                                            </div>

                                        <?php
                                    }
                                        ?>



                                    </div>

                                    <div class="cart-hover">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                            <div class="cart-hover"><button class="btn btn-cart">Xem chi tiết</button>
                                        </a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">

                                    <h6 class="product-name">
                                        <a
                                            href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']) { ?>

                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } else {  ?>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                            <!-- product item end -->

                        <?php endforeach  ?>
                        <!-- product item end -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>





<!-- Thêm jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Thêm ElevateZoom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script>
    $(document).ready(function() {
        $('.zoomImg').elevateZoom({
            zoomType: "inner", // Zoom bên trong ảnh
            cursor: "crosshair", // Dùng con trỏ hình chữ thập
            zoomWindowFadeIn: 500, // Hiệu ứng mờ dần khi mở zoom
            zoomWindowFadeOut: 500 // Hiệu ứng mờ dần khi đóng zoom
        });
    });
</script>
<script>
    document.querySelectorAll('.pro-large-img').forEach(function(imgContainer) {
        imgContainer.addEventListener('mousemove', function(e) {
            const img = imgContainer.querySelector('img');
            const rect = imgContainer.getBoundingClientRect();
            const x = e.clientX - rect.left; // Vị trí X chuột
            const y = e.clientY - rect.top; // Vị trí Y chuột
            img.style.transformOrigin = `${x}px ${y}px`; // Tùy chỉnh điểm zoom
            img.style.transform = 'scale(1.5)';
        });

        imgContainer.addEventListener('mouseleave', function() {
            const img = imgContainer.querySelector('img');
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)';
        });
    });
</script>

<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>