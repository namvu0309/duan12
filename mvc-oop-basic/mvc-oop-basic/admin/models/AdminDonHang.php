
<?php
class AdminDonHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id =trang_thai_don_hangs.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi: ' . $e->getMessage();
        }
    }
    public function getAllTrangThaiDonHang()
    {
        try {
            $sql ='SELECT * FROM trang_thai_don_hangs';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'lỗi: ' . $e->getMessage();
        }
    }
    public function getDetailDonHang($id)
    {
        try {
            $sql = 'SELECT don_hangs.*, 
                        trang_thai_don_hangs.ten_trang_thai, 
                        tai_khoans.ho_ten, 
                        tai_khoans.email, 
                        tai_khoans.so_dien_thoai, 
                        phuong_thuc_thanh_toans.ten_phuong_thuc
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
                INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getListSpDonHang($id)
    {
        try {
            // SQL query to fetch the list of products associated with an order
            $sql = 'SELECT chi_tiet_don_hangs.*, san_phams.ten_san_pham
                FROM chi_tiet_don_hangs
                INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                WHERE chi_tiet_don_hangs.don_hang_id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            // Return all matching rows as an array
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Print out error message and include query for debugging
            echo "Error executing query: " . $e->getMessage() . "<br>";
            echo "SQL Query: " . $sql;
            return false;
        }
    }



   

    public function updateDonHang($id, $ten_nguoi_nhan,
    $sdt_nguoi_nhan,
    $email_nguoi_nhan,
    $dia_chi_nguoi_nhan,
    $ghi_chu,
    $trang_thai_id
    )
    {
        try {
            // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
            $sql = 'UPDATE don_hang 
        SET ten_nguoi_nhan = :ten_nguoi_nhan, 
            sdt_nguoi_nhan = :sdt_nguoi_nhan, 
            email_nguoi_nhan = :email_nguoi_nhan, 
            dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan, 
            ghi_chu = :ghi_chu, 
            trang_thai_id = :trang_thai_id
          
        WHERE id = :id';
            // Chuẩn bị statement
            $stmt = $this->conn->prepare($sql);

            // Thực thi statement với các giá trị đã bind
            $stmt->execute([
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':id' => $id
            ]);

            // Trả về true nếu thêm thành công
            return true;
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


    // public function getDetailAnhDonHang($id)
    // {
    //     try {
    //         $sql = 'SELECT *from hinh_anh_trang_thais WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id
    //         ]);
    //         return $stmt->fetch();
    //     } catch (Exception $e) {
    //         echo "Lỗi: " . $e->getMessage();
    //     }
    // }

    // public function updateAnhDonHang($id, $new_file)
    // {
    //     try {
    //         // Chuẩn bị câu lệnh SQL với các placeholders cho dữ liệu
    //         $sql = 'UPDATE hinh_anh_trang_thais
    //     SET link_hinh_anh=:new_file
    //     WHERE id = :id';
    //         // Chuẩn bị statement
    //         $stmt = $this->conn->prepare($sql);

    //         // Thực thi statement với các giá trị đã bind
    //         $stmt->execute([
    //             ':new_file' => $new_file,
    //             ':id' => $id,

    //         ]);

    //         // Trả về true nếu thêm thành công
    //         return true;
    //     } catch (Exception $e) {
    //         // Hiển thị thông báo lỗi nếu có lỗi xảy ra
    //         echo 'Lỗi: ' . $e->getMessage();
    //         return false;
    //     }
    // }
    // public function destroyAnhDonHang($id)
    // {
    //     try {
    //         $sql = 'DELETE FROM hinh_anh_trang_thais WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([':id' => $id]);

    //         // Return true if a row was deleted, false otherwise
    //         return $stmt->rowCount() > 0;
    //     } catch (Exception $e) {
    //         // Log the error instead of displaying it
    //         error_log("Error deleting image with ID $id: " . $e->getMessage());
    //         return false;
    //     }
    // }



    // public function destroyDonHang($id)
    // {
    //     try {
    //         $sql = 'DELETE FROM trang_thais WHERE id = :id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':id' => $id
    //         ]);
    //     } catch (Exception $e) {
    //         echo "Lỗi: " . $e->getMessage();
    //     }
    //     return true;
    // }
}
