<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- about us area start -->
    <section class="about-us section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="about-thumb">
                        <img src="https://static.vecteezy.com/system/resources/previews/009/836/222/non_2x/nbh-letter-design-nbh-letter-logo-design-on-black-background-nbh-creative-initials-letter-logo-concept-nbh-letter-design-nbh-letter-logo-design-on-black-background-n-vector.jpg" alt="about thumb">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-content">
                        <h2 class="about-title">Giới thiệu</h2>
                        <h5 class="about-sub-title">
                           Được thành lập ngày 28/10/2024
                        </h5>
                        <p>Chào mừng bạn đến với NBH, cửa hàng mỹ phẩm mới mẻ mang đến cho bạn những sản phẩm làm đẹp chất lượng, an toàn và hiệu quả. Chúng tôi tự hào là điểm đến lý tưởng để bạn khám phá các dòng sản phẩm mỹ phẩm đa dạng, từ skincare chăm sóc da cho đến makeup hoàn hảo, phù hợp với mọi nhu cầu và loại da. Với sứ mệnh mang lại vẻ đẹp tự nhiên và sự tự tin cho mỗi khách hàng, NBH cam kết cung cấp các sản phẩm chính hãng, nguồn gốc rõ ràng, được lựa chọn kỹ càng từ các thương hiệu uy tín trên thị trường.</p>
                        <p>Hãy đến với chúng tôi để trải nghiệm không gian mua sắm thân thiện, dịch vụ tư vấn chuyên nghiệp, và những chương trình ưu đãi hấp dẫn. Đừng bỏ lỡ cơ hội chăm sóc sắc đẹp mỗi ngày với NBH nơi làm đẹp bắt đầu từ sự tin tưởng!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us area end -->

    <!-- team area start -->
    <div class="team-area section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Thành viên</h2>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row mbn-30 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-30">
                        <div class="team-thumb">
                            <img src="assets/img/team/team_member_1.jpg" alt="">
                            <div class="team-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <h6 class="team-member-name">Vũ Trọng Nam</h6>
                            <p>C.E.O & Marketing</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-30">
                        <div class="team-thumb">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSplQCd2AGBm7ykf3qHgbzD2dgzACmYkOmrsQ&s" alt="">
                            <div class="team-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <h6 class="team-member-name">Lê Ngọc Ban</h6>
                            <p>Trưởng Bộ Phận Bán Hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-30">
                        <div class="team-thumb">
                            <img src="assets/img/team/team_member_3.jpg" alt="">
                            <div class="team-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <h6 class="team-member-name">Trần Đức Hiểu</h6>
                            <p>Trưởng Bộ Phận Kho Và Hàng Hóa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- team area end -->
</main>

<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php' ?>
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php' ?>
