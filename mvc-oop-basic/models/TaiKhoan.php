<?php

class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // Kiểm tra tài khoản tồn tại
            if (!$user) {
                return 'Tài khoản không tồn tại hoặc thông tin không chính xác';
            }

            // Kiểm tra mật khẩu
            if (!password_verify($mat_khau, $user['mat_khau'])) {
                return 'Mật khẩu không đúng';
            }

            // Kiểm tra vai trò
            if ($user['chuc_vu_id'] == 2) { // Admin
                if ($user['trang_thai'] == 1) {
                    return $user['email']; // Đăng nhập thành công
                } else {
                    return 'Tài khoản bị cấm';
                }
            } else {
                return 'Tài khoản không có quyền đăng nhập admin';
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

}