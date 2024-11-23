<?php require_once 'layout/header.php' ?>

<?php require_once 'layout/menu.php' ?>
<div class="my-account-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">

                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Thông Tin Tài Khoản</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                        Đơn Hàng</a>

                                    <a href="<?= BASE_URL . '?act=logout' ?>"><i class="fa fa-sign-out"></i> Đăng Xuất</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <div class="tab-pane fade show active" id="account-info" role="tabpanel">

                                        <div class="myaccount-content">
                                            <h5>Chi Tiết Tài Khoản</h5>
                                            <div class="account-details-form">
                                                <form action="<?= BASE_URL . '?act=tai-khoan' ?>" method="POST">
                                                    <input type="hidden" name="tai_khoan_id" value="<?= $thongTin['id'] ?>">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">Họ Tên</label>
                                                                <input type="text" id="first-name" name="ho" placeholder="Nhập họ" value="<?= explode(' ', $thongTin['ho_ten'])[0] ?>">
                                                                <?php if (isset($_SESSION['errors']['ho'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['ho'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name" class="required">Số Điện Thoại</label>
                                                                <input class="form-control" type="number" value="<?= $thongTin['so_dien_thoai'] ?>" name="so_dien_thoai">
                                                                <?php if (isset($_SESSION['errors']['ten'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['so_dien_thoai'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">Ngày Sinh</label>
                                                                <input type="date" id="first-name" name="ngay_sinh" placeholder="Nhập ngày sinh" value="<?= explode(' ', $thongTin['ngay_sinh'])[0] ?>">
                                                                <?php if (isset($_SESSION['errors']['ngay_sinh'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['ngay_sinh'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="gioi_tinh" class="required">Giới Tính</label>
                                                                <select class="form-control" name="gioi_tinh" id="gioi_tinh">
                                                                    <option value="1" <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam</option>
                                                                    <option value="0" <?= $thongTin['gioi_tinh'] == 0 ? 'selected' : '' ?>>Nữ</option>
                                                                </select>
                                                                <?php if (isset($_SESSION['errors']['gioi_tinh'])) { ?>
                                                                    <p class="text-danger"><?= $_SESSION['errors']['gioi_tinh'] ?></p>
                                                                <?php } ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="display-name" class="required">Địa Chỉ</label>
                                                        <input class="form-control" type="text" value="<?= $thongTin['dia_chi'] ?>" name="dia_chi">
                                                        <?php if (isset($_SESSION['errors']['dia_chi'])) { ?>
                                                            <p class="text-danger"><?= $_SESSION['errors']['dia_chi'] ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email</label>
                                                        <input type="email" id="email" name="email" placeholder="Email" value="<?= $thongTin['email'] ?>">
                                                        <?php if (isset($_SESSION['errors']['email'])) { ?>
                                                            <p class="text-danger"><?= $_SESSION['errors']['email'] ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <fieldset>
                                                        <legend>Đổi mật khẩu</legend>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mật khẩu hiện tại</label>
                                                            <input type="password" id="current-pwd" name="old_pass" placeholder="Mật khẩu hiện tại">
                                                            <?php if (isset($_SESSION['errors']['old_pass'])) { ?>
                                                                <p class="text-danger"><?= $_SESSION['errors']['old_pass'] ?></p>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">Mật khẩu mới</label>
                                                                    <input type="password" id="new-pwd" name="new_pass" placeholder="Mật khẩu mới">
                                                                    <?php if (isset($_SESSION['errors']['new_pass'])) { ?>
                                                                        <p class="text-danger"><?= $_SESSION['errors']['new_pass'] ?></p>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Xác nhận mật khẩu</label>
                                                                    <input type="password" id="confirm-pwd" name="confirm_pass" placeholder="Nhập lại mật khẩu mới">
                                                                    <?php if (isset($_SESSION['errors']['confirm_pass'])) { ?>
                                                                        <p class="text-danger"><?= $_SESSION['errors']['confirm_pass'] ?></p>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr" type="submit">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div> <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Orders</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Aug 22, 2018</td>
                                                            <td>Pending</td>
                                                            <td>$3000</td>
                                                            <td><a href="cart.html" class="btn btn-sqr">View</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>July 22, 2018</td>
                                                            <td>Approved</td>
                                                            <td>$200</td>
                                                            <td><a href="cart.html" class="btn btn-sqr">View</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>June 12, 2017</td>
                                                            <td>On Hold</td>
                                                            <td>$990</td>
                                                            <td><a href="cart.html" class="btn btn-sqr">View</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/miniCart.php' ?>

<?php require_once 'layout/footer.php' ?>