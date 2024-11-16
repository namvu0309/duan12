<?php

class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email,$mat_khau){
        try{
            $sql = " SELECT * FROM tai_khoans WHERE email= :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email,
                ]
            );
            $user= $stmt->fetch();

            if($user && password_verify($mat_khau,$user['mat_khau'])){
                if($user['chuc_vu_id']==2){ //ADMIN
                   if( $user['trang_thai']==1){
                        return $user['email']; // thanh cong
                   }else {
                        return "Tài khoản bị cấm";
                   }
                }
            }elseif($user && $mat_khau==$user['mat_khau']){
                if($user['chuc_vu_id']==2){ // KHACH HANG
                    return "Tài khoản không có quyền đăng nhập admin";
                }
            }else{
                return 'Vui lòng ki ểm tra lại thông tin đăng nhập';
            }
    
        }catch(Exception $e){
            echo "Lỗi: ".$e->getMessage();
            return  false;
        }
    }
}