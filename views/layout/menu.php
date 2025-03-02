  <!-- Start Header Area -->
  <header class="header-area header-wide">
      <!-- main header start -->
      <div class="main-header d-none d-lg-block">


          <!-- header middle area start -->
          <div class="header-main-area sticky">
              <div class="container">
                  <div class="row align-items-center position-relative">

                      <!-- start logo area -->
                      <div class="col-lg-2">
                          <div class="logo">`
                              <a href="<?= BASE_URL ?>">
                                  <img class="logo-img" src="./views/assets/img/logo/logo.png" alt="Brand Logo">
                              </a>
                          </div>
                      </div>
                      <!-- start logo area -->

                      <!-- main menu area start -->
                      <div class="col-lg-6 position-static">
                          <div class="main-menu-area">
                              <div class="main-menu">
                                  <!-- main menu navbar start -->
                                  <nav class="desktop-menu">
                                      <ul>
                                          <li><a href="<?= BASE_URL ?>">Trang chủ <i></i></a>

                                          </li>

                                          <li><a href="<?= BASE_URL . '?act=san-pham-theo-danh-muc' ?>">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                              <ul class="dropdown">
                                                  <?php foreach ($listDanhMuc as $danhMuc) { ?>
                                                      <li><a href="<?= BASE_URL . '?act=san-pham-theo-danh-muc&danh_muc_id=' . $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></a></li>
                                                  <?php  } ?>
                                              </ul>
                                          </li>
                                          <li><a href="<?= BASE_URL . '?act=gioi-thieu' ?>">Giới thiệu</a></li>
                                          <li><a href="<?= BASE_URL . '?act=lien-he' ?>">Liên hệ</a></li>
                                      </ul>
                                  </nav>

                                  <!-- main menu navbar end -->
                              </div>
                          </div>
                      </div>
                      <!-- main menu area end -->

                      <!-- mini cart area start -->
                      <div class="col-lg-4">
                          <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                              <div class="header-search-container">
                                  <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                  <form class="header-search-box d-lg-none d-xl-block" action="<?= BASE_URL . '?act=search' ?>" method="POST">
                                      <input type="text" name="keyword" placeholder="Nhập tên sản phẩm" class="header-search-field">
                                      <button class="header-search-btn" type="submit"><i class="pe-7s-search"></i></button>
                                  </form>
                              </div>
                              <div class="header-configure-area">

                                  <ul class="nav justify-content-end">

                                      <li class="user-hover">
                                          <a href="#">

                                              <i class="pe-7s-user"></i>
                                          </a>
                                          <ul class="dropdown-list " style="width: 230px;">

                                              <?php if (isset($_SESSION['user_client'])) { ?>
                                                  <li>
                                                      <label for="">
                                                          <?php if (isset($_SESSION['user_client'])): ?>
                                                              <a href="<?= BASE_URL . '?act=tai-khoan' ?>">
                                                                  <?= $_SESSION['user_client']; ?>
                                                              </a>
                                                          <?php endif; ?>
                                                      </label>
                                                  </li>

                                                  <li><a href="<?= BASE_URL . '?act=logout' ?>">Đăng xuất</a></li>
                                                  <li><a href="<?= BASE_URL_ADMIN ?>">Đăng Nhập Admin</a></li>
                                                  <li><a href="<?= BASE_URL . '?act=lich-su-mua-hang' ?>">Đơn Hàng Cá Nhân</a></li>
                                              <?php } else { ?>
                                                  <li><a href="<?= BASE_URL ?>?act=login">Đăng nhập</a></li>
                                                 
                                                  <li><a href="<?= BASE_URL . '?act=form-dang-ky' ?>">Đăng ký</a></li>
                                              <?php } ?>

                                          </ul>
                                      </li>

                                      <li>
                                          <a href="#" class="minicart-btn">
                                              <i class="pe-7s-shopbag"></i>
                                              <div class="notification">2</div>
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!-- mini cart area end -->

                  </div>
              </div>
          </div>
          <!-- header middle area end -->
      </div>
      <!-- main header start -->


  </header>