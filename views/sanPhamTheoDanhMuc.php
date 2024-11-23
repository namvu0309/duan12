<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>




<main>
      
<div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        <li><a href="#">fashionware <span>(10)</span></a></li>
                                        <li><a href="#">kitchenware <span>(5)</span></a></li>
                                        <li><a href="#">electronics <span>(8)</span></a></li>
                                        <li><a href="#">accessories <span>(4)</span></a></li>
                                        <li><a href="#">shoe <span>(5)</span></a></li>
                                        <li><a href="#">toys <span>(2)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">price</h5>
                                <div class="sidebar-body">
                                    <div class="price-range-wrap">
                                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1" data-max="1000"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
                                        <div class="range-slider">
                                            <form action="#" class="d-flex align-items-center justify-content-between">
                                                <div class="price-input">
                                                    <label for="amount">Price: </label>
                                                    <input type="text" id="amount">
                                                </div>
                                                <button class="filter-btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">Brand</h5>
                                <div class="sidebar-body">
                                    <ul class="checkbox-container categories-list">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Studio (3)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">Hastech (4)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->
                        <div class="shop-product-wrap grid-view row mb-4">
                            <!-- product item list wrapper start -->
                            <?php foreach ($spdm as $sanPham): ?>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <!-- product grid start -->
                                    <div class="product-item shadow-sm p-3 mb-5 bg-white rounded">
                                        <figure class="product-thumb">
                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                <img class="pri-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh']  ?>         " alt="product">
                                                <img class="sec-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <?php
                                                // Hiển thị nhãn "Mới" nếu sản phẩm mới trong vòng 7 ngày
                                                $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                $ngayHienTai = new DateTime();
                                                $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                if ($tinhNgay->days <= 7): ?>
                                                    <div class="product-label new">
                                                        <span>Mới</span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="button-group">
                                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Thêm vào yêu thích"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="So sánh"><i class="pe-7s-refresh-2"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Xem nhanh"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                                </a>
                                            </h6>
                                            <div class="price-box">
                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <span class="price-regular text-success">$<?= number_format($sanPham['gia_khuyen_mai'], 2) ?></span>
                                                    <span class="price-old text-muted"><del>$<?= number_format($sanPham['gia_san_pham'], 2) ?></del></span>
                                                <?php else: ?>
                                                    <span class="price-regular">$<?= number_format($sanPham['gia_san_pham'], 2) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                </div>
                            <?php endforeach; ?>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="col-12">
                                <div class="pagination-area text-center">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end pagination area -->
                        </div>

                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>

    
</main>



<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php' ?>
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php' ?>