         <aside class="main-sidebar sidebar-dark-primary elevation-4">
             <!-- Brand Logo -->
             <a href="../../index3.html" class="brand-link text-center">
                 <img src="./assets/dist/img/tải xuống (1).png" alt="AdminLTE Logo" width="70px" style="border-radius: 100px;">
                 <!--  -->
                 <!-- <span class="brand-text font-weight-light">Admin NBH</span> -->
             </a>

             <!-- Sidebar -->
             <div class="sidebar">
                 <!-- Sidebar user (optional) -->
                 <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                     <div class="image">
                         <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                     </div>
                     <div class="info">
                         <a href="#" class="d-block">Alexander Pierce</a>
                     </div>
                 </div>

                 <!-- SidebarSearch Form -->

                 <!-- Sidebar Menu -->
                 <nav class="mt-2">
                     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                         <li class="nav-item">
                             <a href="index.php" class="nav-link">
                                 <i class="nav-icon fas fa-tachometer-alt"></i>
                                 <p>
                                     Trang chủ
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="index.php?act=danh-muc-mi-pham" class="nav-link">
                                 <i class="nav-icon fas fa-th"></i>
                                 <p>
                                     Danh Mục Mỹ Phẩm
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="index.php?act=san-pham" class="nav-link">
                                 <i class="nav-icon fas fa-coins"></i>
                                 <p>
                                     Sản Phẩm
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon fas fa-user"></i>
                                 <p>Quản lý tài khoản</p>
                                 <i class="fas fa-angle-left right"></i>
                             </a>
                             <ul class="nav nav-treeview">
                                 <li class="nav-item">
                                     <a href="<?= 'index.php?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                                         <i class="nav-icon far fa-user"></i>
                                         <p>Tài khoản quản trị</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="<?= 'index.php?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                                         <i class="nav-icon far fa-user"></i>
                                         <p>Tài khoản khách hàng</p>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="<?= 'index.php?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>" class="nav-link">
                                         <i class="nav-icon far fa-user"></i>
                                         <p>Tài khoản cá nhân</p>
                                     </a>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </nav>
                 <!-- /.sidebar-menu -->
             </div>
             <!-- /.sidebar -->
         </aside>